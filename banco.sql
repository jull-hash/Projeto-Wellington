create database papelaria;
use papelaria;

create table usuario (
id_usuario int auto_increment primary key,
imagem_usuario varchar(255),
nome_usuario varchar(100) not null,
senha varchar(255) not null,
endereco varchar(255),
email varchar(255) not null,
telefone varchar(12),
user_criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
tipo enum('user','adm') not null default 'user'
);

create table livro (
id_livro int auto_increment primary key,
nome_livro varchar(100) not null,
autor varchar(100),
publicado varchar(100),
genero varchar(100),
preco_livro decimal(10,2) not null,
imagem_livro varchar(255),
descricao_livro text,
quantidade_livro int default (0),
livro_criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);


create table pedido (
id_pedido int auto_increment primary key,
data_pedido DATETIME DEFAULT CURRENT_TIMESTAMP,
total_pedido decimal(10,2) not null,
status_pedido enum('1','2','3') not null default '1',
    user_id int,
    constraint fk_pedido_user
    foreign key (user_id)
    references usuario(id_usuario)
);

create table item_pedido (
    id_item int auto_increment primary key,
    pedido_id int,
    livro_id int,
    quantidade int not null default 1,
    preco_unitario decimal(10, 2) not null,
    constraint fk_item_pedido foreign key (pedido_id) references pedido(id_pedido),
    constraint fk_item_livro foreign key (livro_id) references livro(id_livro)
);

insert into usuario (nome_usuario, senha, email, tipo) values(
'adm',
'$2y$10$ohhQiLo3tTuc.LtonkoGKepsyg84OVvzXe3sxH0r6crmDhHac1zqG',
'adm@adm',
'adm'
);

insert into usuario (nome_usuario, senha, email, tipo) values(
'user',
'$2y$10$ohhQiLo3tTuc.LtonkoGKepsyg84OVvzXe3sxH0r6crmDhHac1zqG',
'email@email',
'user'
);