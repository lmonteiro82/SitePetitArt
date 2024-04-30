-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Abr-2024 às 23:42
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `petitart`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`) VALUES
(2, 'marco', '$2y$10$B5CUWeduvgGFMHbHUC/gk.CbFy/NkNyX9688l6DuuYyNlJBZeheH2', ''),
(3, 'monica', '$2y$10$ksxSUoUmkrBrhKwdI1PMMObvGRk7wzeoZlZbrx.tEkmMJUQoCSsZu', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome`, `email`, `password`) VALUES
(2, 'Joao', 'joao@fernando.pt', '$2y$10$DyuCmwlcTWQZfXtAYvxATO3O7ZeRtfiMveJwnk0IuVEhASZBLgj4e'),
(4, 'marco', 'marcoalves1517@gmail.com', '$2y$10$FREGe4zZD0lFiy6WzBAyRe8lHSBV.gn15K/7lnT7/zwmGS2LS.phy'),
(5, 'andre', 'andre@andre.com', '$2y$10$b5tAUXOo7xfxih20Sv6x8ORQ8mnyzlsXWSH.vNXK6KkkD//BmFN2O'),
(6, 'maria', 'maria@maria.com', '$2y$10$K7eulRuMW6HUZgoaMVxm6u6Oyanpe9b6bdYmPz4YjTR.v4axUYiuC'),
(7, 'leandro', 'leandro@leandro.cic', '$2y$10$9ztYsIXkf98fxi/9bFS.Fe7F7A/BWHiLDz73A6UvDJoh5Dlz.vDQ6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_pedido` date NOT NULL,
  `status` enum('pendente','pago','aguardando levantamento','terminado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantidade` int(11) NOT NULL,
  `imagem` text NOT NULL,
  `data_adicao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `rrp`, `quantidade`, `imagem`, `data_adicao`) VALUES
(1, 'Budas de gesso perfumados com flores', 'Budinhas de gesso perfumados com flores, apenas na Petit Art.', 10.00, 0.00, 10, 'arranjoflores.jpg', '2019-03-13 17:55:22'),
(2, 'Caixa Rosas Perfumadas', 'Caixinha com rosas perfumadas, de um novo cheiro ao seu lar.', 4.99, 0.00, 20, 'caixarosas.jpg', '2019-03-13 18:52:49'),
(3, 'Canecas dia da mae', 'Compre aqui a caneca para a sua querida mae', 5.99, 0.00, 10, 'canecasdiamae.jpg', '2019-03-13 18:47:56'),
(4, 'Corujas de gesso', 'Corujas de gesso perfumadas', 7.00, 0.00, 7, 'corujas.jpg', '2019-03-13 17:42:04');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índices para tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
