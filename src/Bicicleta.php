<?php

namespace TpFinal;

 class Bicicleta extends Transporte{
 	
 	public function __construct($patente){
 		$this->identificador = $patente;
 		$this->tipo = "Bicicleta";
 	}
 } 
