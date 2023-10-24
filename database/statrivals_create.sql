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
    Porcentaje_Completo decimal(5,2) NOT NULL,
    foreign key (ID_Usuario) references Usuario(ID_Usuario),
    foreign key (ID_Logro) references Logro(ID_Logro)
);

create table Liga (
	ID_Liga INT auto_increment PRIMARY KEY,
	Nombre_Liga varchar(255) NOT NULL,
	Imagen varchar(255) NOT NULL
);

create table Jugador (
	ID_Jugador INT auto_increment PRIMARY KEY,
    ID_LIGA INT NOT NULL,
    Nombre_Jugador varchar(255) NOT NULL,
    Goles INT NOT NULL,
    Asistencias INT NOT NULL,
    Valor INT NOT NULL,
    Partidos_Jugados INT NOT NULL,
    Popularidad varchar(50) NOT NULL,
    Imagen varchar(255) NOT NULL,
    CONSTRAINT check_popularidad CHECK (popularidad IN ('media','alta')),
    foreign key (ID_Liga) references Liga(ID_Liga)
);

create table Modo_De_Juego (
	ID_Modo INT auto_increment PRIMARY KEY,
    Nombre_Modo varchar(255) NOT NULL,
    Descripcion text,
    Imagen varchar(255) NOT NULL
);

create table Registro_Partida (
	ID_Partida INT auto_increment PRIMARY KEY,
    ID_Usuario INT NOT NULL,
    ID_Modo INT NOT NULL,
    ID_Liga INT NOT NULL,
    Dificultad varchar(50) NOT NULL,
    Puntuacion INT NOT NULL,
    Fecha datetime NOT NULL,
    CONSTRAINT check_dificultad CHECK (dificultad IN ('normal','dificil')),
    foreign key (ID_Usuario) references Usuario(ID_Usuario),
    foreign key (ID_Modo) references Modo_De_Juego(ID_Modo),
    foreign key (ID_Liga) references Liga(ID_Liga)
);
