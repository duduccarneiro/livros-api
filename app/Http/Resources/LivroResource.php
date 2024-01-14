<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'codL' => $this->Codl,
            'titulo' => $this->Titulo,
            'editora' => $this->Editora,
            'edicao' => $this->Edicao,
            'anoPublicacao' => $this->AnoPublicacao,
            'valor' => $this->Valor,
            'autores' => AutorResource::collection($this->whenLoaded('autores')),
            'assuntos' => AssuntoResource::collection($this->whenLoaded('assuntos')),
        ];
    }
}
