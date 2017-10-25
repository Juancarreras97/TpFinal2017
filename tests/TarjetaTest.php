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

}
