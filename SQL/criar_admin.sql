INSERT INTO usuarios (nome, login, senha_hash, ativo)
VALUES (
    'Administrador',
    'adm',
    '$2y$10$.T/tvuO3IOyLAVFpddyZquQAoJp/JBVzc8BJWNWB0xqUz5l.RBnW.',
    1
)
ON DUPLICATE KEY UPDATE
    nome = VALUES(nome),
    senha_hash = VALUES(senha_hash),
    ativo = 1;
