<!DOCTYPE html>
<html>
<body>

<h1>Elenco Clienti</h1>

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


$sql = "SELECT id, rag_sociale, indirizzo, cap, comune, provincia, stato, cod_fiscale FROM Clienti";
$result = $conn->query($sql);
echo "<table style='width:100%'>";
if ($result->num_rows > 0) {
    // output data of each row
    echo "<tr>" . 
    "<th>" . "id" . "</th>" . 
    "<th>" . "Ragione sociale" . "</th>" .
	"<th>" . "Indirizzo" . "</th>" .
	"<th>" . "Cap" . "</th>" .
	"<th>" . "Comune" . "</th>" . 
	"<th>" . "Provincia" . "</th>" .
	"<th>" . "Stato" . "</th>" .
	"<th>" . "Codice fiscale" . "</th>" .
	"</tr>";
    while($row = $result->fetch_assoc()) {
        echo 
        "<tr>" .
        "<td>" . $row["id"]. "</td>" .
        "<td>" . $row["rag_sociale"]. "</td>" .
        "<td>" . $row["indirizzo"]. "</td>" .
        "<td>" . $row["cap"]. "</td>" .
        "<td>" . $row["comune"]. "</td>" .
        "<td>" . $row["provincia"]. "</td>" .
        "<td>" . $row["stato"]. "</td>" .
        "<td>" . $row["cod_fiscale"]. "</td>" .
        "</tr>";
        //"id: " . $row["id"]. " - Ragione sociale: " . $row["rag_sociale"]. " - Indirizzo: " . $row["indirizzo"]. "<br>";
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