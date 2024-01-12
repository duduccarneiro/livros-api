<?php

namespace App\Models;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assunto extends Model
{
    use HasFactory;

    protected $table = 'Assunto';

    protected $primaryKey = 'CodAs';

    public $timestamps = false;

    protected $fillable = ['Descricao'];

    public function livros() {
        return $this->belongsToMany(Livro::class, 'Livro_Assunto', 'Livro_Codl', 'Assunto_CodAs');
    }
}
