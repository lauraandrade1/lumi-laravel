<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('psicologos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('crp')->unique()->comment('Número CRP no formato XX/XXXXX');
            $table->string('telefone')->nullable();
            $table->string('especialidade');
            $table->text('bio');
            $table->string('foto')->nullable();
            $table->decimal('valor_consulta', 8, 2)->nullable();
            $table->enum('modalidade', ['presencial', 'online', 'ambos'])->default('ambos');
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable();
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->boolean('ativo')->default(true);
            $table->decimal('avaliacao_media', 3, 2)->default(0.00);
            $table->integer('total_avaliacoes')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('psicologos');
    }
};
