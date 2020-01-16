@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $numMin = isset($numMin) ? $numMin : '0,00';
    $numMax = isset($numMax) ? $numMax : '999999999,99';
    $numStep = isset($numStep) ? $numStep : 'any';
    $readOnly = $readOnly ?? false;
    $visible = (!$visible) ? 'style=display:none' : '';
@endphp

{{--  {{dd($inputValue)}}  --}}
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}}" {{$visible}} id="div__{{$id}}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  

    <input type="number" class="form-control{{ $errors->has($field) ? ' is-invalid' : '' }} {{$css}}" name="{{$name}}" id="{{$id}}" min="{{$numMin}}" max="{{$numMax}}" step="{{$numStep}}" value="{{ isset($inputValue) ? $inputValue : old($field) }}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }} {{ $readOnly ? 'readonly' : ''}}>

    @if ($errors->has($field))
        <span class="invalid-feedback">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>