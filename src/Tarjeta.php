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
	protected $viajes_en_bici = array();
  

  	public function __construct($id = 0){
  		$this->carga = 0.0;

  		if ($id == 0)
  			$this->id = rand(1000, 9999);
  		else
  			$this->id = $id;
  	}

 	public function pagar(Transporte $transporte, $fecha_y_hora, $medio = 0) {
 		if ($transporte->get_tipo() == "Colectivo"){
 			$fecha = strtotime($fecha_y_hora);
 			
 			if ($medio == 1)
 				$precio = 4.85;
 			else
				$precio = 9.70;
 				
 			if (!empty($this->viajes_en_colectivo)){
 				$ultimo_viaje = end($this->viajes_en_colectivo);


 				if ($transporte->nombre() != $ultimo_viaje->Transporte()->nombre()){

	 				$diferencia = $fecha - $ultimo_viaje->Fecha();

 					if ($diferencia <= 3600){
 						if ($medio == 1)
 							$precio = 1.60;
 						else
 							$precio = 3.20;
 					} else if ($diferencia <= 5400){
 						if(intval(strftime('%H',$fecha)) < 6 or intval(strftime('%H',$fecha)) >= 22){
 							if ($medio == 1)
 								$precio = 1.60;
 							else
 								$precio = 3.20;				
 						}
 						else if((intval(strftime('%w',$fecha)) == 0 and 
 								intval(strftime('%H',$fecha)) >= 6 and 
 								intval(strftime('%H',$fecha)) < 22) 
 								or (intval(strftime('%w',$fecha)) == 6 and 
 								intval(strftime('%H',$fecha)) >= 14 and 
 								intval(strftime('%H',$fecha)) < 22)){

 							if ($medio == 1)
 								$precio = 1.60;
 							else
 								$precio = 3.20;	
 						}
 					}
 				}

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

 				else{
 					return "No tiene suficiente saldo para realizar esta operacion";
 				}
 			}

 		} else if($transporte->Tipo() == "Bicicleta"){
			$fecha = strtotime($fecha_y_hora);
			$precio = 12.45;
			
			if (!empty($this->viajes_en_bici)){
				$ultimo_viaje = end($this->viajes_en_bici);
				if((strftime('%D',$fecha) == strftime('%D',$ultimo_viaje->Fecha()))){
					$precio = 0;
				}
			}
			
			$viaje = new Viaje($precio, $transporte, $fecha);
			
			if ($this->saldo() - $precio > 0){
				$this->carga -= $precio;
				$this->viajes[] = $viaje;
				$this->viajes_en_bici[] = $viaje;
			} else
				return "No tiene suficiente saldo para realizar esta operacion";
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

		$this->restarviajesplus();

 	}

 	protected function restarviajesplus() {
		
		if(count($this->viajes_plus) > 0){
			if(count($this->viajes_plus) == 1){
				$this->carga -= end(($this->viajes_plus))->Monto();
				unset($this->viajes_plus[0]);
			} else {
				$this->carga -= end(($this->viajes_plus))->Monto();
				unset($this->viajes_plus[1]);

				if($this->saldo() > $this->viajes_plus[0]->Monto())
					$this->restarviajesplus();
				else
					return "No tiene suficiente saldo para pagar todos los viajes plus";

			}
		}
 	}
 
    public function saldo() {
		return $this->carga;
	}

	public function viajesRealizados() {
 		return $this->viajes;
 	}
 }
 
