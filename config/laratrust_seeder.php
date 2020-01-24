<?php

return [
    'role_structure' => [
        'admin' => [
            'user' => 'c,r,u,d',
            'role' => 'c,r,u,d',
            'view-graph' => 'a',
            'change-rate-limit' => 'a',
            'drop-pppoe' => 'a'

        ],
        'user' => [
            'user' => 'r,u',
            'profile' => 'r,u'
        ]
    ],
    'permissions_map' => [
        'c' => 'cadastrar',
        'r' => 'listar',
        'u' => 'alterar',
        'd' => 'excluir',
        'a' => 'acessar'
    ]
];
