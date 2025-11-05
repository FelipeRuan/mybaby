-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS Babyconect;

USE babyconect;

-- Tabela de usuários
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    avatar_url VARCHAR(255),
    bio TEXT,
    tipo ENUM('mae', 'profissional', 'loja','pai') DEFAULT 'mae',
    data_nascimento DATE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Tabela de perfis de maternidade
CREATE TABLE perfis_maternidade (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT UNIQUE NOT NULL,
    etapa_gravidez ENUM('tentante', 'primeiro_trimestre', 'segundo_trimestre', 'terceiro_trimestre', 'recem_nascido', '0-6_meses', '6-12_meses', '1-2_anos', '2+_anos'),
    quantidade_filhos INT DEFAULT 0,
    interesses JSON, -- ["amamentacao", "sono", "alimentacao"]
    restricoes TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de categorias de produtos
CREATE TABLE categorias (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    icone VARCHAR(50),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE
);

-- Tabela de produtos
CREATE TABLE produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vendedor_id INT NOT NULL,
    categoria_id INT NOT NULL,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    preco_original DECIMAL(10,2),
    quantidade_estoque INT DEFAULT 0,
    imagens JSON, -- URLs das imagens
    caracteristicas JSON, -- {"marca": "X", "material": "Y"}
    condicao ENUM('novo', 'seminovo', 'usado') DEFAULT 'novo',
    tags JSON, -- ["bebe", "recem-nascido", "promocao"]
    avaliacao_media DECIMAL(3,2) DEFAULT 0,
    total_avaliacoes INT DEFAULT 0,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (vendedor_id) REFERENCES usuarios(id),
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabela de vídeos/reels
CREATE TABLE videos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    video_url VARCHAR(255) NOT NULL,
    thumbnail_url VARCHAR(255),
    duracao_segundos INT,
    categoria ENUM('dicas', 'experiencias', 'humor', 'educativo', 'review', 'outros') DEFAULT 'dicas',
    tags JSON, -- ["amamentacao", "dicas", "primeira-viagem"]
    contagem_visualizacoes INT DEFAULT 0,
    contagem_curtidas INT DEFAULT 0,
    contagem_comentarios INT DEFAULT 0,
    aprovado BOOLEAN DEFAULT FALSE, -- Para moderação
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabela de curtidas em vídeos
CREATE TABLE curtidas_videos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    video_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_curtida (usuario_id, video_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE
);

-- Tabela de comentários em vídeos
CREATE TABLE comentarios_videos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    video_id INT NOT NULL,
    comentario TEXT NOT NULL,
    comentario_pai_id INT NULL, -- Para respostas
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE,
    FOREIGN KEY (comentario_pai_id) REFERENCES comentarios_videos(id)
);

-- Tabela de carrinho de compras
CREATE TABLE carrinhos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabela de itens no carrinho
CREATE TABLE itens_carrinho (
    id INT PRIMARY KEY AUTO_INCREMENT,
    carrinho_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    preco_unitario DECIMAL(10,2) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (carrinho_id) REFERENCES carrinhos(id) ON DELETE CASCADE,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- Tabela de pedidos
CREATE TABLE pedidos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    numero_pedido VARCHAR(20) UNIQUE NOT NULL,
    status ENUM('pendente', 'confirmado', 'preparando', 'enviado', 'entregue', 'cancelado') DEFAULT 'pendente',
    subtotal DECIMAL(10,2) NOT NULL,
    taxa_entrega DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) NOT NULL,
    endereco_entrega JSON NOT NULL, -- {"rua": "...", "cidade": "...", "cep": "..."}
    metodo_pagamento ENUM('cartao', 'pix', 'boleto') DEFAULT 'cartao',
    dados_pagamento JSON, -- Informações do pagamento
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabela de itens do pedido
CREATE TABLE itens_pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    total_item DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

-- Tabela de avaliações de produtos
CREATE TABLE avaliacoes_produtos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    pedido_id INT NOT NULL,
    nota INT NOT NULL CHECK (nota >= 1 AND nota <= 5),
    comentario TEXT,
    fotos JSON, -- URLs das fotos da avaliação
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_avaliacao (usuario_id, produto_id, pedido_id),
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id),
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
);

-- Tabela de seguidores (para rede social)
CREATE TABLE seguidores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    seguidor_id INT NOT NULL, -- quem segue
    seguido_id INT NOT NULL, -- quem é seguido
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_seguimento (seguidor_id, seguido_id),
    FOREIGN KEY (seguidor_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (seguido_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Tabela de mensagens/comunidade
CREATE TABLE mensagens_comunidade (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    mensagem TEXT NOT NULL,
    tipo ENUM('duvida', 'desabafo', 'conquista', 'dica') DEFAULT 'duvida',
    tags JSON,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabela de respostas nas mensagens da comunidade
CREATE TABLE respostas_comunidade (
    id INT PRIMARY KEY AUTO_INCREMENT,
    mensagem_id INT NOT NULL,
    usuario_id INT NOT NULL,
    resposta TEXT NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ativo BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (mensagem_id) REFERENCES mensagens_comunidade(id) ON DELETE CASCADE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Tabela de notificações
CREATE TABLE notificacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    tipo ENUM('curtida', 'comentario', 'seguidor', 'pedido', 'sistema') DEFAULT 'sistema',
    titulo VARCHAR(200) NOT NULL,
    mensagem TEXT NOT NULL,
    lida BOOLEAN DEFAULT FALSE,
    link VARCHAR(255), -- URL para redirecionamento
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Índices para melhor performance
CREATE INDEX idx_videos_usuario ON videos(usuario_id);
CREATE INDEX idx_videos_categoria ON videos(categoria);
CREATE INDEX idx_videos_data ON videos(criado_em);
CREATE INDEX idx_produtos_vendedor ON produtos(vendedor_id);
CREATE INDEX idx_produtos_categoria ON produtos(categoria_id);
CREATE INDEX idx_produtos_preco ON produtos(preco);
CREATE INDEX idx_pedidos_usuario ON pedidos(usuario_id);
CREATE INDEX idx_pedidos_status ON pedidos(status);
CREATE INDEX idx_comentarios_video ON comentarios_videos(video_id);
CREATE INDEX idx_curtidas_video ON curtidas_videos(video_id);