use statrivals;

create view ranking_todo as 
select u.Nombre_Usuario as Nombre_Usuario, 
(select sum(r.Puntuacion) from Registro_Partida r
where r.ID_Usuario = u.ID_Usuario) as Puntuacion from Usuario u;

create view ranking_partida as 
select u.Nombre_Usuario as Nombre_Usuario, 
(select max(r.Puntuacion) from Registro_Partida r
where r.ID_Usuario = u.ID_Usuario) as Puntuacion from Usuario u;
