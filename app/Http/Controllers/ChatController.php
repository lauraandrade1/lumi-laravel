<?php
namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Mensagem;
use App\Models\Psicologo;
use App\Models\Estudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Lista todos os chats do usuário logado
    public function index()
    {
        $chats = Chat::where('usuario_id', Auth::id())
            ->with('ultimaMensagem')
            ->orderByDesc('updated_at')
            ->get();

        return view('chat.index', compact('chats'));
    }

    // Abre ou cria chat com um profissional
    public function abrir(Request $request)
    {
        $request->validate([
            'destinatario_id'   => 'required|integer',
            'destinatario_tipo' => 'required|in:psicologo,estudante',
        ]);

        $chat = Chat::firstOrCreate([
            'usuario_id'        => Auth::id(),
            'destinatario_id'   => $request->destinatario_id,
            'destinatario_tipo' => $request->destinatario_tipo,
        ]);

        return redirect()->route('chat.show', $chat->id);
    }

    // Exibe o chat com as mensagens
    public function show(int $id)
    {
        $chat = Chat::where('id',$id)
            ->where('usuario_id', Auth::id())
            ->with('mensagens')
            ->firstOrFail();

        // Marca mensagens do profissional como lidas
        $chat->mensagens()
            ->where('remetente_tipo','!=','usuario')
            ->where('lida', false)
            ->update(['lida' => true]);

        return view('chat.show', compact('chat'));
    }

    // Envia mensagem
    public function enviar(Request $request, int $chatId)
    {
        $request->validate(['conteudo' => 'required|string|max:2000']);

        $chat = Chat::where('id',$chatId)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();

        Mensagem::create([
            'chat_id'        => $chat->id,
            'remetente_id'   => Auth::id(),
            'remetente_tipo' => 'usuario',
            'conteudo'       => $request->conteudo,
        ]);

        $chat->touch();

        return back()->with('success','Mensagem enviada!');
    }

    // Resposta do profissional (rota separada usada via painel deles no futuro)
    public function responder(Request $request, int $chatId)
    {
        $request->validate(['conteudo' => 'required|string|max:2000']);

        // Identifica se é psicólogo ou estudante pela sessão (simplificado)
        $tipo = session('profissional_tipo', 'psicologo');
        $id   = session('profissional_id');

        $chat = Chat::findOrFail($chatId);

        Mensagem::create([
            'chat_id'        => $chat->id,
            'remetente_id'   => $id,
            'remetente_tipo' => $tipo,
            'conteudo'       => $request->conteudo,
        ]);

        $chat->touch();
        return back();
    }
}
