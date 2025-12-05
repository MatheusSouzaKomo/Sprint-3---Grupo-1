<footer class="sac-footer">
    <div class="container">
        <div class="sac-grid">
            
            <div class="sac-info flow">
                <h2>Fale Conosco</h2>
                <p>Tem alguma dúvida sobre os serviços de saúde, trânsito ou segurança? Envie sua mensagem e nossa equipe responderá em breve.</p>
                
                <ul class="sac-contacts">
                    <li><strong>Email:</strong> <a href="mailto:contato@exemplo.com" class="sac-links">contato@exemplo.com</a></li>
                    <li><strong>Tel:</strong> <a href="tel:08001234567" class="sac-links">0800 123 4567</a></li>
                </ul>
            </div>   
            <div class="sac-buttons">
                <a href="avaliacao.php"><button class="sac-btn">Enviar Avaliação</button></a>
                <a href="reclamacao.php"><button class="sac-btn">Enviar Reclamação</button></a>
                <button id="theme-toggle" class="sac-btn">🌙 Modo Noturno</button>
             <?php 

             /* Verifica se o usuário está logado e se é um administrador para exibir o botão de modo desenvolvedor */
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                if (isset($_SESSION['nivel']) && $_SESSION['nivel'] === 'Administração'): 
                ?>
                    <button id="css-toggle" class="sac-btn" style="background: linear-gradient(45deg, #ef4444, #f97316); font-size: 0.85rem;">
                        🔧 Modo Desenvolvedor (CSS Desligado)
                    </button>
                <?php endif; ?>
            </div>

        </div>
    </div>
</footer>