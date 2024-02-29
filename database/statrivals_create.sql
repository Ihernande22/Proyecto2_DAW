drop database if exists statrivals;
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

CREATE TABLE Estado (
    ID_Usuario INT NOT NULL,
    EnPartida BOOLEAN NOT NULL,
    FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

CREATE TABLE Estado_Partida (
    ID_Usuario INT NOT NULL,
    Puntuacion INT NOT NULL,
    Lista_Jugadores LONGTEXT,
    FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario)
);

ALTER TABLE Estado_Partida
ADD COLUMN Modo VARCHAR(255);

/*Modos*/
insert into Modo_De_Juego values (1,'Goles','Inferir con los goles anotados a lo largo de su carrera','goles.jpg');
insert into Modo_De_Juego values (2,'Asistencias','Inferir con las asistencias dadas a lo largo de su carrera','asistencias.jpg');
insert into Modo_De_Juego values (3,'Partidos Jugados','Inferir con los partidos jugados a lo largo de su carrera','partidos.jpg');
insert into Modo_De_Juego values (4,'Valor de Mercado','Inferir con el máximo valor de mercado alcanzado a lo largo de su carrera','valor.jpg');

/*Ligas*/
insert into Liga values (1, 'Liga EA Sports', 'LigaEASports.jpg');
insert into Liga values (2, 'Premier League', 'PremierLeague.jpg');
insert into Liga values (3, 'Bundesliga', 'Bundesliga.jpg');
insert into Liga values (4, 'Serie A', 'SerieA.jpg');
insert into Liga values (5, 'Aleatorio', 'Aleatorio.jpg');


