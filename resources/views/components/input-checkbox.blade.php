@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-1';
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $name = isset($name) ? $name : $field;
    $id = isset($id) ? $id : $name;
    $label = isset($label) ? $label : $name;
    $dataOn = isset($dataOn) ? $dataOn : 'Sim';
    $dataOff = isset($dataOff) ? $dataOff : 'Não';
    $dataWidth = isset($dataWidth) ? $dataWidth : 55;
    $dataSize = isset($dataSize) ? $dataSize : 'mini';
    $dataOnStyle = isset($dataOnStyle) ? $dataOnStyle : 'success';
    $dataOffStyle = isset($dataOffStyle) ? $dataOffStyle : 'secondary';
    $checked = isset($inputValue) ? (($inputValue) || (old($field))) : old($field);
    $permission = isset($permission) ? $permission : true;
@endphp

@permission($permission)
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  

    <input type="checkbox" class="form-control" 
    name="{{$name}}"
    id="{{$id}}"
    value=true
    {{ ($checked) ? 'checked' : '' }} 
    data-toggle="toggle" 
    data-width="{{$dataWidth}}" 
    data-on="{{$dataOn}}" 
    data-off="{{$dataOff}}"
    data-size="{{$dataSize}}"
    data-onstyle="{{$dataOnStyle}}"
    data-offstyle="{{$dataOffStyle}}"
    {{ ($disabled) ? 'disabled=disabled' : '' }}>

    @if ($errors->has($field))
        <span class="help-block">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>
@endpermission
