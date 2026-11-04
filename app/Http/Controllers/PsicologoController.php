<?php
namespace App\Http\Controllers;

use App\Models\Psicologo;
use App\Rules\CrpValido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PsicologoController extends Controller
{
    public function index(Request $request)
    {
        $query = Psicologo::aprovados();
        if ($request->filled('busca')) {
            $b = $request->busca;
            $query->where(fn($q) => $q->where('nome','like',"%$b%")
                ->orWhere('especialidade','like',"%$b%")
                ->orWhere('cidade','like',"%$b%"));
        }
        if ($request->filled('especialidade')) $query->where('especialidade',$request->especialidade);
        if ($request->filled('modalidade'))    $query->where('modalidade',$request->modalidade);

        $psicologos    = $query->orderByDesc('avaliacao_media')->paginate(12);
        $especialidades = Psicologo::aprovados()->distinct()->pluck('especialidade');
        return view('psicologos.index', compact('psicologos','especialidades'));
    }

    public function show(int $id)
    {
        $psicologo = Psicologo::aprovados()->findOrFail($id);
        return view('psicologos.show', compact('psicologo'));
    }

    public function create() { return view('psicologos.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'nome'           => ['required','string','min:3','max:100'],
            'email'          => ['required','email','unique:psicologos,email'],
            'crp'            => ['required','string','unique:psicologos,crp', new CrpValido()],
            'telefone'       => ['nullable','string','max:20'],
            'especialidade'  => ['required','string','max:100'],
            'bio'            => ['required','string','min:50','max:2000'],
            'modalidade'     => ['required','in:presencial,online,ambos'],
            'cidade'         => ['nullable','string','max:100'],
            'estado'         => ['nullable','string','size:2'],
            'valor_consulta' => ['nullable','numeric','min:0'],
            'password'       => ['required','confirmed','min:8'],
            'foto'           => ['nullable','image','mimes:jpeg,png,webp','max:2048'],
        ],[
            'nome.required'          => 'O nome é obrigatório.',
            'email.unique'           => 'Este e-mail já está cadastrado.',
            'crp.unique'             => 'Este CRP já está cadastrado.',
            'especialidade.required' => 'A especialidade é obrigatória.',
            'bio.min'                => 'A biografia deve ter no mínimo 50 caracteres.',
            'password.confirmed'     => 'As senhas não coincidem.',
            'foto.image'             => 'O arquivo deve ser uma imagem.',
            'foto.max'               => 'A imagem deve ter no máximo 2 MB.',
        ]);

        $caminhoFoto = null;
        if ($request->hasFile('foto'))
            $caminhoFoto = $request->file('foto')->store('psicologos/fotos','public');

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
            'foto'           => $caminhoFoto,
        ]);

        return redirect()->route('psicologos.index')
            ->with('success','Candidatura enviada com sucesso! Nossa equipe irá analisá-la em até 48 horas. 💜');
    }

    public function validarCrp(Request $request)
    {
        $crp = strtoupper(trim($request->crp ?? ''));
        if (!Psicologo::validarFormatoCrp($crp))
            return response()->json(['valido'=>false,'mensagem'=>'Formato inválido. Use: UF/NNNNN (ex: SP/12345)']);
        if (Psicologo::where('crp',$crp)->exists())
            return response()->json(['valido'=>false,'mensagem'=>'Este CRP já está cadastrado na plataforma.']);
        return response()->json(['valido'=>true,'mensagem'=>'CRP com formato válido! ✓']);
    }
}
