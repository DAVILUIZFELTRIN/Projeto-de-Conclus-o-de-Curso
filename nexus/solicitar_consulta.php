<?php
$page_title = "Nexus - Solicitar Consulta";
include 'includes/header_funcionarios.php';
include 'includes/conexao.php';

// Verifica se o funcionário está logado
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] !== "funcionario") {
    header("Location: entrar.php");
    exit;
}

$id_funcionario = $_SESSION["id"];

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $motivo_consulta = $_POST['motivo_consulta'];
    $disponibilidade = $_POST['disponibilidade'];
    $urgencia = $_POST['urgencia'];

    // Atualiza a tabela 'funcionarios' com as informações da solicitação
    // A coluna 'motivacoes_busca' já existe e será usada para o motivo.
    // Adicionaremos as colunas 'disponibilidade_consulta' e 'urgencia_consulta' na tabela 'funcionarios'
    // no próximo passo de modificação do banco de dados.

    // Por enquanto, vamos apenas atualizar a 'motivacoes_busca' e assumir que o funcionário já está cadastrado.
    $stmt = $conn->prepare("UPDATE funcionarios SET motivacoes_busca = ?, disponibilidade_consulta = ?, urgencia_consulta = ? WHERE id_funcionario = ?");
    $stmt->bind_param("sssi", $motivo_consulta, $disponibilidade, $urgencia, $id_funcionario);

    if ($stmt->execute()) {
        echo "<script>alert('Sua solicitação de consulta foi registrada com sucesso! Entraremos em contato em breve.'); window.location.href='funcionarios.php';</script>";
    } else {
        echo "Erro ao registrar solicitação: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    exit;
}

// Busca os dados do funcionário para preencher o formulário (se necessário)
$sql_funcionario = "SELECT nome, email, cpf, data_nascimento, genero, endereco, id_empresa FROM funcionarios WHERE id_funcionario = ?";
$stmt_funcionario = $conn->prepare($sql_funcionario);
$stmt_funcionario->bind_param("i", $id_funcionario);
$stmt_funcionario->execute();
$result_funcionario = $stmt_funcionario->get_result();
$funcionario = $result_funcionario->fetch_assoc();
$stmt_funcionario->close();

// Busca o nome da empresa
$nome_empresa = "Não Informada";
if ($funcionario['id_empresa']) {
    $sql_empresa = "SELECT nome_empresa FROM empresas WHERE id_empresa = ?";
    $stmt_empresa = $conn->prepare($sql_empresa);
    $stmt_empresa->bind_param("i", $funcionario['id_empresa']);
    $stmt_empresa->execute();
    $result_empresa = $stmt_empresa->get_result();
    if ($result_empresa->num_rows > 0) {
        $empresa = $result_empresa->fetch_assoc();
        $nome_empresa = $empresa['nome_empresa'];
    }
    $stmt_empresa->close();
}

$conn->close();
?>

<div class="form-section">
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1 class="form-title">Solicitação de Consulta</h1>
                <p class="form-subtitle">Preencha os dados para solicitar um agendamento.</p>
            </div>

            <form method="POST" action="solicitar_consulta.php">
                <table class="form-table">
                    <!-- Dados do Funcionário (Apenas para visualização) -->
                    <tr>
                        <td><div class="form-group"><label>Nome:</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" disabled></div></td>
                        <td><div class="form-group"><label>E-mail:</label><input type="email" class="form-control" value="<?php echo htmlspecialchars($funcionario['email']); ?>" disabled></div></td>
                    </tr>
                    <tr>
                        <td><div class="form-group"><label>CPF:</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['cpf']); ?>" disabled></div></td>
                        <td><div class="form-group"><label>Data de Nascimento:</label><input type="date" class="form-control" value="<?php echo htmlspecialchars($funcionario['data_nascimento']); ?>" disabled></div></td>
                    </tr>
                    <tr>
                        <td><div class="form-group"><label>Gênero:</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['genero']); ?>" disabled></div></td>
                        <td><div class="form-group"><label>Empresa:</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($nome_empresa); ?>" disabled></div></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="form-group"><label>Endereço:</label><input type="text" class="form-control" value="<?php echo htmlspecialchars($funcionario['endereco']); ?>" disabled></div></td>
                    </tr>

                    <!-- Campos da Solicitação (Editáveis) -->
                    <tr>
                        <td colspan="2"><div class="form-group"><label for="motivo_consulta">Qual o motivo da sua busca por este serviço? (Será salvo em 'motivacoes_busca')</label>
                        <textarea class="form-control" id="motivo_consulta" name="motivo_consulta" rows="4" required></textarea></div></td>
                    </tr>
                    <tr>
                        <td><div class="form-group"><label for="disponibilidade">Disponibilidade de Horário (Ex: Manhã, Tarde, Noite):</label>
                        <input type="text" class="form-control" id="disponibilidade" name="disponibilidade" required></div></td>
                        <td><div class="form-group"><label for="urgencia">Nível de Urgência (Ex: Baixa, Média, Alta):</label>
                        <select class="form-control" id="urgencia" name="urgencia" required>
                            <option value="B">Baixa</option>
                            <option value="M">Média</option>
                            <option value="A">Alta</option>
                        </select></div></td>
                    </tr>
                </table>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Agendar</button>
                    <a href="funcionarios.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
