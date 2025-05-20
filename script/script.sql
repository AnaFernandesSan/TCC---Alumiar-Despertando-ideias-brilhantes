CREATE DATABASE seila;
USE seila;

-- Tabela usuario
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL,
  `sobrenome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nasc` date NOT NULL,
  `nivel` int(11) NULL,
  `tipo` ENUM('normal', 'imagem')  NULL,
  `token` varchar (255) NULL,
  `token_tempoVida` varchar (255) NULL,
  `foto` varchar (200) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela videos
CREATE TABLE `videos` (
  `id` int(11) NOT NULL auto_increment ,
  `titulo` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Tabela atividade
CREATE TABLE `atividade` (
  `id` int(11) NOT NULL auto_increment,
  `tipo` enum('quiz','arrastar') NOT NULL,
  `dificuldade` varchar(255) NOT NULL,
  `pontos` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela arrastar
CREATE TABLE `arrastar` (
  `word` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  PRIMARY KEY (`atividade_id`),
  CONSTRAINT `fk_arrastar_atividade_id` FOREIGN KEY (`atividade_id`) REFERENCES `atividade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela quiz
CREATE TABLE `quiz` (
  `nome` varchar(255) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  PRIMARY KEY (`atividade_id`),
  CONSTRAINT `fk_quiz_atividade_id` FOREIGN KEY (`atividade_id`) REFERENCES `atividade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela pergunta (chave estrangeira renomeada para quiz_id)
CREATE TABLE `pergunta` (
  `id` int(11) NOT NULL auto_increment,
  `quiz_id` int(11) NOT NULL, -- Renomeado de atividade_id para quiz_id
  `pergunta` varchar(255) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `tipo` enum('normal','imagem') NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`atividade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela pre_req
CREATE TABLE `pre_req` (
  `id` int(11) NOT NULL auto_increment,
  `aula_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pre_req_ibfk_1` (`aula_id`),
  CONSTRAINT `pre_req_ibfk_1` FOREIGN KEY (`aula_id`) REFERENCES `videos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela realiza
CREATE TABLE `realiza` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `atividade_id` int(11) NOT NULL,
  `tentativa` int(11) NOT NULL,
  `pontuacao` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `atividade_id` (`atividade_id`),
  CONSTRAINT `realiza_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`id`),
  CONSTRAINT `realiza_ibfk_2` FOREIGN KEY (`atividade_id`) REFERENCES `atividade` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabela resposta
CREATE TABLE `resposta` (
  `id` int(11) NOT NULL auto_increment,
  `pergunta_id` int(11) NOT NULL,
  `resposta` varchar(255) NOT NULL,
  `resposta_correta` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pergunta_id` (`pergunta_id`),
  CONSTRAINT `fk_resposta_pergunta_id` FOREIGN KEY (`pergunta_id`) REFERENCES `pergunta` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

