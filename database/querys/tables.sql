use phone_store;

create table profiles (
    `id` INT not null primary key AUTO_INCREMENT,
    `profileName` varchar(100) not null
);

CREATE TABLE `controles` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '1',
  `tipo` enum('Corporativo','Front') DEFAULT 'Corporativo'
);

INSERT INTO `controles` (`id`, `nome`, `status`, `tipo`) VALUES (1, 'cliente', '1', 'Corporativo'), (2, 'usuario', '1', 'Corporativo'), (3, 'perfil', '1', 'Corporativo'), (4, 'categoria', '1', 'Corporativo'), (5, 'produto', '1', 'Corporativo'), (6, 'venda', '1', 'Corporativo'), (7, 'estoque', '1', 'Corporativo');

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `controle_id` int(11) NOT NULL,
  `perfil_id` int(11) NOT NULL,
  `select` char(1) NOT NULL DEFAULT '0',
  `delete` char(1) NOT NULL DEFAULT '0',
  `update` char(1) NOT NULL DEFAULT '0',
  `insert` char(1) NOT NULL DEFAULT '0',
  `show` char(1) NOT NULL DEFAULT '0',
    FOREIGN KEY (controle_id)
        REFERENCES controles(id),
    FOREIGN KEY (perfil_id)
        REFERENCES profiles(id)
);

insert into profiles (id, profileName) values (1, 'Administrador');

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

insert into users (id, profile_id, fullname, email, senha, photo) values (1, 1, 'Adm/root', 'adm@email.com', '$2y$10$Gmz.25k5ftPF.2wv8tPwFePbai4.xQN6M9VxGXn6vrpWIeKF/hmue', 'photo.png'); 
-- senha = 1234