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

    public function testRealizarUnTransbordo(){
    	$tarjeta = new Tarjeta();
    	$colectivo1 = new Colectivo("143 Rojo", "Rosario bus");
    	$colectivo2 = new Colectivo("133 Negro", "Rosario bus");
    	
    	$tarjeta->recargar(50);
    	
    	$tarjeta->pagar($colectivo1, "27.10.17 13:40:30");
    	$this->assertEquals($tarjeta->saldo(), 50-9.70);

        $tarjeta->pagar($colectivo2, "27.10.17 14:10:35");
        $this->assertEquals($tarjeta->saldo(), (50-9.70)-3.20);
    }

    public function testRealizarUnTransbordoYUnViaje(){
    	$tarjeta = new Tarjeta();
    	$colectivo1 = new Colectivo("143 Rojo", "Rosario bus");
    	$colectivo2 = new Colectivo("133 Negro", "Rosario bus");
    	
    	$tarjeta->recargar(50);
    	
    	$tarjeta->pagar($colectivo1, "27.10.17 13:40:30");
    	$this->assertEquals($tarjeta->saldo(), 50-9.70);

        $tarjeta->pagar($colectivo2, "27.10.17 14:10:35");
        $this->assertEquals($tarjeta->saldo(), (50-9.70)-3.20);

        $tarjeta->pagar($colectivo2, "27.10.17 14:10:45");
        $this->assertEquals($tarjeta->saldo(), ((50-9.70)-3.20)-9.70);
    }

    public function testRealizarUnViajePlus(){
    	$tarjeta = new Tarjeta();
    	$colectivo1 = new Colectivo("143 Rojo", "Rosario bus");
    	
    	$tarjeta->pagar($colectivo1, "27.10.17 13:40:30");
		$this->assertEquals($tarjeta->saldo(),0);

		$tarjeta->recargar(30);
		$this->assertEquals($tarjeta->saldo(), 30-9.70);	
  	

    }

	public function testSacarunabici(){
		$tarjeta = new Tarjeta();
		$bici = new Bicicleta(1234);
		
		$tarjeta->recargar(50);
    	
    	$tarjeta->pagar($bici, "27.10.17 13:40:30");
    	$this->assertEquals($tarjeta->saldo(), 50-12.45);	

	}

	public function testSacarvariasbicis(){
		$tarjeta = new Tarjeta();
		$bici = new Bicicleta(1234);

		$tarjeta->recargar(50);
    	
    	$tarjeta->pagar($bici, "27.10.17 13:40:30");
    	$this->assertEquals($tarjeta->saldo(), 50-12.45);	

    	$tarjeta->pagar($bici, "27.10.17 15:23:14");
    	$this->assertEquals($tarjeta->saldo(), 50-12.45);	

    	$tarjeta->pagar($bici, "27.10.17 16:35:12");
    	$this->assertEquals($tarjeta->saldo(), 50-12.45);	


	}

}
