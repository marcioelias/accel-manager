@php
    $inputType = isset($type) ? $type : 'text';
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $required = isset($required) ? $required : false;
    $items = isset($items) ? $items : false;
    $fieldDisplay = isset($fieldDisplay) ? $fieldDisplay : false;
    $disabled = isset($disabled) ? $disabled : false;
@endphp

@if($inputType == 'hidden')           
    <input id="{{$field}}" type="{{$inputType}}" name="{{$field}}" value="{{ isset($value) ? $value : old($field) }}">
@else
    <div class="form-group {{ $errors->has($field) ? ' has-error' : '' }}">      
        <div class="row">
            <div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} col-xg{{$inputSize}}">
                @if(isset($label))
                    @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
                    @endcomponent
                @endif  
                @if($inputType == 'textarea')
                    <textarea class="form-control" rows="5" id="{{$field}}" name="{{$field}}">{{ isset($value) ? $value : old($field) }}</textarea>
                @elseif($inputType == 'select')
                    @component('components.select', ['field' => $field, 'items' => $items, 'fieldDisplay' => $fieldDisplay])
                    @endcomponent
                @else
                    <input id="{{$field}}" type="{{ $inputType }}" class="form-control" name="{{$field}}" value="{{ isset($value) ? $value : old($field) }}" {{ isset($required) ? 'required' : ''  }}  {{ isset($autofocus) ? 'autofocus' : '' }} {{($disabled) ? 'disabled="disabled"' : ''}}>
                @endif
                @if ($errors->has($field))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first($field) }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>
@endif