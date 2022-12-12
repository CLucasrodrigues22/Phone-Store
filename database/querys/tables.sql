use phone_store;

create table profiles (
    id INT not null primary key AUTO_INCREMENT,
    profileName varchar(100) not null
);

insert into profiles (id, profileName) values (1, 'Administrador');

create table users (
    id INT not null primary key AUTO_INCREMENT,
    profile_id INT not null,
    fullname varchar(100) not null,
    email varchar(150) not null,
    senha varchar(250) not null,
    photo varchar(150) not null,
    FOREIGN KEY (profile_id)
        REFERENCES profiles(id)
);

insert into users (id, profile_id, fullname, email, senha, photo) values (1, 1, 'Lucas Rodrigues', 'lucas@email.com', '$2y$10$Gmz.25k5ftPF.2wv8tPwFePbai4.xQN6M9VxGXn6vrpWIeKF/hmue', 'photo.png');