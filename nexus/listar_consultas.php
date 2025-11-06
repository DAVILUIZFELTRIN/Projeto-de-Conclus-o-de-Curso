<?php
$page_title = "Nexus - Lista de Consultas";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$sql = "SELECT ac.id_agendamento, ac.data_consulta, ac.local_consulta, ac.status as status_agendamento, p.nome as nome_psicologo, f.nome as nome_funcionario, e.nome_empresa
        FROM agendamento_consulta ac
        LEFT JOIN psicologos p ON ac.id_psicologo = p.id_psicologo
        LEFT JOIN funcionarios_consultas fc ON ac.id_agendamento = fc.id_agendamento
        LEFT JOIN funcionarios f ON fc.id_funcionario = f.id_funcionario
        LEFT JOIN empresas e ON f.id_empresa = e.id_empresa";
$result = $conn->query($sql);

?>
<div class="back-button-container">
    <button class="btn-voltar" onclick="window.location.href='dashboard_admin.php'">Voltar</button>
</div>
<div class="container">
    <h1>Lista de Consultas</h1>
    <a href="agendar_consulta.php" class="btn btn-primary">Agendar Nova Consulta</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID Agendamento</th>
                <th>Data/Hora</th>
                <th>Local</th>
                <th>Status</th>
                <th>Psicólogo</th>
                <th>Funcionário</th>
                <th>Empresa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_agendamento"] . "</td>";
                    echo "<td>" . $row["data_consulta"] . "</td>";
                    echo "<td>" . $row["local_consulta"] . "</td>";
                    echo "<td>" . $row["status_agendamento"] . "</td>";
                    echo "<td>" . $row["nome_psicologo"] . "</td>";
                    echo "<td>" . $row["nome_funcionario"] . "</td>";
                    echo "<td>" . $row["nome_empresa"] . "</td>";
                    echo "<td>
                            <a href=\"editar_agendamento.php?id=" . $row["id_agendamento"] . "\" class=\"btn btn-warning btn-sm\">Editar</a>
                            <a href=\"deletar_agendamento.php?id=" . $row["id_agendamento"] . "\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm(\'Tem certeza que deseja deletar este agendamento?\');\">Deletar</a>
                            <a href=\"registrar_consulta.php?id_agendamento=" . $row["id_agendamento"] . "\" class=\"btn btn-info btn-sm\">Registrar Consulta</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=\"8\">Nenhuma consulta agendada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>
