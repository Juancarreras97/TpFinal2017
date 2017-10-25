<?php

namespace TpFinal;

interface Tarjeta_interfaz {
 #	public function pagar(Transporte $transporte, $fecha_y_hora);
 	public function recargar($monto);
 	public function saldo();
 	public function viajesRealizados();
}

class Tarjeta implements Tarjeta_interfaz {
	
	protected $carga;
	protected $viajes = array();
	protected $id;
  

  	public function __construct($id = 0){
  		$this->carga = 0.0;

  		if ($id == 0)
  			$this->id = rand(1000, 9999);
  		else
  			$this->id = $id;
  	}

 #	public function pagar(Transporte $transporte, $fecha_y_hora) {

 #	}
 
 	public function recargar($monto) {
		$montosposibles = [
			10	=>	10.0,
			20	=>	20.0,
			30	=>	30.0,
			50	=>	50.0,
			100	=>	100.0,
			332	=>	388.0,
			624	=>	776.0
		];
  
		if (in_array($monto, $montosposibles)){
			$this->carga += $monto;
		} else
			return "No se puede recargar ese monto";
 	}
 
    public function saldo() {
		return $this->carga;
	}

	public function viajesRealizados() {
 		return $this->viajes;
 	}
 }
 
