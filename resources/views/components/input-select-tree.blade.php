@php
    $inputSize = isset($inputSize) ? '-'.$inputSize : '-12';
    $disabled = isset($disabled) ? $disabled : false;
    $autofocus = isset($autofocus) ? $autofocus : false;
    $required = isset($required) ? $required : false;
    $css = isset($css) ? $css : '';
    $indexSelected = isset($indexSelected) ? $indexSelected : false;
    $liveSearch = isset($liveSearch) ? $liveSearch : false;
    $defaultNone = isset($defaultNone) ? $defaultNone : false;
    $div_css = isset($div_css) ? $div_css : '';

    if ($items) {
        $traverse = function ($items, $keyField, $indexSelected, $displayField, $field, &$options = [], $prefix = '-') use (&$traverse) {
            foreach ($items as $item) {
                if (($item->$keyField == $indexSelected) || ($item->$keyField == old($field))) {
                    $options[] = '<option value="'.$item->$keyField.'" selected="selected">'.$prefix.' '.$item->$displayField.'</option>';
                } else {
                    $options[] = '<option value="'.$item->$keyField.'">'.$prefix.' '.$item->$displayField.'</option>';
                }
                //echo PHP_EOL.$prefix.' '.$item->name;

                $traverse($item->children, $keyField, $indexSelected, $displayField, $field, $options, $prefix.' - ');
            }
        };
        $traverse($items, $keyField, $indexSelected, $displayField, $field, $options);
    }
@endphp
<div class="col col-sm col-md{{$inputSize}} col-lg{{$inputSize}} {{ $errors->has($field) ? ' has-error' : '' }} {{$div_css}}">
    @if(isset($label))
        @component('components.label', ['label' => $label, 'field' => $field, 'required' => $required])
        @endcomponent
    @endif  
    <select class="form-control selectpicker {{$css}}" {{ $liveSearch ? 'data-live-search=true' : '' }} id="{{$id}}" name="{{$name}}" {{ $required ? 'required' : '' }}  {{ $autofocus ? 'autofocus' : '' }} {{ $disabled ? 'disabled="disabled"' : '' }}>
        @if(isset($options)) 
        @foreach($options as $option)
            {!! $option !!}
        @endforeach
        @endif
    </select>

    @if ($errors->has($field))
        <span class="invalid-feedback">
            <strong>{{ $errors->first($field) }}</strong>
        </span>
    @endif
</div>