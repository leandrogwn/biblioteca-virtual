-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: mysql.twi.com.br:3306
-- Tempo de Geração: 26/09/2022 às 20:56:26
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `bb_genero`
--

CREATE TABLE IF NOT EXISTS `bb_genero` (
  `cod_genero` int(11) NOT NULL AUTO_INCREMENT,
  `genero` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_genero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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
