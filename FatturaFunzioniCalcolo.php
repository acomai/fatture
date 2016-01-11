
<?php
/*
$importoError = $nameError = $emailError = "";
$importo = $name = $email = "";

	
	$inps = inps($importo);
	$imponibile = imponibile($importo, $inps);
	$iva = iva($imponibile);
	$imponibileIva = imponibileIva($imponibile, $iva);
	$ritenuta = ritenuta($imponibileIva);
	$aPagare = aPagare($imponibileIva, $ritenuta);
	
*/
	function inps($importo) {
		return $importo * 0.04;
	}
	
	function imponibile($importo, $inps) {
		return $importo + $inps;
	}
	
	function iva($imponibile) {
		return $imponibile * 0.22;
	}
	
	function imponibileIva($imponibile, $iva) {
		return $imponibile + $iva;
	}
	
	function ritenuta($imponibile) {
		return $imponibile * 0.20;
	}
	
	function aPagare($imponibileIva, $ritenuta) {
		return $imponibileIva - $ritenuta;
	}

?>


