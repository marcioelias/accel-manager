<div class="form-group">      
    <div class="row">
        @foreach($inputs as $input)
            @php
                $input['field'] = isset($input['field']) ? $input['field'] : '';
                $input['inputSize'] = isset($input['inputSize']) ? $input['inputSize'] : '12';
                $input['inputValue'] = isset($input['inputValue']) ? $input['inputValue'] : null;
                $input['css'] = isset($input['css']) ? $input['css'] : '';
                $input['disabled'] = isset($input['disabled']) ? $input['disabled'] : false;
                $input['name'] = isset($input['name']) ? $input['name'] : $input['field'];
                $input['id'] = isset($input['id']) ? $input['id'] : $input['field'];
                $input['displayField'] = isset($input['displayField']) ? $input['displayField'] : $input['field'];
                $input['keyField'] = isset($input['keyField']) ? $input['keyField'] : $input['field'];
                $input['indexSelected'] = isset($input['indexSelected']) ? $input['indexSelected'] : false;
                $input['liveSearch'] = isset($input['liveSearch']) ? $input['liveSearch'] : false;
                $input['rows'] = isset($input['rows']) ? $input['rows'] : 5;
                $input['defaultNone'] = isset($input['defaultNone']) ? $input['defaultNone'] : false;
                $input['sideBySide'] = isset($input['sideBySide']) ? $input['sideBySide'] : false;
                $input['dateTimeFormat'] = isset($input['dateTimeFormat']) ? $input['dateTimeFormat'] : false;
                $input['numMin'] = isset($input['numMin']) ? $input['numMin'] : null;
                $input['numMax'] = isset($input['numMax']) ? $input['numMax'] : null;
                $input['numStep'] = isset($input['numStep']) ? $input['numStep'] : null;
                $input['radioButtons'] = isset($input['radioButtons']) ? $input['radioButtons'] : [];
                $input['defaultValue'] = isset($input['defaultValue']) ? $input['defaultValue'] : false;
                $input['picker_begin'] = isset($input['picker_begin']) ? $input['picker_begin'] : false;
                $input['picker_end'] = isset($input['picker_end']) ? $input['picker_end'] : false;
                $input['div_css'] = isset($input['div_css']) ? $input['div_css'] : '';
                $input['vModel'] = isset($input['vModel']) ? $input['vModel'] : false;
                $input['readOnly'] = isset($input['readOnly']) ? $input['readOnly'] : false;
                $input['maxLength'] = isset($input['maxLength']) ? $input['maxLength'] : false;
                $input['dataWidth'] = isset($input['dataWidth']) ? $input['dataWidth'] : null;
                $input['dataSize'] = isset($input['dataSize']) ? $input['dataSize'] : null;
                $input['dataOn'] = isset($input['dataOn']) ? $input['dataOn'] : null;
                $input['dataOff'] = isset($input['dataOff']) ? $input['dataOff'] : null;
                $input['dataOnStyle'] = isset($input['dataOnStyle']) ? $input['dataOnStyle'] : null;
                $input['dataOffStyle'] = isset($input['dataOffStyle']) ? $input['dataOffStyle'] : null;
                $input['permission'] = isset($input['permission']) ? $input['permission'] : null;
                $input['visible'] = isset($input['visible']) ? $input['visible'] : true;
                $input['searchById'] = isset($input['searchById']) ? $input['searchById']: true;
            @endphp
            @if($input['type'] == 'text')
                @component('components.input-text', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'readOnly' => $input['readOnly'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'text-typeahead')
                @php
                    $initialize_typeahead_scripts = true;
                @endphp
                @component('components.input-text-typeahead', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'file')
                @component('components.input-file', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'textarea')
                @component('components.input-textarea', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'rows' => $input['rows'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'password')
                @component('components.input-password', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'datetime')
                @component('components.input-datetime', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'sideBySide' => $input['sideBySide'],
                    'dateTimeFormat' => $input['dateTimeFormat'],
                    'picker_begin' => $input['picker_begin'],
                    'picker_end' => $input['picker_end'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'select')
                @component('components.input-select', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'items' => $input['items'],
                    'displayField' => $input['displayField'],
                    'keyField' => $input['keyField'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'inputValue' => $input['inputValue'],
                    'indexSelected' => $input['indexSelected'],
                    'liveSearch' => $input['liveSearch'],
                    'defaultNone' => $input['defaultNone'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible'],
                    'searchById' => $input['searchById']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'select-tree')
                @component('components.input-select-tree', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'items' => $input['items'],
                    'displayField' => $input['displayField'],
                    'keyField' => $input['keyField'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'inputValue' => $input['inputValue'],
                    'indexSelected' => $input['indexSelected'],
                    'liveSearch' => $input['liveSearch'],
                    'defaultNone' => $input['defaultNone'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'number')
                @component('components.input-number', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'numMin' => $input['numMin'],
                    'numMax' => $input['numMax'],
                    'numStep' => $input['numStep'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'readOnly' => $input['readOnly'],
                    'visible' => $input['visible']
                ])    
                @endcomponent
            @endif
            @if($input['type'] == 'btn-group')
                @component('components.input-btn-group', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'radioButtons' => $input['radioButtons'],
                    'defaultValue' => $input['defaultValue'],
                    'div_css' => $input['div_css'],
                    'vModel' => $input['vModel'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'hidden')
                @component('components.input-hidden', [
                    'field' => $input['field'],
                    'inputValue' => $input['inputValue'],
                    'id' => $input['id'],
                    'name' => $input['name'],
                    'vModel' => $input['vModel']
                ])
                @endcomponent
            @endif
            @if($input['type'] == 'checkbox')
                @component('components.input-checkbox', [
                    'field' => $input['field'],
                    'label' => $input['label'],
                    'inputSize' => $input['inputSize'],
                    'inputValue' => $input['inputValue'],
                    'dataWidth' => $input['dataWidth'],
                    'dataSize' => $input['dataSize'],
                    'dataOn' => $input['dataOn'],
                    'dataOff' => $input['dataOff'],
                    'dataOnStyle' => $input['dataOnStyle'],
                    'dataOffStyle' => $input['dataOffStyle'],
                    'disabled' => $input['disabled'],
                    'name' => $input['name'],
                    'id' => $input['id'],
                    'css' => $input['css'],
                    'vModel' => $input['vModel'],
                    'readOnly' => $input['readOnly'],
                    'permission' => $input['permission'],
                    'visible' => $input['visible']
                ])
                @endcomponent
            @endif
        @endforeach
    </div>
</div>