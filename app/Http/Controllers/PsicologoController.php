<?php

namespace App\Http\Controllers;

use App\Models\Psicologo;
use App\Rules\CrpValido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PsicologoController extends Controller
{
    // ── Listagem pública ─────────────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Psicologo::aprovados();

        if ($request->filled('busca')) {
            $busca = $request->busca;
            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                  ->orWhere('especialidade', 'like', "%{$busca}%")
                  ->orWhere('cidade', 'like', "%{$busca}%");
            });
        }

        if ($request->filled('especialidade')) {
            $query->where('especialidade', $request->especialidade);
        }

        if ($request->filled('modalidade')) {
            $query->where('modalidade', $request->modalidade);
        }

        $psicologos = $query->orderByDesc('avaliacao_media')->paginate(12);

        $especialidades = Psicologo::aprovados()
            ->distinct()
            ->pluck('especialidade');

        return view('psicologos.index', compact('psicologos', 'especialidades'));
    }

    // ── Detalhe ──────────────────────────────────────────────────────────────
    public function show(int $id)
    {
        $psicologo = Psicologo::aprovados()->findOrFail($id);
        return view('psicologos.show', compact('psicologo'));
    }

    // ── Formulário de cadastro ───────────────────────────────────────────────
    public function create()
    {
        return view('psicologos.create');
    }

    // ── Cadastro (com validação de CRP) ──────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'nome'           => ['required', 'string', 'min:3', 'max:100'],
            'email'          => ['required', 'email', 'unique:psicologos,email'],
            'crp'            => ['required', 'string', 'unique:psicologos,crp', new CrpValido()],
            'telefone'       => ['nullable', 'string', 'max:20'],
            'especialidade'  => ['required', 'string', 'max:100'],
            'bio'            => ['required', 'string', 'min:50', 'max:2000'],
            'modalidade'     => ['required', 'in:presencial,online,ambos'],
            'cidade'         => ['nullable', 'string', 'max:100'],
            'estado'         => ['nullable', 'string', 'size:2'],
            'valor_consulta' => ['nullable', 'numeric', 'min:0'],
            'password'       => ['required', 'confirmed', 'min:8'],
        ], [
            'nome.required'          => 'O nome é obrigatório.',
            'email.required'         => 'O e-mail é obrigatório.',
            'email.unique'           => 'Este e-mail já está cadastrado.',
            'crp.required'           => 'O CRP é obrigatório.',
            'crp.unique'             => 'Este CRP já está cadastrado na plataforma.',
            'especialidade.required' => 'A especialidade é obrigatória.',
            'bio.required'           => 'A biografia é obrigatória.',
            'bio.min'                => 'A biografia deve ter no mínimo 50 caracteres.',
            'modalidade.required'    => 'Selecione a modalidade de atendimento.',
            'password.required'      => 'A senha é obrigatória.',
            'password.confirmed'     => 'As senhas não coincidem.',
            'password.min'           => 'A senha deve ter no mínimo 8 caracteres.',
        ]);

        Psicologo::create([
            'nome'           => $request->nome,
            'email'          => $request->email,
            'crp'            => strtoupper($request->crp),
            'telefone'       => $request->telefone,
            'especialidade'  => $request->especialidade,
            'bio'            => $request->bio,
            'modalidade'     => $request->modalidade,
            'cidade'         => $request->cidade,
            'estado'         => $request->estado ? strtoupper($request->estado) : null,
            'valor_consulta' => $request->valor_consulta,
            'password'       => Hash::make($request->password),
            'status'         => 'pendente',
        ]);

        return redirect()->route('psicologos.index')
            ->with('success', 'Candidatura enviada com sucesso! Nossa equipe irá analisá-la em até 48 horas. 💜');
    }

    // ── Validação AJAX do CRP ────────────────────────────────────────────────
    public function validarCrp(Request $request)
    {
        $crp = strtoupper(trim($request->crp ?? ''));

        if (! Psicologo::validarFormatoCrp($crp)) {
            return response()->json([
                'valido'   => false,
                'mensagem' => 'Formato inválido. Use: UF/NNNNN (ex: SP/12345)',
            ]);
        }

        $existe = Psicologo::where('crp', $crp)->exists();
        if ($existe) {
            return response()->json([
                'valido'   => false,
                'mensagem' => 'Este CRP já está cadastrado na plataforma.',
            ]);
        }

        return response()->json([
            'valido'   => true,
            'mensagem' => 'CRP com formato válido! ✓',
        ]);
    }
}
