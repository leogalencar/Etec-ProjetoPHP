-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Ago-2022 às 01:55
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `2dsprojeto`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `salvar_categoria` (IN `var_id` INT, IN `var_descricao` VARCHAR(50), IN `var_video` VARCHAR(100))  BEGIN
    DECLARE id_cat int;
    SET id_cat = (SELECT id FROM categoria WHERE id = var_id);
   
    IF (id_cat > 0) THEN
        UPDATE categoria SET descricao = var_descricao, video = var_video WHERE id = var_id;
        COMMIT;
    ELSE
        INSERT INTO categoria VALUES(var_id, var_descricao, var_video);
        COMMIT;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `salvar_cliente` (IN `var_id` INT, IN `var_nome` VARCHAR(50), IN `var_email` VARCHAR(50), IN `var_telefone` VARCHAR(20), IN `var_video` VARCHAR(100))  BEGIN
    DECLARE id_cli int;
    SET id_cli = (SELECT id FROM cliente WHERE id = var_id);
   
    IF (id_cli > 0) THEN
        UPDATE cliente SET nome = var_nome WHERE id = var_id;
        UPDATE cliente SET email = var_email WHERE id = var_id;
        UPDATE cliente SET telefone = var_telefone WHERE id = var_id;
        UPDATE cliente SET video = var_video WHERE id = var_id;
        COMMIT;
    ELSE
        INSERT INTO cliente VALUES(var_id, var_nome, var_email, var_telefone, var_video);
        COMMIT;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `salvar_fornecedor` (IN `var_id` INT, `var_nome` VARCHAR(50), `var_cep` VARCHAR(20), `var_email` VARCHAR(50))  BEGIN
    DECLARE id_fornecedor int;
    SET id_fornecedor = (SELECT id FROM fornecedor WHERE id = var_id);
   
    IF (id_fornecedor > 0) THEN
        UPDATE fornecedor SET nome = var_nome WHERE id = var_id;
        UPDATE fornecedor SET cep = var_cep WHERE id = var_id;
        UPDATE fornecedor SET email = var_email WHERE id = var_id;
        COMMIT;
    ELSE
        INSERT INTO fornecedor VALUES(var_id, var_nome, var_cep, var_email);
        COMMIT;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `salvar_usuario` (IN `var_matricula` INT, IN `var_senha` VARCHAR(40))  NO SQL
BEGIN
    DECLARE id_usuario int;
    SET id_usuario = (SELECT matricula FROM usuario WHERE matricula = var_matricula);
   
    IF (id_usuario > 0) THEN
        UPDATE usuario SET matricula = var_matricula WHERE matricula = var_matricula;
        UPDATE usuario SET senha = var_senha WHERE matricula = var_matricula;
        COMMIT;
    ELSE
        INSERT INTO usuario VALUES(var_matricula, var_senha);
        COMMIT;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id`, `descricao`, `video`) VALUES
(1, 'Teste2dada', 'adad'),
(2, 'a', NULL),
(3, 'wdwddd', NULL),
(4, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `email`, `telefone`, `video`) VALUES
(1, 'Bagriel Gorges', 'gorges.bagri@email.com', '9 9999-9999', '2NyFQJGwnJM'),
(2, 'Aaa', 'emailmuitobom@email.com', '4444', 'saWgLFerG4Y'),
(3, 'dwd', 'dwdw@aaaaa', '2322', 'saZ3EHWFZSY');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `cep`, `email`) VALUES
(2, 'Coca-Cola', '13300-000', 'cocacola@contato.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`id`, `endereco`, `data_publicacao`, `id_categoria`) VALUES
(1, '9caeab6b4dd3c83582329f6719017dd40bf8d07d.jpg', '2022-05-12', 1),
(2, '418f3f43147f5e1c179e6d1b7049f9dda91c2b37.jpg', '2022-05-12', NULL),
(3, '7ca83f9985aca4c33292035c411ecce6b6834f42.jpg', '2022-05-12', NULL),
(4, '9badb439a455afa498c4a9ff2e2f1bec0918dc10.jpg', '2022-06-06', 1),
(5, '1d943bc52f0281212291ac858860fd15cb8d6d5e.jpg', '2022-06-06', 2),
(6, 'e37a87564f1c15ed2f1d45365368dee8dda186b9.png', '2022-06-07', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_fornecedor`
--

CREATE TABLE `imagem_fornecedor` (
  `id` int(11) NOT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `imagem_fornecedor`
--

INSERT INTO `imagem_fornecedor` (`id`, `endereco`, `data_publicacao`, `id_fornecedor`) VALUES
(4, 'e7da2275965cfacf539cdb2130e98f50e6bb77dd.png', '2022-06-07', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem_produto`
--

CREATE TABLE `imagem_produto` (
  `id` int(11) NOT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `data_publicacao` date DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `preco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `matricula` int(11) NOT NULL,
  `senha` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`matricula`, `senha`) VALUES
(123, '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices para tabela `imagem_fornecedor`
--
ALTER TABLE `imagem_fornecedor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_fornecedor` (`id_fornecedor`);

--
-- Índices para tabela `imagem_produto`
--
ALTER TABLE `imagem_produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`matricula`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `imagem_fornecedor`
--
ALTER TABLE `imagem_fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `imagem_produto`
--
ALTER TABLE `imagem_produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Limitadores para a tabela `imagem_fornecedor`
--
ALTER TABLE `imagem_fornecedor`
  ADD CONSTRAINT `imagem_fornecedor_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
