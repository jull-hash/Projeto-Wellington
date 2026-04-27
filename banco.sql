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


create table estoque (
    id_estoque int auto_increment primary key,
    nome_estoque varchar(100) not null,
    
    livro_id int,
    constraint fk_livro_guardar
    foreign key (livro_id)
    references livro(id_livro)
    );
