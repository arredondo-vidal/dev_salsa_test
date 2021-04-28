-- https://www.digitalocean.com/community/tutorials/crear-un-nuevo-usuario-y-otorgarle-permisos-en-mysql-es
-- https://stackoverflow.com/questions/13357760/mysql-create-user-if-not-exists

CREATE USER IF NOT EXISTS 'newuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON dbase . * TO 'newuser'@'localhost';

CREATE DATABASE IF NOT EXISTS dbase;

USE dbase;
CREATE TABLE IF NOT EXISTS users(
   name varchar(100),
   email varchar(100),
   password varchar(100),
   activo int(11)
) ENGINE=MyISAM;
