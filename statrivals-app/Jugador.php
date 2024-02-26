<?php

class Jugador implements JsonSerializable {
    // Propiedades de la clase Jugador
    private $id;
    private $nombre;
    private $imagen;

    // Constructor de la clase Jugador
    public function __construct($id, $nombre, $imagen) {
        $this->id = $id;
        $this->nombre = $nombre;
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
            'imagen' => $this->imagen
        ];
    }
}
