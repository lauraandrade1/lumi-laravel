# 🧠 Lumi — Plataforma de Autoajuda e Bem-Estar Emocional
### Projeto Laravel — UNIFRAN | Engenharia de Software

---

## 📋 O que foi criado

| Módulo | Descrição |
|--------|-----------|
| **Autenticação** | Login, cadastro, logout com validação completa |
| **Usuários** | Cadastro, perfil, edição, exclusão de conta |
| **Psicólogos** | Cadastro com validação de CRP, aprovação admin, listagem pública |
| **Diário Emocional** | CRUD completo com termômetro de humor e tags de emoção |
| **Exercícios** | Listagem pública por categoria com passo a passo |
| **Materiais** | Artigos, vídeos, workbooks, podcasts |
| **Painel Admin** | Dashboard + CRUD completo de todos os módulos |

---

## ⚙️ Configuração no VS Code / Terminal

### 1. Pré-requisitos
- PHP 8.1+
- Composer
- MySQL (ou XAMPP/WAMP)
- Node.js (opcional, não há assets Vite neste projeto)

### 2. Clonar e instalar dependências
```bash
# Entrar na pasta
cd lumi-laravel

# Instalar dependências PHP
composer install

# Copiar arquivo de ambiente
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate
```

### 3. Configurar banco de dados
Edite o arquivo `.env` e configure:
```env
DB_DATABASE=lumi_db
DB_USERNAME=root
DB_PASSWORD=sua_senha
```

Crie o banco no MySQL:
```sql
CREATE DATABASE lumi_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Rodar migrations e seeders
```bash
# Criar tabelas e popular com dados de exemplo
php artisan migrate --seed
```

### 5. Iniciar o servidor
```bash
php artisan serve
```

Acesse: **http://localhost:8000**

---

## 👥 Contas de acesso criadas pelo Seeder

| Tipo | E-mail | Senha |
|------|--------|-------|
| **Admin** | admin@lumi.com.br | admin123 |
| **Usuário** | ana@teste.com | senha123 |
| **Psicólogo** | mariana@psi.com | psi123 |

---

## 🗂️ Estrutura de Pastas

```
lumi-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php         ← Login/Cadastro/Logout
│   │   │   ├── HomeController.php         ← Página inicial
│   │   │   ├── PsicologoController.php    ← Listagem + cadastro + CRP
│   │   │   ├── UsuarioController.php      ← Perfil do usuário
│   │   │   ├── DiarioController.php       ← CRUD Diário Emocional
│   │   │   ├── ExercicioController.php    ← Listagem exercícios
│   │   │   ├── MaterialController.php     ← Listagem materiais
│   │   │   └── AdminController.php        ← Painel admin (CRUD tudo)
│   │   └── Middleware/
│   │       └── AdminMiddleware.php        ← Proteção de rotas admin
│   ├── Models/
│   │   ├── Usuario.php
│   │   ├── Psicologo.php
│   │   ├── EntradaDiario.php
│   │   ├── Exercicio.php
│   │   └── Material.php
│   └── Rules/
│       └── CrpValido.php                  ← Validação de CRP
├── database/
│   ├── migrations/                        ← 3 arquivos de migration
│   └── seeders/
│       └── DatabaseSeeder.php             ← Dados de exemplo
├── public/
│   ├── css/lumi.css                       ← Todo o CSS (roxo/branco)
│   └── js/lumi.js                         ← JS interativo
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php                  ← Layout principal
│   │   └── admin.blade.php                ← Layout admin com sidebar
│   ├── auth/           login + register
│   ├── home/           página inicial
│   ├── psicologos/     listagem + detalhe + cadastro
│   ├── diario/         index + edit
│   ├── exercicios/     index
│   ├── materiais/      index + show
│   ├── usuario/        perfil + edit
│   └── admin/          dashboard + CRUD de tudo
└── routes/
    └── web.php                            ← Todas as rotas
```

---

## 🔒 Validação de CRP

O CRP é validado em **`app/Rules/CrpValido.php`**:

1. **Formato**: `UF/NNNNN` (ex: `SP/12345`, `06/12345`)
2. **Unicidade**: não permite CRP já cadastrado
3. **Feedback AJAX**: validação em tempo real no formulário
4. **Modo acadêmico**: aceita qualquer CRP com formato válido

> Para integrar com a API real do CFP em produção, descomente o bloco `consultarCfp()` na Rule.

---

## 🎨 Tema Visual

- **Cor primária**: `#7c3aed` (roxo)
- **Cor escura**: `#4c1d95`
- **Fundo**: branco e `#f5f3ff`
- **Fontes**: Inter (corpo) + Playfair Display (títulos)
- **Ícones**: Font Awesome 6

---

## 📌 Rotas Principais

```
GET  /                          → Home
GET  /login                     → Formulário login
POST /login                     → Autenticar
GET  /cadastro                  → Formulário cadastro
POST /cadastro                  → Criar conta
POST /logout                    → Sair

GET  /psicologos                → Listagem pública
GET  /psicologos/{id}           → Perfil do psicólogo
GET  /psicologos/cadastro       → Formulário cadastro psicólogo
POST /psicologos/cadastro       → Salvar candidatura
GET  /psicologos/validar-crp    → Validação AJAX do CRP

GET  /diario                    → Diário (auth)
POST /diario                    → Salvar entrada (auth)
PUT  /diario/{id}               → Atualizar entrada (auth)
DELETE /diario/{id}             → Excluir entrada (auth)

GET  /admin                     → Dashboard admin
GET  /admin/usuarios            → CRUD usuários
GET  /admin/psicologos          → CRUD + aprovação psicólogos
GET  /admin/exercicios          → CRUD exercícios
GET  /admin/materiais           → CRUD materiais
```

---

*Projeto acadêmico — UNIFRAN 2026 | Engenharia de Software*
