@extends('layouts.app')

@section('content')
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Novo BRAS', 
            'routeUrl' => route('concentrador.store'), 
            'method' => 'POST',
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
                            'inputSize' => 5
                        ],
                        [
                            'type' => 'number',
                            'field' => 'port',
                            'label' => 'Porta',
                            'required' => true,
                            'inputSize' => 2
                        ],
                        [
                            'type' => 'text',
                            'field' => 'password',
                            'label' => 'Senha',
                            'required' => true,
                            'inputSize' => 5
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection
