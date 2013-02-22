<!DOCTYPE html>
<html lang="pt-br" >

<head>
	<meta charset="uft-8" >
</head>

<body>

<?php
//imports
require_once 'Redecard.php';

// alias
use \redecard_php\Redecard;

//execute
try{
	
	$redecard = new Redecard(34215468);
	$transacao = $redecard->newTransaction();
	$transacao -> setValor(20);
	$transacao -> setTipoTransacao(04);
	
}catch (InvalidArgumentException $e){

	echo $e->getMessage();
	
}

?>

</body>

</html>