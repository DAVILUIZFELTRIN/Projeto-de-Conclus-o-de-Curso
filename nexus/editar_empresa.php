<?php
$page_title = "Nexus - Editar Empresa";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$id_empresa = $_GET['id'] ?? null;
$empresa = null;

if ($id_empresa) {
    $stmt = $conn->prepare("SELECT id_empresa, nome_empresa, area_atuacao, endereco, telefone, email, cnpj, porte_empresarial, numero_de_funcionarios, data_consulta FROM empresas WHERE id_empresa = ?");
    $stmt->bind_param("i", $id_empresa);
    $stmt->execute();
    $result = $stmt->get_result();
    $empresa = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id_empresa) {
    $nome_empresa = $_POST['nome_empresa'];
    $area_atuacao = $_POST['area_atuacao'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $porte_empresarial = $_POST['porte_empresarial'];
    $numero_de_funcionarios = $_POST['numero_de_funcionarios'];
    $dia_consulta = $_POST['dia_consulta'];

    $stmt = $conn->prepare("UPDATE empresas SET nome_empresa = ?, area_atuacao = ?, endereco = ?, telefone = ?, email = ?, cnpj = ?, porte_empresarial = ?, numero_de_funcionarios = ?, data_consulta = ? WHERE id_empresa = ?");
    $stmt->bind_param("sssssisssi", $nome_empresa, $area_atuacao, $endereco, $telefone, $email, $cnpj, $porte_empresarial, $numero_de_funcionarios, $dia_consulta, $id_empresa);

    if ($stmt->execute()) {
        echo "<script>alert('Empresa atualizada com sucesso!'); window.location.href='listar_empresas.php';</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
$conn->close();
?>

<div class="container">
    <?php if ($empresa): ?>
    <div class="form-cadastro-moderno">
        <h1>Editar Empresa</h1>
        
        <form method="POST" action="editar_empresa.php?id=<?php echo $id_empresa; ?>">
            <div class="form-row">
                <div class="form-field">
                    <label for="nome_empresa">Nome de sua Empresa:</label>
                    <input type="text" id="nome_empresa" name="nome_empresa" value="<?php echo htmlspecialchars($empresa['nome_empresa']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="area_atuacao">Área de atuação:</label>
                    <input type="text" id="area_atuacao" name="area_atuacao" value="<?php echo htmlspecialchars($empresa['area_atuacao']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($empresa['endereco']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($empresa['telefone']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($empresa['email']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="cnpj">Cnpj:</label>
                    <input type="text" id="cnpj" name="cnpj" value="<?php echo htmlspecialchars($empresa['cnpj']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="porte_empresarial">Porte-empresarial:</label>
                    <select id="porte_empresarial" name="porte_empresarial" required>
                        <option value="">Selecione...</option>
                        <option value="P" <?php echo ($empresa['porte_empresarial'] == 'P') ? 'selected' : ''; ?>>Pequeno</option>
                        <option value="M" <?php echo ($empresa['porte_empresarial'] == 'M') ? 'selected' : ''; ?>>Médio</option>
                        <option value="G" <?php echo ($empresa['porte_empresarial'] == 'G') ? 'selected' : ''; ?>>Grande</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="numero_de_funcionarios">Nº de funcionários:</label>
                    <input type="number" id="numero_de_funcionarios" name="numero_de_funcionarios" value="<?php echo htmlspecialchars($empresa['numero_de_funcionarios']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="dia_consulta">Dia para a consulta semanal:</label>
                    <select id="dia_consulta" name="dia_consulta" required>
                        <option value="">Selecione...</option>
                        <option value="SEG" <?php echo ($empresa['data_consulta'] == 'SEG') ? 'selected' : ''; ?>>Segunda-feira</option>
                        <option value="TER" <?php echo ($empresa['data_consulta'] == 'TER') ? 'selected' : ''; ?>>Terça-feira</option>
                        <option value="QUA" <?php echo ($empresa['data_consulta'] == 'QUA') ? 'selected' : ''; ?>>Quarta-feira</option>
                        <option value="QUI" <?php echo ($empresa['data_consulta'] == 'QUI') ? 'selected' : ''; ?>>Quinta-feira</option>
                        <option value="SEX" <?php echo ($empresa['data_consulta'] == 'SEX') ? 'selected' : ''; ?>>Sexta-feira</option>
                    </select>
                </div>
                <div class="form-field">
                    <!-- Campo vazio para manter o layout -->
                </div>
            </div>

            <button type="submit" class="btn-submit-moderno">Atualizar</button>
        </form>
        
        <div class="form-actions" style="text-align: center; margin-top: 20px;">
            <a href="listar_empresas.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
    <?php else: ?>
        <p style="text-align: center; color: white; font-size: 1.5rem; margin-top: 50px;">Empresa não encontrada.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
