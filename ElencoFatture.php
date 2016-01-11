<!DOCTYPE html>
<html>
<body>

<h1>Elenco Fatture</h1>

<?php
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


$sql = "SELECT numero, importo, inps, imponibile, iva, imponibile_iva, ritenuta, a_pagare FROM AFatture";
$result = $conn->query($sql);

echo "<table style='width:100%'>";

if ($result->num_rows > 0) {
	echo "<tr>" . 
    "<th>" . "Numero" . "</th>" . 
    "<th>" . "Importo" . "</th>" .
	"<th>" . "Inps (4%)" . "</th>" .
	"<th>" . "Imponibile" . "</th>" .
	"<th>" . "Iva (22%)" . "</th>" . 
	"<th>" . "Imponibile Iva" . "</th>" .
	"<th>" . "Ritenuta d'acconto (20%)" . "</th>" .
	"<th>" . "Totale a pagare" . "</th>" .
	"<th>" . "Cliente" . "</th>" .
	"</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo 
        "<tr>" .
        "<td>" . $row["numero"]. "</td>" .
        "<td>" . $row["importo"]. "</td>" .
        "<td>" . $row["inps"]. "</td>" .
        "<td>" . $row["imponibile"]. "</td>" .
        "<td>" . $row["iva"]. "</td>" .
        "<td>" . $row["imponibile_iva"]. "</td>" .
        "<td>" . $row["ritenuta"]. "</td>" .
        "<td>" . $row["a_pagare"]. "</td>" .
        "<td>" . $row["id_cliente"]. "</td>" .
        "</tr>";
        //echo "id: " . $row["numero"]. " - Importo: " . $row["importo"]. " - Totale da pagare: " . $row["a_pagare"]. "<br>";
    }
} else {
    echo "0 results";
}

echo "</table>";

$conn->close();

?>
<input type="submit" onclick="javascript:location.href='fatture.html'" value="Esci"/>
</body>
</html>