@extends('layouts.app')

@section('content')
    @component('components.table', [
        'captions' => $fields, 
        'rows' => $concentradores, 
        'model' => 'concentrador',
        'tableTitle' => 'BRAS',
        'displayField' => 'server_name',
        'actions' => ['edit', 'destroy']
        ]);
    @endcomponent
@endsection