-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25/11/2024 às 13:04
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
-- Banco de dados: `papanico`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `pac_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agenda`
--

INSERT INTO `agenda` (`id`, `pac_id`, `data`, `horario`) VALUES
(1, 21, '2024-11-08', '12:20:00'),
(2, 23, '2024-11-09', '08:24:00'),
(3, 21, '2024-11-08', '08:30:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

CREATE TABLE `avisos` (
  `aviso_id` int(11) NOT NULL,
  `pac_id` int(11) DEFAULT NULL,
  `tipo_aviso` varchar(50) NOT NULL,
  `mensagem_aviso` varchar(50) NOT NULL,
  `data_aviso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `exame`
--

CREATE TABLE `exame` (
  `exame_id` int(11) NOT NULL,
  `pac_id` int(11) NOT NULL,
  `exame_Data` date NOT NULL,
  `exames_result` varchar(200) NOT NULL,
  `exame_obs` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `examemock`
--

CREATE TABLE `examemock` (
  `exame_id` int(11) NOT NULL,
  `pac_id` int(11) NOT NULL,
  `fez_papanicolau` enum('Sim','Não','Não Lembro') NOT NULL,
  `data_papanicolau` date DEFAULT NULL,
  `usa_diu` enum('Sim','Não') NOT NULL,
  `gravida` enum('Sim','Não') NOT NULL,
  `usa_pilula` enum('Sim','Não') NOT NULL,
  `usa_hormonio` enum('Sim','Não') NOT NULL,
  `fez_radioterapia` enum('Sim','Não') NOT NULL,
  `data_ultima_menstruacao` date DEFAULT NULL,
  `nao_lembra_menstruacao` enum('Sim','Não') DEFAULT NULL,
  `sangramento_relacao` enum('Sim','Não') NOT NULL,
  `sangramento_menopausa` enum('Sim','Não') NOT NULL,
  `inspecao_colo` enum('Normal','Ausente','Alterado','Não visualizado') NOT NULL,
  `sinais_dst` enum('Sim','Não') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `examemock`
--

INSERT INTO `examemock` (`exame_id`, `pac_id`, `fez_papanicolau`, `data_papanicolau`, `usa_diu`, `gravida`, `usa_pilula`, `usa_hormonio`, `fez_radioterapia`, `data_ultima_menstruacao`, `nao_lembra_menstruacao`, `sangramento_relacao`, `sangramento_menopausa`, `inspecao_colo`, `sinais_dst`, `created_at`, `updated_at`) VALUES
(1, 18, 'Não', '0222-02-22', 'Sim', 'Não', 'Sim', 'Não', 'Sim', '0000-00-00', 'Não', 'Sim', 'Não', 'Alterado', 'Sim', '2024-11-23 01:45:13', '2024-11-23 02:51:29'),
(2, 20, 'Sim', '0010-10-25', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim', '2002-10-25', NULL, 'Sim', 'Sim', 'Normal', 'Sim', '2024-11-23 01:59:40', '2024-11-23 01:59:40'),
(3, 24, 'Sim', '3333-03-31', 'Sim', 'Sim', 'Sim', 'Não', 'Não', '3333-03-31', 'Não', 'Sim', 'Não', 'Alterado', 'Não', '2024-11-23 02:54:33', '2024-11-23 02:54:33'),
(4, 27, 'Sim', '2024-11-08', 'Não', 'Sim', 'Sim', 'Não', 'Sim', '2024-11-08', 'Não', 'Não', 'Sim', 'Ausente', 'Não', '2024-11-25 11:38:24', '2024-11-25 11:38:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `pac_id` int(5) NOT NULL,
  `pac_nome` varchar(50) NOT NULL,
  `pac_cpf` varchar(11) NOT NULL,
  `pac_sus` varchar(15) NOT NULL,
  `pac_datanasc` date NOT NULL,
  `pac_celular` varchar(20) NOT NULL,
  `pac_telefone2` varchar(20) DEFAULT NULL,
  `pac_tel_recados` varchar(20) DEFAULT NULL,
  `pac_email` varchar(50) DEFAULT NULL,
  `pac_endereco` varchar(100) NOT NULL,
  `ubs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`pac_id`, `pac_nome`, `pac_cpf`, `pac_sus`, `pac_datanasc`, `pac_celular`, `pac_telefone2`, `pac_tel_recados`, `pac_email`, `pac_endereco`, `ubs_id`, `user_id`) VALUES
(18, 'Sanozuki sagara gianico Pika', '141.034.112', '123456789123456', '2222-02-22', '(16) 99999-1212', '(16) 3252-8222', '(16) 9999-1212', 'maria@jasebel.com', 'asasdas', 1, 1),
(20, 'jose marimbondo', '431.233.234', '123124141', '2024-06-04', '(16) 99909-9999', '(16) 9909-9999', '(16) 9909-9999', 'jose@gmail.com', 'Rua Num sei oq n sei oq la', 2, 1),
(21, 'paulo ricardo', '431.233.234', '12423422', '2024-11-27', '(16) 99909-9999', '(16) 9909-9999', '(16) 9909-9999', 'paulo@gmail.com', 'Feio', 1, 1),
(22, 'leo', '431.233.234', '12423422', '2024-11-01', '(16) 99909-9999', '(16) 9909-9999', '(16) 9909-9999', 'leo@gmail.com', 'fefweffw', 2, 1),
(23, 'antonio12', '431.233.234', '12423422', '2024-11-02', '(16) 99909-9999', '(16) 9909-9999', '(16) 9909-9999', 'antonio@gmail.com', 'hberhregreg', 2, 1),
(24, 'paulo', '555.555.555', '23423525235', '2024-11-27', '(99) 99999-9999', '(99) 9999-9999', '(99) 9999-9999', 'paulo@gmail.com', 'Rua Paulo Ricardo', 3, 1),
(25, 'MARIA EDUARDA DOS SANTOS', '555.555.555', '3423423423', '2024-11-01', '(99) 99999-9999', '(99) 9999-9999', '(99) 9999-9999', 'paulo@gmail.com', 'Rua Vicente Romano', 3, 1),
(26, 'MARIA EDUARDA DOS SANTOS', '242.342.342', '234234234', '2024-11-01', '(16) 99999-9999', '(16) 9999-9999', '(16) 9999-9999', 'maria@gmail.com', 'Rua Vicente Romano', 2, 1),
(27, 'mari', '242.342.342', '2342423424', '2024-11-07', '(16) 99999-9999', '(16) 9999-9999', '(16) 9999-9999', 'maria66@gmail.com', 'ger', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ubs`
--

CREATE TABLE `ubs` (
  `ubs_id` int(5) NOT NULL,
  `ubs_nome` varchar(50) NOT NULL,
  `ubs_telefone` varchar(20) NOT NULL,
  `ubs_endereco` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ubs`
--

INSERT INTO `ubs` (`ubs_id`, `ubs_nome`, `ubs_telefone`, `ubs_endereco`) VALUES
(1, 'talavasso', '16999999999', 'Rua Viviiviviv'),
(2, 'ubs falida', '(16) 99133-6573', 'Rua dos pandeiros, vila soraima, 69'),
(3, 'dr paulo ricardo da silva', '(16) 99705-2781', 'Lá'),
(4, 'ubs yasmim', '(17) 99788-8888', 'wefbwehfb');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `user_id` int(11) NOT NULL,
  `ubs_id` int(11) DEFAULT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_senha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`user_id`, `ubs_id`, `user_login`, `user_senha`) VALUES
(1, 1, 'enf1', '123'),
(4, NULL, 'maria', '123'),
(5, 2, 'alex', '123'),
(6, 3, 'paulo ricardo', 'paulo'),
(7, 4, 'yas', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pac_id` (`pac_id`);

--
-- Índices de tabela `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`aviso_id`),
  ADD KEY `pac_id` (`pac_id`);

--
-- Índices de tabela `exame`
--
ALTER TABLE `exame`
  ADD PRIMARY KEY (`exame_id`),
  ADD KEY `pac_id` (`pac_id`);

--
-- Índices de tabela `examemock`
--
ALTER TABLE `examemock`
  ADD PRIMARY KEY (`exame_id`),
  ADD KEY `pac_id` (`pac_id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`pac_id`),
  ADD KEY `ubs_id` (`ubs_id`),
  ADD KEY `usuario_id` (`user_id`);

--
-- Índices de tabela `ubs`
--
ALTER TABLE `ubs`
  ADD PRIMARY KEY (`ubs_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `ubs_id` (`ubs_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `aviso_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `exame`
--
ALTER TABLE `exame`
  MODIFY `exame_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `examemock`
--
ALTER TABLE `examemock`
  MODIFY `exame_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `pac_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `ubs`
--
ALTER TABLE `ubs`
  MODIFY `ubs_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`pac_id`);

--
-- Restrições para tabelas `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `avisos_ibfk_1` FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`pac_id`);

--
-- Restrições para tabelas `exame`
--
ALTER TABLE `exame`
  ADD CONSTRAINT `exame_ibfk_1` FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`pac_id`);

--
-- Restrições para tabelas `examemock`
--
ALTER TABLE `examemock`
  ADD CONSTRAINT `examemock_ibfk_1` FOREIGN KEY (`pac_id`) REFERENCES `pacientes` (`pac_id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`ubs_id`) REFERENCES `ubs` (`ubs_id`),
  ADD CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`user_id`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`ubs_id`) REFERENCES `ubs` (`ubs_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
