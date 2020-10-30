-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 06-Out-2020 às 20:29
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_curso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `alu_id` int(11) NOT NULL,
  `alu_nome` varchar(200) COLLATE utf8_bin NOT NULL,
  `alu_data_cadastro` date NOT NULL,
  `alu_data_atualizado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela de Alunos';

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`alu_id`, `alu_nome`, `alu_data_cadastro`, `alu_data_atualizado`) VALUES
(1, 'Jônatas Ramos', '2020-10-04', '2020-10-06 18:26:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `cur_id` int(11) NOT NULL,
  `cur_nome` varchar(200) COLLATE utf8_bin NOT NULL,
  `cur_carga_horaria` int(11) NOT NULL,
  `cur_data_cadastro` date NOT NULL,
  `cur_data_atualizado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela de cursos';

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`cur_id`, `cur_nome`, `cur_carga_horaria`, `cur_data_cadastro`, `cur_data_atualizado`) VALUES
(1, 'Laravel', 180, '2020-10-04', '2020-10-06 18:27:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_aluno`
--

CREATE TABLE `curso_aluno` (
  `cal_id` int(11) NOT NULL,
  `cal_id_aluno` int(11) NOT NULL,
  `cal_id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela pivô entrea Curso e Aluno';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`alu_id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`cur_id`),
  ADD UNIQUE KEY `cur_nome_UNIQUE` (`cur_nome`);

--
-- Indexes for table `curso_aluno`
--
ALTER TABLE `curso_aluno`
  ADD PRIMARY KEY (`cal_id`),
  ADD KEY `fk_curso_aluno_aluno_idx` (`cal_id_aluno`),
  ADD KEY `fk_curso_aluno_curso1_idx` (`cal_id_curso`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aluno`
--
ALTER TABLE `aluno`
  MODIFY `alu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `cur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `curso_aluno`
--
ALTER TABLE `curso_aluno`
  MODIFY `cal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `curso_aluno`
--
ALTER TABLE `curso_aluno`
  ADD CONSTRAINT `fk_curso_aluno_aluno` FOREIGN KEY (`cal_id_aluno`) REFERENCES `aluno` (`alu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_curso_aluno_curso1` FOREIGN KEY (`cal_id_curso`) REFERENCES `curso` (`cur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
