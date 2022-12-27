use phone_store;

create table profiles (
    `id` INT not null primary key AUTO_INCREMENT,
    `profileName` varchar(100) not null,
    `status` char(1) NULL DEFAULT '0',
    `vizualizar` char(1) NULL DEFAULT '0',
    `atualizar` char(1) NULL DEFAULT '0',
    `cadastrar` char(1) NULL DEFAULT '0',
    `deletar` char(1) NULL DEFAULT '0'
);

insert into profiles (id, profileName, vizualizar, atualizar, cadastrar, deletar) values (1, 'Administrador', '1', '1', '1', '1');

create table users (
    `id` INT not null primary key AUTO_INCREMENT,
    `profile_id` INT not null,
    `fullname` varchar(100) not null,
    `email` varchar(150) not null,
    `senha` varchar(250) not null,
    `photo` varchar(150) not null,
    FOREIGN KEY (profile_id)
        REFERENCES profiles(id)
);

insert into users (id, profile_id, fullname, email, senha, photo) values (1, 1, 'lucas@email.com', 'adm@email.com', '$2y$10$Gmz.25k5ftPF.2wv8tPwFePbai4.xQN6M9VxGXn6vrpWIeKF/hmue', 'photo.png'); 
-- senha = 1234

create table smartphones (
    `id` INT not null primary key AUTO_INCREMENT,
    `tipo` varchar(20) DEFAULT 'smartphone',
    `marca` varchar(50),
    `codigo` INT not null,
    `modelo` varchar(100) not null,
    `sistema` varchar(50) not null,
    `camera` varchar(20) not null,
    `memoria` varchar(20) not null,
    `ram` varchar(20) not null
);

create table notebooks (
    `id` INT not null primary key AUTO_INCREMENT,
    `tipo` varchar(20) DEFAULT 'notebook',
    `marca` varchar(50),
    `codigo` INT not null,
    `modelo` varchar(100) not null, 
    `cpu` varchar(50) not null,
    `ram` varchar(50) not null,
    `gpu` varchar(50) not null,
    `tela` varchar(50) not null
);

create table imgsmartphones (
    `id` INT not null primary key AUTO_INCREMENT,
    `smartphone_id` INT not null,
    `photo1` varchar(100),
    `photo2` varchar(100),
    `photo3` varchar(100),
    `photo4` varchar(100),
    `photo5` varchar(100),
    FOREIGN KEY (smartphone_id)
        REFERENCES smartphones(id)
);

create table imgnotebooks (
    `id` INT not null primary key AUTO_INCREMENT,
    `notebook_id` INT not null,
    `photo1` varchar(100),
    `photo2` varchar(100),
    `photo3` varchar(100),
    `photo4` varchar(100),
    `photo5` varchar(100),
    FOREIGN KEY (notebook_id)
        REFERENCES notebooks(id)
);