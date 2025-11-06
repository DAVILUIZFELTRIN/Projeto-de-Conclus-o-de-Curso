<?php
$page_title = "Nexus - Cadastrar Psicólogo";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $status = $_POST['status'];
    $cpf = $_POST['cpf'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha
    $carteira_identificacao = $_POST['carteira_identificacao'];

    $stmt = $conn->prepare("INSERT INTO psicologos (nome, email, telefone, status, cpf, senha, carteira_identificacao) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $nome, $email, $telefone, $status, $cpf, $senha, $carteira_identificacao);

    if ($stmt->execute()) {
        echo "<script>alert('Psicólogo cadastrado com sucesso!'); window.location.href='listar_psicologos.php';</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
$conn->close();
?>

<div class="container">
    <div class="form-cadastro-moderno">
        <h1>Psicólogo</h1>
        
        <form method="POST" action="cadastrar_psicologo.php">
            <div class="form-row">
                <div class="form-field">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-field">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" required>
                </div>
                <div class="form-field">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="carteira_identificacao">Carteira de Identificação:</label>
                    <input type="number" id="carteira_identificacao" name="carteira_identificacao" required>
                </div>
                <div class="form-field">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="">Selecione...</option>
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-field">
                    <!-- Campo vazio para manter o layout -->
                </div>
            </div>

            <button type="submit" class="btn-submit-moderno">Enviar</button>
        </form>
        
        <div class="form-actions" style="text-align: center; margin-top: 20px;">
            <a href="listar_psicologos.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
