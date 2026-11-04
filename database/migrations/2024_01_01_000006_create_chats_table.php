<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->unsignedBigInteger('destinatario_id');
            $table->string('destinatario_tipo'); // 'psicologo' ou 'estudante'
            $table->timestamps();
        });

        Schema::create('mensagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained('chats')->onDelete('cascade');
            $table->unsignedBigInteger('remetente_id');
            $table->string('remetente_tipo'); // 'usuario', 'psicologo', 'estudante'
            $table->text('conteudo');
            $table->boolean('lida')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('mensagens');
        Schema::dropIfExists('chats');
    }
};
