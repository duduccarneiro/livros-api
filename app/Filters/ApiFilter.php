<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {

    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request) {
        $eloQuery = [];

        foreach($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if( !isset($query) ) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach($operators as $operator) {
                if( isset($query[$operator])) {
                    if($query[$operator] === '%'){
                        continue;
                    }
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }

    public function addSort(Request $request, $query) {
        if($request->has('sort_by')) {

            $sortBy = $request->input('sort_by');
            $sortByArray = explode(',', $sortBy);

            $orderArray = array();
            if($request->has('order')) {
                $order = $request->input('order');
                $orderArray = explode(',', $order);
            }
            $diferença = count($sortByArray) - count($orderArray);
            if( $diferença != 0 ) {
                $orderArray = array_merge( $orderArray, array_fill($diferença - 1, $diferença, 'asc') );
            }

            $sortInformation = array_combine($sortByArray, $orderArray);

            foreach($sortInformation as $field => $orderDirection){
                $field = $this->columnMap[$field] ?? $field;
                $query->orderBy($field, $orderDirection);
            }
        }
    }
}
