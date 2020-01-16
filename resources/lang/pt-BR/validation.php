<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O campo :attribute não é um URL válido.',
    'after'                => 'O campo :attribute deve ser uma data depois :date.',
    'after_or_equal'       => 'O campo :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O campo :attribute só pode conter letras.',
    'alpha_dash'           => 'O campo :attribute só pode conter letras, números e traços.',
    'alpha_num'            => 'O campo :attribute só pode conter letras e números.',
    'array'                => 'O campo :attribute deve ser uma matriz.',
    'before'               => 'O campo :attribute deve ser uma data anterior :date.',
    'before_or_equal'      => 'O campo :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O campo :attribute deve ser entre :min e :max.',
        'file'    => 'O campo :attribute deve ser entre :min e :max kilobytes.',
        'string'  => 'O campo :attribute deve ser entre :min e :max caracteres.',
        'array'   => 'O campo :attribute deve ter entre :min e :max itens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'O campo :attribute de confirmação não confere.',
    'date'                 => 'O campo :attribute não é uma data válida.',
    'date_format'          => 'O campo :attribute não corresponde ao formato :format.',
    'different'            => 'Os campos :attribute e :other devem ser diferentes.',
    'digits'               => 'O campo :attribute deve ter :digits dígitos.',
    'digits_between'       => 'O campo :attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => 'O campo :attribute tem dimensões de imagem inválidas.',
    'distinct'             => 'O campo :attribute campo tem um valor duplicado.',
    'email'                => 'O campo :attribute deve ser um endereço de e-mail válido.',
    'exists'               => 'O campo :attribute selecionado é inválido.',
    'file'                 => 'O campo :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute o campo deve ter um valor.',
    'image'                => 'O campo :attribute deve ser uma imagem.',
    'in'                   => 'O campo :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O campo :attribute deve ser um número inteiro.',
    'ip'                   => 'O campo :attribute deve ser um endereço de IP válido.',
    'ipv4'                 => 'O campo :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O campo :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O campo :attribute deve ser uma string JSON válida.',
    'max'                  => [
        'numeric' => 'O campo :attribute não pode ser superior a :max.',
        'file'    => 'O campo :attribute não pode ser superior a :max kilobytes.',
        'string'  => 'O campo :attribute não pode ser superior a :max caracteres.',
        'array'   => 'O campo :attribute não pode ter mais do que :max itens.',
    ],
    'mimes'                => 'O campo :attribute deve ser um arquivo de tipo: :values.',
    'mimetypes'            => 'O campo :attribute deve ser um arquivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo :attribute deve ser pelo menos :min.',
        'file'    => 'O campo :attribute deve ter pelo menos :min kilobytes.',
        'string'  => 'O campo :attribute deve ter pelo menos :min caracteres.',
        'array'   => 'O campo :attribute deve ter pelo menos :min itens.',
    ],
    'not_in'               => 'O campo :attribute selecionado é inválido.',
    'numeric'              => 'O campo :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O campo :attribute tem um formato inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'O campo :attribute é obrigatório exceto quando :other seja :values.',
    'required_with'        => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é obrigatório quando :values está presente.',
    'required_without'     => 'O campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é obrigatório quando nenhum dos :values estão presentes.',
    'same'                 => 'Os campos :attribute e :other devem corresponder.',
    'size'                 => [
        'numeric' => 'O campo :attribute deve ser :size.',
        'file'    => 'O campo :attribute deve ser :size kilobytes.',
        'string'  => 'O campo :attribute deve ser :size caracteres.',
        'array'   => 'O campo :attribute deve conter :size itens.',
    ],
    'string'               => 'O campo :attribute deve ser uma string.',
    'timezone'             => 'O campo :attribute deve ser uma zona válida.',
    'unique'               => 'O campo :attribute já está sendo utilizado.',
    'uploaded'             => 'O campo :attribute falha no upload.',
    'url'                  => 'O campo :attribute tem um formato inválido.',
    'cpfCnpj'              => 'O número informado no campo :attribute não é válido.',
    'telefone'             => 'O campo :attribute não representa um telefone válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        /* tanques */
        'descricao_tanque' => 'Tanque',
        'capacidade' => 'Capacidade',
        'combustivel_id' => 'Combustível',
        /* grupo de produtos */
        'grupo_produto' => 'Grupo de Produto',
        /* modelos de bombas */
        'modelo_bomba' => 'Modelo de Bomba', 
        'num_bicos' => 'Núm. Bicos',
        /* tipo de bomba */
        'tipo_bomba' => 'Tipo de Bomba',
        /* unidade de produto */
        'unidade' => 'Unidade',
        'permite_fracionamento' => 'Permite Fracionamento',
        /* produto */
        'produto_descricao' => 'Descrição',
        'produto_desc_red' => 'Descrição Reduzida',
        'unidade_id' => 'Unidade',
        'grupo_produto_id' => 'Grupo',
        'valor_unitario' => 'Valor Unitário',
        'qtd_estoque' => 'Qtd. Estoque',
        /* combustivel */
        'descricao' => 'Descrição',
        'descricao_reduzida' => 'Desc. Reduzida',
        'valor' => 'Valor',
        /* marca veículo */
        'marca_veiculo' => 'Marca de Veículo',
        /* modelo veiculo */
        'modelo_veiculo' => 'Modelo de Veículo',
        'capacidade_tanque' => 'Capacidade do Tanque',
        /* cliente */
        'nome_razao' => 'Nome/Razão Social',
        'fantasia' => 'Nome Fantasia',
        'cpf_cnpj' => 'CPF/CNPJ',
        'rg_id' => 'RG/IE',
        'fone1' => 'Fone [1]',
        'fone2' => 'Fone [2]',
        'email1' => 'E-mail [1]',
        'email2' => 'E-mail [2]',
        'endereco' => 'Endereço',
        'numero' => 'Número',
        'bairro' => 'Bairro',
        'cidade' => 'Cidade',
        'uf' => 'UF',
        'cliente_id' => 'Cliente',
        'veiculo_id' => 'Veículo',
        'km_veiculo' => 'KM do Veículo',
        'volume abastecimento' => 'Quantidade',
        'campo valor' => 'Valor Unitário',
        'valor abastecimento' => 'Valor Total',
        'eh_afericao' => 'Aferição',
        'true' => 'Verdadeiro',
        'password' => 'Senha',
        'estoque_id' => 'Estoque',
        'servico' => 'Serviço',
        'grupo_servico_id' => 'Grupo de Serviço',
        'valor_servico' => 'Valor',
    ],

];
