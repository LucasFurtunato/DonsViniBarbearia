
USE hostdeprojetos_donvinibarbearia;

DROP TABLE IF EXISTS `agendamentos`;
DROP TABLE IF EXISTS `funcionario`;
DROP TABLE IF EXISTS `galeria`;
DROP TABLE IF EXISTS `unidade`;
DROP TABLE IF EXISTS `servicos`;
DROP TABLE IF EXISTS `gerente`;
DROP TABLE IF EXISTS `cuidados`;
DROP TABLE IF EXISTS `barba`;
DROP TABLE IF EXISTS `cliente`;
DROP TABLE IF EXISTS `corte`;

CREATE TABLE `servicos` (
  `servicosId` int(100) NOT NULL AUTO_INCREMENT,
  `tipoServico` varchar(250) DEFAULT NULL,
  `nomeServico` varchar(250) DEFAULT NULL,
  `preco` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`servicosId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cliente` (
  `clienteId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `email_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`clienteId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cliente` VALUES (1,'lucas','lucasfurtunato11@gmail.com','$2y$10$uznfxeckkn7gskpn4rxxfubgfpb5jaatuvkiwemrglwyqtuxeym52','2f43b9b936',1);

CREATE TABLE `gerente` (
  `codigo` varchar(10) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gerente` VALUES ('12345','gerente@gmail.com','123','gerente');


CREATE TABLE `unidade` (
  `unidadeId` int(11) NOT NULL AUTO_INCREMENT,
  `cep` varchar(9) DEFAULT NULL,
  `logradouro` varchar(50) DEFAULT NULL,
  `numero` varchar(50) DEFAULT NULL,
  `complemento` varchar(30) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`unidadeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO unidade VALUES (1, '07131-030', 'R. São Geraldo', '446', '', 'Jardim São Paulo', 'Guarulhos', 'SP');
INSERT INTO unidade VALUES (2, '07135-040', 'R. Joana Reche Reche', '12', '2° piso', 'Jardim Adriana', 'Guarulhos', 'SP');


CREATE TABLE `funcionario` (
  `funcionarioId` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `unidadeId` int(2) NOT NULL,
  `senha` varchar(250) NOT NULL,
  PRIMARY KEY (`funcionarioId`),
  KEY `unidadeId` (`unidadeId`),
  CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`unidadeId`) REFERENCES `unidade` (`unidadeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `agendamentos` (
  `agendamentosId` int(11) NOT NULL AUTO_INCREMENT,
  `unidadeId` int(11) NOT NULL,
  `funcionarioId` int(11) NOT NULL,
  `clienteId` int(11) NOT NULL,
  `barbaId` int(11) NOT NULL,
  `corteId` int(11) NOT NULL,
  `cuidadosId` int(11) NOT NULL,
  `preco` int(255) NOT NULL,
  `dia` date NOT NULL,
  `horario` time NOT NULL,
  PRIMARY KEY (`agendamentosId`),
  KEY `unidadeId` (`unidadeId`),
  KEY `clienteId` (`clienteId`),
  KEY `funcionarioId` (`funcionarioId`),
  KEY `corteId` (`corteId`),
  KEY `barbaId` (`barbaId`),
  KEY `cuidadosId` (`cuidadosId`),
  CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`unidadeId`) REFERENCES `unidade` (`unidadeId`),
  CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`clienteId`) REFERENCES `cliente` (`clienteId`),
  CONSTRAINT `agendamentos_ibfk_3` FOREIGN KEY (`funcionarioId`) REFERENCES `funcionario` (`funcionarioId`),
  CONSTRAINT `agendamentos_ibfk_4` FOREIGN KEY (`corteId`) REFERENCES `servicos` (`servicosId`),
  CONSTRAINT `agendamentos_ibfk_5` FOREIGN KEY (`barbaId`) REFERENCES `servicos` (`servicosId`),
  CONSTRAINT `agendamentos_ibfk_6` FOREIGN KEY (`cuidadosId`) REFERENCES `servicos` (`servicosId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `galeria` (
  `galeriaId` int(100) NOT NULL AUTO_INCREMENT,
  `localizacao` int(3) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`galeriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


