<?php
$page_title = "Nexus - Consultas Registradas";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

$sql = "SELECT c.id_consulta, c.data_realizacao, c.resumo, c.observacoes, c.encaminhamento, c.satisfacao_funcionario, 
               p.nome as nome_psicologo, f.nome as nome_funcionario, e.nome_empresa
        FROM consultas c
        LEFT JOIN psicologos p ON c.id_psicologo = p.id_psicologo
        LEFT JOIN agendamento_consulta ac ON c.id_agendamento = ac.id_agendamento
        LEFT JOIN funcionarios_consultas fc ON ac.id_agendamento = fc.id_agendamento
        LEFT JOIN funcionarios f ON fc.id_funcionario = f.id_funcionario
        LEFT JOIN empresas e ON f.id_empresa = e.id_empresa";

$result = $conn->query($sql);

?>
<div class="back-button-container">
    <button class="btn-voltar" onclick="window.location.href='dashboard_admin.php'">Voltar</button>
</div>
<div class="container">
    <h1>Consultas Registradas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID Consulta</th>
                <th>Data Realização</th>
                <th>Psicólogo</th>
                <th>Funcionário</th>
                <th>Empresa</th>
                <th>Resumo</th>
                <th>Observações</th>
                <th>Encaminhamento</th>
                <th>Satisfação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_consulta"] . "</td>";
                    echo "<td>" . $row["data_realizacao"] . "</td>";
                    echo "<td>" . $row["nome_psicologo"] . "</td>";
                    echo "<td>" . $row["nome_funcionario"] . "</td>";
                    echo "<td>" . $row["nome_empresa"] . "</td>";
                    echo "<td>" . htmlspecialchars($row["resumo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["observacoes"]) . "</td>";
                    echo "<td>" . ($row["encaminhamento"] == 'S' ? 'Sim' : 'Não') . "</td>";
                    echo "<td>" . $row["satisfacao_funcionario"] . "</td>";
                    echo "<td>
                            <a href=\"editar_consulta_registrada.php?id=" . $row["id_consulta"] . "\" class=\"btn btn-warning btn-sm\">Editar</a>
                            <a href=\"deletar_consulta_registrada.php?id=" . $row["id_consulta"] . "\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm(\'Tem certeza que deseja deletar esta consulta registrada?\');\">Deletar</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=\"10\">Nenhuma consulta registrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include 'includes/footer.php';
?>
