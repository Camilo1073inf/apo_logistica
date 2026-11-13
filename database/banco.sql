CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  peso DECIMAL(10,2) NOT NULL,
  medidas VARCHAR(50),
  quantidade INT NOT NULL DEFAULT 1,
  valor DECIMAL(10,2) NOT NULL
);

CREATE TABLE enderecos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rua VARCHAR(120) NOT NULL,
  numero VARCHAR(10) NOT NULL,
  complemento VARCHAR(60),
  bairro VARCHAR(60) NOT NULL,
  cidade VARCHAR(60) NOT NULL,
  estado CHAR(2) NOT NULL,
  cep VARCHAR(9) NOT NULL
);

CREATE TABLE transportadores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  cpf_cnpj VARCHAR(18) NOT NULL,
  telefone VARCHAR(20),
  cidade VARCHAR(60)
);

CREATE TABLE fretes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  data_frete DATE NOT NULL,
  transportador_id INT NOT NULL,
  origem_id INT NOT NULL,
  destino_id INT NOT NULL,
  FOREIGN KEY (transportador_id) REFERENCES transportadores(id),
  FOREIGN KEY (origem_id) REFERENCES enderecos(id),
  FOREIGN KEY (destino_id) REFERENCES enderecos(id)
);

CREATE TABLE frete_produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  frete_id INT NOT NULL,
  produto_id INT NOT NULL,
  quantidade INT NOT NULL DEFAULT 1,
  FOREIGN KEY (frete_id) REFERENCES fretes(id) ON DELETE CASCADE,
  FOREIGN KEY (produto_id) REFERENCES produtos(id)
);