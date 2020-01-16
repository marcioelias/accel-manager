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
    $checked = isset($checked) ? $checked : false;
    $indexSelected = isset($indexSelected) ? $indexSelected : old(str_replace('[]', '', $field));
@endphp
<div class="card">
    <div class="card-header">
        <strong>{{$title}}</strong>
    </div>
    <div class="card-body" style="padding: 0px !important;">
        <div style="margin-bottom: 10px; overflow-y:scroll; height:150px; -webkit-overflow-scrolling: touch;">
            <ul class="list-group">
                @foreach($items as $item)
                    @php
                    $inputValue = false
                    @endphp
                    @if(isset($indexSelected))
                    @foreach($indexSelected as $idx)
                        @if($idx == $item->$value)
                            @php
                            $inputValue = $idx
                            @endphp
                        @endif
                    @endforeach
                    @endif
                <li class="list-group-item" style="padding: 0 !important">
                    @component('components.input-simple-checkbox', [
                        'checked' => $checked,
                        'dataWidth' => $dataWidth,
                        'dataOn' => $dataOn,
                        'dataOff' => $dataOff,
                        'dataSize' => $dataSize,
                        'dataOnStyle' => $dataOnStyle,
                        'dataOffStyle' => $dataOffStyle,
                        'label' => $item->$label,
                        'field' => $field, 
                        'value' => $item->$value,
                        'inputValue' => $inputValue
                    ]) 
                    @endcomponent
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
