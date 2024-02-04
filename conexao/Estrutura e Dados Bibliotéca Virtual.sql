-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.twi.com.br:3306
-- Tempo de Geração: 26/09/2022 às 20:55:53
-- Versão do Servidor: 5.6.49-log
-- Versão do PHP: 7.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `pibemaprgovbr`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_biblioteca`
--

CREATE TABLE IF NOT EXISTS `bb_biblioteca` (
  `cod_biblioteca` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_biblioteca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `bb_biblioteca`
--

INSERT INTO `bb_biblioteca` (`cod_biblioteca`, `nome`, `telefone`, `responsavel`) VALUES
(1, 'Biblioteca Octávio Simioni', '4532381347', 'Adriana'),
(2, 'BIBI', '2342', 'Eu');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_emprestimo`
--

CREATE TABLE IF NOT EXISTS `bb_emprestimo` (
  `cod_emprestimo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_leitor` int(11) NOT NULL,
  `cod_livro` int(11) NOT NULL,
  `cod_biblioteca` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `situacao_emprestimo` int(11) DEFAULT NULL COMMENT '1= Devolvido, 0 = N Devolvido',
  PRIMARY KEY (`cod_emprestimo`),
  KEY `cod_leitor` (`cod_leitor`),
  KEY `cod_livro` (`cod_livro`),
  KEY `cod_biblioteca` (`cod_biblioteca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Extraindo dados da tabela `bb_emprestimo`
--

INSERT INTO `bb_emprestimo` (`cod_emprestimo`, `cod_leitor`, `cod_livro`, `cod_biblioteca`, `data_emprestimo`, `data_devolucao`, `obs`, `situacao_emprestimo`) VALUES
(34, 2, 7, 1, '2015-02-08', '2015-02-12', '', 0),
(35, 4, 13, 1, '2016-08-19', '2016-08-23', 'Teste', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_genero`
--

CREATE TABLE IF NOT EXISTS `bb_genero` (
  `cod_genero` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_genero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `bb_genero`
--

INSERT INTO `bb_genero` (`cod_genero`, `genero`) VALUES
(2, 'Romance'),
(3, 'Terror'),
(4, 'Suspense'),
(5, 'Ações'),
(6, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_leitor`
--

CREATE TABLE IF NOT EXISTS `bb_leitor` (
  `cod_leitor` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cod_tipo` int(11) NOT NULL,
  `cod_biblioteca` int(11) NOT NULL,
  PRIMARY KEY (`cod_leitor`),
  KEY `cod_tipo` (`cod_tipo`),
  KEY `cod_biblioteca` (`cod_biblioteca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `bb_leitor`
--

INSERT INTO `bb_leitor` (`cod_leitor`, `nome`, `telefone`, `cod_tipo`, `cod_biblioteca`) VALUES
(2, 'evandro gonçalves', '4591212223', 1, 1),
(4, 'Jonival Gonçalves :D', '4591274441', 1, 1),
(6, 'Leandro', '4591382364', 1, 1),
(8, 'testess', '43', 1, 1),
(10, 'stese', '234', 1, 1),
(12, 'Leandro', '34', 2, 1),
(13, 'qwer', '4343', 1, 1),
(14, 'dfadsf', '567', 1, 1),
(16, 'testesdf', '24234', 1, 1),
(17, 'testedfsd', '234', 1, 1),
(18, 'qwerqwre', '5656', 1, 1),
(19, 'tsfd', '234', 1, 1),
(20, 'sdfasdf', '234', 1, 1),
(21, 'sdf', '234', 1, 1),
(22, 'sfasdf', '23', 1, 1),
(23, 'sdfsdf', '234234', 1, 1),
(24, 'asdf', '234', 2, 1),
(25, 'werwer', '234', 3, 1),
(26, 'asdfrf', '234', 2, 1),
(27, 'sadfs', 'sdfsdf', 2, 2),
(28, 'asd', '3443', 2, 2),
(29, 'adsf', '234', 2, 1),
(30, 'adsfsadf', '23423', 1, 2),
(31, 'asdfasdf', '2134234', 1, 2),
(32, 'Rodrigo teste', '', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_livro`
--

CREATE TABLE IF NOT EXISTS `bb_livro` (
  `cod_livro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `qtd` int(11) NOT NULL,
  `cod_genero` int(11) NOT NULL,
  `cod_biblioteca` int(11) NOT NULL,
  PRIMARY KEY (`cod_livro`),
  KEY `cod_genero` (`cod_genero`),
  KEY `cod_biblioteca` (`cod_biblioteca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `bb_livro`
--

INSERT INTO `bb_livro` (`cod_livro`, `nome`, `autor`, `titulo`, `volume`, `qtd`, `cod_genero`, `cod_biblioteca`) VALUES
(7, 'O massacre do garfo', 'Tonho', 'O massacre do garfo', '2', 1, 3, 1),
(9, 'Teste', 'teste', 'testes', '1', 0, 3, 1),
(10, 'teste1', 'teste1', 'teste1', '1', 0, 2, 1),
(12, 'Teste2', 'teste2', 'teste2', '1', 0, 4, 1),
(13, 'Cofrinho azul', 'Dono do cofrinho', 'Cofrinho', '1', 2, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_tipo_leitor`
--

CREATE TABLE IF NOT EXISTS `bb_tipo_leitor` (
  `cod_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `emprestimo_dias` int(11) NOT NULL,
  `qtd_livros` int(11) NOT NULL,
  PRIMARY KEY (`cod_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `bb_tipo_leitor`
--

INSERT INTO `bb_tipo_leitor` (`cod_tipo`, `tipo`, `emprestimo_dias`, `qtd_livros`) VALUES
(1, 'Aluno', 4, 3),
(2, 'Professor', 14, 14),
(3, 'SR', 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_usuario`
--

CREATE TABLE IF NOT EXISTS `bb_usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cod_biblioteca` int(11) NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  KEY `cod_biblioteca` (`cod_biblioteca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `bb_usuario`
--

INSERT INTO `bb_usuario` (`cod_usuario`, `nome`, `telefone`, `usuario`, `senha`, `cod_biblioteca`) VALUES
(1, 'Leandro Gonçalves', '4591382364', 'leandro', 'senha', 1);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `bb_emprestimo`
--
ALTER TABLE `bb_emprestimo`
  ADD CONSTRAINT `bb_emprestimo_ibfk_1` FOREIGN KEY (`cod_leitor`) REFERENCES `bb_leitor` (`cod_leitor`),
  ADD CONSTRAINT `bb_emprestimo_ibfk_2` FOREIGN KEY (`cod_livro`) REFERENCES `bb_livro` (`cod_livro`),
  ADD CONSTRAINT `bb_emprestimo_ibfk_3` FOREIGN KEY (`cod_biblioteca`) REFERENCES `bb_biblioteca` (`cod_biblioteca`);

--
-- Restrições para a tabela `bb_leitor`
--
ALTER TABLE `bb_leitor`
  ADD CONSTRAINT `bb_leitor_ibfk_1` FOREIGN KEY (`cod_tipo`) REFERENCES `bb_tipo_leitor` (`cod_tipo`),
  ADD CONSTRAINT `bb_leitor_ibfk_2` FOREIGN KEY (`cod_biblioteca`) REFERENCES `bb_biblioteca` (`cod_biblioteca`);

--
-- Restrições para a tabela `bb_livro`
--
ALTER TABLE `bb_livro`
  ADD CONSTRAINT `bb_livro_ibfk_1` FOREIGN KEY (`cod_genero`) REFERENCES `bb_genero` (`cod_genero`),
  ADD CONSTRAINT `bb_livro_ibfk_2` FOREIGN KEY (`cod_biblioteca`) REFERENCES `bb_biblioteca` (`cod_biblioteca`);

--
-- Restrições para a tabela `bb_usuario`
--
ALTER TABLE `bb_usuario`
  ADD CONSTRAINT `bb_usuario_ibfk_1` FOREIGN KEY (`cod_biblioteca`) REFERENCES `bb_biblioteca` (`cod_biblioteca`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
