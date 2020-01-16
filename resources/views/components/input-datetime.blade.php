@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $items = isset($items) ? $items : false;
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $sideBySide = isset($sideBySide) ? $sideBySide : false;
    $dateTimeFormat = isset($dateTimeFormat) ? $dateTimeFormat : false;
    $picker_begin = isset($picker_begin) ? $picker_begin : '';
    $picker_end = isset($picker_end) ? $picker_end : '';
    $div_css = isset($div_css) ? $div_css : '';
@endphp

{{--  {{dd($inputValue)}}  --}}
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }} {{$div_css}}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  
    
    <div class="form-group">
        <div class="input-group date" id="{{$id}}_picker" data-target-input="nearest">
            <input type="text" class="form-control {{$css}}" name="{{$name}}" id="{{$id}}" value="{{ isset($inputValue) ? $inputValue : old($field) }}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }}>
            <div class="input-group-append" data-target="#{{$id}}_picker" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
            </div>
        </div>
    </div>
    {{--  <div class="input-group date" id="{{$id}}_picker">
        <input type="text" class="form-control {{$css}}" name="{{$name}}" id="{{$id}}" value="{{ isset($inputValue) ? $inputValue : old($field) }}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }}>
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>  --}}

    @if ($errors->has($field))
        <span class="invalid-feedback">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>
@push('document-ready')
$(function () {
        $('#{{$id}}_picker').datetimepicker({
            {{ $sideBySide ? 'sideBySide: true, ' : '' }}
            format : "{{ $dateTimeFormat ? $dateTimeFormat : 'DD/MM/YYYY HH:mm' }}",
            {{ ($picker_end == $id) ? 'useCurrent: false' : '' }}

        });
        $('#{{$id}}_picker').val('{{ isset($inputValue) ? $inputValue : old($field) }}');
        @if($picker_begin == $id) 
            $("#{{$picker_begin}}_picker").on("dp.change", function (e) {
                $('#{{$picker_end}}_picker').data("DateTimePicker").minDate(e.date);
            });
        @endif
        @if($picker_end == $id) 
            $("#{{$picker_end}}_picker").on("dp.change", function (e) {
                $('#{{$picker_begin}}_picker').data("DateTimePicker").maxDate(e.date);
            });
        @endif
    });
@endpush