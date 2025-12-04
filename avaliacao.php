<form action="processa_avaliacao.php" method="POST">
    <label>Mensagem de avaliação:</label>
    <input type="text" name="msg_avaliacao" required>

    <label>Setor:</label>
    <select name="setor_avaliacao" required>
        <option value="1">Saúde</option>
        <option value="2">Educação</option>
        <option value="3">Economia</option>
        <option value="4">Lazer</option>
        <option value="5">Segurança</option>
        <option value="6">Trânsito</option>
    </select>

    <label>Nota (1 a 5):</label>
    <select name="nota_avaliacao" required>
        <option value="1">1 - Péssimo</option>
        <option value="2">2 - Ruim</option>
        <option value="3">3 - Regular</option>
        <option value="4">4 - Bom</option>
        <option value="5">5 - Excelente</option>
    </select>

    <button type="submit">Enviar Avaliação</button>
</form>