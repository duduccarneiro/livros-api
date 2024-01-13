<?php

namespace App\Filters;

use Illuminate\Http\Request;

class LivroFilter extends ApiFilter {

    protected $safeParams = [
        'codl' => ['eq', 'like'],
        'titulo' => ['eq', 'like'],
        'editora' => ['eq', 'like'],
        'edicao' => ['eq', 'like'],
        'anoPublicacao' => ['eq', 'like']
    ];

    protected $columnMap = [
        'codl' => 'Codl',
        'titulo' => 'Titulo',
        'editora' => 'Editora',
        'edicao' => 'Edicao',
        'anoPublicacao' => 'AnoPublicacao'
    ];

    protected $operatorMap = [
        'eq'  => '=',
        'ne'  => '!=',
        'lt'  => '<',
        'lte' => '<=',
        'gt'  => '>',
        'gte' => '>=',
        'like' => 'like',
    ];

}
