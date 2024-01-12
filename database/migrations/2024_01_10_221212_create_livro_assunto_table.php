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
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            $table->unsignedBiginteger('Livro_Codl');
            $table->unsignedBiginteger('Assunto_CodAs');

            $table->foreign('Livro_Codl', 'Livro_Assunto_FkIndex1')->references('Codl')
                ->on('Livro')->onDelete('Cascade');
            $table->foreign('Assunto_CodAs', 'Livro_Assunto_FkIndex2')->references('CodAs')
                ->on('Assunto')->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Assunto');
    }
};
