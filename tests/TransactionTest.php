<?php

require_once 'PHPUnit\Framework\TestCase.php';
require_once 'Transaction.php';

use \redecard_php\Transaction;

/**
 * test case.
 */
class TransactionTest extends PHPUnit_Framework_TestCase {
	
	protected function setUp() {
		parent::setUp ();
					
	}

	protected function tearDown() {
		
		parent::tearDown ();
	}
	
	public function __construct() {

	}
	
	public function testTotalNegativoException(){
		
		$transaction = new Transaction();
		
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setTotal(-1);	
		
	}
	
	public function testTotalZeradoException(){
	
		$transaction = new Transaction();
		
		$this->setExpectedException('InvalidArgumentException');
		
		$transaction -> setTotal(0);
	
	}	
	
	public function testTotal(){
		
		$transaction = new Transaction();
		
		$transaction -> setTotal( 20.0 );
		
		$this -> assertEquals("20.00", $transaction -> getTotal() );		
		
	}
	
	public function testTipoTransacaoValidas(){
		
		$transaction = new Transaction();
		
		$transaction -> setTipoTransacao("08");
		$transaction -> setTipoTransacao("04");
		$transaction -> setTipoTransacao("06");
		$transaction -> setTipoTransacao("73");
		$transaction -> setTipoTransacao("39");
		$transaction -> setTipoTransacao("40");
		
	}
	
	public function testTipoTransacaoEquals(){
	
		$transaction = new Transaction();
	
		$transaction -> setTipoTransacao("08");

		$this -> assertEquals("08", $transaction->getTipoTransacao());
	
	}	

	public function testParcelasExceptionSemTipoTransaction(){
		
		$transaction = new Transaction();
		
		$this->setExpectedException('RuntimeException');
		$transaction -> setParcelas("00");
	
	}

	public function testParcelasExceptionComTipoTransactionInvalida(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setTipoTransacao("08");
		$transaction -> setParcelas("00");
	
	}	
	
	public function testParcelas(){
	
		$transaction = new Transaction();
	
		$transaction -> setTipoTransacao("04");
		$transaction -> setParcelas("01");
	
		$this -> assertEquals("01", $transaction -> getParcelas() );
		
	}	
	
	public function testNumPedidoExceptionVazio(){
		
		$transaction = new Transaction();
		
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setNumPedido("");
		
		
	}
	
	public function testNumPedidoExceptionGrande(){
	
		$transaction = new Transaction();
		
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setNumPedido("01234567890123456");	
	
	}

	public function testNumPedidoCerto(){
	
		$transaction = new Transaction();
	
		$transaction -> setNumPedido("0123456789012345");
		
		$this -> assertEquals("0123456789012345", $transaction->getNumPedido());
	
	}

	public function testNumCartaoExceptionVazio(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setNumCartao("");
	
	
	}
	
	public function testNumCartaoExceptionGrande(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setNumCartao("01234567890123456");
	
	}
	
	public function testNumCartaoCerto(){
	
		$transaction = new Transaction();
	
		$transaction -> setNumCartao("0123456789012345");
	
		$this -> assertEquals("0123456789012345", $transaction->getNumCartao());
	
	}	
	
	public function testCVC2Exception(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setCVC2("02");
	
	}	
	
	public function testCVC2Certo(){
	
		$transaction = new Transaction();
	
		$transaction -> setCVC2("022");
	
		$this -> assertEquals("022", $transaction->getCVC2());
	}	
	
	public function testMesExceptionMenor(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setMes("00");
	
	}
	
	public function testMesExceptionMaior(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setMes("13");
	
	}	
	
	public function testMesCerto(){
	
		$transaction = new Transaction();
	
		$transaction -> setMes("01");
	
		$this -> assertEquals("01", $transaction->getMes());
		
	}
	
	public function testAnoExceptionMenor(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setAno( '2012' );
	
	}
	
	public function testAnoCerto(){
	
		$transaction = new Transaction();
	
		$transaction -> setAno(date("Y"));
	
		$this -> assertEquals(date("Y"), $transaction->getAno());
	
	}

	public function testPortadorExceptionMaior(){
	
		$transaction = new Transaction();
	
		$this->setExpectedException('InvalidArgumentException');
		
		/* Conhecido como Dom Pedro I */
		$transaction -> setPortador( 'Pedro de Alcântara Francisco Antônio João Carlos Xavier de Paula Miguel Rafael Joaquim José Gonzaga Pascoal Cipriano Serafim de Bragança e Bourbon' );
	
	}
	
