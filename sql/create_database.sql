CREATE TABLE usuarios (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(40) NOT NULL,
    sobrenome VARCHAR(40) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(155) NOT NULL
);

CREATE TABLE clientes (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_usuario INTEGER NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
	nome VARCHAR(40) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    obs VARCHAR(155) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT true
);

CREATE TABLE produtos (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_usuario INTEGER NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
	nome VARCHAR(40) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT true
);

CREATE TABLE vendas (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_usuario INTEGER NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
    id_cliente INTEGER NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes (id),
    id_produto INTEGER NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES produtos (id),
	data_venda DATE NOT NULL,
    quantidade INTEGER NOT NULL,
    status_pgto BOOLEAN NOT NULL,
    data_pgto DATE NOT NULL
);