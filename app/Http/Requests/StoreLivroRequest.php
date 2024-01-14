<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivroRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Titulo' => 'required|max:40',
            'Editora' => 'required|max:40',
            'Edicao' => 'required|integer',
            'AnoPublicacao' => 'required|max:4',
            'Valor' => 'required|decimal:2'
        ];
    }

    public function prepareForValidation()
    {
        if($this->titulo) {
            $this->merge(['Titulo' => $this->titulo]);
        }
        if($this->editora) {
            $this->merge(['Editora' => $this->editora]);
        }
        if($this->edicao) {
            $this->merge(['Edicao' => $this->edicao]);
        }
        if($this->anoPublicacao) {
            $this->merge(['AnoPublicacao' => $this->anoPublicacao]);
        }
        if($this->valor) {
            $this->merge(['Valor' => $this->valor]);
        }
    }
}
