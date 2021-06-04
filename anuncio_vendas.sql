-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jun-2021 às 05:35
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `anuncio_vendas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `anuncio_id` int(11) NOT NULL,
  `anuncio_user_id` int(11) UNSIGNED NOT NULL,
  `anuncio_codigo` longtext NOT NULL,
  `anuncio_titulo` varchar(255) NOT NULL,
  `anuncio_descricao` longtext NOT NULL,
  `anuncio_categoria_pai_id` int(11) NOT NULL,
  `anuncio_categoria_id` int(11) NOT NULL,
  `anuncio_preco` decimal(15,2) NOT NULL,
  `anuncio_localizacao_cep` varchar(15) NOT NULL,
  `anuncio_logradouro` varchar(255) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_bairro` varchar(50) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_cidade` varchar(50) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_estado` varchar(2) DEFAULT NULL COMMENT 'Preenchido via consulta API Via CEP',
  `anuncio_bairro_metalink` varchar(50) DEFAULT NULL,
  `anuncio_cidade_metalink` varchar(50) DEFAULT NULL,
  `anuncio_data_criacao` timestamp NULL DEFAULT current_timestamp(),
  `anuncio_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `anuncio_publicado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Publicado ou não',
  `anuncio_situacao` tinyint(1) NOT NULL COMMENT 'Novo ou usado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `anuncios`
--

