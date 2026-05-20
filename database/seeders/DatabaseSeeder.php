<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Psicologo;
use App\Models\Exercicio;
use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin ──────────────────────────────────────────────────────────
        Usuario::create([
            'nome'     => 'Administrador Lumi',
            'email'    => 'admin@lumi.com.br',
            'password' => Hash::make('admin123'),
            'tipo'     => 'admin',
            'ativo'    => true,
        ]);

        // ── Usuário comum de teste ─────────────────────────────────────────
        Usuario::create([
            'nome'            => 'Ana Silva',
            'email'           => 'ana@teste.com',
            'password'        => Hash::make('senha123'),
            'telefone'        => '(11) 91234-5678',
            'data_nascimento' => '1995-03-15',
            'tipo'            => 'usuario',
            'ativo'           => true,
        ]);

        // ── Psicólogos ─────────────────────────────────────────────────────
        $psicologos = [
            [
                'nome'          => 'Dra. Mariana Costa',
                'email'         => 'mariana@psi.com',
                'crp'           => 'SP/12345',
                'especialidade' => 'Ansiedade',
                'bio'           => 'Psicóloga clínica com 8 anos de experiência em terapia cognitivo-comportamental. Especializada no tratamento de transtornos de ansiedade, depressão e estresse. Atendimento humanizado e baseado em evidências científicas.',
                'modalidade'    => 'ambos',
                'cidade'        => 'São Paulo',
                'estado'        => 'SP',
                'valor_consulta'=> 150.00,
                'status'        => 'aprovado',
            ],
            [
                'nome'          => 'Dr. Rafael Mendes',
                'email'         => 'rafael@psi.com',
                'crp'           => 'RJ/67890',
                'especialidade' => 'Depressão',
                'bio'           => 'Psicólogo com formação em psicanálise e terapia sistêmica. Atendo adultos e adolescentes com foco em depressão, luto e questões existenciais. Mais de 10 anos de atuação clínica.',
                'modalidade'    => 'online',
                'cidade'        => 'Rio de Janeiro',
                'estado'        => 'RJ',
                'valor_consulta'=> 130.00,
                'status'        => 'aprovado',
            ],
            [
                'nome'          => 'Dra. Juliana Pereira',
                'email'         => 'juliana@psi.com',
                'crp'           => 'MG/54321',
                'especialidade' => 'Relacionamentos',
                'bio'           => 'Especialista em terapia de casais e relacionamentos. Formação em abordagem humanista e terapia focada nas emoções. Ajudo casais e indivíduos a construírem conexões mais saudáveis e significativas.',
                'modalidade'    => 'ambos',
                'cidade'        => 'Belo Horizonte',
                'estado'        => 'MG',
                'valor_consulta'=> 120.00,
                'status'        => 'aprovado',
            ],
            [
                'nome'          => 'Dr. Carlos Ferreira',
                'email'         => 'carlos@psi.com',
                'crp'           => 'PR/11111',
                'especialidade' => 'Autoestima',
                'bio'           => 'Psicólogo com foco em autoestima, autoconhecimento e desenvolvimento pessoal. Uso de técnicas da terapia de aceitação e compromisso (ACT) e mindfulness para auxiliar no processo terapêutico.',
                'modalidade'    => 'online',
                'cidade'        => 'Curitiba',
                'estado'        => 'PR',
                'valor_consulta'=> 110.00,
                'status'        => 'pendente',
            ],
        ];

        foreach ($psicologos as $p) {
            Psicologo::create(array_merge($p, ['password' => Hash::make('psi123')]));
        }

        // ── Exercícios ─────────────────────────────────────────────────────
        $exercicios = [
            [
                'titulo'          => 'Respiração 4-7-8',
                'descricao'       => 'Técnica de respiração desenvolvida pelo Dr. Andrew Weil para reduzir ansiedade e promover relaxamento profundo. Ideal para momentos de estresse agudo.',
                'categoria'       => 'respiracao',
                'duracao_minutos' => 5,
                'icone'           => 'fa-wind',
                'ordem'           => 1,
                'passos'          => ['Sente-se confortavelmente com as costas retas', 'Expire completamente pela boca', 'Feche a boca e inspire pelo nariz contando 4 segundos', 'Segure a respiração contando até 7', 'Expire completamente pela boca contando até 8', 'Repita o ciclo 3 a 4 vezes'],
            ],
            [
                'titulo'          => 'Meditação da Bondade Amorosa',
                'descricao'       => 'Prática meditativa que cultiva sentimentos de amor e compaixão por si mesmo e pelos outros, reduzindo o autocriticismo e aumentando o bem-estar emocional.',
                'categoria'       => 'meditacao',
                'duracao_minutos' => 10,
                'icone'           => 'fa-heart',
                'ordem'           => 2,
                'passos'          => ['Sente-se em posição confortável e feche os olhos', 'Respire profundamente por alguns momentos', 'Visualize a si mesmo e repita mentalmente: "Que eu seja feliz, que eu seja saudável"', 'Pense em alguém próximo e envie os mesmos votos', 'Expanda para pessoas neutras e difíceis', 'Termine enviando bondade a todos os seres'],
            ],
            [
                'titulo'          => 'Relaxamento Muscular Progressivo',
                'descricao'       => 'Técnica de Jacobson que consiste em tensionar e relaxar grupos musculares sequencialmente, promovendo relaxamento profundo e reduzindo a tensão física associada ao estresse.',
                'categoria'       => 'relaxamento',
                'duracao_minutos' => 15,
                'icone'           => 'fa-spa',
                'ordem'           => 3,
                'passos'          => ['Deite-se confortavelmente', 'Começe pelos pés: tensione por 5 segundos, relaxe por 10', 'Suba pelas panturrilhas, coxas, abdômen', 'Tensione os ombros, braços e mãos', 'Faça a face: contraia, depois relaxe', 'Observe a sensação de relaxamento por todo o corpo'],
            ],
            [
                'titulo'          => 'Body Scan Mindfulness',
                'descricao'       => 'Prática de atenção plena ao corpo, percorrendo cada parte com atenção curiosa e sem julgamento, aumentando a consciência corporal e reduzindo o estresse.',
                'categoria'       => 'mindfulness',
                'duracao_minutos' => 20,
                'icone'           => 'fa-brain',
                'ordem'           => 4,
                'passos'          => ['Deite-se em posição confortável', 'Feche os olhos e faça 3 respirações profundas', 'Leve a atenção para os pés com curiosidade', 'Percorra lentamente cada parte do corpo', 'Observe sensações sem tentar mudá-las', 'Conclua trazendo atenção para a respiração'],
            ],
            [
                'titulo'          => 'Respiração Quadrada',
                'descricao'       => 'Técnica simples e eficaz usada por militares e atletas de elite para recuperar a calma rapidamente em situações de alta pressão.',
                'categoria'       => 'respiracao',
                'duracao_minutos' => 5,
                'icone'           => 'fa-wind',
                'ordem'           => 5,
                'passos'          => ['Inspire por 4 segundos', 'Segure o ar por 4 segundos', 'Expire por 4 segundos', 'Aguarde 4 segundos antes de inspirar de novo', 'Repita por 4 a 8 ciclos'],
            ],
        ];

        foreach ($exercicios as $ex) {
            Exercicio::create(array_merge($ex, ['ativo' => true]));
        }

        // ── Materiais ──────────────────────────────────────────────────────
        $materiais = [
            [
                'titulo'    => 'Como gerenciar a ansiedade no dia a dia',
                'descricao' => 'Artigo completo com estratégias práticas e baseadas em evidências para lidar com a ansiedade no cotidiano, desde técnicas de respiração até mudanças de hábitos.',
                'tipo'      => 'artigo',
                'url'       => 'https://www.psicologiaviva.com.br/blog/ansiedade/',
                'ativo'     => true,
            ],
            [
                'titulo'    => 'Meditação guiada para iniciantes',
                'descricao' => 'Vídeo com meditação guiada especialmente desenvolvida para quem está começando a praticar mindfulness. Duração de 10 minutos.',
                'tipo'      => 'video',
                'url'       => 'https://www.youtube.com/watch?v=exemple',
                'ativo'     => true,
            ],
            [
                'titulo'    => 'Diário de Gratidão — Workbook',
                'descricao' => 'Material interativo para cultivar a gratidão no dia a dia. Inclui exercícios diários, reflexões guiadas e espaço para registros pessoais.',
                'tipo'      => 'workbook',
                'ativo'     => true,
            ],
            [
                'titulo'    => 'Mente em Foco — Podcast de Saúde Mental',
                'descricao' => 'Podcast semanal com episódios sobre saúde mental, bem-estar emocional e autoconhecimento. Entrevistas com psicólogos e especialistas.',
                'tipo'      => 'podcast',
                'url'       => 'https://open.spotify.com/show/exemple',
                'ativo'     => true,
            ],
        ];

        foreach ($materiais as $m) {
            Material::create($m);
        }
    }
}
