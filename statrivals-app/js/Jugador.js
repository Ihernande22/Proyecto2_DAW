class Jugador {
    constructor(id, nombre, goles, asistencias, valor, partidosJugados, popularidad, imagen) {
        this.id = id;
        this.nombre = nombre;
        this.goles = goles;
        this.asistencias = asistencias;
        this.valor = valor;
        this.partidosJugados = partidosJugados;
        this.popularidad = popularidad;
        this.imagen = imagen;
    }

    getId() {
        return this.id;
    }

    getNombre() {
        return this.nombre;
    }

    getGoles() {
        return this.goles;
    }

    getAsistencias() {
        return this.asistencias;
    }

    getValor() {
        return this.valor;
    }

    getPartidosJugados() {
        return this.partidosJugados;
    }

    getPopularidad() {
        return this.popularidad;
    }

    getImagen() {
        return this.imagen;
    }
}

