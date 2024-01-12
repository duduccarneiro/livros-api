<?php

namespace App\Models;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'Autor';

    protected $primaryKey = 'CodAu';

    public $timestamps = false;

    protected $fillable = ['Nome'];

    public function livros() {
        return $this->belongsToMany(Livro::class, 'Livro_Autor', 'Livro_Codl', 'Autor_CodAu');
    }
}
