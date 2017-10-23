<?php

namespace TpFinal;

 class Colectivo extends Transporte{
 	protected $empresa;

 	public function __construct($linea, $empresa){
 		$this->identificador = $linea;
 		$this->empresa = $empresa;
 		$this->tipo = "Colectivo";

 
 }