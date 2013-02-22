<?php
namespace redecard_php;

/**
 *
 * @author Demetrius Feijoo Campos
 * @link http://www.operabacana.com.br
 * @version 0.1v
 *
 */
class Transaction {
	
	private $valor;
	private $tipoTransacao;
	private $parcelas;
	private $numeroPedido;
	private $numeroCartao;
	private $cvc;
	private $mes;
	private $ano;
	private $portador;
	private $iata;
	private $distribuidor;
	private $concentrador;
	private $taxaEmbarque;
	private $entrada;
	private $numDoc = array();
	private $pax = array();
	private $confTXN;
	private $addData;
	
	public function __construct(){
		
	}
	
	
	/**
	 * @return string
	 */	
	public function __toString(){
		
		return "";
		
	}
	
	public function __clone(){
		
		
	}

	
	/**
	 * @return the $valor
	 */
	public function getValor(){
	
		return $this -> valor;
	
	}
	
	/**
	 * @return $transacao
	 */
	public function getTipoTransacao(){
	
		return $this -> tipoTransacao;
	
	}
	
	/**
	 * @return the $parcelas
	 */
	public function getParcelas() {
		
		return $this->parcelas;
		
	}

	/**
	 * @return the $numeroPedido
	 */
	public function getNumeroPedido() {
		
		return $this->numeroPedido;
		
	}

	/**
	 * @return the $numeroCartao
	 */
	public function getNumeroCartao() {
		
		return $this->numeroCartao;
		
	}

	/**
	 * @return the $cvc
	 */
	public function getCvc() {
		
		return $this->cvc;
		
	}

	/**
	 * @return the $mes
	 */
	public function getMes() {
		
		return $this->mes;
		
	}

	/**
	 * @return the $ano
	 */
	public function getAno() {
		
		return $this->ano;
		
	}

	/**
	 * @return the $portador
	 */
	public function getPortador() {
		
		return $this->portador;
		
	}

	/**
	 * @return the $iata
	 */
	public function getIata() {
		
		return $this->iata;
		
	}

	/**
	 * @return the $distribuidor
	 */
	public function getDistribuidor() {
		
		return $this->distribuidor;
		
	}

	/**
	 * @return the $concentrador
	 */
	public function getConcentrador() {
		
		return $this->concentrador;
		
	}

	/**
	 * @return the $taxaEmbarque
	 */
	public function getTaxaEmbarque() {
		
		return $this->taxaEmbarque;
		
	}

	/**
	 * @return the $entrada
	 */
	public function getEntrada() {
		
		return $this->entrada;
		
	}

	/**
	 * @return the $numDoc
	 */
	public function getNumDoc() {
		
		return $this->numDoc;
		
	}

	/**
	 * @return the $pax
	 */
	public function getPax() {
		
		return $this->pax;
		
	}

	/**
	 * @return the $confTXN
	 */
	public function getConfTXN() {
		
		return $this->confTXN;
		
	}

	/**
	 * @return the $addData
	 */
	public function getAddData() {
		
		return $this->addData;
		
	}
	
	/**
	 * Seta o valor total da transacao
	 * @param double $valor
	 * @throws \InvalidArgumentException
	 */
	public function setValor( $valor ){
	
		if( !is_double($valor) || $valor <= 0 ){
	
			throw new \InvalidArgumentException( sprintf("O parametro passado para o metodo %s devera ser um double e maior que zero. ", __METHOD__) );
				
		}
	
		$this -> valor = number_format($valor, 2, ".", "");
	
		return $this;
	
	}
	
	
	/**
	 * Tipos de transacoes:
	 * 04 - A vista
	 * 06 - Parcelado emissor
	 * 08 - Parcelado estabelecimento
	 * 73 - Pre-autorizacao
	 * 39 - IATA a vista
	 * 40 - IATA parcelado
	 *
	 * @param String $tipo
	 * @throws \InvalidArgumentException
	 */
	public function setTipoTransacao( $tipo ){
		
		if( $tipo != "04" && $tipo != "06" && $tipo != "08" && $tipo != "73" && $tipo != "39" && $tipo != "40" ){
	
			throw new \InvalidArgumentException( sprintf( "O parametro passado para o metodo %s devera ser igual a 04, 06, 08, 73, 39 ou 40!" , __METHOD__) );
				
		}
	
		$this->tipoTransacao = (String) $tipo;
	
	}	

	/**
	 * @param String $parcelas
	 * @throws \RuntimeException
	 */
	public function setParcelas($parcelas) {
		
		if( ( (empty($parcelas) ||  $parcelas == "00") && $this -> getTipoTransacao() != "04"   )  ){
		
			throw new \RuntimeException( sprintf( "O valor das parcelas nao pode ser vazio quando o tipo de transacao nao e a vista! " ) );
		
		}else{
			
			if( empty($this -> getTipoTransacao()) ){
				
				//throw new \RuntimeException( sprintf( "Primeiro e necessario setar o tipo de transacao." ) );
				
			}
			
		}
		
		
		
		$this->parcelas = $parcelas;
		
	}

	/**
	 * @param field_type $numeroPedido
	 */
	public function setNumeroPedido($numeroPedido) {
		$this->numeroPedido = $numeroPedido;
	}

	/**
	 * @param field_type $numeroCartao
	 */
	public function setNumeroCartao($numeroCartao) {
		$this->numeroCartao = $numeroCartao;
	}

	/**
	 * @param field_type $cvc
	 */
	public function setCvc($cvc) {
		$this->cvc = $cvc;
	}

	/**
	 * @param field_type $mes
	 */
	public function setMes($mes) {
		$this->mes = $mes;
	}

	/**
	 * @param field_type $ano
	 */
	public function setAno($ano) {
		$this->ano = $ano;
	}

	/**
	 * @param field_type $portador
	 */
	public function setPortador($portador) {
		$this->portador = $portador;
	}

	/**
	 * @param field_type $iata
	 */
	public function setIata($iata) {
		$this->iata = $iata;
	}

	/**
	 * @param field_type $distribuidor
	 */
	public function setDistribuidor($distribuidor) {
		$this->distribuidor = $distribuidor;
	}

	/**
	 * @param field_type $concentrador
	 */
	public function setConcentrador($concentrador) {
		$this->concentrador = $concentrador;
	}

	/**
	 * @param field_type $taxaEmbarque
	 */
	public function setTaxaEmbarque($taxaEmbarque) {
		$this->taxaEmbarque = $taxaEmbarque;
	}

	/**
	 * @param field_type $entrada
	 */
	public function setEntrada($entrada) {
		$this->entrada = $entrada;
	}

	/**
	 * @param multitype: $numDoc
	 */
	public function setNumDoc($numDoc) {
		$this->numDoc = $numDoc;
	}

	/**
	 * @param multitype: $pax
	 */
	public function setPax($pax) {
		$this->pax = $pax;
	}

	/**
	 * @param field_type $confTXN
	 */
	public function setConfTXN($confTXN) {
		$this->confTXN = $confTXN;
	}

	/**
	 * @param field_type $addData
	 */
	public function setAddData($addData) {
		$this->addData = $addData;
	}

	public function captura(){
		
		/*Verificar o IATA*/
		
	}

}

?>