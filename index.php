<!DOCTYPE html>
<html lang="pt-br" >

<head>
	<meta charset="uft-8" >
</head>

<body>

<?php
//imports
require_once 'Transaction.php';

// alias
use \redecard_php\Transaction;

//execute
$transacao = new Transaction();

try{
	
	$transacao -> setConfTXN(1);
	$transacao -> setPortador("Demetrius Feijoo Campos");	
	$transacao -> setFiliacao("012121212121");
	$transacao -> setTotal(0.01);
	$transacao -> setTipoTransacao("04");
	$transacao -> setParcelas("00");
	$transacao -> setNumPedido("000000000");
	$transacao -> setNumCartao("000000000");
	$transacao -> setCVC2("201");
	$transacao -> setMes("12");
	$transacao -> setAno("2013");
	
	$retorno = $transacao -> consultaAutorizacao();	

	
}catch (InvalidArgumentException $e){

	echo $e->getMessage();
	
}catch( BadMethodCallException $e ){

	echo $e->getMessage();

}

?>

</body>

</html>