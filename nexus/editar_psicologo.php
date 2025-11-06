<?php
$page_title = "Nexus - Editar Psicólogo";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$id_psicologo = $_GET['id'] ?? null;
$psicologo = null;

if ($id_psicologo) {
    $stmt = $conn->prepare("SELECT id_psicologo, nome, email, telefone, status, cpf, carteira_identificacao FROM psicologos WHERE id_psicologo = ?");
    $stmt->bind_param("i", $id_psicologo);
    $stmt->execute();
    $result = $stmt->get_result();
    $psicologo = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id_psicologo) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $status = $_POST['status'];
    $cpf = $_POST['cpf'];
    $carteira_identificacao = $_POST['carteira_identificacao'];

    $stmt = $conn->prepare("UPDATE psicologos SET nome = ?, email = ?, telefone = ?, status = ?, cpf = ?, carteira_identificacao = ? WHERE id_psicologo = ?");
    $stmt->bind_param("sssssii", $nome, $email, $telefone, $status, $cpf, $carteira_identificacao, $id_psicologo);

    if ($stmt->execute()) {
        echo "<script>alert('Psicólogo atualizado com sucesso!'); window.location.href='listar_psicologos.php';</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
$conn->close();
?>

<div class="container">
    <?php if ($psicologo): ?>
    <div class="form-cadastro-moderno">
        <h1>Editar Psicólogo</h1>
        
        <form method="POST" action="editar_psicologo.php?id=<?php echo $id_psicologo; ?>">
            <div class="form-row">
                <div class="form-field">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($psicologo['nome']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($psicologo['email']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($psicologo['telefone']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($psicologo['cpf']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="carteira_identificacao">Carteira de Identificação:</label>
                    <input type="number" id="carteira_identificacao" name="carteira_identificacao" value="<?php echo htmlspecialchars($psicologo['carteira_identificacao']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="">Selecione...</option>
                        <option value="A" <?php echo ($psicologo['status'] == 'A') ? 'selected' : ''; ?>>Ativo</option>
                        <option value="I" <?php echo ($psicologo['status'] == 'I') ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-submit-moderno">Atualizar</button>
        </form>
        
        <div class="form-actions" style="text-align: center; margin-top: 20px;">
            <a href="listar_psicologos.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
    <?php else: ?>
        <p style="text-align: center; color: white; font-size: 1.5rem; margin-top: 50px;">Psicólogo não encontrado.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
