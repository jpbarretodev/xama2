CREATE DATABASE IF NOT EXISTS testecartorio
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE testecartorio;

CREATE TABLE protocolos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(50) NOT NULL,
    data_abertura DATETIME NOT NULL,
    situacao INT NULL,
    custas DECIMAL(10, 2) NULL,
    pagamento INT NOT NULL,
    responsavel VARCHAR(100) NOT NULL,
    UNIQUE INDEX uk_codigo_responsavel (codigo, responsavel),
    INDEX idx_data_responsavel (data_abertura, responsavel)
);

CREATE TABLE apresentantes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    documento VARCHAR(20) NULL,
    id_protocolo INT NOT NULL,
    FOREIGN KEY (id_protocolo) REFERENCES protocolos(id)
        ON DELETE CASCADE
);
