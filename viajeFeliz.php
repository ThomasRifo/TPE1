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

//funcion para saber si el pasajero a agregar ya se encuentra dentro del viaje

    public function nuevoPasajero($array, $documento){ //ARRAY FUE AGREGADO PARA PROBAR
        $i= 0;
        $nuevoPasajero = true;
        $indiceMaximo = count($array->pasajeros);
        while($i < $indiceMaximo && $array->pasajeros[$i]["documento"] != $documento){
            $i += 1;
        }
        if($indiceMaximo > $i && $array->pasajeros[$i]["documento"] == $documento){
            $nuevoPasajero = false;
        }
        return $nuevoPasajero;
    }


    //Si la funcion nuevoPasajero retorna true, procede a agregarlo, sino avisa que el pasajero ya se encuentra registrado.
    public function __agregarPasajero($array, $documento, $nombre, $apellido){
        $fueAgregado = false;
        if(count($array->pasajeros) < $array->maxPasajeros){
            if($this->nuevoPasajero($array, $documento)){ //SOLO TENIA $DOCUMENTO
                $pasajero = array(
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "documento" => $documento
            
            );
            array_push($array->pasajeros, $pasajero);
            //echo "El pasajero fue agregado con exito";
            $fueAgregado = true;
            } /*else {
            //echo "El pasajero que desea ingresar ya se encuentra registrado en este viaje.";
            }*/
        } /*else {
            echo "El viaje se encuentra completo, no se pueden añadir pasajeros.";
        }*/
        return $fueAgregado;
    }

    //Elimina al pasajero indicado con el documento. LEER COMENTARIO DENTRO CODIGO.
    //Podría ser mas eficiente usar un foreach en vez de for al igual que en modificarPasajero. Revisar
    public function __eliminarPasajero($array, $documento){
        $pasajeroExiste = false;
        for($i = 0; $i < count($array->pasajeros); $i++){
            if($array->pasajeros[$i]["documento"] == $documento){
                array_splice($array->pasajeros, $i, 1);
                break;
                $pasajeroExiste = true;
            }
        }
        //Esto TENGO QUE ponerlo en el case correspondiente.
        /* if($pasajeroExiste){
            echo "El pasajero ha sido eliminado correctamente del viaje.";
        } else {
            echo "El pasajero que desea eliminar no se encuentra en el viaje";
        } */
    }


    public function __ExistePasajero($array, $documento){
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
        // CREO QUE NO HACE FALTA $fueModificado = $this->__ExistePasajero($documento);
        for($i = 0; $i < count($this->pasajeros); $i++){
            if($this->pasajeros[$i]["documento"] == $documento){
                $this->pasajeros[$i]["nombre"] = $nuevoNombre;
                $this->pasajeros[$i]["apellido"] = $nuevoApellido;
                $this->pasajeros[$i]["documento"] = $nuevoDocumento;
                break;
               // El echo va en el test. echo "Los datos del pasajero fueron modificados con éxito";
            }
               // El echo va en el test. echo "El documento ingresado no corresponde a un pasajero de este viaje";
        }
        // MISMO Q ARRIBA return $fueModificado;
    }

    public function __toString() {
        $texto = '';
        foreach ($this->pasajeros as $pasajero) {
          $texto .= "{$pasajero['documento']} - {$pasajero['nombre']} {$pasajero['apellido']}\n";
        }
    
        return "Código: {$this->codigo}\nDestino: {$this->destino}\nMáx. Pasajeros: {$this->maxPasajeros}\nPasajeros:\n{$texto}";
        }
}