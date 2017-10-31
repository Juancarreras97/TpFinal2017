<?php

namespace TpFinal;

class Viaje{
	protected $tipo;
	protected $monto;
	protected $transporte;
	protected $fecha;

	public function __construct($monto, Transporte $transporte, $fecha){
		$this->monto = $monto;
		$this->transporte = $transporte;
		$this->fecha = $fecha;

		$this->tipo = $transporte->Tipo();
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

	public function Fecha(){
		return $this->fecha;
	}

}