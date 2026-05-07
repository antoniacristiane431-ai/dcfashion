-- Banco de Dados DC Fashion
CREATE DATABASE IF NOT EXISTS dcfashion;
USE dcfashion;

-- Tabela de Produtos
CREATE TABLE IF NOT EXISTS produtos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  categoria VARCHAR(50) NOT NULL,
  preco DECIMAL(10, 2) NOT NULL,
  img VARCHAR(255),
  iframe LONGTEXT,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Clientes (Cadastro)
CREATE TABLE IF NOT EXISTS clientes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  cadastrado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Pedidos (Carrinho)
CREATE TABLE IF NOT EXISTS pedidos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  cliente_id INT,
  total DECIMAL(10, 2),
  status VARCHAR(50) DEFAULT 'pendente',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

-- Tabela de Itens do Pedido
CREATE TABLE IF NOT EXISTS itens_pedido (
  id INT PRIMARY KEY AUTO_INCREMENT,
  pedido_id INT,
  produto_id INT,
  quantidade INT DEFAULT 1,
  preco_unitario DECIMAL(10, 2),
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
  FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- Inserir dados dos produtos
INSERT INTO produtos (nome, categoria, preco, img, iframe) VALUES
(1, 'Blusa Elegante', 'blusa', 80.00, 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d', NULL),
(2, 'Blazer Feminino', 'blazer', 150.00, NULL, '<iframe src="https://assets.pinterest.com/ext/embed.html?id=9148005521899093" height="300" width="100%" frameborder="0" scrolling="no"></iframe>'),
(3, 'Calça Social', 'calca', 120.00, NULL, '<iframe src="https://assets.pinterest.com/ext/embed.html?id=902971794045098517" height="300" width="100%" frameborder="0" scrolling="no"></iframe>'),
(4, 'Calça Jeans', 'jeans', 110.00, 'https://images.unsplash.com/photo-1521335629791-ce4aec67dd47', NULL),
(5, 'Camisa Feminina', 'camisa', 90.00, 'https://images.unsplash.com/photo-1483985988355-763728e1935b', NULL),
(6, 'Colete Moderno', 'colete', 95.00, 'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb', NULL),
(7, 'Regata Básica', 'regata', 60.00, NULL, '<iframe src="https://assets.pinterest.com/ext/embed.html?id=580471839515051875" height="300" width="100%" frameborder="0" scrolling="no"></iframe>'),
(8, 'Vestido Floral', 'vestido', 140.00, NULL, '<iframe src="https://assets.pinterest.com/ext/embed.html?id=4292562141085239" height="300" width="100%" frameborder="0" scrolling="no"></iframe>');
