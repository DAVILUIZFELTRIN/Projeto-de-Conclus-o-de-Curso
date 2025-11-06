<?php 
$page_title = "Nexus - Solicite uma Proposta";
include 'includes/header_tela_info.php'; 
?>

<!-- Formulário de Solicitação de Proposta -->
<section class="form-section">
    <div class="container">
        <div class="form-container-proposta">
            <h1 class="form-title-proposta">Empresa</h1>
            <p class="form-subtitle-proposta">A melhoria de gestão e cuidado da saúde mental em sua empresa começam aqui!</p>
            
            <form id="contactForm" method="POST" action="processa-formulario.php">
                <div class="form-group-proposta">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                
                <div class="form-group-proposta">
                    <label for="nome_empresa">Nome de sua Empresa:</label>
                    <input type="text" id="nome_empresa" name="nome_empresa" required>
                </div>
                
                <div class="form-group-proposta">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group-proposta">
                    <label for="telefone">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" required>
                </div>
                
                <div class="form-group-proposta">
                    <label for="numero_de_funcionarios">Nº de funcionários:</label>
                    <input type="number" id="numero_de_funcionarios" name="numero_de_funcionarios" required>
                </div>
                
                <div class="form-group-proposta">
                    <label for="porque_procura">O que motivou sua empresa a buscar nossos serviços?</label>
                    <textarea id="porque_procura" name="porque_procura" rows="4" required></textarea>
                </div>
                
                <button type="submit" class="btn-enviar-proposta">Enviar</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
