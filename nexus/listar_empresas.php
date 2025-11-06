<?php
$page_title = "Nexus - Lista de Empresas";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$sql = "SELECT id_empresa, nome_empresa, area_atuacao, endereco, telefone, email, cnpj, porte_empresarial, numero_de_funcionarios, data_consulta FROM empresas";
$result = $conn->query($sql);

?>
<div class="container">
    <h1>Lista de Empresas</h1>
    <a href="cadastrar_empresa.php" class="btn btn-primary">Cadastrar Nova Empresa</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome da Empresa</th>
                <th>Área de Atuação</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>CNPJ</th>
                <th>Porte Empresarial</th>
                <th>Nº Funcionários</th>
	                <th>Dia Consulta</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_empresa"] . "</td>";
                    echo "<td>" . $row["nome_empresa"] . "</td>";
                    echo "<td>" . $row["area_atuacao"] . "</td>";
                    echo "<td>" . $row["endereco"] . "</td>";
                    echo "<td>" . $row["telefone"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["cnpj"] . "</td>";
                    echo "<td>" . $row["porte_empresarial"] . "</td>";
                    echo "<td>" . $row["numero_de_funcionarios"] . "</td>";
	                    echo "<td>" . $row["data_consulta"] . "</td>";
                    echo "<td>
                            <a href=\"editar_empresa.php?id=" . $row["id_empresa"] . "\" class=\"btn btn-warning btn-sm\">Editar</a>
                            <a href=\"deletar_empresa.php?id=" . $row["id_empresa"] . "\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm(\'Tem certeza que deseja deletar esta empresa?\');\">Deletar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=\"11\">Nenhuma empresa cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>
