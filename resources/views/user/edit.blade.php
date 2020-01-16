@extends('layouts.app')

@section('content')
    <div class="card m-0 border-0">
        @component('components.form', [
            'title' => 'Alterar Usuário', 
            'routeUrl' => route('user.update', $user->id), 
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
                            'autofocus' => true,
                            'inputValue' => $user->name,
                            'inputSize' => 7
                        ],
                        [
                            'type' => 'select',
                            'field' => 'role_id',
                            'label' => 'Perfil', 
                            'inputSize' => 4,
                            'searchById' => false,
                            'items' => $roles,
                            'displayField' => 'display_name',
                            'keyField' => 'id',
                            'indexSelected' => $user->roles()->first()->id
                        ],
                        [
                            'type' => 'select',
                            'field' => 'active',
                            'label' => 'Ativo',
                            'inputSize' => 1,
                            'indexSelected' => $user->active,
                            'items' => Array('Não', 'Sim'),
                            'searchById' => false
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'username',
                            'disabled' => true,
                            'label' => 'Usuário',
                            'required' => true,
                            'inputValue' => $user->username,
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'text',
                            'field' => 'email',
                            'label' => 'E-mail',
                            'required' => true,
                            'inputValue' => $user->email
                        ]
                    ]
                ])
                @endcomponent
                @component('components.form-group', [
                    'inputs' => [
                        [
                            'type' => 'password',
                            'field' => 'password',
                            'label' => 'Senha',
                            'required' => true,
                            'inputSize' => 6
                        ],
                        [
                            'type' => 'password',
                            'field' => 'password_confirmation',
                            'label' => 'Confirmação de Senha',
                            'required' => true,
                            'inputSize' => 6
                        ]
                    ]
                ])
                @endcomponent
            @endsection
        @endcomponent
    </div>
@endsection