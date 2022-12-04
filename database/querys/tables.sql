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
    senha varchar(32) not null,
    FOREIGN KEY (profile_id)
        REFERENCES profiles(id)
);