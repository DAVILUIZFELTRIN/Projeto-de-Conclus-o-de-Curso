<?php
$page_title = "Nexus - Lista de Psicólogos";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$sql = "SELECT id_psicologo, nome, email, telefone, status, cpf, carteira_identificacao FROM psicologos";
$result = $conn->query($sql);

?>
<div class="back-button-container">
    <button class="btn-voltar" onclick="window.location.href='dashboard_admin.php'">Voltar</button>
</div>
<div class="container">
    <h1>Lista de Psicólogos</h1>
    <a href="cadastrar_psicologo.php" class="btn btn-primary">Cadastrar Novo Psicólogo</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Status</th>
                <th>CPF</th>
                <th>Carteira de Identificação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_psicologo"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["telefone"] . "</td>";
                    echo "<td>" . ($row["status"] == 'A' ? 'Ativo' : 'Inativo') . "</td>";
                    echo "<td>" . $row["cpf"] . "</td>";
                    echo "<td>" . $row["carteira_identificacao"] . "</td>";
                    echo "<td>
                            <a href=\"editar_psicologo.php?id=" . $row["id_psicologo"] . "\" class=\"btn btn-warning btn-sm\">Editar</a>
                            <a href=\"deletar_psicologo.php?id=" . $row["id_psicologo"] . "\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm(\'Tem certeza que deseja deletar este psicólogo?\');\">Deletar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=\"8\">Nenhum psicólogo cadastrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>