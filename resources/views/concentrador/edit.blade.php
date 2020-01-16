@extends('layouts.app')

@section('content')
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Alterar Concentrador', 
            'routeUrl' => route('concentrador.update', $concentrador->id), 
            'method' => 'PUT',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Save', 'icon' => 'check'],
                ['type' => 'button', 'label' => 'Cancel', 'icon' => 'times']
                ]
            ])
            @section('formFields')
            @component('components.form-group', [
                'inputs' => [
                    [
                        'type' => 'text',
                        'field' => 'server_name',
                        'label' => 'Nome do BRAS',
                        'required' => true,
                        'inputValue' => $concentrador->server_name
                    ]
                ]
            ])
            @endcomponent
            @component('components.form-group', [
                'inputs' => [
                    [
                        'type' => 'text',
                        'field' => 'ip_address',
                        'label' => 'Endereço IP',
                        'required' => true,
                        'inputSize' => 5,
                        'inputValue' => $concentrador->ip_address
                    ],
                    [
                        'type' => 'number',
                        'field' => 'port',
                        'label' => 'Porta',
                        'required' => true,
                        'inputSize' => 2,
                        'inputValue' => $concentrador->port
                    ],
                    [
                        'type' => 'text',
                        'field' => 'password',
                        'label' => 'Senha',
                        'required' => true,
                        'inputSize' => 5,
                        'inputValue' => $concentrador->password
                    ]
                ]
            ])
            @endcomponent
        @endsection
        @endcomponent
    </div>
@endsection