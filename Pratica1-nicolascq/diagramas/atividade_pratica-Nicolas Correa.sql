create database atividade_pratica;
use atividade_pratica;

CREATE TABLE Cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(15)
);

CREATE TABLE Colaborador (
    id_colaborador INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cargo VARCHAR(50)
);

CREATE TABLE Chamado (
    id_chamado INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    descricao TEXT NOT NULL,
    criticidade ENUM('baixa', 'média', 'alta') NOT NULL,
    Status ENUM('aberto', 'em andamento', 'resolvido') DEFAULT 'aberto',
    data_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    id_colaborador INT,
    
    
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente) ON DELETE CASCADE,
    FOREIGN KEY (id_colaborador) REFERENCES Colaborador(id_colaborador) ON DELETE SET NULL
);

select*from Cliente;