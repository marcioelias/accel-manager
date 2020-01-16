<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\RoleUser;
use Illuminate\Http\Request;
use App\Rules\ValidRoleUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class RoleUsersController extends Controller
{
    public $fields = [
        'id' => 'ID',
        'display_name' => 'Perfil',
        'name' => 'Usuário'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarRoleUser()) {
            if ($request->searchField) {
                $roleUsers = DB::table('role_user')
                                ->select('role_user.*', 'roles.display_name', 'users.name')
                                ->join('users', 'users.id', 'role_user.user_id')
                                ->join('roles', 'roles.id', 'role_user.role_id')
                                ->where('roles.display_name', 'like', '%'.$request->searchField.'%')
                                ->orWhere('users.name', 'like', '%'.$request->searchField.'%')
                                ->orWhere('users.email', 'like', '%'.$request->searchField.'%')
                                ->orderBy('role_user.role_id', 'asc')
                                ->paginate();
            } else {
                $roleUsers = DB::table('role_user')
                                ->select('role_user.*', 'roles.display_name', 'users.name')
                                ->join('users', 'users.id', 'role_user.user_id')
                                ->join('roles', 'roles.id', 'role_user.role_id')
                                ->orderBy('role_user.role_id', 'asc')
                                ->paginate();
            }

            return View('role_user.index', [
                    'roleUsers' => $roleUsers,
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
        if (Auth::user()->canCadastrarRoleUser()) {
            return View('role_user.create', [
                'roles' => Role::all(),
                'users' => User::all()
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
        if (Auth::user()->canCadastrarRoleUser()) {
            $role = Role::find($request->role_id);
            $user = User::find($request->user_id);

            $this->validate($request, [
                'role_id' => 'required|numeric',
                'user_id' => ['required', 'numeric', new ValidRoleUser($role, $user)],
            ]);

            try {
                $roleUser = new RoleUser($request->all());
                $roleUser->user_type = 'App\User';
                
                if ($roleUser->save()) {
                    Session::flash('success', __('messages.create_success_f', [
                        'model' => __('models.role_user'),
                        'name' => $roleUser->user->name.' - '.$roleUser->role->display_name
                    ]));
                    return redirect()->action('RoleUsersController@index');
                }
            } catch (\Exception $e) {
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
     public function edit(RoleUser $roleUser)
    {        
        if (Auth::user()->canAlterarRoleUser()) {
            return View('role_user.edit', [
                'users' => User::all(),
                'roles' => Role::all(),
                'roleUser' => $roleUser
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
     * @param  \App\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleUser $roleUser)
    {
        if (Auth::user()->canAlterarRoleUser()) {
            $role = Role::find($request->role_id);
            $user = User::find($request->user_id);

            $this->validate($request, [
                'role_id' => 'numeric|required',
                'user_id' => ['required', 'numeric', new ValidRoleUser($role, $user)],
            ]);

            try {
                $roleUser = RoleUser::find($roleUser->id);
                $roleUser->user_id = $request->user_id;
                $roleUser->role_id = $request->role_id;

                if ($roleUser->save()) {
                    Session::flash('success', __('messages.update_success_f', [
                        'model' => __('models.role_user'),
                        'name' => $roleUser->user->name.' - '.$roleUser->role->display_name
                    ]));
                    return redirect()->action('RoleUsersController@index');
                } 
            } catch (\Exception $e) {
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
     * @param  \App\RoleUser  $roleUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleUser $roleUser)
    {
        if (Auth::user()->canAlterarRoleUser()) {
            try {
                $roleUser = RoleUser::find($roleUser->id);
                if ($roleUser->delete()) {
                    Session::flash('success', __('messages.delete_success_f', [
                        'model' => __('models.role_user'),
                        'name' => $roleUser->user->name.' - '.$roleUser->role->display_name
                    ]));
                    
                    return redirect()->action('RoleUsersController@index');
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
                return redirect()->action('RoleUsersController@index');
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();   
        }
    }
}
