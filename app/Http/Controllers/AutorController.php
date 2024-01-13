<?php

namespace App\Http\Controllers;

use App\Filters\AutorFilter;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Http\Resources\AutorCollection;
use App\Http\Resources\AutorResource;
use App\Models\Autor;
use Error;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new AutorFilter();
        $queryItems = $filter->transform($request);

        $autoresQuery = Autor::where($queryItems);

        $filter->addSort($request, $autoresQuery);

        if( $request->has('size') ){
            $autores = $autoresQuery->paginate($request->input('size'));
        }else {
            $autores = $autoresQuery->get();
        }

        return new AutorCollection($autores);
    }

    /**
     * Display a listing of the resource.
     */
    public function get(Request $request, Autor $autor)
    {
        return new AutorResource($autor);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAutorRequest $request)
    {
        return new AutorResource( Autor::create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAutorRequest $request, Autor $autor)
    {
        $autor->update($request->all());

        return new AutorResource( $autor );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $autor = Autor::findOrFail($id);

        return $autor->delete();
    }
}
