<?php
$page_title = "Nexus - Visualizar Proposta";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID da proposta não especificado.'); window.location.href='listar_propostas.php';</script>";
    exit();
}

$id_proposta = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM proposta WHERE id_proposta = ?");
$stmt->bind_param("i", $id_proposta);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Proposta não encontrada.'); window.location.href='listar_propostas.php';</script>";
    exit();
}

$proposta = $result->fetch_assoc();
?>

<div class="container">
    <h1>Detalhes da Proposta #<?php echo $proposta['id_proposta']; ?></h1>
    
    <div class="proposta-detalhes">
        <div class="detalhes-card">
            <h3>Informações do Solicitante</h3>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($proposta['nome']); ?></p>
            <p><strong>Empresa:</strong> <?php echo htmlspecialchars($proposta['nome_empresa']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($proposta['email']); ?></p>
            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($proposta['telefone']); ?></p>
            <p><strong>Número de Funcionários:</strong> <?php echo $proposta['numero_de_funcionarios']; ?></p>
        </div>
        
        <div class="detalhes-card">
            <h3>Motivo da Solicitação</h3>
            <p><?php echo nl2br(htmlspecialchars($proposta['porque_procura'])); ?></p>
        </div>
    </div>
    
    <div class="form-actions">
        <a href="editar_proposta.php?id=<?php echo $proposta['id_proposta']; ?>" class="btn btn-warning">Editar</a>
        <a href="listar_propostas.php" class="btn btn-secondary">Voltar</a>
        <a href="deletar_proposta.php?id=<?php echo $proposta['id_proposta']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja deletar esta proposta?');">Deletar</a>
    </div>
</div>

<style>
.proposta-detalhes {
    margin: 30px 0;
}

.detalhes-card {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.detalhes-card h3 {
    color: #142ca1;
    margin-bottom: 15px;
    font-size: 1.3rem;
}

.detalhes-card p {
    margin-bottom: 10px;
    font-size: 1.1rem;
    line-height: 1.6;
}

.detalhes-card strong {
    color: #333;
}
</style>

<?php 
$stmt->close();
$conn->close();
include 'includes/footer.php'; 
?>
