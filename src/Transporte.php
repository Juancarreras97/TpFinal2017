<?php

namespace TpFinal;

 abstract class Transporte {
 	protected $identificador;
 	protected $tipo;
 	
    public function nombre(){
 		return $this->identificador;
    }

    public function Tipo(){
    	return $this->tipo;
    }
 }
