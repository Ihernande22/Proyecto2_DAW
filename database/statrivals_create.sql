create database statrivals;
use statrivals;

create table Usuario (
	ID_Usuario INT auto_increment PRIMARY KEY,
    Nombre_Usuario varchar(255) NOT NULL,
    Correo_Electronico varchar(255) NOT NULL,
    Contraseña varchar(255) NOT NULL
);

create table Logro (
	ID_Logro INT auto_increment PRIMARY KEY,
    Descripcion text,
    Imagen varchar(255) NOT NULL
);

create table Logro_Usuario (
	ID_Usuario INT NOT NULL,
    ID_Logro INT NOT NULL,
    Porcentaje_Completo decimal(5,2) NOT NULL
);