	public function testPortadorCerto(){
	
		$transaction = new Transaction();
	
		$transaction -> setPortador("Demetrius Feijoo Campos");
	
		$this -> assertEquals("Demetrius Feijoo Campos", $transaction->getPortador());
	
	}	
	
	public function testAutorizacaoExceptionSemFiliacao(){
	
	
		$this -> setExpectedException('BadMethodCallException');
		
		$transaction = new Transaction();
		$transaction -> setTotal(20.0);
		$transaction -> setTipoTransacao("04");
		$transaction -> setPortador("Demetrius Feijoo Campos");
		$transaction -> setMes("12");
		$transaction -> setAno("2013");		
		$transaction -> setParcelas("00");
		$transaction -> setNumPedido("000000000");
		$transaction -> setNumCartao("000000000");
		$transaction -> consultaAutorizacao();
	
	}	
	
	public function testAutorizacaoExceptionSemTotal(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTipoTransacao("04");
		$transaction -> setPortador("Demetrius Feijoo Campos");		
		$transaction -> setMes("12");
		$transaction -> setAno("2013");		
		$transaction -> setParcelas("00");
		$transaction -> setNumPedido("000000000");
		$transaction -> setNumCartao("000000000");
		$transaction -> consultaAutorizacao();
	
	}	
	
	public function testAutorizacaoExceptionSemTipoTransacao(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTotal(20.0);
		$transaction -> setPortador("Demetrius Feijoo Campos");
		$transaction -> setMes("12");
		$transaction -> setAno("2013");		
		$transaction -> setParcelas("00");
		$transaction -> setNumPedido("000000000");
		$transaction -> setNumCartao("000000000");
		$transaction -> consultaAutorizacao();
	
	}	
	
	public function testAutorizacaoExceptionSemPortador(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTotal(20.0);
		$transaction -> setMes("12");
		$transaction -> setAno("2013");
		$transaction -> setParcelas("00");
		$transaction -> setNumPedido("000000000");
		$transaction -> setNumCartao("000000000");
		$transaction -> consultaAutorizacao();
	
	}
		
	public function testAutorizacaoExceptionSemParcelas(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTotal(20.0);
		$transaction -> setTipoTransacao("04");
		$transaction -> setPortador("Demetrius Feijoo Campos");		
		$transaction -> setMes("12");
		$transaction -> setAno("2013");		
		$transaction -> setNumPedido("000000000");
		$transaction -> setNumCartao("000000000");
		$transaction -> consultaAutorizacao();
	
	}	
	
	public function testAutorizacaoExceptionSemNumPedido(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTotal(20.0);
		$transaction -> setTipoTransacao("04");
		$transaction -> setPortador("Demetrius Feijoo Campos");
		$transaction -> setMes("12");
		$transaction -> setAno("2013");		
		$transaction -> setParcelas("00");
		$transaction -> setNumCartao("000000000");
		$transaction -> consultaAutorizacao();
	
	}

	public function testAutorizacaoExceptionSemNumCartao(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTotal(20.0);
		$transaction -> setTipoTransacao("04");
		$transaction -> setPortador("Demetrius Feijoo Campos");
		$transaction -> setMes("12");
		$transaction -> setAno("2013");		
		$transaction -> setParcelas("00");
		$transaction -> setNumPedido("000000000");
		$transaction -> consultaAutorizacao();
	
	}

	public function testAutorizacaoExceptionSemValidade(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTotal(20.0);
		$transaction -> setTipoTransacao("04");	
		$transaction -> setPortador("Demetrius Feijoo Campos");
		$transaction -> setParcelas("00");
		$transaction -> setNumCartao("000000000");
		$transaction -> setNumPedido("000000000");
		$transaction -> consultaAutorizacao();
	
	}

	public function testAutorizacaoExceptionValidadeInvalida(){
	
		$this -> setExpectedException('BadMethodCallException');
	
		$transaction = new Transaction();
		$transaction -> setFiliacao("012121212121");
		$transaction -> setTotal(20.0);
		$transaction -> setTipoTransacao("04");
		$transaction -> setPortador("Demetrius Feijoo Campos");
		$transaction -> setMes("12");
		$transaction -> setAno("2012");
		$transaction -> setParcelas("00");
		$transaction -> setNumPedido("000000000");
		$transaction -> setNumCartao("000000000");
		$transaction -> consultaAutorizacao();
	
	}	
		
}

