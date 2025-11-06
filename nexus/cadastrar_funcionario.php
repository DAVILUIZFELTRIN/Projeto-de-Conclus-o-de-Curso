<?php
$page_title = "Nexus - Cadastrar Funcionário";
include 'includes/header_funcionarios.php';
include 'includes/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_POST['id_empresa'];
    $cargo = $_POST['cargo'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $genero = $_POST['genero'];
    $data_contratacao = $_POST['data_contratacao'];
    $jornada_de_trabalho = $_POST['jornada_de_trabalho'];
    $motivacoes_busca = $_POST['motivacoes_busca'];

    $stmt = $conn->prepare("INSERT INTO funcionarios (id_empresa, cargo, nome, cpf, data_nascimento, email, endereco, genero, data_contratacao, jornada_de_trabalho, motivacoes_busca) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssssss", $id_empresa, $cargo, $nome, $cpf, $data_nascimento, $email, $endereco, $genero, $data_contratacao, $jornada_de_trabalho, $motivacoes_busca);

    if ($stmt->execute()) {
        echo "<script>alert('Consulta do Funcionário solicitada com sucesso!'); window.location.href='funcionarios.php';</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

$empresas_query = "SELECT id_empresa, nome_empresa FROM empresas ORDER BY nome_empresa";
$empresas_result = $conn->query($empresas_query);

$conn->close();
?>

<div class="container">
    <div class="form-cadastro-moderno">
        <h1>Funcionário</h1>
        
        <form method="POST" action="cadastrar_funcionario.php">
            <div class="form-row full-width">
                <div class="form-field">
                    <label for="id_empresa">Empresa:</label>
                    <select id="id_empresa" name="id_empresa" required>
                        <option value="">Selecione uma empresa</option>
                        <?php
                        if ($empresas_result->num_rows > 0) {
                            while($empresa_row = $empresas_result->fetch_assoc()) {
                                echo "<option value=\"" . $empresa_row["id_empresa"] . "\">" . htmlspecialchars($empresa_row["nome_empresa"]) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="form-field">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-field">
                    <label for="cargo">Cargo:</label>
                    <input type="text" id="cargo" name="cargo" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>
                <div class="form-field">
                    <label for="genero">Gênero:</label>
                    <select id="genero" name="genero" required>
                        <option value="">Selecione...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                    </select>
                </div>
            </div>

            <div class="form-row full-width">
                <div class="form-field">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="data_contratacao">Data de Contratação:</label>
                    <input type="date" id="data_contratacao" name="data_contratacao" required>
                </div>
                <div class="form-field">
                    <label for="jornada_de_trabalho">Jornada de Trabalho (horas):</label>
                    <input type="number" id="jornada_de_trabalho" name="jornada_de_trabalho" required>
                </div>
            </div>

            <div class="form-row full-width">
                <div class="form-field">
                    <label for="motivacoes_busca">Motivações para Buscar Atendimento Psicológico:</label>
                    <textarea id="motivacoes_busca" name="motivacoes_busca" rows="4" placeholder="Descreva as motivações do funcionário para buscar atendimento psicológico..."></textarea>
                </div>
            </div>

            <button type="submit" class="btn-submit-moderno">Enviar</button>
        </form>
        
       
    </div>
</div>

<?php include 'includes/footer.php'; ?>
