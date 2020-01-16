@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $numMin = isset($numMin) ? $numMin : '0';
    $numMax = isset($numMax) ? $numMax : '999999999';
    $numStep = isset($numStep) ? $numStep : '1';
    $readOnly = ($readOnly) ? 'readonly' : '';
@endphp

{{--  {{dd($inputValue)}}  --}}
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  

    <input type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control {{$css}}" name="{{$name}}" id="{{$id}}" min="{{$numMin}}" max="{{$numMax}}" step="{{$numStep}}" value="{{ isset($inputValue) ? $inputValue : old($field) }}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }}  {{$readOnly}}>

    @if ($errors->has($field))
        <span class="help-block">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>