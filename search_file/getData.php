<?php
//mi connetto al db
//parametri db
define ("DB_HOST", "localhost"); // imposto il nome dell'host del db
define ("DB_USER", "root"); // imposto il nome dello user
define ("DB_PASS",""); // imposto password
define ("DB_NAME","test"); // imposto nome db

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
} 

//query di selezione

$query = "SELECT `Retailer Code`, `Ragione Sociale`, `Order Number`, `Order Status`, `Nome`, `Cognome`, `Telefono`, `Numero Cliente`, `Data PreOrder`, `Data InTransit`, `Data Cancelled`, `Data Complete` FROM `reports` ";
$result = $conn->query($query);

//algoritmo di riempimento array
$i = 0;
$tabella = "";

while($row = mysqli_fetch_array($result)){
	$tabella.='{"Retailer Code":"'.$row['Retailer Code'].'","Ragione Sociale":"'.$row['Ragione Sociale'].'","Order Number":"'.$row['Order Number'].'","Order Status":"'.$row['Order Status'].'","Nome":"'.$row['Nome'].'","Cognome":"'.$row['Cognome'].'","Telefono":"'.$row['Telefono'].'","Numero Cliente":"'.$row['Numero Cliente'].'","Data PreOrder":"'.$row['Data PreOrder'].'","Data InTransit":"'.$row['Data InTransit'].'","Data Cancelled":"'.$row['Data Cancelled'].'","Data Complete":"'.$row['Data Complete'].'"},';
	$i++;
}

$tabella = substr($tabella,0, strlen($tabella) - 1);

echo '{"data":['.$tabella.']}';


?>