drop database if exists sistema_gurus;

create database sistema_gurus;

use sistema_gurus;

create table login (
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL,
	nivel_acesso ENUM ("Cidadão", "Associado", "Administração"),
    id_usuario INT AUTO_INCREMENT PRIMARY KEY
    );
    
    create table reclamacao (
    msg_reclamacao VARCHAR(255) NOT NULL,
    id_reclamacao int(6) PRIMARY KEY AUTO_INCREMENT,
    setor_reclamacao ENUM ("Saúde", "Educação", "Economia", "Lazer", "Segurança", "Trânsito"),
    id_usuario INT,
    FOREIGN KEY(id_usuario) REFERENCES login(id_usuario)
    );
    
    create table avaliacao (
    msg_avaliacao VARCHAR(255) NOT NULL,
    id_avaliacao int(6) PRIMARY KEY AUTO_INCREMENT,
    nota_avaliacao int(5),
    setor_avaliacao ENUM ("Saúde", "Educação", "Economia", "Lazer", "Segurança", "Trânsito"),
    id_usuario INT,
    FOREIGN KEY(id_usuario) REFERENCES login(id_usuario)
    );
    
		

