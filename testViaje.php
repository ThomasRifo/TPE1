<?php

include 'viajeFeliz.php';


$listaViajes = array();

// Instancia de la clase Viaje, con los atributos 001, Bariloche, 24.
$viaje = new Viajes("001", "Bariloche", 24);
$listaViajes[$viaje->__getCodigo()] = $viaje;

//Menú principal

$opcion = 0;
while ($opcion != 4) {
    echo "\n******Menú******\n";
    echo "1. Cargar información de un viaje\n";
    echo "2. Modificar Información de un viaje\n";
    echo "3. Ver información de un viaje\n";
    echo "4. Salir\n";
    echo "Ingrese una opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            //Pide los datos del viaje que desea cargar al sistema y le deja como clave el código
            echo "\nIngrese el código del viaje: ";
            $codigo = trim(fgets(STDIN));

            echo "\nIngrese el destino del viaje: ";
            $destino = trim(fgets(STDIN));
            echo "\nIngrese capacidad maxíma de pasajeros: ";
            $maxPasajeros = trim(fgets(STDIN));
            $viaje = new Viajes($codigo, $destino, $maxPasajeros);
            $listaViajes[$viaje->codigo] = $viaje;
            echo "\nViaje cargado con éxito.\n";
            break;
        case 2:
            //Pide el código del viaje a modificar al principio y comprueba si existe el viaje que desea modificar.
            do {
                echo "\nIngresar el código del viaje a modificar: ";
                $codigo = trim(fgets(STDIN));
                foreach ($listaViajes as $viaje){
                    //Si el viaje existe, despliega el menú con todas las opciones para modificar los datos del viaje.
                    if ($codigo == $viaje->__getCodigo()) {
                        $encontrado = true;
                        echo "\n1. Código del viaje: \n";
                        echo "2. Destino del viaje: \n";
                        echo "3. Capacidad máxima del viaje: \n";
                        echo "4. Agregar pasajero a un viaje: \n";
                        echo "5. Eliminar pasajero del viaje: \n";
                        echo "6. Cambiar información de un pasajero: \n";
                        echo "7. Salir\n";
                        echo "Ingrese una opción válida: ";
                        $opcionModificar = (int)trim(fgets(STDIN));
                        switch ($opcionModificar) {
                            case 1: //CAMBIAR CODIGO
                                echo "\nIngresar el nuevo código de viaje: \n";
                                $nuevoCodigo = trim(fgets(STDIN));
                                $viaje->__setCodigo($nuevoCodigo);
                                echo "\nEl nuevo código de viaje es: " . $viaje->__getCodigo() . "\n";
                                break;
                            case 2: //CAMBIAR DESTINO
                                echo "\nIngresar el nuevo destino: \n";
                                $destinoNuevo = trim(fgets(STDIN));
                                $listaViajes[$codigo]->__setDestino($destinoNuevo);
                                echo "\nEl nuevo destino del viaje " . $codigo . " es: " . $viaje->__getDestino() . "\n";
                                break;
                            case 3:  //CAMBIAR CAPACIDAD MAXIMA
                                echo "\nIngresar la nueva capacidad máxima: \n";
                                $nuevaCapacidad = trim(fgets(STDIN));
                                $listaViajes[$codigo]->__setMaxPasajeros($nuevaCapacidad);
                                echo "\nLa nueva capacidad máxima del viaje " . $codigo . " es : " . $viaje->__getMaxPasajeros() . "\n";
                                break;
                            case 4: //AGREGAR PASAJERO
                                //Verifica si hay lugar en el viaje para poder acceder a esta opción.
                                $capacidadLlena = $viaje->__capacidadLLena($listaViajes[$codigo]);
                                if ($capacidadLlena) {
                                    echo "\nEl viaje " . $codigo . " ha alcanzado su límite máximo de pasajeros.\n";
                                } else {
                                    echo "\nIngresar los datos del pasajero que desea agregar al viaje: \n";
                                    echo "Documento: ";
                                    $documentoPasajero = trim(fgets(STDIN));
                                    $existePasajero = $viaje->__ExistePasajero($listaViajes[$codigo], $documentoPasajero);
                                    //Verifica si el pasajero ya se encuentra en el viaje indicado, sino se encuentra procede a pedirle los datos y lo agrega con la función __agregarPasajero
                                    if ($existePasajero) {
                                        echo "\nEl pasajero ya se encuentra en el viaje " . $codigo . "\n";
                                    } else {
                                        echo "Nombre: ";
                                        $nombrePasajero = trim(fgets(STDIN));
                                        echo "Apellido: ";
                                        $apellidoPasajero = trim(fgets(STDIN));
                                        $viaje->__agregarPasajero($listaViajes[$codigo], $documentoPasajero, $nombrePasajero, $apellidoPasajero);
                                        echo "\nEl pasajero fue agregado con éxito\n"; 
                                    }
                                }
                                break;
                            case 5: //ELIMINAR PASAJERO
                                echo "\nIngresar el documento del pasajero que desea eliminar: \n";
                                $documento = trim(fgets(STDIN));
                                $existePasajero = $viaje->__ExistePasajero($listaViajes[$codigo], $documentoPasajero);
                                //Verifica si el pasajero se encuentra en el viaje, si se encuentra procede a eliminarlo.
                                if ($existePasajero) {
                                    $listaViajes[$codigo]->__eliminarPasajero($listaViajes[$codigo], $documento);
                                    echo "\nEl pasajero fue eliminado del viaje correctamente.\n";
                                } else {
                                    echo "\nEl pasajero no se encuentra dentro del viaje " . $codigo . "\n";
                                }
                                break;
                            case 6: //MODIFICAR PASAJERO
                                echo "\nIngresar el documento del pasajero registrado: \n";
                                $documento = trim(fgets(STDIN));
                                $existePasajero = $viaje->__ExistePasajero($listaViajes[$codigo], $documento);
                                //Verifica si el pasajero se encuentra en el viaje y pide los nuevos datos a registrar. Luego con la funcion modificarPasajero cambia los datos antiguos por los nuevos
                                if ($existePasajero) {
                                    echo "\nSe modificará el pasajero de documento: " . $documento . ". A continuación ingresar los datos nuevamente. \n";
                                    echo "\nIngresar el documento: \n";
                                    $nuevoDocumento = trim(fgets(STDIN));
                                    echo "Ingresar el nombre: \n";
                                    $nuevoNombre = trim(fgets(STDIN));
                                    echo "Ingresar el apellido: \n";
                                    $nuevoApellido = trim(fgets(STDIN));
                                    $listaViajes[$codigo]->__modificarPasajero($documento, $nuevoNombre, $nuevoApellido, $nuevoDocumento);
                                    echo "\nLos datos del pasajero fueron modificados con éxito. \n";
                                } else {
                                    echo "\nEl documento ingresado no corresponde a un pasajero de este viaje. \n";
                                    break;
                                }
                            case 7:
                                break;
                        }
                    }
                }
                if(!$encontrado) {
                    echo "\nNo se encontró ningun viaje con el código " . $codigo . "\n ";
                }
            } while ($opcionModificar = !7);
            break;
        case 3:
            echo "\nIngrese el código del viaje para acceder a la información del mismo: ";
            $codigo = trim(fgets(STDIN));
            //Comprueba que exista el viaje del que se desea ver la información y luego retorna la información del viaje.
            foreach ($listaViajes as $viaje) {
                if ($codigo == $viaje->codigo) {
                    $encontrado = true;
                    echo $viaje->__toString();
                }
            }
            if(!$encontrado) {
                echo "\nNo se encontró ningun viaje con el código asfasf " . $codigo . "\n ";
            }
            break;
        case 4:
            break;
    }
}
