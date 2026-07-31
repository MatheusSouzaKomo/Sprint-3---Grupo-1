# 🏙️ Guru's City

Portal municipal digital para acompanhamento, avaliação e envio de reclamações sobre os serviços públicos de uma cidade — organizado por setores (Saúde, Educação, Economia, Lazer, Segurança e Trânsito).

Projeto desenvolvido em **PHP + MySQL**, com sistema de autenticação, níveis de acesso, painel administrativo e uma interface responsiva com suporte a tema claro/escuro.

---

## ✨ Funcionalidades

- **Autenticação e cadastro de usuários**, com sessões PHP (`$_SESSION`) e 3 níveis de acesso: `Cidadão`, `Associado` e `Administração`.
- **Painel principal (Hub)** com acesso rápido a cada setor da cidade.
- **Setores da cidade**: Saúde, Educação, Economia, Lazer, Segurança e Trânsito, cada um com sua própria página e conteúdo.
- **Sistema de avaliações**: usuários avaliam um setor com nota (1 a 5) e comentário.
- **Sistema de reclamações**: usuários registram reclamações vinculadas a um setor específico.
- **Painel administrativo**:
  - Gestão de usuários com busca e paginação.
  - Edição e exclusão de contas.
  - Visualização consolidada de todas as avaliações e reclamações da plataforma.
- **Perfil de usuário editável** (dados pessoais e senha).
- **Tema claro/escuro persistente**, com preferência salva no navegador e detecção automática do tema do sistema.
- **Interface responsiva**, com menu lateral (hambúrguer) para dispositivos móveis.
- **Simulador de semáforo interativo** na página do setor de Trânsito, como funcionalidade extra de destaque.

---

## 🛠️ Tecnologias utilizadas

| Camada         | Tecnologia                                   |
|----------------|-----------------------------------------------|
| Back-end       | PHP (mysqli, prepared statements)              |
| Banco de dados | MySQL                                          |
| Front-end      | HTML5, CSS3 (design system com tokens/BEM) e JavaScript puro |

---

## 📁 Estrutura do projeto

```
GuruCityInterwined_G.C.I/
├── crud/
│   ├── ddl_sprint3.sql       # Criação das tabelas do banco
│   └── dml_sprint3.sql       # Dados de exemplo e consultas
├── css/
│   ├── boilerplate.css       # Sistema de layout base
│   └── style.css             # Estilos e temas da aplicação
├── includes/
│   ├── header.php            # Cabeçalho e navegação
│   └── footer.php            # Rodapé
├── sectors/                  # Páginas dos setores da cidade
│   ├── setorSaude.php
│   ├── setorEducacao.php
│   ├── setorEconomia.php
│   ├── setorLazer.php
│   ├── setorSeguranca.php
│   └── setorTransito.php
├── admin_users.php           # Gestão de usuários (admin)
├── admin_visao.php           # Visão geral de avaliações/reclamações (admin)
├── hub.php                   # Painel principal
├── login.php / logout.php    # Autenticação
├── cadastro.php               # Cadastro de novos usuários
├── perfil.php                 # Perfil do usuário logado
├── avaliacao.php               # Formulário de avaliação
├── reclamacao.php               # Formulário de reclamação
├── connection.php               # Configuração da conexão com o banco
└── functions.php                # Funções auxiliares
```

---

## 🔐 Níveis de acesso

| Nível             | Permissões                                                        |
|-------------------|---------------------------------------------------------------------|
| **Cidadão**        | Acessa os setores, envia avaliações e reclamações.                 |
| **Associado**      | Mesmo acesso do Cidadão, com escopo intermediário na plataforma.    |
| **Administração**  | Acesso total: gestão de usuários, visualização de todas as avaliações e reclamações, painel administrativo. |

---

## 🚀 Como executar localmente

### Pré-requisitos
- PHP 7.4+ com extensão `mysqli`
- MySQL/MariaDB
- Servidor local como XAMPP, WAMP, Laragon ou o servidor embutido do PHP

### Passo a passo

1. **Clone o repositório**
   ```bash
   git clone https://github.com/MatheusDev09/GuruCityInterwined_G.C.I.git
   ```

2. **Crie o banco de dados**

   Execute o script de criação das tabelas:
   ```bash
   mysql -u root -p < crud/ddl_sprint3.sql
   ```
   *(Opcional)* Popule com dados de exemplo:
   ```bash
   mysql -u root -p < crud/dml_sprint3.sql
   ```

3. **Configure a conexão com o banco**

   Edite `connection.php` com as credenciais do seu ambiente:
   ```php
   $host = 'localhost';
   $user = 'root';
   $password = '';
   $db = 'sistema_gurus';
   ```

4. **Inicie o servidor**
   ```bash
   php -S localhost:8000
   ```

5. Acesse `http://localhost:8000/hub.php` no navegador.

---

## 🗄️ Modelo de dados

O banco `sistema_gurus` é composto por três tabelas principais:

- **`login`** — usuários da plataforma (nome, e-mail, senha, nível de acesso).
- **`reclamacao`** — reclamações vinculadas a um usuário e a um setor.
- **`avaliacao`** — avaliações (nota + comentário) vinculadas a um usuário e a um setor.

---

## 🧭 Roadmap / melhorias futuras

- Hash de senhas (ex.: `password_hash`), em vez de armazenamento em texto puro.
- Uso de variáveis de ambiente para credenciais do banco.
- Validação e sanitização adicional nos formulários do lado do servidor.

---

## 👥 Autor

Projeto acadêmico desenvolvido por **Matheus Souza** e equipe, como parte da Sprint 3.

---

