<?php
$page_title = "Nexus - Editar Funcionário";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$id_funcionario = $_GET['id'] ?? null;
$funcionario = null;

if ($id_funcionario) {
    $stmt = $conn->prepare("SELECT id_funcionario, id_empresa, cargo, nome, cpf, data_nascimento, email, endereco, genero, data_contratacao, jornada_de_trabalho, motivacoes_busca, disponibilidade_consulta, urgencia_consulta FROM funcionarios WHERE id_funcionario = ?");
    $stmt->bind_param("i", $id_funcionario);
    $stmt->execute();
    $result = $stmt->get_result();
    $funcionario = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id_funcionario) {
    $id_empresa = $_POST['id_empresa'];
    $cargo = $_POST['cargo'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $genero = $_POST['genero'];
    $data_contratacao = $_POST['data_contratacao'];
    $jornada_de_trabalho = $_POST['jornada_de_trabalho'];
    $motivacoes_busca = $_POST['motivacoes_busca'];
    $disponibilidade_consulta = $_POST['disponibilidade_consulta'];
    $urgencia_consulta = $_POST['urgencia_consulta'];

    $stmt = $conn->prepare("UPDATE funcionarios SET id_empresa = ?, cargo = ?, nome = ?, cpf = ?, data_nascimento = ?, email = ?, endereco = ?, genero = ?, data_contratacao = ?, jornada_de_trabalho = ?, motivacoes_busca = ?, disponibilidade_consulta = ?, urgencia_consulta = ? WHERE id_funcionario = ?");
    $stmt->bind_param("issssssssssssi", $id_empresa, $cargo, $nome, $cpf, $data_nascimento, $email, $endereco, $genero, $data_contratacao, $jornada_de_trabalho, $motivacoes_busca, $disponibilidade_consulta, $urgencia_consulta, $id_funcionario);

    if ($stmt->execute()) {
        echo "<script>alert('Funcionário atualizado com sucesso!'); window.location.href='listar_funcionarios.php';</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

$empresas_query = "SELECT id_empresa, nome_empresa FROM empresas ORDER BY nome_empresa";
$empresas_result = $conn->query($empresas_query);

$conn->close();
?>

<div class="container">
    <?php if ($funcionario): ?>
    <div class="form-cadastro-moderno">
        <h1>Editar Funcionário</h1>
        
        <form method="POST" action="editar_funcionario.php?id=<?php echo $id_funcionario; ?>">
            <div class="form-row full-width">
                <div class="form-field">
                    <label for="id_empresa">Empresa:</label>
                    <select id="id_empresa" name="id_empresa" required>
                        <option value="">Selecione uma empresa</option>
                        <?php
                        if ($empresas_result->num_rows > 0) {
                            while($empresa_row = $empresas_result->fetch_assoc()) {
                                $selected = ($empresa_row["id_empresa"] == $funcionario["id_empresa"]) ? "selected" : "";
                                echo "<option value=\"" . $empresa_row["id_empresa"] . "\" " . $selected . ">" . htmlspecialchars($empresa_row["nome_empresa"]) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($funcionario['cpf']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($funcionario['email']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="cargo">Cargo:</label>
                    <input type="text" id="cargo" name="cargo" value="<?php echo htmlspecialchars($funcionario['cargo']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($funcionario['data_nascimento']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="genero">Gênero:</label>
                    <select id="genero" name="genero" required>
                        <option value="">Selecione...</option>
                        <option value="M" <?php echo ($funcionario['genero'] == 'M') ? 'selected' : ''; ?>>Masculino</option>
                        <option value="F" <?php echo ($funcionario['genero'] == 'F') ? 'selected' : ''; ?>>Feminino</option>
                        <option value="O" <?php echo ($funcionario['genero'] == 'O') ? 'selected' : ''; ?>>Outro</option>
                    </select>
                </div>
            </div>

            <div class="form-row full-width">
                <div class="form-field">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($funcionario['endereco']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="data_contratacao">Data de Contratação:</label>
                    <input type="date" id="data_contratacao" name="data_contratacao" value="<?php echo htmlspecialchars($funcionario['data_contratacao']); ?>" required>
                </div>
                <div class="form-field">
                    <label for="jornada_de_trabalho">Jornada de Trabalho (horas):</label>
                    <input type="number" id="jornada_de_trabalho" name="jornada_de_trabalho" value="<?php echo htmlspecialchars($funcionario['jornada_de_trabalho']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="disponibilidade_consulta">Disponibilidade para Consulta:</label>
                    <input type="text" id="disponibilidade_consulta" name="disponibilidade_consulta" value="<?php echo htmlspecialchars($funcionario['disponibilidade_consulta']); ?>" placeholder="Ex: Segunda e Quarta, 14h-16h">
                </div>
                <div class="form-field">
                    <label for="urgencia_consulta">Urgência da Consulta:</label>
                    <select id="urgencia_consulta" name="urgencia_consulta">
                        <option value="">Selecione...</option>
                        <option value="A" <?php echo ($funcionario['urgencia_consulta'] == 'A') ? 'selected' : ''; ?>>Alta</option>
                        <option value="M" <?php echo ($funcionario['urgencia_consulta'] == 'M') ? 'selected' : ''; ?>>Média</option>
                        <option value="B" <?php echo ($funcionario['urgencia_consulta'] == 'B') ? 'selected' : ''; ?>>Baixa</option>
                    </select>
                </div>
            </div>

            <div class="form-row full-width">
                <div class="form-field">
                    <label for="motivacoes_busca">Motivações para Buscar Atendimento Psicológico:</label>
                    <textarea id="motivacoes_busca" name="motivacoes_busca" rows="4" placeholder="Descreva as motivações do funcionário para buscar atendimento psicológico..."><?php echo htmlspecialchars($funcionario['motivacoes_busca']); ?></textarea>
                </div>
            </div>

            <button type="submit" class="btn-submit-moderno">Atualizar</button>
        </form>
        
        <div class="form-actions" style="text-align: center; margin-top: 20px;">
            <a href="listar_funcionarios.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
    <?php else: ?>
        <p style="text-align: center; color: white; font-size: 1.5rem; margin-top: 50px;">Funcionário não encontrado.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
