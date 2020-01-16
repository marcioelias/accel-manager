@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $roleUsers, 
        'model' => 'role_user',
        'tableTitle' => 'Associação de Usuários e Perfis de Acesso',
        'displayField' => 'name',
        'actions' => ['edit', 'destroy'],
        ]);
    @endcomponent
@endsection