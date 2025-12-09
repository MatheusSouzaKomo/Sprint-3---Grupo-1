<?php
session_start();
include __DIR__ . '/connection.php';
include __DIR__ . '/includes/functions.php';
include __DIR__ . '/includes/breadcrumb.php';

// Proteção: Apenas administradores podem acessar
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['nivel'] !== 'Administração') {
    header("Location: hub.php");
    exit;
}

// Valida o ID do usuário vindo da URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin_users.php?status=invalidid");
    exit;
}

$id_usuario_para_editar = $_GET['id'];

// Busca as informações do usuário a ser editado
$sql = "SELECT nome, email, nivel_acesso FROM login WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario_para_editar);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    // Se o usuário não for encontrado, redireciona de volta com um erro
    header("Location: admin_users.php?status=notfound");
    exit;
}

$niveis_acesso = ['Usuário', 'Administração']; // Opções para o select

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - <?php echo htmlspecialchars($user['nome']); ?></title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boilerplate.css">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>

    <main class="o-container" style="padding-top: var(--space-12); padding-bottom: var(--space-12);">
        <?php
        generate_breadcrumb([
            ['name' => 'Painel Principal', 'url' => '/Sprint-3---Grupo-1/hub.php'],
            ['name' => 'Administração', 'url' => '/Sprint-3---Grupo-1/admin_users.php'],
            ['name' => 'Editar Usuário', 'url' => '#']
        ]);
        ?>

        <h1 class="u-text-center" style="margin-bottom: var(--space-8);">Editar Usuário</h1>
        <div class="c-login-box" style="max-width: 500px; margin: 0 auto;">
            <form action="processa_edicao_admin.php" method="POST" id="admin-edit-form" novalidate>
                <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario_para_editar); ?>">

                <div class="c-form-field">
                    <label for="nome" class="c-form-field__label">Nome:</label>
                    <input type="text" id="nome" name="nome" class="c-form-field__input" value="<?php echo htmlspecialchars($user['nome']); ?>" required>
                </div>

                <div class="c-form-field">
                    <label for="email" class="c-form-field__label">Email:</label>
                    <input type="email" id="email" name="email" class="c-form-field__input" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="c-form-field">
                    <label for="nivel_acesso" class="c-form-field__label">Nível de Acesso:</label>
                    <select id="nivel_acesso" name="nivel_acesso" class="c-form-field__input">
                        <?php foreach ($niveis_acesso as $nivel): ?>
                            <option value="<?php echo $nivel; ?>" <?php if ($user['nivel_acesso'] === $nivel) echo 'selected'; ?>><?php echo $nivel; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="c-form-field">
                    <label for="nova_senha" class="c-form-field__label">Nova Senha (opcional):</label>
                    <input type="password" id="nova_senha" name="nova_senha" class="c-form-field__input" placeholder="Deixe em branco para não alterar">
                </div>

                <div class="c-profile-actions" style="margin-top: var(--space-6); display: flex; gap: var(--space-4);">
                    <button type="submit" class="c-btn c-btn--primary" style="width: 100%;">Salvar Alterações</button>
                    <a href="admin_users.php" class="c-btn" style="width: 100%; text-align: center;">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>