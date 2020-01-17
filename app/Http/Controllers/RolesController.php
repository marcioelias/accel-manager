<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\PermissionRole;
use App\RolePermission;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RolesController extends Controller
{
    use SearchTrait;

    public $fields = [
        'id' => ['label' => 'ID', 'type' => 'int', 'searchParam' => true],
        'name' => ['Identificação', 'type' => 'string',  'searchParam' => true],
        'display_name' => ['label' => 'Perfil', 'type' => 'string', 'searchParam' => true],
        'description' => 'Descrição'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarRole()) {
            if ($request->SearchField) {
                $whereRaw = $this->getWhereField($request, $this->fields);
                $roles = Role::whereRaw($whereRaw)
                            ->paginate();
            } else {
                $roles = Role::paginate();
            }

            return View('role.index', [
                'roles' => $roles,
                'fields' => $this->fields
            ]);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->canCadastrarRole()) {
            $permissions = Permission::orderBy('id', 'asc')->get();

            return View('role.create', [
                'permissions' => $permissions
            ]);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        if (Auth::user()->canCadastrarRole()) {
            $this->validate($request, [
                'name' => 'required|string|min:5|max:100|unique:roles',
                'display_name' => 'required|string|max:100|unique:roles'
            ]);

            try {
                DB::beginTransaction();

                $role_id = DB::table('roles')->insertGetId([
                    'name' => $request->name,
                    'display_name' => $request->display_name,
                    'description' => $request->description
                ]);

                $permissions = $request->permissions ?? [];
                foreach ($permissions as $permission) {
                    DB::table('permission_role')->insert([
                        'permission_id' => $permission,
                        'role_id' => $role_id
                    ]);
                }
            } catch (\Exception $e) {
                DB::rollback();

                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));
                return redirect()->back()->withInput();
            }

            DB::commit();
            
            Session::flash('success', __('messages.create_success', [
                'model' => __('models.role'),
                'name' => $request->display_name 
            ]));
            return redirect()->action('RolesController@index');
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if (Auth::user()->canAlterarRole()) {
            $permissions = Permission::orderBy('id', 'asc')->get();        

            foreach ($role->permissions as $permission) {
                $assigned_permissions[] = $permission->id;
            }

            return View('role.edit', [
                'role' => $role,
                'permissions' => $permissions,
                'assigned_permissions' => $assigned_permissions ?? []
            ]);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        if (Auth::user()->canAlterarRole()) {
            $this->validate($request, [
                'name' => 'required|string|min:5|max:100|unique:roles,id,'.$role->id,
                'display_name' => 'required|string|max:100|unique:roles,id,'.$role->id
            ]);

            DB::beginTransaction();
            try {
                DB::table('roles')
                        ->where('id', $role->id)
                        ->update([
                            'display_name' => $request->display_name,
                            'description' => $request->description
                        ]);
                
                $this->updatePermissions($request, $role);
                        
                DB::commit();

                Session::flash('success', __('messages.update_success', [
                    'model' => __('models.role'),
                    'name' => $request->display_name
                ]));
                return redirect()->action('RolesController@index');
                
            } catch (\Exception $e) {
                DB::rollback();
                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));
                return redirect()->back()->withInput();
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (Auth::user()->canExcluirRole()) {
            try {
                if ($role->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.role'),
                        'name' => $role->display_name
                    ]));
                    return redirect()->action('RolesController@index');
                }
            } catch (\Exception $e) {
                switch ($e->getCode()) {
                    case 23000:
                        Session::flash('error', __('messages.fk_exception'));
                        break;
                    default:
                        Session::flash('error', __('messages.exception', [
                            'exception' => $e->getMessage()
                        ]));
                        break;
                }
                return redirect()->action('RolesController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();   
        }
    }

    public function updatePermissions(Request $request, Role $role) {
        $this->removeOldPermissions($request, $role);
        $this->addNewPermissions($request, $role);
    }

    public function removeOldPermissions(Request $request, Role $role) {
        DB::table('permission_role')->where('role_id', $role->id)
                                    ->whereNotIn('permission_id', $request->permissions)
                                    ->delete();
    }

    public function addNewPermissions(Request $request, Role $role) {
        $actualPermissions = DB::table('permission_role')->select('permission_id')->where('role_id', $role->id)->get();
        
        foreach ($request->permissions as $newPermission) {
            $dbPermission = DB::table('permission_role')->where('role_id', $role->id)->where('permission_id', $newPermission)->first();
            if ($dbPermission === null) {
                try {
                    DB::table('permission_role')->insert([
                        'permission_id' => $newPermission,
                        'role_id' => $role->id
                    ]);
                } catch (\Exception $e) {
                    dd($e);
                }
            }
        }
    }
}
