<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefone')->nullable();
            $table->string('instituicao');
            $table->string('semestre');
            $table->string('area_estudo');
            $table->text('bio');
            $table->string('foto')->nullable();
            $table->enum('modalidade', ['presencial','online','ambos'])->default('ambos');
            $table->string('cidade')->nullable();
            $table->string('estado', 2)->nullable();
            $table->enum('status', ['pendente','aprovado','rejeitado'])->default('pendente');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('estudantes'); }
};
