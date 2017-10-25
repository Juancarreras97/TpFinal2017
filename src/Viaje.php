<?php

namespace TpFinal;

class Viaje{
	protected $tipo;
	protected $monto;
	protected $transporte;

	public function __construct($monto, Transporte $transporte){
		$this->monto = $monto;
		$this->transporte = $transporte;

		$this->tipo = "En " . $transporte->Tipo();
	}

	public function Tipo(){
		return $this->tipo;
	}

	public function Transporte(){
		return $this->transporte;
	}

	public function Monto(){
		return $this->monto;
	}

}