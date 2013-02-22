<?php
namespace redecard_php;

//import's
require_once 'Transaction.php';

//aliases
use redecard_php\Transaction;

/**
 *
 * @author Demetrius Feijoo Campos
 * @link http://www.operabacana.com.br
 * @version 0.1v       
 *        
 */

class Redecard {
	
	private $filiacao;
	
	public function __construct( $filiacao ) {

		if(empty($filiacao)){
			
			throw new \InvalidArgumentException("Um numero valido de filiacao deve ser fornecido!");
					
		}
		
		$this -> filiacao = $filiacao;
		
	}
	
	/**
	 * @return string
	 */
	public function __toString(){
		
		return sprintf("Afiliacao: %d", $this->getFiliacao());
		
	}

	public function __clone(){
		
	}
	
	
	
	/**
	 * @return the $filiacao
	 */
	public function getFiliacao() {
		
		return $this->filiacao;
		
	}
	
	/**
	 * Retorna uma transação 
	 * @return \redecard_php\Transaction
	 */
	public function newTransaction(){
		
		return new Transaction();	
		
	}
	
}

?>