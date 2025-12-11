<?php
session_start();
include '../connection.php';

// Proteção da página: Apenas administradores podem acessar
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['nivel'] !== 'Administração') {
    header("Location: ../pages/main/hub.php");
    exit;
}

// Função para obter mensagens de status
function get_status_message($status) {
    switch ($status) {
        case 'user_deleted':
            return ['message' => 'Usuário excluído com sucesso.', 'type' => 'success'];
        case 'delete_error':
            return ['message' => 'Erro ao excluir o usuário.', 'type' => 'danger'];
        case 'user_updated':
            return ['message' => 'Usuário atualizado com sucesso.', 'type' => 'success'];
        case 'update_error':
            return ['message' => 'Erro ao atualizar o usuário.', 'type' => 'danger'];
        case 'user_created':
            return ['message' => 'Usuário criado com sucesso.', 'type' => 'success'];
        case 'create_error':
            return ['message' => 'Erro ao criar o usuário.', 'type' => 'danger'];
        case 'self_delete_error':
            return ['message' => 'Você não pode excluir sua própria conta.', 'type' => 'warning'];
        default:
            return null;
    }
}
// Lógica de Busca
$search_term = $_GET['search'] ?? '';
$search_query = "%" . $search_term . "%";

// Lógica de Paginação
$resultados_por_pagina = 10; // Quantos usuários por página
$pagina_atual = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($pagina_atual - 1) * $resultados_por_pagina;

// Contar o total de usuários
$total_usuarios_sql = "SELECT COUNT(*) FROM login WHERE nome LIKE ? OR email LIKE ?";
$stmt_total = $conn->prepare($total_usuarios_sql);
$stmt_total->bind_param("ss", $search_query, $search_query);
$stmt_total->execute();
$total_usuarios = $stmt_total->get_result()->fetch_row()[0];
$total_paginas = ceil($total_usuarios / $resultados_por_pagina);

// Buscar usuários para a página atual
$sql = "SELECT id_usuario, nome, email, nivel_acesso AS nivel FROM login WHERE nome LIKE ? OR email LIKE ? LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $search_query, $search_query, $offset, $resultados_por_pagina);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);

// Mensagens de feedback
$status_message = get_status_message($_GET['status'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Usuários</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/boilerplate.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

     <main style="padding-top: var(--space-12); padding-bottom: var(--space-12);">
        
        <div class="o-container">
            <h1 class="u-text-center" style="margin-bottom: var(--space-8);">Administração de Usuários</h1>

            <!-- Barra de Busca -->
            <div class="c-search-bar">
                <form action="admin_users.php" method="GET">
                    <input type="search" name="search" class="c-search-bar__input" placeholder="Buscar por nome ou email..." value="<?php echo htmlspecialchars($search_term); ?>">
                    <button type="submit" class="c-btn c-btn--primary">Buscar</button>
                </form>
            </div>

            <?php if ($status_message): ?>
                <div class="c-alert c-alert--<?php echo $status_message['type']; ?>">
                    <span><?php echo $status_message['message']; ?></span>
                    <button class="c-alert__close-btn" aria-label="Fechar">&times;</button>
                </div>
            <?php endif; ?>
        </div>

        <div class="c-table-container">
            <table class="c-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Nível</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id_usuario']); ?></td>
                            <td><?php echo htmlspecialchars($user['nome']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['nivel']); ?></td>
                            <td>
                                <div style="display: flex; gap: var(--space-2);">
                                    <a href="edit_user.php?id=<?php echo $user['id_usuario']; ?>" class="c-btn c-btn--primary c-btn--sm">Editar</a>
                                <?php if ($user['id_usuario'] !== $_SESSION['id_usuario']): // Impede que o admin se auto-delete ?>
                                    <form action="delete_user.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.');">
                                        <input type="hidden" name="id_usuario" value="<?php echo $user['id_usuario']; ?>">
                                        <button type="submit" class="c-btn c-btn--danger c-btn--sm">Excluir</button>
                                    </form>
                                <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Componente de Paginação -->
        <div class="o-container">
            <nav class="c-pagination" aria-label="Navegação de página">
                <?php if ($pagina_atual > 1): // Mantém o termo de busca na paginação ?>
                    <a href="?page=<?php echo $pagina_atual - 1; ?>&search=<?php echo urlencode($search_term); ?>" class="c-pagination__link">Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search_term); ?>" class="c-pagination__link <?php if ($i == $pagina_atual) echo 'c-pagination__link--active'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($pagina_atual < $total_paginas): ?>
                    <a href="?page=<?php echo $pagina_atual + 1; ?>&search=<?php echo urlencode($search_term); ?>" class="c-pagination__link">Próxima</a>
                <?php endif; ?>
            </nav>
        </div>

    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>