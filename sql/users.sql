create database medical_test;

create table users (
  id integer NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email varchar(128) UNIQUE NOT NULL,
  password varchar(128) NOT NULL,
  token varchar(128) NOT NULL
);
