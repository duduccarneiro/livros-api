<?php

namespace App\Filters;

use Illuminate\Http\Request;

class AssuntoFilter extends ApiFilter {

    protected $safeParams = [
        'codAs' => ['eq', 'like'],
        'descricao' => ['eq', 'like'],
    ];

    protected $columnMap = [
        'codAs' => 'CodAs',
        'descricao' => 'Descricao'
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
