<?php

namespace App\Models;

use App\Models\Autor;
use App\Models\Assunto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'Livro';

    protected $primaryKey = 'Codl';

    public $timestamps = false;

    protected $fillable = ['Titulo', 'Editora', 'Edicao', 'AnoPublicacao'];

    public function autores() {
        return $this->belongsToMany(Autor::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }

    public function assuntos() {
        return $this->belongsToMany(Assunto::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_CodAs');
    }
}
