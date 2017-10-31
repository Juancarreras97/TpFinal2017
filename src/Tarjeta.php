<?php

namespace TpFinal;

interface Tarjeta_interfaz {
 	public function pagar(Transporte $transporte, $fecha_y_hora);
 	public function recargar($monto);
 	public function saldo();
 	public function viajesRealizados();
}

class Tarjeta implements Tarjeta_interfaz {
	
	protected $carga;
	protected $viajes = array();
	protected $id;
	protected $viajes_plus = array();
	protected $viajes_en_colectivo = array();
  

  	public function __construct($id = 0){
  		$this->carga = 0.0;

  		if ($id == 0)
  			$this->id = rand(1000, 9999);
  		else
  			$this->id = $id;
  	}

 	public function pagar(Transporte $transporte, $fecha_y_hora, $medio = 0) {
 		if ($transporte->Tipo() == "Colectivo"){
 			$fecha = strtotime($fecha_y_hora);
 			$ultimo_viaje = end($this->viajes_en_colectivo);


 			if ($transporte->nombre() == $ultimo_viaje->Transporte()->nombre()){

	 			$diferencia = $fecha - $ultimo_viaje->Fecha();

 				if ($diferencia <= 3600){
 					if ($medio == 1)
 						$precio = 1.60;
 					else
 						$precio = 3.20;
 				} else if ($diferencia <= 5400){
 					if(intval(strftime('%G',$fecha)) < 6 or intval(strftime('%G',$fecha)) >= 22){
 						if ($medio == 1)
 							$precio = 1.60;
 						else
 							$precio = 3.20;				
 					}
 					else if((intval(strftime('%w',$fecha)) == 0 and 
 								intval(strftime('%G',$fecha)) >= 6 and intval(strftime('%G',$fecha)) < 22) or (intval(strftime('%w',$fecha)) == 6 and intval(strftime('%G',$fecha)) >= 14 and intval(strftime('%G',$fecha)) < 22)){

 						if ($medio == 1)
 							$precio = 1.60;
 						else
 							$precio = 3.20;	
 					}
 				}

 			} else{
 				if ($medio == 1)
 					$precio = 4.85;
 				else
 					$precio = 9.70;
 			}

 			$viaje = new Viaje($precio, $transporte, $fecha);

 			if ($this->saldo() - $precio > 0){
 				$this->carga -= $precio;
 				$this->viajes[] = $viaje;
 				$this->viajes_en_colectivo[] = $viaje; 
 			} else{
 				if(count($this->viajes_plus) <= 2){
 					$this->viajes[] = $viaje;
 					$this->viajes_en_colectivo[] = $viaje; 
 					$this->viajes_plus[] = $viaje;
 				}
 			}

 		} else{

 		}
 	}
 
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
  
		if (array_key_exists($monto, $montosposibles)){
			$this->carga += $montosposibles[$monto];
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
 
