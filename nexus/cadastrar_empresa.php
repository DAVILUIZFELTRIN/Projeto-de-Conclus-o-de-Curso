<?php
$page_title = "Nexus - Cadastrar Empresa";
include 'includes/header_dashboard_admin.php';
include 'includes/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_empresa = $_POST['nome_empresa'];
    $area_atuacao = $_POST['area_atuacao'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cnpj = $_POST['cnpj'];
    $porte_empresarial = $_POST['porte_empresarial'];
    $numero_de_funcionarios = $_POST['numero_de_funcionarios'];
    $dia_consulta = $_POST['dia_consulta'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash da senha

    $stmt = $conn->prepare("INSERT INTO empresas (nome_empresa, area_atuacao, endereco, telefone, email, cnpj, porte_empresarial, numero_de_funcionarios, senha, data_consulta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssissss", $nome_empresa, $area_atuacao, $endereco, $telefone, $email, $cnpj, $porte_empresarial, $numero_de_funcionarios, $senha, $dia_consulta);

    if ($stmt->execute()) {
        echo "<script>alert('Empresa cadastrada com sucesso!'); window.location.href='listar_empresas.php';</script>";
    } else {
        echo "<script>alert('Erro: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
$conn->close();
?>

<div class="container">
    <div class="form-cadastro-moderno">
        <h1>Empresa</h1>
        
        <form method="POST" action="cadastrar_empresa.php">
            <div class="form-row">
                <div class="form-field">
                    <label for="nome_empresa">Nome de sua Empresa:</label>
                    <input type="text" id="nome_empresa" name="nome_empresa" required>
                </div>
                <div class="form-field">
                    <label for="area_atuacao">Área de atuação:</label>
                    <input type="text" id="area_atuacao" name="area_atuacao" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                </div>
                <div class="form-field">
                    <label for="telefone">Telefone:</label>
                    <input type="text" id="telefone" name="telefone" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-field">
                    <label for="cnpj">Cnpj:</label>
                    <input type="text" id="cnpj" name="cnpj" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="porte_empresarial">Porte-empresarial:</label>
                    <select id="porte_empresarial" name="porte_empresarial" required>
                        <option value="">Selecione...</option>
                        <option value="P">Pequeno</option>
                        <option value="M">Médio</option>
                        <option value="G">Grande</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="numero_de_funcionarios">Nº de funcionários:</label>
                    <input type="number" id="numero_de_funcionarios" name="numero_de_funcionarios" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-field">
                    <label for="dia_consulta">Dia para a consulta semanal:</label>
                    <select id="dia_consulta" name="dia_consulta" required>
                        <option value="">Selecione...</option>
                        <option value="SEG">Segunda-feira</option>
                        <option value="TER">Terça-feira</option>
                        <option value="QUA">Quarta-feira</option>
                        <option value="QUI">Quinta-feira</option>
                        <option value="SEX">Sexta-feira</option>
                    </select>
                </div>
                <div class="form-field">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
            </div>

            <button type="submit" class="btn-submit-moderno">Enviar</button>
        </form>
        
        <div class="form-actions" style="text-align: center; margin-top: 20px;">
            <a href="listar_empresas.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
