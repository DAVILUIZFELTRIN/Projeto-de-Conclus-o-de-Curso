<?php
$page_title = "Nexus - Registrar Consulta";
include 'includes/header.php';
include 'includes/conexao.php';

$id_agendamento = $_GET['id_agendamento'] ?? null;
$agendamento = null;

if ($id_agendamento) {
    $stmt = $conn->prepare("SELECT ac.id_agendamento, ac.data_consulta, ac.local_consulta, p.nome as nome_psicologo, f.nome as nome_funcionario, e.nome_empresa, ac.id_psicologo
                            FROM agendamento_consulta ac
                            LEFT JOIN psicologos p ON ac.id_psicologo = p.id_psicologo
                            LEFT JOIN funcionarios_consultas fc ON ac.id_agendamento = fc.id_agendamento
                            LEFT JOIN funcionarios f ON fc.id_funcionario = f.id_funcionario
                            LEFT JOIN empresas e ON f.id_empresa = e.id_empresa
                            WHERE ac.id_agendamento = ?");
    $stmt->bind_param("i", $id_agendamento);
    $stmt->execute();
    $result = $stmt->get_result();
    $agendamento = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id_agendamento) {
    $id_psicologo = $_POST['id_psicologo']; // Vem do agendamento
    $data_realizacao = $_POST['data_realizacao'];
    $resumo = $_POST['resumo'];
    $observacoes = $_POST['observacoes'];
    $encaminhamento = $_POST['encaminhamento'];
    $satisfacao_funcionario = $_POST['satisfacao_funcionario'];

    $stmt = $conn->prepare("INSERT INTO consultas (id_agendamento, id_psicologo, data_realizacao, resumo, observacoes, encaminhamento, satisfacao_funcionario) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssss", $id_agendamento, $id_psicologo, $data_realizacao, $resumo, $observacoes, $encaminhamento, $satisfacao_funcionario);

    if ($stmt->execute()) {
        // Atualizar o status do agendamento para 'Concluída'
        $stmt_update_agendamento = $conn->prepare("UPDATE agendamento_consulta SET status = 'C' WHERE id_agendamento = ?");
        $stmt_update_agendamento->bind_param("i", $id_agendamento);
        $stmt_update_agendamento->execute();
        $stmt_update_agendamento->close();

        echo "<script>alert('Consulta registrada com sucesso!'); window.location.href='listar_consultas.php';</script>";
    } else {
        echo "Erro ao registrar consulta: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<div class="container">
    <h1>Registrar Consulta</h1>
    <?php if ($agendamento): ?>
    <form method="POST" action="registrar_consulta.php?id_agendamento=<?php echo $id_agendamento; ?>">
        <input type="hidden" name="id_psicologo" value="<?php echo $agendamento['id_psicologo']; ?>">
        <div class="form-group">
            <label>Agendamento ID:</label>
            <p><?php echo $agendamento['id_agendamento']; ?></p>
        </div>
        <div class="form-group">
            <label>Data/Hora Agendada:</label>
            <p><?php echo $agendamento['data_consulta']; ?></p>
        </div>
        <div class="form-group">
            <label>Local:</label>
            <p><?php echo htmlspecialchars($agendamento['local_consulta']); ?></p>
        </div>
        <div class="form-group">
            <label>Psicólogo:</label>
            <p><?php echo htmlspecialchars($agendamento['nome_psicologo']); ?></p>
        </div>
        <div class="form-group">
            <label>Funcionário:</label>
            <p><?php echo htmlspecialchars($agendamento['nome_funcionario']); ?> (<?php echo htmlspecialchars($agendamento['nome_empresa']); ?>)</p>
        </div>
        <hr>
        <div class="form-group">
            <label for="data_realizacao">Data e Hora da Realização da Consulta:</label>
            <input type="datetime-local" class="form-control" id="data_realizacao" name="data_realizacao" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
        </div>
        <div class="form-group">
            <label for="resumo">Resumo da Consulta:</label>
            <textarea class="form-control" id="resumo" name="resumo" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="observacoes">Observações:</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="encaminhamento">Encaminhamento (S/N):</label>
            <select class="form-control" id="encaminhamento" name="encaminhamento" required>
                <option value="N">Não</option>
                <option value="S">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="satisfacao_funcionario">Satisfação do Funcionário (1-5):</label>
            <input type="number" class="form-control" id="satisfacao_funcionario" name="satisfacao_funcionario" min="1" max="5" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar Consulta</button>
        <a href="listar_consultas.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <p>Agendamento não encontrado ou inválido para registro.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
