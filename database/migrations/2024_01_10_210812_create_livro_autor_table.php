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
        Schema::create('Livro_Autor', function (Blueprint $table) {
            $table->unsignedBiginteger('Livro_Codl');
            $table->unsignedBiginteger('Autor_CodAu');

            $table->foreign('Livro_Codl', 'Livro_Autor_FkIndex1')->references('Codl')
                ->on('Livro')->onDelete('Cascade');
            $table->foreign('Autor_CodAu', 'Livro_Autor_FkIndex2')->references('CodAu')
                ->on('Autor')->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Autor');
    }
};
