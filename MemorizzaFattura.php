<html>
<body>
	Welcome,  
	<strong><?php 
	echo $_POST["name"]; ?></strong>
	<?php
    echo " -   Your email address is: "; 
    echo $_POST["email"]; ?><br>
	
	<hr />


Importo fattura: <strong><?php echo $_POST["importo"]; ?></strong><br><br>
<?php

$importo = $_POST["importo"];

//calcoli
$inps = inps($importo);
$imponibile = imponibile($importo, $inps);
$iva = iva($imponibile);
$imponibileIva = imponibileIva($imponibile, $iva);
$ritenuta = ritenuta($imponibile);
$aPagare = aPagare($imponibileIva, $ritenuta);

//memorizzazione su DB MySQL
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Fatture";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO AFatture (importo, inps, imponibile, iva, imponibile_iva, ritenuta, a_pagare, id_cliente)
VALUES ($importo, $inps, $imponibile, $iva, $imponibileIva, $ritenuta, $aPagare, 1)";

if ($conn->query($sql) === TRUE) {
	$last_id = $conn->insert_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();


//visualizzazione
echo "Inps (4%): " . number_format ($inps , 2 , "." , "," ) . "<br>";
echo "Imponibile con Inps: " . number_format ($imponibile , 2 , "." , "," ) . "<br>";
echo "Iva (22%): " . number_format ($iva , 2 , "." , ",")  . "<br>";
echo "Imponibile con Iva: " . number_format ($imponibileIva , 2 , "." , "," ) . "<br>";
echo "Ritenuta d'acconto (20%): " . number_format ($ritenuta , 2 , "." , "," ) . "<br>" . "<br>";
echo "<strong>" . "Totale da pagare: " . number_format ($aPagare , 2 , "." , "," ) . "</strong>" . "<br>";
echo "<hr />";
echo "Fattura memorizzata " . "<strong>" .  "con il numero " . $last_id . "</strong>" . "<br>";

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
?><br>

<button type="button" onclick="javascript:location.href='jsFattura.html'">Altra fattura</button>
<button type="button" onclick="javascript:location.href='ElencoFatture.php'">Elenco fatture</button>


</body>
</html> 