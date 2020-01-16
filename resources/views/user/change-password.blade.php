@extends('layouts.app')

@section('content')
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Alterar Senha de Acesso', 
            'routeUrl' => route('user.change.password', $user->id), 
            'cancelRoute' => 'user.profile',
            'method' => 'PUT',
            'formButtons' => [
                ['type' => 'submit', 'label' => 'Salvar', 'icon' => 'check'],
                ['type' => 'button', 'label' => 'Cancelar', 'icon' => 'times']
                ]
            ])
            @section('formFields')
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'name',
                            'label' => 'Nome',
                            'required' => true,
                            'disabled' => true,
                            'inputSize' => 6,
                            'inputValue' => $user->name
                        ],
                        [
                            'type' => 'text',
                            'field' => 'email',
                            'label' => 'E-mail',
                            'required' => true,
                            'disabled' => true,
                            'inputSize' => 6,
                            'inputValue' => $user->email
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'password',
                            'field' => 'current_password',
                            'label' => 'Senha Atual',
                            'inputSize' => 4
                        ],
                        [
                            'type' => 'password',
                            'field' => 'password',
                            'label' => 'Nova Senha',
                            'inputSize' => 4
                        ],
                        [
                            'type' => 'password',
                            'field' => 'password_confirmation',
                            'label' => 'Confirmar Nova Senha',
                            'inputSize' => 4
                        ],
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection