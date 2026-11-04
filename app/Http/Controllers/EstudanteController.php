<?php
namespace App\Http\Controllers;

use App\Models\Estudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstudanteController extends Controller
{
    public function index(Request $request)
    {
        $query = Estudante::aprovados();
        if ($request->filled('busca')) {
            $b = $request->busca;
            $query->where(fn($q) => $q->where('nome','like',"%$b%")
                ->orWhere('area_estudo','like',"%$b%")
                ->orWhere('cidade','like',"%$b%"));
        }
        if ($request->filled('area'))      $query->where('area_estudo',$request->area);
        if ($request->filled('modalidade')) $query->where('modalidade',$request->modalidade);

        $estudantes = $query->paginate(12);
        $areas = Estudante::aprovados()->distinct()->pluck('area_estudo');
        return view('estudantes.index', compact('estudantes','areas'));
    }

    public function show(int $id)
    {
        $estudante = Estudante::aprovados()->findOrFail($id);
        return view('estudantes.show', compact('estudante'));
    }

    public function create()
    {
        return view('estudantes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'        => ['required','string','min:3','max:100'],
            'email'       => ['required','email','unique:estudantes,email'],
            'telefone'    => ['nullable','string','max:20'],
            'instituicao' => ['required','string','max:150'],
            'semestre'    => ['required','string','max:20'],
            'area_estudo' => ['required','string','max:100'],
            'bio'         => ['required','string','min:50','max:2000'],
            'modalidade'  => ['required','in:presencial,online,ambos'],
            'cidade'      => ['nullable','string','max:100'],
            'estado'      => ['nullable','string','size:2'],
            'password'    => ['required','confirmed','min:8'],
            'foto'        => ['nullable','image','mimes:jpeg,png,webp','max:2048'],
        ], [
            'nome.required'        => 'O nome é obrigatório.',
            'email.unique'         => 'Este e-mail já está cadastrado.',
            'instituicao.required' => 'A instituição é obrigatória.',
            'semestre.required'    => 'O semestre é obrigatório.',
            'area_estudo.required' => 'A área de estudo é obrigatória.',
            'bio.required'         => 'A biografia é obrigatória.',
            'bio.min'              => 'A biografia deve ter no mínimo 50 caracteres.',
            'password.confirmed'   => 'As senhas não coincidem.',
            'foto.image'           => 'O arquivo deve ser uma imagem.',
            'foto.max'             => 'A imagem deve ter no máximo 2 MB.',
        ]);

        $caminhoFoto = null;
        if ($request->hasFile('foto'))
            $caminhoFoto = $request->file('foto')->store('estudantes/fotos','public');

        Estudante::create([
            'nome'        => $request->nome,
            'email'       => $request->email,
            'telefone'    => $request->telefone,
            'instituicao' => $request->instituicao,
            'semestre'    => $request->semestre,
            'area_estudo' => $request->area_estudo,
            'bio'         => $request->bio,
            'modalidade'  => $request->modalidade,
            'cidade'      => $request->cidade,
            'estado'      => $request->estado ? strtoupper($request->estado) : null,
            'password'    => Hash::make($request->password),
            'foto'        => $caminhoFoto,
            'status'      => 'pendente',
        ]);

        return redirect()->route('psicologos.index')
            ->with('success','Candidatura enviada! Nossa equipe analisará em até 48 horas. 💜');
    }
}
