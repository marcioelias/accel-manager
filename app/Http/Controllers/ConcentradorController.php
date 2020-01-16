<?php

namespace App\Http\Controllers;

use App\Concentrador;
use App\Traits\SearchTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConcentradorController extends Controller
{
    use SearchTrait;
    
    public $fields = [
        'id' => ['label' => 'ID', 'type' => 'int', 'searchParam' => true],
        'server_name' => ['label' => 'BRAS', 'type' => 'string', 'searchParam' => true],
        'ip_address' => ['label' => 'Endereço IP', 'type' => 'string'],
        'port' => ['label' => 'Porta', 'type' => 'int'],
        'active' => ['label' => 'Ativo', 'type' => 'bool']
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->canListarConcentrador()) {
            if (isset($request->searchField)) {
                $whereRaw = $this->getWhereField($request, $this->fields);
                $concentradores = DB::table('concentradores')
                    ->whereRaw($whereRaw)
                    ->paginate();
            } else {
                $concentradores = Concentrador::paginate();
            }

            return View('concentrador.index')
                    ->withFields($this->fields)
                    ->withConcentradores($concentradores);
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
        if (Auth::user()->canCadastrarConcentrador()) {
            return View('concentrador.create');
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
        if (Auth::user()->canCadastrarConcentrador()) {
            $this->validate($request, [
                'server_name' => 'required|unique:concentradores,server_name',
                'ip_address' => 'ipv4|unique:concentradores,ip_address',
                'port' => 'integer|between:1,65535'
            ]);

            try {
                $concentrador = new Concentrador($request->all());
                
                if ($concentrador->save()) {
                    Session::flash('success', __('messages.create_success', [
                        'model' => __('models.concentrador'),
                        'name' => $concentrador->server_name
                    ]));
                    return redirect()->action('ConcentradorController@index');   
                } else {
                    Session::flash('error',  __('messages.create_error', [
                        'model' => __('models.concentrador'),
                        'name' => $concentrador->server_name
                    ]));
                    return back()->withInputs();
                }
            } catch (\Exception $e) {
                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));
                return back()->withInput();
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Concentrador $concentrador)
    {
        if (Auth::user()->canAlterarConcentrador()) {
            return View('concentrador.edit')->withConcentrador($concentrador);
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Concentrador $concentrador)
    {
        if (Auth::user()->canAlterarConcentrador()) {
            $this->validate($request, [
                'server_name' => 'required|unique:concentradores,server_name,'.$concentrador->id.',id',
                'ip_address' => 'ipv4|unique:concentradores,ip_address,'.$concentrador->id.',id',
                'port' => 'integer|between:1,65535'
            ]);

            try {
                $concentrador->fill($request->all());
                
                if ($concentrador->save()) {
                    Session::flash('success', __('messages.update_success', [
                        'model' => __('models.concentrador'),
                        'name' => $concentrador->server_name
                    ]));
                    return redirect()->action('ConcentradorController@index');
    
                } else {
                    Session::flash('error',  __('messages.update_error', [
                        'model' => __('models.concentrador'),
                        'name' => $concentrador->server_name
                    ]));
                    return back()->withInputs();
                }

            } catch (\Exception $e) {
                Session::flash('error', __('messages.exception', [
                    'exception' => $e->getMessage()
                ]));
                return back()->withInput();
            }
        } else {
            Session::flash('error', __('messages.access_denied'));
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concentrador $concentrador)
    {
        if (Auth::user()->canExcluirConcentrador()) {
            try {
                if ($concentrador->delete()) {
                    Session::flash('success', __('messages.delete_success', [
                        'model' => __('models.concentrador'),
                        'name' => $concentrador->server_name
                    ]));
                    return redirect()->action('ConcentradorController@index');
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
}
