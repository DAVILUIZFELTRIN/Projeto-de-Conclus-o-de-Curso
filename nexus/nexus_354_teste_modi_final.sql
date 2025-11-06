-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/11/2025 às 05:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nexus_354_teste_modi_final`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento_consulta`
--

CREATE TABLE `agendamento_consulta` (
  `id_agendamento` int(11) NOT NULL,
  `data_consulta` datetime DEFAULT NULL,
  `local_consulta` varchar(50) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `id_psicologo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `consultas`
--

CREATE TABLE `consultas` (
  `id_consulta` int(11) NOT NULL,
  `id_agendamento` int(11) NOT NULL,
  `id_psicologo` int(11) NOT NULL,
  `data_realizacao` datetime NOT NULL,
  `resumo` varchar(180) DEFAULT NULL,
  `observacoes` varchar(180) DEFAULT NULL,
  `encaminhamento` char(1) DEFAULT NULL,
  `satisfacao_funcionario` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nome_empresa` varchar(50) DEFAULT NULL,
  `area_atuacao` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `telefone` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cnpj` int(14) DEFAULT NULL,
  `porte_empresarial` char(3) DEFAULT NULL,
  `numero_de_funcionarios` int(11) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `data_consulta` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`id_empresa`, `nome_empresa`, `area_atuacao`, `endereco`, `telefone`, `email`, `cnpj`, `porte_empresarial`, `numero_de_funcionarios`, `senha`, `data_consulta`) VALUES
(2, 'Nexus ', 'tecnologia', 'rua dom pedro segundo', 2147483647, 'nexus@gmail.com', 2147483647, 'M', 300, '$2y$10$ef6OtYIIJnEzq8C/MCf18uxFM5Lg/gpEuOR4e0zKu4o', 'SEG'),
(6, 'Prefeitura', 'gestÃ£o publica', 'santa barabara', 2147483647, 'prefeitura@hotmail.com', 2147483647, 'G', 300, '$2y$10$6WumukOrvjom9d0jCLiCY.0pmWSaLzm3U55KS9xyPPv', 'TER');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas_psicologos`
--

CREATE TABLE `empresas_psicologos` (
  `id_empresa` int(11) NOT NULL,
  `id_psicologo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id_funcionario` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `genero` char(1) DEFAULT NULL,
  `data_contratacao` date DEFAULT NULL,
  `jornada_de_trabalho` int(11) DEFAULT NULL,
  `motivacoes_busca` varchar(250) NOT NULL,
  `disponibilidade_consulta` varchar(50) DEFAULT NULL,
  `urgencia_consulta` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `id_empresa`, `cargo`, `nome`, `cpf`, `data_nascimento`, `email`, `endereco`, `genero`, `data_contratacao`, `jornada_de_trabalho`, `motivacoes_busca`, `disponibilidade_consulta`, `urgencia_consulta`) VALUES
(1, 2, '0', 'davi', '10654444943', '2008-02-26', 'daviluizfeltrin@gmail.com', 'rua dom pedro segundo', 'M', '2025-10-30', 8, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios_consultas`
--

CREATE TABLE `funcionarios_consultas` (
  `id_funcionario` int(11) NOT NULL,
  `id_agendamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `proposta`
--

CREATE TABLE `proposta` (
  `id_proposta` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_empresa` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` int(11) NOT NULL,
  `numero_de_funcionarios` int(11) NOT NULL,
  `porque_procura` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `psicologos`
--

CREATE TABLE `psicologos` (
  `id_psicologo` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `carteira_identificacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `psicologos`
--

INSERT INTO `psicologos` (`id_psicologo`, `nome`, `email`, `telefone`, `status`, `cpf`, `senha`, `carteira_identificacao`) VALUES
(1, 'davi', 'daviluizfeltrin@gmail.com', '48998540226', 'A', '10654444943', '$2y$10$cIUs0D5fwSJnW.POahKTxOgJzyF7U/G8RPfJHQ.BYqLhL10BiRwYW', 430200);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('empresa','funcionario','psicologo','admin') NOT NULL,
  `status` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `senha`, `tipo`, `status`) VALUES
(1, 'admin@gmail.com', 'admin123', 'admin', 'A');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento_consulta`
--
ALTER TABLE `agendamento_consulta`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `id_psicologo` (`id_psicologo`);

--
-- Índices de tabela `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_consulta`),
  ADD KEY `id_agendamento` (`id_agendamento`),
  ADD KEY `id_psicologo` (`id_psicologo`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `empresas_psicologos`
--
ALTER TABLE `empresas_psicologos`
  ADD PRIMARY KEY (`id_empresa`,`id_psicologo`),
  ADD KEY `fk_empresas_psicologos_psicologo` (`id_psicologo`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id_funcionario`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Índices de tabela `funcionarios_consultas`
--
ALTER TABLE `funcionarios_consultas`
  ADD PRIMARY KEY (`id_funcionario`,`id_agendamento`),
  ADD KEY `id_agendamento` (`id_agendamento`);

--
-- Índices de tabela `proposta`
--
ALTER TABLE `proposta`
  ADD PRIMARY KEY (`id_proposta`);

--
-- Índices de tabela `psicologos`
--
ALTER TABLE `psicologos`
  ADD PRIMARY KEY (`id_psicologo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento_consulta`
--
ALTER TABLE `agendamento_consulta`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_consulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `proposta`
--
ALTER TABLE `proposta`
  MODIFY `id_proposta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `psicologos`
--
ALTER TABLE `psicologos`
  MODIFY `id_psicologo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamento_consulta`
--
ALTER TABLE `agendamento_consulta`
  ADD CONSTRAINT `agendamento_consulta_ibfk_1` FOREIGN KEY (`id_psicologo`) REFERENCES `psicologos` (`id_psicologo`);

--
-- Restrições para tabelas `consultas`
--
ALTER TABLE `consultas`
  ADD CONSTRAINT `consultas_ibfk_1` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamento_consulta` (`id_agendamento`),
  ADD CONSTRAINT `consultas_ibfk_2` FOREIGN KEY (`id_psicologo`) REFERENCES `psicologos` (`id_psicologo`);

--
-- Restrições para tabelas `empresas_psicologos`
--
ALTER TABLE `empresas_psicologos`
  ADD CONSTRAINT `fk_empresas_psicologos_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_empresas_psicologos_psicologo` FOREIGN KEY (`id_psicologo`) REFERENCES `psicologos` (`id_psicologo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id_empresa`);

--
-- Restrições para tabelas `funcionarios_consultas`
--
ALTER TABLE `funcionarios_consultas`
  ADD CONSTRAINT `funcionarios_consultas_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionarios` (`id_funcionario`),
  ADD CONSTRAINT `funcionarios_consultas_ibfk_2` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamento_consulta` (`id_agendamento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
