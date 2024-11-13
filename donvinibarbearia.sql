
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


CREATE TABLE `barba` (
  `barbaId` int(100) NOT NULL AUTO_INCREMENT,
  `nomeBarba` varchar(250) NOT NULL,
  `preco` varchar(250) NOT NULL,
  PRIMARY KEY (`barbaId`)
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

INSERT INTO `cliente` VALUES (1,'lucas','lucasfurtunato11@gmail.com','$2y$10$uznfxeckkn7gskpn4rxxfubgfpb5jaatuvkiwemrglwyqtuxeym52','2f43b9b936',1),(2,'jhota','jota@gmail.com','123','Ze0uUzRkfB',0),(3,'gaga','gaga@gmail.com','123','ZQBAKar&ds',0),(4,'gog','gog@gmail.com','123','97vYNslolA',0),(5,'gu','gu@gmail.com','123','1pQPPkxzqg',0);



CREATE TABLE `corte` (
  `corteId` int(100) NOT NULL AUTO_INCREMENT,
  `nomeCorte` varchar(250) NOT NULL,
  `preco` varchar(250) NOT NULL,
  PRIMARY KEY (`corteId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `cuidados` (
  `cuidadosId` int(100) NOT NULL AUTO_INCREMENT,
  `nomeCuidado` varchar(250) NOT NULL,
  `preco` varchar(250) NOT NULL,
  PRIMARY KEY (`cuidadosId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
  `corteId` int(100) NOT NULL,
  `barbaId` int(100) NOT NULL,
  `cuidadosId` int(100) NOT NULL,
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
  CONSTRAINT `agendamentos_ibfk_4` FOREIGN KEY (`corteId`) REFERENCES `corte` (`corteId`),
  CONSTRAINT `agendamentos_ibfk_5` FOREIGN KEY (`barbaId`) REFERENCES `barba` (`barbaId`),
  CONSTRAINT `agendamentos_ibfk_6` FOREIGN KEY (`cuidadosId`) REFERENCES `cuidados` (`cuidadosId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `galeria` (
  `galeriaId` int(100) NOT NULL AUTO_INCREMENT,
  `localizacao` int(3) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`galeriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `servicos` (
  `servicoId` int(100) NOT NULL AUTO_INCREMENT,
  `barbaId` int(100) DEFAULT NULL,
  `corteId` int(100) DEFAULT NULL,
  `cuidadosId` int(100) DEFAULT NULL,
  PRIMARY KEY (`servicoId`),
  KEY `barbaId` (`barbaId`),
  KEY `corteId` (`corteId`),
  KEY `cuidadosId` (`cuidadosId`),
  CONSTRAINT `servicos_ibfk_1` FOREIGN KEY (`barbaId`) REFERENCES `barba` (`barbaId`),
  CONSTRAINT `servicos_ibfk_2` FOREIGN KEY (`corteId`) REFERENCES `corte` (`corteId`),
  CONSTRAINT `servicos_ibfk_3` FOREIGN KEY (`cuidadosId`) REFERENCES `cuidados` (`cuidadosId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

