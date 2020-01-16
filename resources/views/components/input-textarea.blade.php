@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $rows = isset($rows) ? $rows : 5;
    $div_css = isset($div_css) ? $div_css : '';
@endphp
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{$div_css}} {{ $errors->has($field) ? ' has-error' : '' }}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif
    <textarea rows="{{$rows}}" class="form-control {{$css}}" name="{{$name}}" id="{{$id}}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }}>{!! isset($inputValue) ? nl2br($inputValue) : old($field) !!}</textarea>  

    @if ($errors->has($field))
        <span class="invalid-feedback">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>