<?php
session_start();
include 'connection.php';

// Verificar se o usuário é admin (você pode ajustar essa verificação)

if (!isset($_SESSION['nivel']) || $_SESSION['nivel'] !== 'Administração') {
    die("Acesso negado. Apenas administradores podem acessar esta página.");
 }

// Buscar avaliações do banco de dados
$sql_avaliacoes = "SELECT a.*, l.nome FROM avaliacao a JOIN login l ON a.id_usuario = l.id_usuario ORDER BY a.id_avaliacao DESC";
$result_avaliacoes = $conn->query($sql_avaliacoes);

// Buscar reclamações do banco de dados
$sql_reclamacoes = "SELECT r.*, l.nome FROM reclamacao r JOIN login l ON r.id_usuario = l.id_usuario ORDER BY r.id_reclamacao DESC";
$result_reclamacoes = $conn->query($sql_reclamacoes);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="theme.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Painel Admin - Avaliações e Reclamações</title>
    <style>
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .admin-container h2 {
            margin-top: 2rem;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: var(--color-text-primary);
            border-bottom: 2px solid var(--color-border);
            padding-bottom: 0.5rem;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--color-card-bg);
            border: 1px solid var(--color-border);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .admin-table thead {
            background: linear-gradient(45deg, #2563eb, #7c3aed, #ec4899);
            color: white;
        }

        .admin-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
        }

        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--color-border);
            color: var(--color-text-primary);
        }

        .admin-table tbody tr:hover {
            background-color: rgba(37, 99, 235, 0.05);
        }

        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        .nota-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
        }

        .nota-5 { background-color: #10b981; }
        .nota-4 { background-color: #3b82f6; }
        .nota-3 { background-color: #f59e0b; }
        .nota-2 { background-color: #ef4444; }
        .nota-1 { background-color: #dc2626; }

        .setor-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            background-color: #2563eb;
            color: white;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .msg-cell {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .msg-cell:hover {
            overflow: visible;
            white-space: normal;
            word-wrap: break-word;
        }

        .admin-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .admin-header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: var(--color-text-primary);
        }

        .admin-header p {
            color: var(--color-text-secondary);
            font-size: 1.1rem;
        }
    </style>
</head>
<body style="background-color: var(--color-background);">
    <?php include 'includes/header.php'; ?>

    <div class="admin-container">
        <div class="admin-header">
            <h1>Painel de Administrador</h1>
            <p>Visualize todas as avaliações e reclamações dos usuários</p>
        </div>

        <!-- SEÇÃO DE AVALIAÇÕES -->
        <h2>📊 Avaliações</h2>
        <?php if ($result_avaliacoes && $result_avaliacoes->num_rows > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Setor</th>
                        <th>Nota</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_avaliacoes->fetch_assoc()): 
                        $nota_class = 'nota-' . $row['nota_avaliacao'];
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><span class="setor-badge"><?php echo htmlspecialchars($row['setor_avaliacao']); ?></span></td>
                            <td><span class="nota-badge <?php echo $nota_class; ?>"><?php echo $row['nota_avaliacao']; ?> ⭐</span></td>
                            <td class="msg-cell" title="<?php echo htmlspecialchars($row['msg_avaliacao']); ?>"><?php echo htmlspecialchars($row['msg_avaliacao']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert error" style="text-align: center; margin-bottom: 2rem;">Nenhuma avaliação registrada.</div>
        <?php endif; ?>

        <!-- SEÇÃO DE RECLAMAÇÕES -->
        <h2>💬 Reclamações</h2>
        <?php if ($result_reclamacoes && $result_reclamacoes->num_rows > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Setor</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result_reclamacoes->fetch_assoc()): 
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nome']); ?></td>
                            <td><span class="setor-badge"><?php echo htmlspecialchars($row['setor_reclamacao']); ?></span></td>
                            <td class="msg-cell" title="<?php echo htmlspecialchars($row['msg_reclamacao']); ?>"><?php echo htmlspecialchars($row['msg_reclamacao']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert error" style="text-align: center; margin-bottom: 2rem;">Nenhuma reclamação registrada.</div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>

</body>
</html>
