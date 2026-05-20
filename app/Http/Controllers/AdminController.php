<?php

namespace App\Http\Controllers;

use App\Models\{Usuario, Psicologo, Exercicio, Material, EntradaDiario};
use App\Rules\CrpValido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ── Dashboard ────────────────────────────────────────────────────────────
    public function dashboard()
    {
        $stats = [
            'usuarios'            => Usuario::where('tipo', 'usuario')->count(),
            'psicologos_aprovados'=> Psicologo::where('status', 'aprovado')->count(),
            'psicologos_pendentes'=> Psicologo::where('status', 'pendente')->count(),
            'entradas_diario'     => EntradaDiario::count(),
            'exercicios'          => Exercicio::count(),
            'materiais'           => Material::count(),
        ];

        $psicologosPendentes = Psicologo::pendentes()->latest()->take(5)->get();
        $usuariosRecentes    = Usuario::where('tipo', 'usuario')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'psicologosPendentes', 'usuariosRecentes'));
    }

    // ══════════════════════════════════════════════════════════════════════════
    // USUÁRIOS
    // ══════════════════════════════════════════════════════════════════════════
    public function usuarios(Request $request)
    {
        $query = Usuario::where('tipo', 'usuario');

        if ($request->filled('busca')) {
            $b = $request->busca;
            $query->where(fn($q) => $q->where('nome', 'like', "%$b%")->orWhere('email', 'like', "%$b%"));
        }

        $usuarios = $query->latest()->paginate(15);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function showUsuario(int $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function editUsuario(int $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function updateUsuario(Request $request, int $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nome'  => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:usuarios,email,' . $id],
            'tipo'  => ['required', 'in:usuario,admin'],
            'ativo' => ['boolean'],
        ]);

        $dados = $request->only('nome', 'email', 'tipo', 'ativo');
        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $usuario->update($dados);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroyUsuario(int $id)
    {
        Usuario::findOrFail($id)->delete();
        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuário removido.');
    }

    // ══════════════════════════════════════════════════════════════════════════
    // PSICÓLOGOS
    // ══════════════════════════════════════════════════════════════════════════
    public function psicologos(Request $request)
    {
        $query = Psicologo::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('busca')) {
            $b = $request->busca;
            $query->where(fn($q) => $q->where('nome', 'like', "%$b%")
                ->orWhere('crp', 'like', "%$b%")
                ->orWhere('email', 'like', "%$b%"));
        }

        $psicologos = $query->latest()->paginate(15);
        return view('admin.psicologos.index', compact('psicologos'));
    }

    public function showPsicologo(int $id)
    {
        $psicologo = Psicologo::findOrFail($id);
        return view('admin.psicologos.show', compact('psicologo'));
    }

    public function editPsicologo(int $id)
    {
        $psicologo = Psicologo::findOrFail($id);
        return view('admin.psicologos.edit', compact('psicologo'));
    }

    public function updatePsicologo(Request $request, int $id)
    {
        $psicologo = Psicologo::findOrFail($id);

        $request->validate([
            'nome'          => ['required', 'string'],
            'email'         => ['required', 'email', 'unique:psicologos,email,' . $id],
            'crp'           => ['required', new CrpValido(), 'unique:psicologos,crp,' . $id],
            'especialidade' => ['required'],
            'bio'           => ['required', 'min:50'],
            'status'        => ['required', 'in:pendente,aprovado,rejeitado'],
        ]);

        $dados = $request->only('nome', 'email', 'crp', 'especialidade', 'bio', 'modalidade', 'cidade', 'estado', 'valor_consulta', 'status', 'ativo');
        if ($request->filled('password')) {
            $dados['password'] = Hash::make($request->password);
        }

        $psicologo->update($dados);

        return redirect()->route('admin.psicologos.index')
            ->with('success', 'Psicólogo atualizado!');
    }

    public function destroyPsicologo(int $id)
    {
        Psicologo::findOrFail($id)->delete();
        return redirect()->route('admin.psicologos.index')
            ->with('success', 'Psicólogo removido.');
    }

    public function aprovarPsicologo(Request $request, int $id)
    {
        $psicologo = Psicologo::findOrFail($id);
        $acao      = $request->acao ?? 'aprovado';

        $psicologo->update(['status' => $acao]);

        $msg = $acao === 'aprovado'
            ? "Psicólogo {$psicologo->nome} aprovado com sucesso! 🎉"
            : "Candidatura de {$psicologo->nome} rejeitada.";

        return redirect()->back()->with('success', $msg);
    }

    // ══════════════════════════════════════════════════════════════════════════
    // EXERCÍCIOS
    // ══════════════════════════════════════════════════════════════════════════
    public function exercicios()
    {
        $exercicios = Exercicio::orderBy('ordem')->paginate(15);
        return view('admin.exercicios.index', compact('exercicios'));
    }

    public function createExercicio()
    {
        return view('admin.exercicios.create');
    }

    public function storeExercicio(Request $request)
    {
        $request->validate([
            'titulo'           => ['required', 'string'],
            'descricao'        => ['required', 'string'],
            'categoria'        => ['required', 'in:respiracao,meditacao,relaxamento,mindfulness,outro'],
            'duracao_minutos'  => ['required', 'integer', 'min:1'],
        ]);

        $dados = $request->except('passos_texto');
        if ($request->filled('passos_texto')) {
            $dados['passos'] = array_filter(array_map('trim', explode("\n", $request->passos_texto)));
        }
        Exercicio::create($dados);

        return redirect()->route('admin.exercicios.index')
            ->with('success', 'Exercício criado!');
    }

    public function editExercicio(int $id)
    {
        $exercicio = Exercicio::findOrFail($id);
        return view('admin.exercicios.edit', compact('exercicio'));
    }

    public function updateExercicio(Request $request, int $id)
    {
        $exercicio = Exercicio::findOrFail($id);

        $request->validate([
            'titulo'    => ['required', 'string'],
            'descricao' => ['required', 'string'],
            'categoria' => ['required'],
        ]);

        $dados = $request->except('passos_texto');
        if ($request->filled('passos_texto')) {
            $dados['passos'] = array_filter(array_map('trim', explode("\n", $request->passos_texto)));
        }
        $exercicio->update($dados);

        return redirect()->route('admin.exercicios.index')
            ->with('success', 'Exercício atualizado!');
    }

    public function destroyExercicio(int $id)
    {
        Exercicio::findOrFail($id)->delete();
        return redirect()->route('admin.exercicios.index')
            ->with('success', 'Exercício removido.');
    }

    // ══════════════════════════════════════════════════════════════════════════
    // MATERIAIS
    // ══════════════════════════════════════════════════════════════════════════
    public function materiais()
    {
        $materiais = Material::latest()->paginate(15);
        return view('admin.materiais.index', compact('materiais'));
    }

    public function createMaterial()
    {
        return view('admin.materiais.create');
    }

    public function storeMaterial(Request $request)
    {
        $request->validate([
            'titulo'    => ['required', 'string'],
            'descricao' => ['required', 'string'],
            'tipo'      => ['required', 'in:artigo,video,workbook,podcast'],
        ]);

        Material::create($request->all());

        return redirect()->route('admin.materiais.index')
            ->with('success', 'Material criado!');
    }

    public function editMaterial(int $id)
    {
        $material = Material::findOrFail($id);
        return view('admin.materiais.edit', compact('material'));
    }

    public function updateMaterial(Request $request, int $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'titulo'    => ['required', 'string'],
            'descricao' => ['required', 'string'],
            'tipo'      => ['required'],
        ]);

        $material->update($request->all());

        return redirect()->route('admin.materiais.index')
            ->with('success', 'Material atualizado!');
    }

    public function destroyMaterial(int $id)
    {
        Material::findOrFail($id)->delete();
        return redirect()->route('admin.materiais.index')
            ->with('success', 'Material removido.');
    }
}

// NOTE: The storeExercicio and updateExercicio methods above handle 'passos_texto'
// but since AdminController was created before this note, add this helper at the end.