/*Jugadores*/
/*LIGA ESPAÑOLA*/

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('1', '1', 'Pedri Gonzalez', '22', '18', '90', '165', 'alta', 'Pedri.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('2', '1', 'Ronald Araujo', '21', '8', '70', '230', 'alta', 'Araujo.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('3', '1', 'Gavi', '7', '14', '90', '114', 'alta', 'Gavi.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('4', '1', 'Fermin Lopez ', '15', '5', '15', '68', 'alta', 'Fermin.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('5', '1', 'Joao Cancelo', '21', '66', '40', '406', 'alta', 'Cancelo.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('6', '1', 'Joao Félix ', '79', '40', '40', '266', 'alta', 'Felix.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('7', '1', 'Vinicius Junior', '84', '74', '150', '305', 'alta', 'Vinicius.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('8', '1', 'Ferran Torres', '51', '34', '35', '255', 'media', 'Ferran.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('9', '1', 'Eder Militao', '20', '10', '70', '233', 'alta', 'Militao.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('10', '1', 'Luka Modric', '84', '129', '10', '768', 'alta', 'Modric.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('11', '1', 'Eduardo Camavinga', '8', '11', '90', '225', 'alta', 'Camavinga.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('12', '1', 'Aurelien Tchouameni', '11', '13', '90', '206', 'alta', 'Tchouameni.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('13', '1', 'Robert Lewandowski', '556', '150', '20', '753', 'alta', 'Lewandowski.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('14', '1', 'Raphinha', '76', '57', '50', '316', 'alta', 'Raphinha.jpg');
INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('15', '1', 'Brahim Diaz', '49', '35', '20', '247', 'media', 'Brahim.jpg');
INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('16', '1', 'Toni Kroos', '73', '160', '15', '723', 'alta', 'kroos.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('17', '1', 'Antonio Rudiger', '26', '14', '32', '497', 'alta', 'rudiger.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('18', '1', 'Rodrygo', '60', '44', '100', '245', 'alta', 'rodrygo.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('19', '1', 'Ferland Mendy', '10', '23', '20', '274', 'media', 'mendy.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('20', '1', 'Daniel Carvajal', '13', '78', '12', '495', 'alta', 'carvajal.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('81', '1', 'Vitor Roque', '36', '13', '40', '108', 'media', 'vitor.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('82', '1', 'Arda Guler', '23', '25', '15', '84', 'media', 'Guler.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('83', '1', 'Hector Fort', '1', '2', '1', '16', 'media', 'Fort.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('100', '1', 'Miguel Gutierrez', '11', '20', '20', '119', 'media', 'MiguelGutierrez.jpg');



INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('101', '1', 'Aleix Garcia', '17', '25', '20', '241', 'media', 'AleixGarcia.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('102', '1', 'Ivan Martin', '11', '17', '10', '174', 'media', 'IvanMartin.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('103', '1', 'Savio', '11', '11', '30', '78', 'media', 'Savio.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('104', '1', 'Artem Dovbyk', '92', '25', '28', '197', 'media', 'Dovyk.jpg');


/*PREMIER LEAGUE*/

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('21', '2', 'Kevin De Bruyne', '143', '237', '70', '587', 'alta', 'debruyne.jpg');



INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('22', '2', 'Erling Haland', '206', '49', '180', '256', 'alta', 'haaland.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('23', '2', 'Bernardo Silva', '93', '88', '80', '509', 'alta', 'bernardo.jpg');



INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('24', '2', 'Rodri Hernandez', '28', '29', '100', '397', 'alta', 'rodri.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('25', '2', 'Ruben Dias', '16', '13', '80', '356', 'alta', 'rubendias.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('26', '2', 'Marcus Rashford', '130', '72', '75', '390', 'alta', 'rashford.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('27', '2', 'Mohamed Salah', '276', '137', '65', '575', 'alta', 'salah.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('28', '2', 'Virgil Van Dijk', '49', '26', '35', '499', 'alta', 'vanDijk.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('29', '2', 'Josko Gvardiol', '9', '8', '80', '169', 'media', 'gvardiol.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('30', '2', 'Ansu Fati', '37', '14', '35', '135', 'media', 'ansu.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('31', '2', 'Jarrod Bowen', '104', '49', '48', '313', 'media', 'bowen.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('32', '2', 'Heung-min Son', '218', '95', '50', '584', 'alta', 'son.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('33', '2', 'Ollie Watkins', '130', '54', '55', '357', 'media', 'watkins.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('34', '2', 'Alexander Isak', '101', '22', '70', '257', 'media', 'Isak.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('35', '2', 'Callum Wilson', '137', '49', '16', '358', 'media', 'wilson.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('36', '2', 'Anthony Gordon', '38', '23', '45', '185', 'media', 'Gordon.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('37', '2', 'Nicolas Jackson', '28', '15', '35', '106', 'media', 'NicolasJackson.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('38', '2', 'Bukayo Saka', '68', '68', '120', '252', 'alta', 'saka.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('39', '2', 'Raheem Sterling', '177', '147', '50', '543', 'alta', 'Sterling.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('40', '2', 'Martin odegaard', '62', '59', '90', '339', 'alta', 'odegaard.jpg');
INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('84', '2', 'Thiago Alcantara', '48', '63', '10', '486', 'alta', 'Thiago.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('85', '2', 'Luis Diaz', '83', '40', '75', '350', 'alta', 'LuisDiaz.jpg');
INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('86', '2', 'Rico Lewis', '7', '7', '38', '87', 'media', 'RicoLewis.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('87', '2', 'Julio Enciso', '28', '14', '22', '101', 'media', 'Enciso.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('88', '2', 'Julian Alvarez', '86', '46', '90', '203', 'alta', 'Julian.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('89', '2', 'Pedro Neto', '16', '24', '42', '147', 'media', 'neto.jpg');



/*BUNDESLIGA*/

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('41', '3', 'Harry Kane', '329', '87', '110', '532', 'alta', 'kane.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('42', '3', 'Jamal Musiala', '43', '29', '110', '172', 'alta', 'Musiala.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('43', '3', 'Florian Wirtz', '43', '46', '85', '149', 'alta', 'Wirtz.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('44', '3', 'Joshua Kimmich', '52', '116', '75', '479', 'alta', 'Kimmich.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('45', '3', 'Leroy Sane', '119', '118', '75', '429', 'alta', 'sane.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('46', '3', 'Matthijs de Ligt', '33', '12', '70', '349', 'media', 'deLigt.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('47', '3', 'Xavi Simons', '36', '28', '70', '97', 'media', 'Simons.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('48', '3', 'Alphonso Davies', '22', '44', '70', '272', 'alta', 'Davies.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('49', '3', 'Kingsley Coman', '64', '68', '65', '317', 'alta', 'Coman.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('50', '3', 'Dayot Upamecano', '8', '13', '60', '292', 'media', 'Upamecano.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('51', '3', 'Kim Min-Jae', '6', '3', '60', '239', 'media', 'Kim.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('52', '3', 'Serge Gnabry', '123', '73', '55', '359', 'alta', 'Gnabry.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('53', '3', 'Dani Olmo', '65', '59', '50', '291', 'alta', 'Olmo.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('54', '3', 'Mathys Tel', '21', '3', '50', '65', 'media', 'Tel.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('55', '3', 'Lois Openda', '78', '25', '45', '214', 'media', 'Openda.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('56', '3', 'Leon Goretzka', '87', '66', '45', '424', 'alta', 'Goretzka.jpg');



INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('57', '3', 'Serhou Guirassy', '96', '15', '40', '272', 'media', 'Guirassy.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('58', '3', 'Victor Boniface', '52', '26', '40', '135', 'media', 'Boniface.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('59', '3', 'Karim Adeyemi', '81', '52', '35', '212', 'media', 'Adeyemi.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('60', '3', 'Niklas Sule', '21', '14', '30', '392', 'media', 'Sule.jpg');
INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('90', '3', 'Borja Iglesias', '174', '23', '8', '418', 'media', 'panda.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('91', '3', 'Bryan Zaragoza', '19', '3', '12', '106', 'media', 'bryanZaragoza.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('92', '3', 'Sacha Boey', '7','3', '22', '151', 'media', 'boey.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('93', '3', 'Attila Szalai', '17', '13', '10', '278', 'media', 'Szalai.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('94', '3', 'Deniz Undav', '136', '56', '17', '281', 'media', 'Undav.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('95', '3', 'Amadou Haidara', '29','32', '17', '283', 'media', 'Haidara.jpg');


  
/*LIGA ITALIANA*/


  


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('61', '4', 'Victor Osimhen', '103', '26', '120', '203', 'alta', 'Osimhen.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('62', '4', 'Lautaro Martinez', '144', '44', '100', '317', 'alta', 'Lautaro.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('63', '4', 'Rafael Leao', '70', '47', '90', '233', 'alta', 'Leao.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('64', '4', 'Khvicha Kvaratskhelia', '40', '46', '85', '177', 'alta', 'Kvaratskhelia.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('65', '4', 'Nicolo Barella', '31', '52', '75', '374', 'alta', 'Barella.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('66', '4', 'Dušan Vlahovic', '100', '17', '70', '232', 'alta', 'Vlahovic.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('67', '4', 'Theo Hernandez', '31', '40', '60', '283', 'alta', 'Theo.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('68', '4', 'Alessandro Bastoni', '16', '14', '60', '266', 'alta', 'Bastoni.jpg');



INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('69', '4', 'Federico Dimarco', '21', '37', '45', '252', 'media', 'Dimarco.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('70', '4', 'Federico Chiesa', '71', '51', '45', '300', 'alta', 'Chiesa.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('71', '4', 'Benjamin Pavard', '15', '14', '40', '286', 'alta', 'Pavard.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('72', '4', 'Frank Anguissa', '7', '17', '40', '303', 'media', 'Anguissa.jpg');
INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('73', '4', 'Stanislav Lobotka\r\n', '8', '15', '40', '398', 'media', 'Lobotka.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('74', '4', 'Hakan Calhanoglu', '112', '123', '40', '539', 'alta', 'Calhanoglu.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('75', '4', 'Bremer', '20', '6', '40', '196', 'alta', 'Bremer.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('76', '4', 'Marcus Thuram', '68', '45', '40', '268', 'media', 'Thuram.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('77', '4', 'Romelu Lukaku', '298', '94', '40', '616', 'alta', 'Lukaku.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('78', '4', 'Adrien Rabiot', '44', '32', '40', '430', 'alta', 'Rabiot.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('79', '4', 'Giorgio Scalvini', '12', '3', '40', '130', 'media', 'Scalvini.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('80', '4', 'Fikayo Tomori', '16', '6', '40', '305', 'alta', 'Tomori.jpg');

INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('96', '4', 'Rick Karsdorp', '12', '40', '7', '329', 'media', 'Karsdorp.jpg');


INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('97', '4', 'Gianluca  Mancini', '21','9', '20', '336', 'media', 'Mancini.jpg');




INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('98', '4', 'Luka Jovic', '79', '25', '5', '282', 'media', 'Jovic.jpg');





INSERT INTO `Jugador` (`ID_Jugador`, `ID_LIGA`, `Nombre_Jugador`, `Goles`, `Asistencias`, `Valor`, `Partidos_Jugados`, `Popularidad`, `Imagen`) VALUES ('99', '4', 'Christian Pulisic', '66','12', '32', '325', 'media', 'Pulisic.jpg');


  
