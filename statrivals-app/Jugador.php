<?php

class Jugador implements JsonSerializable {
    // Propiedades de la clase Jugador
    private $id;
    private $nombre;
    private $goles;
    private $asistencias;
    private $valor;
    private $partidosJugados;
    private $popularidad;
    private $imagen;

    // Constructor de la clase Jugador
    public function __construct($id, $nombre, $goles, $asistencias, $valor, $partidosJugados, $popularidad, $imagen) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->goles = $goles;
        $this->asistencias = $asistencias;
        $this->valor = $valor;
        $this->partidosJugados = $partidosJugados;
        $this->popularidad = $popularidad;
        $this->imagen = $imagen;
    }

    // Métodos getter y setter para el ID
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    // Métodos getter y setter para el nombre
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Métodos getter y setter para los goles
    public function getGoles() {
        return $this->goles;
    }

    public function setGoles($goles) {
        $this->goles = $goles;
    }

    // Métodos getter y setter para las asistencias
    public function getAsistencias() {
        return $this->asistencias;
    }

    public function setAsistencias($asistencias) {
        $this->asistencias = $asistencias;
    }

    // Métodos getter y setter para el valor
    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    // Métodos getter y setter para los partidos jugados
    public function getPartidosJugados() {
        return $this->partidosJugados;
    }

    public function setPartidosJugados($partidosJugados) {
        $this->partidosJugados = $partidosJugados;
    }

    // Métodos getter y setter para la popularidad
    public function getPopularidad() {
        return $this->popularidad;
    }

    public function setPopularidad($popularidad) {
        $this->popularidad = $popularidad;
    }

    // Métodos getter y setter para la imagen
    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    // Implementa el método jsonSerialize
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'goles' => $this->goles,
            'asistencias' => $this->asistencias,
            'valor' => $this->valor,
            'partidosJugados' => $this->partidosJugados,
            'popularidad' => $this->popularidad,
            'imagen' => $this->imagen
        ];
    }
}
