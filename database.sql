CREATE DATABASE emax;
USE emax;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    senha_hash VARCHAR(255),
    nivel VARCHAR(20), -- Define o grau de acesso ('admin' ou 'user')
    ativo BOOLEAN,     -- Controla se o usuário pode logar (1=Ativo, 0=Bloqueado)
    data_criacao DATETIME
) ENGINE=InnoDB;

CREATE TABLE tentativa_login (
    id_tentativa INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    email_informado VARCHAR(100),
    data_hora DATETIME,
    sucesso BOOLEAN, -- Indica se o login deu certo (1) ou falhou (0)
    ip VARCHAR(45),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB;

CREATE TABLE log (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    acao VARCHAR(50),
    data_hora DATETIME,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
) ENGINE=InnoDB;

-- Usuário ADMIN inicial (senha: admin123)
INSERT INTO usuario (nome, email, senha_hash, nivel, ativo, data_criacao) 
VALUES ('Administrador', 'admin@gmail.com', '$2y$10$i8qhJsAfZGPvoGZlozscwesa/C2RJK7cHorn9rnRh4uAmPv0lLsqq', 'admin', 1, NOW());
