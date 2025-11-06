<?php
// Arquivo: includes/conexao.php

// 1. Definição das credenciais do banco de dados (SUBSTITUA PELOS SEUS DADOS REAIS)
$servername = "localhost";
$username = "root"; // Ex: root
$password = ""; // Ex: '' (vazio para root no XAMPP)
$dbname = "nexus_354_teste_modi_final"; 

// 2. Tenta criar o objeto de conexão MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Verifica se a conexão falhou
if ($conn->connect_error) {
    // Se falhar, exibe o erro e encerra o script.
    die("Falha na Conexão com o Banco de Dados: " . $conn->connect_error);
}
// Se chegou até aqui, a variável $conn é um objeto de conexão válido.
?>