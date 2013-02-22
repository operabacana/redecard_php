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
	
	public function testValorNegativoException(){
		
		$transaction = new Transaction();
		
		$this->setExpectedException('InvalidArgumentException');
		$transaction -> setValor(-1);	
		
	}
	
	public function testValorZeradoException(){
	
		$transaction = new Transaction();
		
		$this->setExpectedException('InvalidArgumentException');
		
		$transaction -> setValor(0);
	
	}	
	
	public function testValor(){
		
		$transaction = new Transaction();
		
		$transaction -> setValor( 20.0 );
		
		$this -> assertEquals("20.00", $transaction -> getValor() );		
		
	}

	public function testParcelasException(){
		
		$transaction = new Transaction();
		
		$this->setExpectedException('RuntimeException');
		$transaction -> setParcelas("00");
		
	
	}	
	
	public function testParcelas(){
	
		$transaction = new Transaction();
	
		//$transaction -> setTipoTransacao("04");
		$transaction -> setParcelas("01");
	
		$this -> assertEquals("01", $transaction -> getParcelas() );
		
	}	
	
}

