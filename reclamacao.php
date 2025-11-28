<form action="processa_reclamacao.php" method="POST">
    <label>Mensagem de reclamação:</label>
    <input type="text" name="msg_reclamacao" required>

    <label>Setor:</label>
    <select name="setor_reclamacao">
        <option value="1">Saúde</option>
        <option value="2">Educação</option>
        <option value="3">Economia</option>
        <option value="4">Lazer</option>
        <option value="5">Segurança</option>
        <option value="6">Trânsito</option>
    </select>

    <button type="submit">Enviar Reclamação</button>
</form>