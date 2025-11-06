<?php
	session_start();
	include 'includes/conexao.php';
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["user_type"] !== "administrador") {
    header("Location: entrar.php");
    exit;
}
$page_title = "Nexus - Dashboard Administrador";
	
	// 1. Contagem de Empresas Cadastradas
	$sql_empresas = "SELECT COUNT(*) as total_empresas FROM empresas";
	$result_empresas = $conn->query($sql_empresas);
	$total_empresas = $result_empresas->fetch_assoc()['total_empresas'];
	
	// 2. Contagem de Solicitações de Consulta (Funcionários com motivacoes_busca preenchida)
	$sql_solicitacoes = "SELECT COUNT(*) as total_solicitacoes FROM funcionarios WHERE motivacoes_busca IS NOT NULL AND motivacoes_busca != ''";
	$result_solicitacoes = $conn->query($sql_solicitacoes);
	$total_solicitacoes = $result_solicitacoes->fetch_assoc()['total_solicitacoes'];
	
	// 3. Contagem de Consultas Agendadas
	$sql_agendadas = "SELECT COUNT(*) as total_agendadas FROM agendamento_consulta";
	$result_agendadas = $conn->query($sql_agendadas);
	$total_agendadas = $result_agendadas->fetch_assoc()['total_agendadas'];
	
	// 4. Contagem de Psicólogos Ativos
	$sql_psicologos = "SELECT COUNT(*) as total_psicologos FROM psicologos WHERE status = 'A'";
	$result_psicologos = $conn->query($sql_psicologos);
	$total_psicologos = $result_psicologos->fetch_assoc()['total_psicologos'];
	
	// 5. Contagem de Propostas Recebidas
	$sql_propostas = "SELECT COUNT(*) as total_propostas FROM proposta";
	$result_propostas = $conn->query($sql_propostas);
	$total_propostas = $result_propostas->fetch_assoc()['total_propostas'];
	
	$conn->close();
include 'includes/header_dashboard_admin.php';
?>
<div class="container">
	    <h1 class="page-title">Dashboard Administrativo</h1>
	    
	    <div class="stats-grid">
	        <div class="stat-card">
	            <h2><?php echo $total_empresas; ?></h2>
	            <p>Empresas Cadastradas</p>
	        </div>
	        <div class="stat-card">
	            <h2><?php echo $total_solicitacoes; ?></h2>
	            <p>Solicitações de Consulta</p>
	        </div>
	        <div class="stat-card">
	            <h2><?php echo $total_agendadas; ?></h2>
	            <p>Consultas Agendadas</p>
	        </div>
	        <div class="stat-card">
	            <h2><?php echo $total_psicologos; ?></h2>
	            <p>Psicólogos Ativos</p>
	        </div>
	        <div class="stat-card">
	            <h2><?php echo $total_propostas; ?></h2>
	            <p>Propostas Recebidas</p>
	        </div>
	    </div>
	
	    <h2 class="section-title">Gerenciamento Rápido</h2>
	    <div class="quick-links">
	        <a href="listar_empresas.php" class="btn-quick-link">Gerenciar Empresas</a>
	        <a href="listar_psicologos.php" class="btn-quick-link">Gerenciar Psicólogos</a>
	        <a href="listar_funcionarios.php" class="btn-quick-link">Gerenciar Funcionários</a>
	        <a href="listar_consultas.php" class="btn-quick-link">Ver Agendamentos</a>
	        <a href="listar_propostas.php" class="btn-quick-link">Ver Propostas</a>
	    </div>
	</div>
