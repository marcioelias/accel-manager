@extends('layouts.app')

@section('content')
@if (Session::has('success'))
	<div class="alert alert-success alert-dismissible" id="success-alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('success') }}
    </div>
@endif
    <div class="card">
        <div class="card-header">
                <h3>Minha Conta</h3>
        </div>
        <div class="panel card-body">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Dados da Conta
                    </div>
                    <div class="card-body">
                        <div class="well-sm">
                            <h5><strong>Nome:</strong></h5> {{$user->name}}
                        </div> 
                        <div class="well-sm">
                            <h5><strong>E-mail:</strong></h5> {{$user->email}}
                        </div>
                        <div class="well-sm">
                            <h5><strong>Criado em:</strong></h5> {{$user->created_at}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Senha
                    </div>
                    <div class="card-body">
                        <a href="{{route('user.form.change.password')}}" class="btn btn-primary">Alterar minha Senha</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Perfil
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($user->roles as $role)
                                <li class="list-group-item">{{$role->display_name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection