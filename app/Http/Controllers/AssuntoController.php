<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Filters\AssuntoFilter;
use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use App\Http\Resources\AssuntoCollection;
use App\Http\Resources\AssuntoResource;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AssuntoFilter();
        $queryItems = $filter->transform($request);

        $assuntosQuery = Assunto::where($queryItems);

        $filter->addSort($request, $assuntosQuery);

        if( $request->has('size') ){
            $assuntos = $assuntosQuery->paginate($request->input('size'));
        }else {
            $assuntos = $assuntosQuery->get();
        }

        return new AssuntoCollection($assuntos);
    }

    /**
     * Display a listing of the resource.
     */
    public function get(Request $request, Assunto $assunto)
    {
        return new AssuntoResource($assunto);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssuntoRequest $request)
    {
        return new AssuntoResource( Assunto::create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssuntoRequest $request, Assunto $assunto)
    {
        $assunto->update($request->all());

        return new AssuntoResource( $assunto );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assunto = Assunto::findOrFail($id);

        return $assunto->delete();
    }
}
