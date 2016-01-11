<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<?php
$importoError = $nameError = $emailError = "";
$importo = $name = $email = "";
$okay = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])) {
     //$nameErr = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameError = "Il nome deve contenere solo lettere";
     }
   }
   
   if (empty($_POST["email"])) {
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailError = "Email non valida";
	 }
   }

   if (empty($_POST["importo"])) {
   	$importoError = "Obbligatorio inserire l'importo";
	   $okay = false;
   } else {
     $importo = test_input($_POST["importo"]);
     // check if e-mail address is well-formed
     if (!preg_match("/^[0-9.,]*$/",$importo)) {
       $importoError = "L'importo deve essere numerico";
		 $okay = false;
	 }
   }

}




?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>welcome</title>
		<meta name="author" content="Adriano" />
		<!-- Date: 2014-12-26 -->
	</head>
	<body>
		<p style="text-align: right;"><?php echo date("d/m/Y h:i:s a");?></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name: <input type="text" name="name" value="<?php echo $name;?>"><span class="error"> <?php echo $nameError;?></span><br><br>
E-mail: <input type="text" name="email" value="<?php echo $email;?>"><span class="error"> <?php echo $emailError;?></span><br><br>
Importo: <input type="text" name="importo" value="<?php echo $importo;?>"><span class="error"> <?php echo $importoError;?></span><br><br>
<input type="submit">
</form>

<?php
if ($importo != null && $importoError == null && $okay == TRUE) {
	echo "<br>" . "Welcome, " . "<strong>" .  $name . "</strong>" . " -   Your email address is: " . $email;

	
	echo "<hr />" . "<br>";
	
	include 'FatturaFunzioniCalcolo.php';
	
	$inps = inps($importo);
	$imponibile = imponibile($importo, $inps);
	$iva = iva($imponibile);
	$imponibileIva = imponibileIva($imponibile, $iva);
	$ritenuta = ritenuta($imponibileIva);
	$aPagare = aPagare($imponibileIva, $ritenuta);
	
	echo "<br>" . "<strong>" . "Importo fattura: " . number_format ($importo , 2 , "." , "," ) . "</strong>" . "<br>" . "<br>";
	echo "Inps (4%): " . number_format ($inps , 2 , "." , "," ) . "<br>";
	echo "Imponibile con Inps: " . number_format ($imponibile , 2 , "." , "," ) . "<br>";
	echo "Iva (22%): " . number_format ($iva , 2 , "." , ",")  . "<br>";
	echo "Imponibile con Iva: " . number_format ($imponibileIva , 2 , "." , "," ) . "<br>";
	echo "Ritenuta d'acconto (20%): " . number_format ($ritenuta , 2 , "." , "," ) . "<br>" . "<br>";
	echo "<strong>" . "Totale da pagare: " . number_format ($aPagare , 2 , "." , "," ) . "</strong>" . "<br>";
}	


/*
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
	
	function ritenuta($imponibileIva) {
		return $imponibileIva * 0.20;
	}
	
	function aPagare($imponibileIva, $ritenuta) {
		return $imponibileIva - $ritenuta;
	}
*/
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

	</body>
</html>

