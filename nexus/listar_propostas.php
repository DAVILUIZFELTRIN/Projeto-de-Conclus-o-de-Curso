<?php
$page_title = "Nexus - Listar Propostas";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$sql = "SELECT * FROM proposta ORDER BY id_proposta DESC";
$result = $conn->query($sql);
?>

<div class="container">
    <h1>Propostas Recebidas</h1>
    <a href="dashboard_admin.php" class="btn btn-secondary">Voltar ao Dashboard</a>
    
    <?php if ($result->num_rows > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Empresa</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Nº Funcionários</th>
                    <th>Motivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id_proposta']; ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['nome_empresa']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['telefone']); ?></td>
                    <td><?php echo $row['numero_de_funcionarios']; ?></td>
                    <td><?php echo htmlspecialchars(substr($row['porque_procura'], 0, 50)) . '...'; ?></td>
                    <td>
                        <a href="visualizar_proposta.php?id=<?php echo $row['id_proposta']; ?>" class="btn-sm btn-primary">Ver</a>
                        <a href="editar_proposta.php?id=<?php echo $row['id_proposta']; ?>" class="btn-sm btn-warning">Editar</a>
                        <a href="deletar_proposta.php?id=<?php echo $row['id_proposta']; ?>" class="btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar esta proposta?');">Deletar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma proposta encontrada.</p>
    <?php endif; ?>
</div>

<?php 
$conn->close();
include 'includes/footer.php'; 
?>
