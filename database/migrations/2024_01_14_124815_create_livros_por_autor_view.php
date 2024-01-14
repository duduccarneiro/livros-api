<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // \DB::statement("
        //     CREATE VIEW view_livros_por_autor 
        //     AS
        //     SELECT * 
        //     FROM Autor a 
        //         LEFT OUTER JOIN Livro_Autor la ON (a.`CodAu` = la.`Autor_CodAu`) 
        //         LEFT OUTER JOIN Livro l ON (l.`Codl` = la.`Livro_Codl`);
        // ");
        \DB::statement("
            CREATE VIEW view_livros_por_autor 
            AS
            SELECT a.*, l.*, assu.*
            FROM Autor a 
                LEFT OUTER JOIN Livro_Autor la ON (a.`CodAu` = la.`Autor_CodAu`) 
                LEFT OUTER JOIN Livro l ON (l.`Codl` = la.`Livro_Codl`) 
                LEFT OUTER JOIN Livro_Assunto las ON (las.`Livro_Codl` = l.`Codl`)
                LEFT OUTER JOIN Assunto assu ON (assu.`CodAs` = las.`Assunto_CodAs`);
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::statement("DROP VIEW view_livros_por_autor;");
    }
};
