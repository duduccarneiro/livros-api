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
            'codl' => $this->Codl,
            'titulo' => $this->Titulo,
            'editora' => $this->Editora,
            'edicao' => $this->Edicao,
            'anoPublicacao' => $this->AnoPublicacao,
        ];
    }
}
