<?php
$page_title = "Nexus - Lista de Funcionários";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$sql = "SELECT f.id_funcionario, f.nome, f.cpf, f.data_nascimento, f.email, f.endereco, f.genero, f.data_contratacao, f.jornada_de_trabalho, e.nome_empresa 
        FROM funcionarios f
        LEFT JOIN empresas e ON f.id_empresa = e.id_empresa";
$result = $conn->query($sql);

?>
<div class="back-button-container">
    <button class="btn-voltar" onclick="window.location.href='dashboard_admin.php'">Voltar</button>
</div>

<div class="container">
    <h1>Lista de Funcionários</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data Nasc.</th>
                <th>Email</th>
                <th>Endereço</th>
                <th>Gênero</th>
                <th>Data Cont.</th>
                <th>Jornada</th>
                <th>Empresa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_funcionario"] . "</td>";
                    echo "<td>" . $row["nome"] . "</td>";
                    echo "<td>" . $row["cpf"] . "</td>";
                    echo "<td>" . $row["data_nascimento"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["endereco"] . "</td>";
                    echo "<td>" . $row["genero"] . "</td>";
                    echo "<td>" . $row["data_contratacao"] . "</td>";
                    echo "<td>" . $row["jornada_de_trabalho"] . "</td>";
                    echo "<td>" . $row["nome_empresa"] . "</td>";
                    echo "<td>
                            <a href=\"editar_funcionario.php?id=" . $row["id_funcionario"] . "\" class=\"btn btn-warning btn-sm\">Editar</a>
                            <a href=\"deletar_funcionario.php?id=" . $row["id_funcionario"] . "\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm(\'Tem certeza que deseja deletar este funcionário?\');\">Deletar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=\"11\">Nenhum funcionário cadastrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>
