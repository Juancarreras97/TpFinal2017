<?php

namespace TpFinal;

interface Tarjeta {
 	public function pagar(Transporte $transporte, $fecha_y_hora);
 	public function recargar($monto);
 	public function saldo();
 	public function viajesRealizados();
}

class Tarjeta implements Tarjeta {
  protected $carga;
  
 	public function pagar(Transporte $transporte, $fecha_y_hora) {
 
 	}
 
 	public function recargar($monto) {
 
 	}
 
    public function saldo() {
        	return $this->carga;
      }

    public function viajes_realizados() {
 
     }
 }
 
 
 class Viaje{

 }
