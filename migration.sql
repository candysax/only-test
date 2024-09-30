create table users
(
    id int auto_increment
        primary key,
    username varchar(255) not null,
    email    varchar(255) not null,
    phone    varchar(255) not null,
    password varchar(255) null,
    constraint users_email_unique
        unique (email),
    constraint users_phone_unique
        unique (phone),
    constraint users_username_unique
        unique (username)
);

