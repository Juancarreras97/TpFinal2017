<?php

namespace TpFinal;

interface Tarjeta {
 	public function pagar(Transporte $transporte, $fecha_y_hora);
 	public function recargar($monto);
 	public function saldo();
 	public function viajesRealizados();
}

class Tarjeta implements Tarjeta {
  
 	public function pagar(Transporte $transporte, $fecha_y_hora) {
 
 	}
 
 	public function recargar($monto) {
 
 	}
 
    public function saldo() {
        	return 0;
      }

    public function viajes_realizados() {
 
     }
 }
 

 class Colectivo extends Transporte{
 	protected $empresa;

 	public function __construct($linea, $empresa){
 		$this->identificador = $linea;
 		$this->empresa = $empresa;
 		$this->tipo = "Colectivo";

 
 }
 
 class Bicicleta extends Transporte{
 	
 	public function __construct($patente){
 		$this->identificador = $patente;
 		$this->tipo = "Bicicleta";
 	}
 } 

 class Viaje{

 }
