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
 
 class Colectivo {
 
 }
 
 class Bicicleta {
 
 } 