INSERT INTO `anuncios` (`anuncio_id`, `anuncio_user_id`, `anuncio_codigo`, `anuncio_titulo`, `anuncio_descricao`, `anuncio_categoria_pai_id`, `anuncio_categoria_id`, `anuncio_preco`, `anuncio_localizacao_cep`, `anuncio_logradouro`, `anuncio_bairro`, `anuncio_cidade`, `anuncio_estado`, `anuncio_bairro_metalink`, `anuncio_cidade_metalink`, `anuncio_data_criacao`, `anuncio_data_alteracao`, `anuncio_publicado`, `anuncio_situacao`) VALUES
(1, 4, '12345678', 'PS4 a venda em bom estado', 'PS4 a venda em bom estado', 3, 5, '35000.00', '0000', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-31 05:35:53', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_fotos`
--

CREATE TABLE `anuncios_fotos` (
  `foto_id` int(11) NOT NULL,
  `foto_anuncio_id` int(11) DEFAULT NULL,
  `foto_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_perguntas`
--

CREATE TABLE `anuncios_perguntas` (
  `pergunta_id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `anuncio_user_id` int(11) NOT NULL COMMENT 'ID do dono do anuncio. Será utilizado para verificar se a pergunta não está atrelada a outro anunciante',
  `anunciante_pergunta_id` int(11) NOT NULL,
  `pergunta` text DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `data_pergunta` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_resposta` datetime DEFAULT NULL,
  `pergunta_respondida` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Uma pergunta sempre será inserida como 0 (zero)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `anuncios_perguntas_historico`
--

CREATE TABLE `anuncios_perguntas_historico` (
  `pergunta_id` int(11) NOT NULL,
  `anuncio_id` int(11) NOT NULL,
  `anuncio_user_id` int(11) NOT NULL COMMENT 'ID do dono do anuncio. Será utilizado para verificar se a pergunta não está atrelada a outro anunciante',
  `anunciante_pergunta_id` int(11) NOT NULL,
  `pergunta` text DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `data_pergunta` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_resposta` datetime DEFAULT NULL,
  `pergunta_respondida` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Uma pergunta sempre será inserida como 0 (zero)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `categoria_id` int(11) NOT NULL,
  `categoria_pai_id` int(11) DEFAULT NULL,
  `categoria_nome` varchar(45) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_meta_link` varchar(100) DEFAULT NULL,
  `categoria_data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_pai_id`, `categoria_nome`, `categoria_ativa`, `categoria_meta_link`, `categoria_data_criacao`, `categoria_data_alteracao`) VALUES
(2, 3, 'Mouse', 1, 'mouse', '2021-03-10 06:32:23', '2021-03-11 04:54:41'),
(3, 3, 'Phones de ouvido gamer', 1, 'phones-de-ouvido-gamer', '2021-03-11 04:57:36', NULL),
(5, 3, 'controles', 1, 'controles', '2021-05-31 05:34:04', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_pai`
--

CREATE TABLE `categorias_pai` (
  `categoria_pai_id` int(11) NOT NULL,
  `categoria_pai_nome` varchar(45) NOT NULL,
  `categoria_pai_ativa` tinyint(1) DEFAULT NULL,
  `categoria_pai_meta_link` varchar(100) DEFAULT NULL,
  `categoria_pai_classe_icone` varchar(50) NOT NULL,
  `categoria_pai_data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria_pai_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias_pai`
--

INSERT INTO `categorias_pai` (`categoria_pai_id`, `categoria_pai_nome`, `categoria_pai_ativa`, `categoria_pai_meta_link`, `categoria_pai_classe_icone`, `categoria_pai_data_criacao`, `categoria_pai_data_alteracao`) VALUES
(2, 'Informática', 1, 'informatica', 'lni-laptop', '2021-03-09 04:49:03', NULL),
(3, 'Games', 1, 'games', 'lni-laptop', '2021-03-10 06:38:39', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'pambaleiros', 'pambaleiro(a)');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

CREATE TABLE `sistema` (
  `sistema_id` int(11) NOT NULL,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_nif` varchar(14) DEFAULT NULL,
  `sistema_agt` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_titulo` varchar(255) DEFAULT NULL,
  `sistema_cep` varchar(4) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_bairro` varchar(100) NOT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_provincia` varchar(45) DEFAULT NULL,
  `sistema_data_alteracao` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_nif`, `sistema_agt`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_titulo`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_bairro`, `sistema_cidade`, `sistema_provincia`, `sistema_data_alteracao`) VALUES
(1, 'Anuncios Inc - Queta', 'Anúncios legais', '002054351LA035', '', '22244556', '+244926219731', 'anuncioslegais@contato.com', 'Anúncios pambala', '0000', 'Malanje', '001', 'Rua da programação', 'Malanje', 'ME', '2021-05-31 05:05:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_foto` varchar(255) NOT NULL,
  `user_bilhete` varchar(15) NOT NULL,
  `user_endereco` varchar(255) NOT NULL,
  `user_numero_endereco` varchar(50) NOT NULL,
  `user_bairro` varchar(50) NOT NULL,
  `user_cidade` varchar(50) NOT NULL,
  `user_provincia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `user_foto`, `user_bilhete`, `user_endereco`, `user_numero_endereco`, `user_bairro`, `user_cidade`, `user_provincia`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$1eDLbdZK0yJXjbNuUp4uteX9ZcB9yGqanKQ/ey7ZV76NRL0YzyMPy', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1622629190, 1, 'Admin Osvaldo Queta', 'istrator', 'ADMIN', '926219731', '1d4e9d128600b422adf7fca86241037f.jpg', '002054351LA035', 'Malanje', '09', 'Maxinde', 'Malanje', 'Malanje'),
(4, '::1', NULL, '$2y$10$Yo5xa2QVg3l1OmuTNqvONuKXlrwtDq0SctHhGJUcOTkQidg7G.HSm', 'delfina@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1615011060, 1616343307, 1, 'Delfina', 'Chinawandela', NULL, '928155131', 'c4dd5513a368df47607929fd9ba4e44b.jpg', '002054351LA035', 'Malanje', 'Malanje', 'Maxinde', 'Malanje', 'Malanje');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(4, 1, 1),
(12, 4, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`anuncio_id`),
  ADD KEY `fk_anuncio_user_id` (`anuncio_user_id`);

--
-- Índices para tabela `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `fk_foto_anuncio_id` (`foto_anuncio_id`);

--
-- Índices para tabela `anuncios_perguntas`
--
ALTER TABLE `anuncios_perguntas`
  ADD PRIMARY KEY (`pergunta_id`),
  ADD KEY `anuncio_id` (`anuncio_id`),
  ADD KEY `anunciante_pergunta_id` (`anunciante_pergunta_id`);

--
-- Índices para tabela `anuncios_perguntas_historico`
--
ALTER TABLE `anuncios_perguntas_historico`
  ADD PRIMARY KEY (`pergunta_id`),
  ADD KEY `anuncio_id` (`anuncio_id`),
  ADD KEY `anunciante_pergunta_id` (`anunciante_pergunta_id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categoria_id`),
  ADD KEY `categoria_pai_id` (`categoria_pai_id`);

--
-- Índices para tabela `categorias_pai`
--
ALTER TABLE `categorias_pai`
  ADD PRIMARY KEY (`categoria_pai_id`);

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sistema`
--
ALTER TABLE `sistema`
  ADD PRIMARY KEY (`sistema_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Índices para tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `anuncio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `anuncios_perguntas`
--
ALTER TABLE `anuncios_perguntas`
  MODIFY `pergunta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `anuncios_perguntas_historico`
--
ALTER TABLE `anuncios_perguntas_historico`
  MODIFY `pergunta_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `categorias_pai`
--
ALTER TABLE `categorias_pai`
  MODIFY `categoria_pai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `sistema`
--
ALTER TABLE `sistema`
  MODIFY `sistema_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_anuncio_user_id` FOREIGN KEY (`anuncio_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `anuncios_fotos`
--
ALTER TABLE `anuncios_fotos`
  ADD CONSTRAINT `fk_foto_anuncio_id` FOREIGN KEY (`foto_anuncio_id`) REFERENCES `anuncios` (`anuncio_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `anuncios_perguntas`
--
ALTER TABLE `anuncios_perguntas`
  ADD CONSTRAINT `fk_anuncio_id` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`anuncio_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `anuncios_perguntas_historico`
--
ALTER TABLE `anuncios_perguntas_historico`
  ADD CONSTRAINT `fk_anuncio_id_historico` FOREIGN KEY (`anuncio_id`) REFERENCES `anuncios` (`anuncio_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `fk_categoria_pai_id` FOREIGN KEY (`categoria_pai_id`) REFERENCES `categorias_pai` (`categoria_pai_id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
