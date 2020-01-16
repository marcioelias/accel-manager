<?php

return [
    'role_structure' => [
        'admin' => [
            'user' => 'c,r,u,d',
            //'profile' => 'c,r,u,d',
            'role' => 'c,r,u,d',
            'concentrador' => 'c,r,u,d',
        ],
        'user' => [
            'user' => 'r,u',
            'profile' => 'r,u'
        ]
    ],
    /* 'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ], */
    'permissions_map' => [
        'c' => 'cadastrar',
        'r' => 'listar',
        'u' => 'alterar',
        'd' => 'excluir'
    ]
];
