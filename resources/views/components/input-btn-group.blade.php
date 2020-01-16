@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $defaultValue = isset($defaultValue) ? $defaultValue : false;
@endphp

{{--  {{dd($inputValue)}}  --}}
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  

    <div class="input-group">
        <div id="{{$field}}" class="btn-group btn-group-toggle" data-toggle="buttons" >
            @foreach($radioButtons as $radioButton)
            <buttom class="btn btn-secondary {{(($defaultValue) && ($defaultValue == $radioButton['value'])) ? ' active' : ''}}">
                <input type="radio" name="{{$name}}" id="{{$id}}" value="{{$radioButton['value']}}" {{(($defaultValue) && ($defaultValue == $radioButton['value'])) ? ' checked' : ''}}> {{$radioButton['label']}}
            </buttom>
            @endforeach
        </div>
    </div>

    @if ($errors->has($field))
        <span class="invalid-feedback">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>