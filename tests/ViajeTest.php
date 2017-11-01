<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class ViajeTest extends TestCase {

	public function testMontoDelViaje (){
		$tarjeta = new Tarjeta();
    	$colectivo = new Colectivo("143 Rojo", "Rosario bus");
    	$tarjeta->recargar(20);
    	$tarjeta->pagar($colectivo, "27.10.17 13:40:30");
    	$this->assertEquals(end($tarjeta->ViajesRealizados())->Monto(), 9.70);

	}
}