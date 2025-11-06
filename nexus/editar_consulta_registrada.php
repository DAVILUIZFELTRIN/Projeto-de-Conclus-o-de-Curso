<?php
$page_title = "Nexus - Editar Consulta Registrada";
include 'includes/header.php';
include 'includes/conexao.php';

$id_consulta = $_GET['id'] ?? null;
$consulta = null;

if ($id_consulta) {
    $stmt = $conn->prepare("SELECT c.id_consulta, c.data_realizacao, c.resumo, c.observacoes, c.encaminhamento, c.satisfacao_funcionario, 
                                   c.id_psicologo, ac.id_agendamento, f.id_funcionario
                            FROM consultas c
                            LEFT JOIN agendamento_consulta ac ON c.id_agendamento = ac.id_agendamento
                            LEFT JOIN funcionarios_consultas fc ON ac.id_agendamento = fc.id_agendamento
                            LEFT JOIN funcionarios f ON fc.id_funcionario = f.id_funcionario
                            WHERE c.id_consulta = ?");
    $stmt->bind_param("i", $id_consulta);
    $stmt->execute();
    $result = $stmt->get_result();
    $consulta = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $id_consulta) {
    $data_realizacao = $_POST['data_realizacao'];
    $resumo = $_POST['resumo'];
    $observacoes = $_POST['observacoes'];
    $encaminhamento = $_POST['encaminhamento'];
    $satisfacao_funcionario = $_POST['satisfacao_funcionario'];

    $stmt = $conn->prepare("UPDATE consultas SET data_realizacao = ?, resumo = ?, observacoes = ?, encaminhamento = ?, satisfacao_funcionario = ? WHERE id_consulta = ?");
    $stmt->bind_param("sssssi", $data_realizacao, $resumo, $observacoes, $encaminhamento, $satisfacao_funcionario, $id_consulta);

    if ($stmt->execute()) {
        echo "<script>alert('Consulta registrada atualizada com sucesso!'); window.location.href='listar_consultas_registradas.php';</script>";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
}

$psicologos_query = "SELECT id_psicologo, nome FROM psicologos ORDER BY nome";
$psicologos_result = $conn->query($psicologos_query);

$funcionarios_query = "SELECT f.id_funcionario, f.nome, e.nome_empresa FROM funcionarios f JOIN empresas e ON f.id_empresa = e.id_empresa ORDER BY f.nome";
$funcionarios_result = $conn->query($funcionarios_query);

$conn->close();
?>

<div class="container">
    <h1>Editar Consulta Registrada</h1>
    <?php if ($consulta): ?>
    <form method="POST" action="editar_consulta_registrada.php?id=<?php echo $id_consulta; ?>">
        <div class="form-group">
            <label for="data_realizacao">Data e Hora da Realização da Consulta:</label>
            <input type="datetime-local" class="form-control" id="data_realizacao" name="data_realizacao" value="<?php echo date('Y-m-d\TH:i', strtotime($consulta['data_realizacao'])); ?>" required>
        </div>
        <div class="form-group">
            <label for="resumo">Resumo da Consulta:</label>
            <textarea class="form-control" id="resumo" name="resumo" rows="3" required><?php echo htmlspecialchars($consulta['resumo']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="observacoes">Observações:</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="3"><?php echo htmlspecialchars($consulta['observacoes']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="encaminhamento">Encaminhamento (S/N):</label>
            <select class="form-control" id="encaminhamento" name="encaminhamento" required>
                <option value="N" <?php echo ($consulta['encaminhamento'] == 'N') ? 'selected' : ''; ?>>Não</option>
                <option value="S" <?php echo ($consulta['encaminhamento'] == 'S') ? 'selected' : ''; ?>>Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="satisfacao_funcionario">Satisfação do Funcionário (1-5):</label>
            <input type="number" class="form-control" id="satisfacao_funcionario" name="satisfacao_funcionario" min="1" max="5" value="<?php echo htmlspecialchars($consulta['satisfacao_funcionario']); ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="listar_consultas_registradas.php" class="btn btn-secondary">Cancelar</a>
    </form>
    <?php else: ?>
        <p>Consulta registrada não encontrada.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
