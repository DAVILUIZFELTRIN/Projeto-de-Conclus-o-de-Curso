<?php
$page_title = "Nexus - Agendar Consulta";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$psicologos_query = "SELECT id_psicologo, nome FROM psicologos WHERE status = 'A' ORDER BY nome";
$psicologos_result = $conn->query($psicologos_query);

$funcionarios_query = "SELECT f.id_funcionario, f.nome, e.nome_empresa FROM funcionarios f JOIN empresas e ON f.id_empresa = e.id_empresa ORDER BY f.nome";
$funcionarios_result = $conn->query($funcionarios_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data_consulta = $_POST['data_consulta'];
    $local_consulta = $_POST['local_consulta'];
    $id_psicologo = $_POST['id_psicologo'];
    $id_funcionario = $_POST['id_funcionario'];
    $status = 'P'; // Pendente

    // Inserir na tabela agendamento_consulta
    $stmt_agendamento = $conn->prepare("INSERT INTO agendamento_consulta (data_consulta, local_consulta, status, id_psicologo) VALUES (?, ?, ?, ?)");
    $stmt_agendamento->bind_param("sssi", $data_consulta, $local_consulta, $status, $id_psicologo);

    if ($stmt_agendamento->execute()) {
        $id_agendamento = $stmt_agendamento->insert_id;

        // Inserir na tabela funcionarios_consultas
        $stmt_func_consulta = $conn->prepare("INSERT INTO funcionarios_consultas (id_funcionario, id_agendamento) VALUES (?, ?)");
        $stmt_func_consulta->bind_param("ii", $id_funcionario, $id_agendamento);

        if ($stmt_func_consulta->execute()) {
            echo "<script>alert('Consulta agendada com sucesso!'); window.location.href='listar_consultas.php';</script>";
        } else {
            echo "Erro ao vincular funcionário à consulta: " . $stmt_func_consulta->error;
        }
        $stmt_func_consulta->close();
    } else {
        echo "Erro ao agendar consulta: " . $stmt_agendamento->error;
    }
    $stmt_agendamento->close();
}
$conn->close();
?>

<div class="container">
    <h1>Agendar Nova Consulta</h1>
    <form method="POST" action="agendar_consulta.php">
        <div class="form-group">
            <label for="data_consulta">Data e Hora da Consulta:</label>
            <input type="datetime-local" class="form-control" id="data_consulta" name="data_consulta" required>
        </div>
        <div class="form-group">
            <label for="local_consulta">Local da Consulta:</label>
            <input type="text" class="form-control" id="local_consulta" name="local_consulta" required>
        </div>
        <div class="form-group">
            <label for="id_psicologo">Psicólogo:</label>
            <select class="form-control" id="id_psicologo" name="id_psicologo" required>
                <option value="">Selecione um psicólogo</option>
                <?php
                if ($psicologos_result->num_rows > 0) {
                    while($psicologo_row = $psicologos_result->fetch_assoc()) {
                        echo "<option value=\"" . $psicologo_row["id_psicologo"] . "\">" . htmlspecialchars($psicologo_row["nome"]) . "</option>";
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
                        echo "<option value=\"" . $funcionario_row["id_funcionario"] . "\">" . htmlspecialchars($funcionario_row["nome"]) . " (" . htmlspecialchars($funcionario_row["nome_empresa"]) . ")</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Agendar</button>
        <a href="listar_consultas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
