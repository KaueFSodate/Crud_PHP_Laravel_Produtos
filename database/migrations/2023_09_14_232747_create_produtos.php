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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("categoria")->constrained("categoria");
            $table->string("nome");
            $table->foreignId("marca")->constrained("marca");
            $table->string("preco");
            $table->float("quantidade");
            $table->foreignId("cor")->constrained("cors");
            $table->string("descricao");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
