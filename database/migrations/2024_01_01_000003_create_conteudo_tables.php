<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entradas_diario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->integer('nivel_humor')->between(1, 5)->comment('1=Muito triste, 5=Muito feliz');
            $table->text('conteudo');
            $table->json('emocoes_tags')->nullable()->comment('Tags de emoções selecionadas');
            $table->timestamps();
        });

        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('categoria', ['respiracao', 'meditacao', 'relaxamento', 'mindfulness', 'outro']);
            $table->integer('duracao_minutos')->default(5);
            $table->string('icone')->default('fa-spa');
            $table->boolean('ativo')->default(true);
            $table->integer('ordem')->default(0);
            $table->json('passos')->nullable()->comment('Passos do exercício em JSON');
            $table->timestamps();
        });

        Schema::create('materiais', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('tipo', ['artigo', 'video', 'workbook', 'podcast']);
            $table->string('url')->nullable();
            $table->string('arquivo')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('ativo')->default(true);
            $table->integer('visualizacoes')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materiais');
        Schema::dropIfExists('exercicios');
        Schema::dropIfExists('entradas_diario');
    }
};
