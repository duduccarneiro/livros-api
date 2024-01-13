<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Filters\LivroFilter;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Http\Resources\LivroCollection;
use App\Http\Resources\LivroResource;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new LivroFilter();
        $queryItems = $filter->transform($request);

        $livrosQuery = Livro::where($queryItems);

        $filter->addSort($request, $livrosQuery);

        if( $request->has('size') ){
            $livros = $livrosQuery->paginate($request->input('size'));
        }else {
            $livros = $livrosQuery->get();
        }

        return new LivroCollection($livros);
    }

    /**
     * Display a listing of the resource.
     */
    public function get(Request $request, Livro $livro)
    {
        return new LivroResource($livro);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivroRequest $request)
    {
        return new LivroResource( Livro::create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLivroRequest $request, Livro $livro)
    {
        $livro->update($request->all());

        return new LivroResource( $livro );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);

        return $livro->delete();
    }
}
