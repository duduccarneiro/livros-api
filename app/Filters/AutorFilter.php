<?php

namespace App\Filters;

use Illuminate\Http\Request;

class AutorFilter extends ApiFilter {

    protected $safeParams = [
        'codAu' => ['eq', 'like'],
        'nome' => ['eq', 'like'],
    ];

    protected $columnMap = [
        'codAu' => 'CodAu',
        'nome' => 'Nome'
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
