CREATE DATABASE gestao_colaboradores;

-- Conecte na base criada antes de executar o restante:
-- \c gestao_colaboradores;

CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome_completo VARCHAR(120) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE colaboradores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    setor VARCHAR(50) NOT NULL,
    email VARCHAR(120) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    situacao VARCHAR(15) NOT NULL DEFAULT 'Ativo',
    data_cadastro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nome_completo, usuario, senha)
VALUES ('Coordenador Geral', 'admin', md5('123456'));

INSERT INTO colaboradores (nome, setor, email, telefone, situacao) VALUES
('Bruno Carvalho', 'Administrativo', 'bruno.carvalho@empresa.com', '(61) 99111-1001', 'Ativo'),
('Fernanda Lima', 'Financeiro', 'fernanda.lima@empresa.com', '(61) 99111-1002', 'Ativo'),
('Rafael Gomes', 'Operacional', 'rafael.gomes@empresa.com', '(61) 99111-1003', 'Férias'),
('Juliana Rocha', 'RH', 'juliana.rocha@empresa.com', '(61) 99111-1004', 'Ativo'),
('Patrícia Nunes', 'Financeiro', 'patricia.nunes@empresa.com', '(61) 99111-1005', 'Inativo'),
('Thiago Alves', 'Operacional', 'thiago.alves@empresa.com', '(61) 99111-1006', 'Ativo'),
('Camila Duarte', 'Administrativo', 'camila.duarte@empresa.com', '(61) 99111-1007', 'Ativo');
