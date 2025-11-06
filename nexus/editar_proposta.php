<?php
$page_title = "Nexus - Editar Proposta";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID da proposta não especificado.'); window.location.href='listar_propostas.php';</script>";
    exit();
}

$id_proposta = $_GET['id'];

// Processar o formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $nome_empresa = $_POST['nome_empresa'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $numero_de_funcionarios = $_POST['numero_de_funcionarios'];
    $porque_procura = $_POST['porque_procura'];

    $stmt = $conn->prepare("UPDATE proposta SET nome = ?, nome_empresa = ?, email = ?, telefone = ?, numero_de_funcionarios = ?, porque_procura = ? WHERE id_proposta = ?");
    $stmt->bind_param("sssisii", $nome, $nome_empresa, $email, $telefone, $numero_de_funcionarios, $porque_procura, $id_proposta);

    if ($stmt->execute()) {
        echo "<script>alert('Proposta atualizada com sucesso!'); window.location.href='listar_propostas.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar proposta: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Buscar dados da proposta
$stmt = $conn->prepare("SELECT * FROM proposta WHERE id_proposta = ?");
$stmt->bind_param("i", $id_proposta);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Proposta não encontrada.'); window.location.href='listar_propostas.php';</script>";
    exit();
}

$proposta = $result->fetch_assoc();
$stmt->close();
?>

<div class="container">
    <h1>Editar Proposta #<?php echo $proposta['id_proposta']; ?></h1>
    
    <form method="POST" action="editar_proposta.php?id=<?php echo $id_proposta; ?>">
        <table class="form-table">
            <tr>
                <td>
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($proposta['nome']); ?>" required>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="nome_empresa">Nome da Empresa:</label>
                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" value="<?php echo htmlspecialchars($proposta['nome_empresa']); ?>" required>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($proposta['email']); ?>" required>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($proposta['telefone']); ?>" required>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <div class="form-group">
                        <label for="numero_de_funcionarios">Número de Funcionários:</label>
                        <input type="number" class="form-control" id="numero_de_funcionarios" name="numero_de_funcionarios" value="<?php echo $proposta['numero_de_funcionarios']; ?>" required>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <div class="form-group">
                        <label for="porque_procura">Por que procura nossos serviços:</label>
                        <textarea class="form-control" id="porque_procura" name="porque_procura" rows="4" required><?php echo htmlspecialchars($proposta['porque_procura']); ?></textarea>
                    </div>
                </td>
            </tr>
        </table>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="listar_propostas.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
