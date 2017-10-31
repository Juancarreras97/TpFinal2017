<?php

namespace TpFinal;

use PHPUnit\Framework\TestCase;

class EstacionTest extends TestCase {

    /**
     * Comprueba que el saldo de una tarjeta nueva sea cero.
     */
    public function testSaldoCero() {
        $tarjeta = new Tarjeta();
        $this->assertEquals($tarjeta->saldo(), 0.0);
    }

    public function testCargar50pesos(){
    	$tarjeta = new Tarjeta();
    	$tarjeta->recargar(50);
		$this->assertEquals($tarjeta->saldo(), 50.0);
    }

    public function testCargar332pesos(){
    	$tarjeta = new Tarjeta();
    	$tarjeta->recargar(332);
		$this->assertEquals($tarjeta->saldo(), 388.0);
    }

    public function testMontoNoValido(){
		$tarjeta = new Tarjeta();
		$tarjeta->recargar(242);
		$this->assertEquals($tarjeta->saldo(), 0.0);
    }

    public function testRealizarUnViaje(){
    	$tarjeta = new Tarjeta();
    	$colectivo = new Colectivo("143 Rojo", "Rosario bus");
    	$tarjeta->recargar(20);
    	$tarjeta->pagar($colectivo, "27.10.17 13:40:30");
    	$this->assertEquals($tarjeta->saldo(), 20-9.70);

    }

    public function testRealizarDosViajes(){
    	$tarjeta = new Tarjeta();
    	$colectivo = new Colectivo("143 Rojo", "Rosario bus");
    	$tarjeta->recargar(30);
    	$tarjeta->pagar($colectivo, "27.10.17 13:40:30");
    	$tarjeta->pagar($colectivo, "27.10.17 13:40:35");
    	$this->assertEquals($tarjeta->saldo(), 30-(9.70*2));
    }

}
