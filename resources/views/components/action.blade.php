<?php
    switch($action) {
        case 'show':
            $btn_style = 'btn-success';
            $btn_icon = 'eye';
            $tooltip = 'Visualizar';
            $permission = 'listar-'.str_replace('_', '-', $model);
            break;
        case 'edit':
            $btn_style = 'btn-warning';
            $btn_icon = 'edit'; 
            $tooltip = 'Editar';
            $permission = 'alterar-'.str_replace('_', '-', $model);
            break;
        case 'destroy':
            $btn_style = 'btn-danger';
            $btn_icon = 'trash-alt';
            $tooltip = 'Remover';
            $permission = 'excluir-'.str_replace('_', '-', $model);
            break;
    }
    $target = isset($target) ? 'target='.$target : '';
?>
@php
    $displayField = isset($displayField) ? $displayField : 'name';
    $keyField = isset($keyField) ? $keyField : 'id';
    $parameters = Request()->request->all() ?? [];
@endphp

{{-- {{ dd(Request()) }} --}}

{{-- @foreach (Request()->request->all() as $key => $value) 
    {{ $key . ' = ' . $value }}
@endforeach --}}

@permission($permission)
@if($action == 'destroy')   
    <form id="deleteForm{{$row->id}}" action="{{route($model.'.'.$action, [$model => $row->$keyField])}}" method="POST" style="display: inline">
        <input type="hidden" name="backUrlParams" value="{{ json_encode(Request()->request->all()) }}">
        <span data-toggle="tooltip" data-placement="top" title="{{$tooltip}}" data-original-title="{{$tooltip}}">
             <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="{{__('Remover ').__('models.'.$model)}}" 
                data-message="Remover {{ __('models.'.$model).': '.$row->$displayField}}?">
                <i class="fas fa-trash-alt"></i>
            </button>
        </span>
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
@else
    <span data-toggle="tooltip" data-placement="top" title="{{$tooltip}}" data-original-title="{{$tooltip}}">
        <a href="{{route($model.'.'.$action, Arr::add($parameters, $model, $row->$keyField))}}" {{ $target }} class="btn btn-sm {{$btn_style}}"><i class="fas fa-{{$btn_icon}}"></i></a>
    </span>
@endif
@endpermission

