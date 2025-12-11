<?php
session_start();
include '../../config/connection.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Busca as informações do usuário no banco de dados
$sql = "SELECT nome, email, nivel_acesso FROM login WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result(); // Use get_result() para buscar os dados
$user = $result->fetch_assoc();

if (!$user) {
    echo "Erro: Usuário não encontrado.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - <?php echo htmlspecialchars($user['nome']); ?></title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/boilerplate.css">
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    
    <main class="o-container" style="padding-top: var(--space-12); padding-bottom: var(--space-12);">
        <?php
        generate_breadcrumb([
            ['name' => 'Painel Principal', 'url' => '/Sprint-3---Grupo-1/hub.php'],
            ['name' => 'Meu Perfil', 'url' => '#']
        ]);
        ?>

        <h1 class="u-text-center" style="margin-bottom: var(--space-8);">Meu Perfil</h1>
        <div class="c-login-box" style="max-width: 500px; margin: 0 auto;" id="profile-container">
            <form action="../../actions/auth_editProfile.php" method="POST" id="profile-edit-form" novalidate>
                <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">

                <div class="c-form-field">
                    <label for="nome" class="c-form-field__label">Nome:</label>
                    <input type="text" id="nome" name="nome" class="c-form-field__input" value="<?php echo htmlspecialchars($user['nome']); ?>" readonly required>
                </div>

                <div class="c-form-field">
                    <label for="email" class="c-form-field__label">Email:</label>
                    <input type="email" id="email" name="email" class="c-form-field__input" value="<?php echo htmlspecialchars($user['email']); ?>" readonly required>
                </div>

                <div class="c-form-field">
                    <label for="nivel_acesso" class="c-form-field__label">Nível de Acesso:</label>
                    <input type="text" id="nivel_acesso" name="nivel_acesso" class="c-form-field__input" value="<?php echo htmlspecialchars($user['nivel_acesso']); ?>" readonly>
                </div>

                <div class="c-form-field" id="current-password-wrapper" style="display: none;">
                    <label for="senha_atual" class="c-form-field__label">Senha Atual:</label>
                    <input type="password" id="senha_atual" name="senha_atual" class="c-form-field__input">
                </div>

                <div class="c-form-field" id="new-password-wrapper" style="display: none;">
                    <label for="nova_senha" class="c-form-field__label">Nova Senha:</label>
                    <input type="password" id="nova_senha" name="nova_senha" class="c-form-field__input">
                </div>

                <div class="c-form-field" id="confirm-password-wrapper" style="display: none;">
                    <label for="confirmar_senha" class="c-form-field__label">Confirmar Nova Senha:</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" class="c-form-field__input">
                </div>

                <div class="c-profile-actions" style="margin-top: var(--space-6);">
                    <button type="button" id="edit-profile-btn" class="c-btn c-btn--primary" style="width: 100%;">Editar Perfil</button>
                    
                    <div id="edit-mode-buttons" style="display: none; gap: var(--space-4);">
                        <button type="submit" class="c-btn c-btn--primary" style="width: 100%;">Salvar Alterações</button>
                        <button type="button" id="cancel-edit-btn" class="c-btn" style="width: 100%;">Cancelar</button>
                    </div>
                </div>
            </form>

            <?php if (isset($user['nivel_acesso']) && $user['nivel_acesso'] === 'admin'): ?>
                <div class="c-admin-panel-link" style="margin-top: var(--space-6); border-top: 1px solid #ccc; padding-top: var(--space-6); text-align: center;">
                    <h2 class="u-h4" style="margin-bottom: var(--space-4);">Painel Administrativo</h2>
                    <p style="margin-bottom: var(--space-4);">Você tem acesso às ferramentas de administração do site.</p>
                    <a href="/Sprint-3---Grupo-1/admin_dashboard.php" class="c-btn c-btn--secondary">Acessar Painel de Admin</a>
                </div>
            <?php endif; ?>

            <a href="hub.php" class="c-btn c-btn--primary" style="margin-top: var(--space-6); display: block; text-align: center;">Voltar ao Painel</a>
        </div>
    </main>
    
    <?php include '../../includes/footer.php'; ?>
    <script src="../../assets/js/script.js"></script>
</body>
</html>