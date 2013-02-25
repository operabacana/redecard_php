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
	
	private $filiacao;
	private $total;
	private $tipoTransacao;
	private $parcelas;
	private $numPedido;
	private $numCartao;
	private $cvc2;
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
	
	CONST URL_AUTORIZACAO_PRODUCAO = "https://ecommerce.redecard.com.br/pos_virtual/wskomerci/cap.asmx/GetAuthorized";
	CONST URL_AUTORIZACAO_TESTE = "https://ecommerce.redecard.com.br/pos_virtual/wskomerci/cap_teste.asmx/GetAuthorizedTst";
		
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
	 * @return the $filiacao
	 */
	public function getFiliacao(){
	
		return $this -> filiacao;
	
	}
	

	
	/**
	 * @return the $valor
	 */
	public function getTotal(){
	
		return $this -> total;
	
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
	public function getNumPedido() {
		
		return $this->numPedido;
		
	}

	/**
	 * @return the $numeroCartao
	 */
	public function getNumCartao() {
		
		return $this->numCartao;
		
	}

	/**
	 * @return the $cvc
	 */
	public function getCVC2() {
		
		return $this->cvc2;
		
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
	 * Codigo de filiacao da loja na redecard.
	 * 
	 * @param String filiacaoo
	 * @throws \InvalidArgumentException
	 */
	public function setFiliacao( $filiacao ){
	
		if( empty($filiacao) ){
	
			throw new \InvalidArgumentException( "O parametro filiacao nao pode ser nulo." );
	
		}
	
		$this -> filiacao = $filiacao;
	
	}
		
	
	/**
	 * Seta o valor total da transacao.
	 * @param double total
	 * @throws \InvalidArgumentException
	 */
	public function setTotal( $total ){
	
		if( !is_double($total) || $total <= 0 ){
	
			throw new \InvalidArgumentException( sprintf("O parametro passado para o metodo %s devera ser um double e maior que zero. ", __METHOD__) );
				
		}
	
		$this -> total = number_format($total, 2, ".", "");
		
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
	 * Numero de parcelas da transacao.
	 * Antes de colocar a quantidade de parcelas e preciso colocar um tipo de transacao.  
	 * Esse metodo so pode receber vazio ou 00 quando o tipo de transacao for a vista, ou seja, tipo de transacao 04 ou 39.
	 * 
	 * @param String $parcelas
	 * @throws \RuntimeException
	 */
	public function setParcelas($parcelas) {
		
		if( ( (empty($parcelas) ||  $parcelas == "00") && $this -> getTipoTransacao() != "04" && $this -> getTipoTransacao() != "39"  )  ){
		
			throw new \InvalidArgumentException( "O valor das parcelas nao pode ser vazio quando o tipo de transacao nao e a vista!"  );
		
		}else{
			
			$transacaoVal = $this -> getTipoTransacao();
			
			if( empty($transacaoVal) ){
				
				throw new \InvalidArgumentException( "Primeiro e necessario setar o tipo de transacao." );
				
			}
			
		}
		
		
		
		$this->parcelas = $parcelas;
		
	}

	/**
	 * O numPedido e o numero do pedido gerado pelo estabelecimento.
	 * O numPedido nao pode ser vazio ou ter mais que 16 caracteres.
	 * 
	 * @param String $numeroPedido
	 * @throws \InvalidArgumentException
	 */
	
	public function setNumPedido($numeroPedido) {
		
		if( empty($numeroPedido) || strlen($numeroPedido) > 16 ){
			
			throw new \InvalidArgumentException("O numero do pedido nao pode ser vazio ou ter mais que 16 caracteres");	
			
		}
		
		$this->numPedido = $numeroPedido;
		
	}

	/**
	 * Deve conter o numero do cartao de credito do portador, podendo ser MasterCard, Diners ou Visa. Nao sao aceitos cartoes de Debito.
	 * O numCartao nao pode ser vazio ou ter mais que 16 caracteres.
	 * 
	 * @param String $numeroCartao
	 * @throws \InvalidArgumentException
	 */
	public function setNumCartao($numeroCartao) {
		
		if( empty($numeroCartao) || strlen($numeroCartao) > 16){
			
			throw new \InvalidArgumentException(" O numero do cartao nao pode ser vazio ou ter mais que 16 caracteres");
			
		}
		
		$this->numCartao = $numeroCartao;
	}

	/**
	 * Este parametro e obrigatorio com excecao dos estabelecimentos que trabalham no seguinte seguimento de venda recorrente.
	 * Este parametro deve possuir 3 caracteres.
	 * 
	 * @param int cvc2c
	 * @throws \InvalidArgumentException
	 */
	public function setCVC2($cvc2) {
		
		if( strlen($cvc2) != 3 ){
			
			throw new \InvalidArgumentException("O CVC2 deve possuir exatamente 3 caracteres");
			
		}
		
		$this->cvc2 = $cvc2;
	}

	/**
	 * Mes de validade do cartao. 
	 * Deve possuir o formato mm.
	 * Exemplo: 01 para Janeiro e 12 para Dezembro.
	 * 
	 * @param String $mes
	 * @throws \InvalidArgumentException
	 */
	public function setMes($mes) {
		
		$arrayMesesValidos = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
		
		if( !in_array($mes, $arrayMesesValidos) ){

			throw new \InvalidArgumentException("O Mes passado e invalido. Ele deve possuir o seguinte formato mm. Exemplo: 01 para Janeiro e 12 para Dezembro. ");
			
		}
		
		$this->mes = $mes;
		
	}

	/**
	 * Ano de validade do carto.
	 * Deve possuir formato yyyy e ser maior ou igual ao ano atual.
	 * Exemplo: 1999, so que maior ou igual ao ano atual.
	 * 
	 * @param String $ano
	 * @throws \InvalidArgumentException
	 */
	public function setAno($ano) {
		
		if( $ano < date('Y') ){
			
			throw new \InvalidArgumentException("O Ano passado e invalido. Ele deve possuir o seguinte formato yyyy e ser maior ou igual ao ano atual. Exemplo: ".date('Y'));
			
		}
		
		$this->ano = $ano;
	}

	/**
	 * Devera conter o nome do portador da forma que foi informado por ele.
	 * O nome do portador nao pode ser maior que 50 caracteres.
	 * Este parametro nao e validade pelo emissor do cartao.
	 * 
	 * @param String $portador
	 * @throws \InvalidArgumentException
	 */
	public function setPortador($portador) {
		
		if( strlen($portador) > 50 ){

			throw new \InvalidArgumentException("O nome do portador nao ser maior que 50 caracteres.");
			
		}
		
		$this->portador = $portador;
	}

	/**
	 * @param String $iata
	 */
	public function setIata($iata) {
		$this->iata = $iata;
	}

	/**
	 * @param String $distribuidor
	 */
	public function setDistribuidor($distribuidor) {
		$this->distribuidor = $distribuidor;
	}

	/**
	 * @param String $concentrador
	 */
	public function setConcentrador($concentrador) {
		$this->concentrador = $concentrador;
	}

	/**
	 * @param String $taxaEmbarque
	 */
	public function setTaxaEmbarque($taxaEmbarque) {
		$this->taxaEmbarque = $taxaEmbarque;
	}

	/**
	 * @param String $entrada
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
	 * @param String $confTXN
	 */
	public function setConfTXN($confTXN) {
		$this->confTXN = (int) $confTXN;
	}

	/**
	 * @param String $addData
	 */
	public function setAddData($addData) {
		$this->addData = $addData;
	}

	/**
	 * Verifica se todos os campos estao devidamente preenchidos. Caso estejam, realiza a consulta.
	 *  
	 * @throws \BadMethodCallException
	 */
	public function consultaAutorizacao(){
		
		$eValida = $this -> validaAutorizacao();
		
		if($eValida){ 
			
			$ch = curl_init(self::URL_AUTORIZACAO_TESTE);
			
		    curl_setopt( $ch , CURLOPT_POST , 1 );
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		    curl_setopt( $ch , CURLOPT_POSTFIELDS , $this -> montaQueryAutorizacao() );
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		    
		    $resposta = curl_exec($ch);
		    
			curl_close($ch);
						
		}
		
	}
	
	
	private function validaAutorizacao(){
	
		$formatoMsgError = "O metodo ".__METHOD__." nao pode ser chamado sem ter antes ter setado valores para os campos:  %s ";
		$metodoTestado = "";
		
		if( $this -> getFiliacao() == "" ){
		
			$metodoTestado .= " 'filiacao' ";
		
		}
		
		if( $this -> getTotal() == "" ){
				
			$metodoTestado .=  " 'total' ";
		
		}
		
		if( $this -> getTipoTransacao() == "" ){
		
			$metodoTestado .= " 'tipo transacao' ";
		
		}
		
		if( $this -> getParcelas() == "" ){
		
			$metodoTestado .= " 'parcelas' ";
		
		}
		
		if( $this -> getNumPedido() == "" ){
		
			$metodoTestado .= " 'numpedido' ";
		
		}
		
		if( $this -> getNumCartao() == "" ){
		
			$metodoTestado .= " 'numcartao' ";
		
		}
		
		if( !$this -> isDataValidadeValida() ){
				
			$metodoTestado .= " 'data de validade' ";
				
		}	

		if(!empty($metodoTestado) ){
						
			throw new \BadMethodCallException(sprintf($formatoMsgError, $metodoTestado));
		
		}else{
			
			return true;
			
		}
		
	}
	
	/**
	 * Uma requisicao so pode ser feita para a Redecard utilizando protocolo seguro. 
	 * 
	 */
	private function isAmbienteSeguro(){
		
	}
	
	private function isDataValidadeValida(){
		
		$dataValidade = mktime(null, null, null, $this -> getMes(), null, $this->getAno());
		$dataAtual = mktime(null, null, null, date('m'), null, date('Y'));
		
		return $dataValidade >= $dataAtual;
		
	}
	
	private function montaQueryAutorizacao(){
		
		$arrayNumDoc = $this -> getNumDoc();
		$arrayPax = $this -> getPax();

		$arrayParametros = array();
		$arrayParametros['FILIACAO'] = $this -> getFiliacao();
		$arrayParametros['TOTAL'] = $this -> getTotal();
		$arrayParametros['TRANSACAO'] = $this -> getTipoTransacao();
		$arrayParametros['PARCELAS'] = $this -> getParcelas();
		$arrayParametros['NUMPEDIDO'] = $this -> getNumPedido();
		$arrayParametros['NRCARTAO'] = $this -> getNumCartao();
		$arrayParametros['CVC2'] = $this -> getCVC2();
		$arrayParametros['MES'] = $this -> getMes();
		$arrayParametros['ANO'] = $this -> getAno();
		$arrayParametros['PORTADOR'] = $this -> getPortador();
		$arrayParametros['IATA'] = $this -> getIata();
		$arrayParametros['DISTRIBUIDOR'] = $this -> getDistribuidor();
		$arrayParametros['CONCENTRADOR'] = $this -> getConcentrador();
		$arrayParametros['TAXAEMBARQUE'] = $this -> getTaxaEmbarque();
		$arrayParametros['ENTRADA'] = $this -> getEntrada();
		$arrayParametros['NUMDOC1'] = $arrayNumDoc[0];
		$arrayParametros['NUMDOC2'] = $arrayNumDoc[1];
		$arrayParametros['NUMDOC3'] = $arrayNumDoc[2];
		$arrayParametros['NUMDOC4'] = $arrayNumDoc[3];
		$arrayParametros['PAX1'] = $arrayPax[0];
		$arrayParametros['PAX2'] = $arrayPax[1];
		$arrayParametros['PAX3'] = $arrayPax[2];
		$arrayParametros['PAX4'] = $arrayPax[3];
		$arrayParametros['CONFTXN'] = $this -> getConfTXN();
		$arrayParametros['AddData'] = $this -> getAddData();

        $queryString = "";

        foreach( $arrayParametros as $ind => $valor ){

            $queryString .= "$ind=$valor&";

        }

        $queryString = trim($queryString);

		return $queryString;
		
	}

}

?>