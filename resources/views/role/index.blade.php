@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $roles, 
        'model' => 'role',
        'tableTitle' => 'Perfil de Acesso',
        'displayField' => 'display_name',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection