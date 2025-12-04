<form action="processa_cadastro.php" method="POST">

    <label>Nome:</label>
        <input type="text" name="nome" required>
    <label>Email:</label>
        <input type="email" name="email" required>
    <label>Senha:</label>
        <input type="password" name="senha" required>

    <label>Nível de acesso (temporário):</label>
    <select name="nivel_acesso" required>
        <option value="Cidadão">Cidadão</option>
        <option value="Associado">Associado</option>
        <option value="Administração">Administração</option>
    </select>

    <button type="submit">Cadastrar</button>
</form>