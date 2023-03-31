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
            echo "\nIngrese el código del viaje: ";
            $codigo = trim(fgets(STDIN));
            echo "\nIngrese el destino del viaje: ";
            $destino = trim(fgets(STDIN));
            echo "\nIngrese capacidad maxíma de pasajeros: ";
            $maxPasajeros = trim(fgets(STDIN));
            $viaje = new Viajes($codigo, $destino, $maxPasajeros);
            $listaViajes[$viaje->__getCodigo()] = $viaje;

            echo "\nViaje cargado con éxito.\n";
            break;
        case 2:
            do {
                echo "\nIngresar el código del viaje a modificar: ";
                $codigo = trim(fgets(STDIN));
                foreach ($listaViajes as $viaje) {
                    if ($codigo == $viaje->codigo) {
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
                                $listaViajes[$codigo]->__setCodigo($nuevoCodigo);
                                //$viaje->__setCodigo($listaViaje, $codigo, $nuevoCodigo);
                                echo "\nEl nuevo código de viaje es: " . $viaje->__getCodigo() . "\n";
                                break;
                            case 2: //CAMBIAR DESTINO
                                echo "\nIngresar el nuevo destino: \n";
                                $destinoNuevo = trim(fgets(STDIN));
                                $listaViajes[$codigo]->__setDestino($destinoNuevo);
                                echo "\nEl nuevo destino del viaje " . $codigo . " es: " . $viaje->__getDestino() . "\n";
                                break;
                            case 3:  //CAMBIAR CAPACIDAD MAXIMA
                                echo "I\nngresar la nueva capacidad máxima: \n";
                                $nuevaCapacidad = trim(fgets(STDIN));
                                $listaViajes[$codigo]->__setMaxPasajeros($nuevaCapacidad);
                                echo "\nLa nueva capacidad máxima del viaje " . $codigo . " es : " . $viaje->__getMaxPasajeros() . "\n";
                                break;
                            case 4: //AGREGAR PASAJERO
                                echo "\nIngresar los datos del pasajero que desea agregar al viaje: \n";
                                echo "Documento: ";
                                $documentoPasajero = trim(fgets(STDIN));
                                echo "Nombre: ";
                                $nombrePasajero = trim(fgets(STDIN));
                                echo "Apellido: ";
                                $apellidoPasajero = trim(fgets(STDIN));
                                $valido = $viaje->__agregarPasajero($listaViajes[$codigo], $documentoPasajero, $nombrePasajero, $apellidoPasajero);
                                if ($valido) {
                                    echo "\nEl pasajero fue agregado con éxito\n";
                                } else {
                                    echo "\nEl pasajero no pudo ser agregado al viaje porque el viaje alcanzó su capacidad máxima o porque el pasajero ya se encuentra en el viaje\n";
                                }
                                break;
                            case 5: //ELIMINAR PASAJERO
                                echo "\nIngresar el documento del pasajero que desea eliminar: \n";
                                $documento = trim(fgets(STDIN));
                                $listaViajes[$codigo]->__eliminarPasajero($listaViajes[$codigo], $documento);
                                break;
                            case 6: //MODIFICAR PASAJERO
                                echo "\nIngresar el documento del pasajero registrado: \n";
                                $documento = trim(fgets(STDIN));
                                $existePasajero = $viaje->__ExistePasajero($listaViajes[$codigo], $documento);
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
                                }
                                break;
                            case 7:
                                break;
                        }
                    } else {
                        echo "\nNo se encontró un viaje con el código " .$codigo ."\n";
                    }
                }
            } while ($opcionModificar = !7);
            break;
        case 3:
            echo "\n Ingrese el código del viaje para acceder a la información del mismo: \n";
            $codigo = trim(fgets(STDIN));
            foreach ($listaViajes as $viaje) {
                if ($codigo == $viaje->codigo) {
                    echo $viaje->__toString();
                } else {
                    echo "\nNo se encontró ningun vuelo con el código " . $codigo . "\n";
                }
            }
            break;
        case 4:
            break;
    }
}
