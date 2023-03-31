<?php

class Viajes {
    public $codigo;
    public $destino;
    public $maxPasajeros;
    public $pasajeros;

    public function __construct($codigo, $destino, $maxPasajeros) {
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->maxPasajeros = $maxPasajeros;
        $this->pasajeros = array();

    }

    public function __getCodigo(){
        return $this->codigo;
    }
    public function __getDestino(){
        return $this->destino;
    }

    public function __getMaxPasajeros(){
        return $this->maxPasajeros;
    }

    public function __getPasajeros(){
        return $this->pasajeros;
    }

    public function __setCodigo($codigo){
            $this->codigo = $codigo;
        }
    public function __setDestino($destino){
        $this->destino = $destino;
    }

    public function __setMaxPasajeros($maximo){
        $this->maxPasajeros = $maximo;
    }

    public function __capacidadLLena($array){
        $capacidadLLena = false;
        if (count($array->pasajeros) >= $array->maxPasajeros){
            $capacidadLLena = true;
        }
        return $capacidadLLena;
    }

    //Agrega al pasajero al array
    public function __agregarPasajero($array, $documento, $nombre, $apellido){
                $pasajero = array(
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "documento" => $documento
                );
                array_push($array->pasajeros, $pasajero);
    }

    //Elimina al pasajero indicado con el documento. 
    //Podría ser mas eficiente usar un foreach en vez de for al igual que en modificarPasajero. Revisar
    public function __eliminarPasajero($array, $documento){
        $pasajeroExiste = false;
        for($i = 0; $i < count($array->pasajeros); $i++){
            //if($array->pasajeros[$i]["documento"] == $documento){ FORMA ANTERIOR DE LA CONDICION
                if($array->__existePasajero($array, $documento)){
                array_splice($array->pasajeros, $i, 1);
                break;
                $pasajeroExiste = true;
            }
        }
    }


    public function __existePasajero($array, $documento){
        $existePasajero = false;
        foreach($array->pasajeros as $pasajero) {
            if($pasajero["documento"] == $documento) {
                $existePasajero = true;
            }
        }
        return $existePasajero;
    }

    //Modifica los datos del pasajero en caso de que exista, sino avisa que no existe tal pasajero.
    //Los echo podría ponerlos directamente en el case correspondiente. A EVALUAR
    public function __modificarPasajero($documento, $nuevoNombre, $nuevoApellido, $nuevoDocumento){
        for($i = 0; $i < count($this->pasajeros); $i++){
            if($this->pasajeros[$i]["documento"] == $documento){
                $this->pasajeros[$i]["nombre"] = $nuevoNombre;
                $this->pasajeros[$i]["apellido"] = $nuevoApellido;
                $this->pasajeros[$i]["documento"] = $nuevoDocumento;
                break;
            }
        }
    }

    public function __toString() {
        $texto = '';
        foreach ($this->pasajeros as $pasajero) {
        $texto .= "{$pasajero['documento']} - {$pasajero['nombre']} {$pasajero['apellido']}\n";
        }
    
        return "Código: {$this->codigo}\nDestino: {$this->destino}\nMáx. Pasajeros: {$this->maxPasajeros}\nPasajeros:\n{$texto}";
        }
}