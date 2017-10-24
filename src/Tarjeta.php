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
  $montosposibles = [10,20,30,50,100,332,624];
  
   if (in_array($monto, array_slice($montosposibles,0,5)){
    $this->carga += $monto;
   } else if (in_array($monto, $montosposibles)){
    if ($monto == 332)
     $this->carga += 388;
    else
     $this->carga += 776;
   }else
       return "No se puede recargar ese monto";
 	}
 
    public function saldo() {
        	return $this->carga;
      }

    public function viajes_realizados() {
 
     }
 }
 
 
 class Viaje{

 }
