<?php
$page_title = "Nexus - Editar Agendamento";
include 'includes/header.php';
include 'includes/conexao.php';

$id_agendamento = $_GET['id'] ?? null;
$agendamento = null;

if ($id_agendamento) {
    $stmt = $conn->prepare("SELECT ac.id_agendamento, ac.data_consulta, ac.local_consulta, ac.status, ac.id_psicologo, fc.id_funcionario
                            FROM agendamento_consulta ac
                            LEFT JOIN funcionarios_consultas fc ON ac.id_agendamento = fc.id_agendamento
                            WHERE ac.id_agendamento = ?");
    $stmt->bind_param("i", $id_agendamento);
    $stmt->execute();
    $result = $stmt->get_result();
    $agendamento = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id_agendamento) {
    $data_consulta = $_POST['data_consulta'];
    $local_consulta = $_POST['local_consulta'];
    $status = $_POST['status'];
    $id_psicologo = $_POST['id_psicologo'];
    $id_funcionario = $_POST['id_funcionario'];

    // Atualizar agendamento_consulta
    $stmt_agendamento = $conn->prepare("UPDATE agendamento_consulta SET data_consulta = ?, local_consulta = ?, status = ?, id_psicologo = ? WHERE id_agendamento = ?");
    $stmt_agendamento->bind_param("sssii", $data_consulta, $local_consulta, $status, $id_psicologo, $id_agendamento);
    $stmt_agendamento->execute();
    $stmt_agendamento->close();

    // Atualizar funcionarios_consultas
    $stmt_func_consulta = $conn->prepare("UPDATE funcionarios_consultas SET id_funcionario = ? WHERE id_agendamento = ?");
    $stmt_func_consulta->bind_param("ii", $id_funcionario, $id_agendamento);
    $stmt_func_consulta->execute();
    $stmt_func_consulta->close();

    echo "<script>alert('Agendamento atualizado com sucesso!'); window.location.href='listar_consultas.php';</script>";
}

$psicologos_query = "SELECT id_psicologo, nome FROM psicologos WHERE status = 'A' ORDER BY nome";
$psicologos_result = $conn->query($psicologos_query);

$funcionarios_query = "SELECT f.id_funcionario, f.nome, e.nome_empresa FROM funcionarios f JOIN empresas e ON f.id_empresa = e.id_empresa ORDER BY f.nome";
$funcionarios_result = $conn->query($funcionarios_query);

$conn->close();
?>

<div class="container">
    <h1>Editar Agendamento</h1>
    <?php if ($agendamento): ?>
    <form method="POST" action="editar_agendamento.php?id=<?php echo $id_agendamento; ?>">
        <div class="form-group">
            <label for="data_consulta">Data e Hora da Consulta:</label>
            <input type="datetime-local" class="form-control" id="data_consulta" name="data_consulta" value="<?php echo date('Y-m-d\TH:i', strtotime($agendamento['data_consulta'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="local_consulta">Local da Consulta:</label>
            <input type="text" class="form-control" id="local_consulta" name="local_consulta" value="<?php echo htmlspecialchars($agendamento['local_consulta']); ?>" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select class="form-control" id="status" name="status" required>
                <option value="P" <?php echo ($agendamento['status'] == 'P') ? 'selected' : ''; ?>>Pendente</option>
                <option value="C" <?php echo ($agendamento['status'] == 'C') ? 'selected' : ''; ?>>Concluída</option>
                <option value="X" <?php echo ($agendamento['status'] == 'X') ? 'selected' : ''; ?>>Cancelada</option>
            </select>
        </div>
        <div class="form-group">
            <label for="id_psicologo">Psicólogo:</label>
            <select class="form-control" id="id_psicologo" name="id_psicologo" required>
                <option value="">Selecione um psicólogo</option>
                <?php
                if ($psicologos_result->num_rows > 0) {
                    while($psicologo_row = $psicologos_result->fetch_assoc()) {
                        $selected = ($psicologo_row["id_psicologo"] == $agendamento["id_psicologo"]) ? "selected" : "";
                        echo "<option value=\"" . $psicologo_row["id_psicologo"] . "\" " . $selected . ">" . htmlspecialchars($psicologo_row["nome"]) . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="id_funcionario">Funcionário:</label>
            <select class="form-control" id="id_funcionario" name="id_funcionario" required>
                <option value="">Selecione um funcionário</option>
                <?php
                if ($funcionarios_result->num_rows > 0) {
                    while($funcionario_row = $funcionarios_result->fetch_assoc()) {
                        $selected = ($funcionario_row["id_funcionario"] == $agendamento["id_funcionario"]) ? "selected" : "";
                        echo "<option value=\"" . $funcionario_row["id_funcionario"] . "\" " . $selected . ">" . htmlspecialchars($funcionario_row["nome"]) . " (" . htmlspecialchars($funcionario_row["nome_empresa"]) . ")</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="listar_consultas.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <p>Agendamento não encontrado.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
