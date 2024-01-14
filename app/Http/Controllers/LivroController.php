<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Filters\LivroFilter;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Http\Resources\LivroCollection;
use App\Http\Resources\LivroResource;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function get(Request $request, $codl)
    {
        $livro = Livro::where('Codl', $codl)->with(['autores', 'assuntos'])->firstOrFail();
        
        return new LivroResource($livro);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLivroRequest $request)
    {
        $livro = Livro::create($request->all());

        if($request->has('autores')){
            $livro->autores()->sync($request->input('autores'));
        }

        if($request->has('assuntos')){
            $livro->assuntos()->sync($request->input('assuntos'));
        }

        return new LivroResource($livro);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLivroRequest $request, Livro $livro)
    {
        $livro->update($request->all());

        if($request->has('autores')){
            $livro->autores()->sync($request->input('autores'));
        }

        if($request->has('assuntos')){
            $livro->assuntos()->sync($request->input('assuntos'));
        }

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

    public function getRelatorioLivrosPorAutor() {
        $results = \DB::select('SELECT * FROM view_livros_por_autor');

        $autorAtual = "";
        $livroAtual = "";
        $assuntosAtring = "";
        $autores = [];
        foreach($results as $item) {
            if(strcmp($autorAtual, $item->Nome ) != 0){
                $autorAtual = $item->Nome;
                $livroAtual = -1;
                $autores[$item->CodAu] = ['Nome' => $item->Nome, 'Livros' => []];
            }
            if($livroAtual != $item->Codl){
                $livroAtual = $item->Codl;
                if($item->Codl) {
                    $autores[$item->CodAu]['Livros'][$item->Codl] = [
                        'Titulo' => $item->Titulo, 
                        'Editora' => $item->Editora, 
                        'Edicao' => $item->Edicao,
                        'AnoPublicacao' => $item->AnoPublicacao,
                        'Valor' => $item->Valor, 
                        'Assuntos' => []
                    ];
                }
            }
            if($item->CodAs) {
                $autores[$item->CodAu]['Livros'][$item->Codl]['Assuntos'][] = $item->Descricao;
            }
        }
        $pdf = Pdf::loadView('livros.livrosPorAutorReport', ["autores" => $autores]);
        //return $pdf->stream();
        return $pdf->download('livros.pdf');
    }
}
