@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
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
    $dataOffStyle = isset($dataOffStyle) ? $dataOffStyle : 'default';
    $checked = isset($inputValue) ? ($value == $inputValue) : false;
@endphp

<input type="checkbox" 
    name="{{$name}}"
    value="{{$value}}"
    {{ ($checked) ? 'checked' : '' }} 
    data-toggle="toggle" 
    data-width="{{$dataWidth}}" 
    data-on="{{$dataOn}}" 
    data-off="{{$dataOff}}"
    data-size="{{$dataSize}}"
    data-onstyle="{{$dataOnStyle}}"
    data-offstyle="{{$dataOffStyle}}">
    {{$label}}
