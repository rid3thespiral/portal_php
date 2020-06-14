<?php
//da implementare il meccanismo delle sessioni

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

//definizioni
$num_righe = 4;
$numInseriti = 0;
$numCambiati = 0;

// modulo: aggiungi ultimo file aggiunto. FILE UPLOADATI
$path = "reports/"; 

$latest_ctime = 0;
$latest_filename = '';    

$d = dir($path);
while (false !== ($entry = $d->read())) {
  $filepath = "{$path}/{$entry}";
  // could do also other checks than just checking whether the entry is a file
  if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
    $latest_ctime = filectime($filepath);
    $latest_filename = $entry;
  }
}

// NOTA BENE: $latest_filename = ultimo file inserito
// Inclusione Libreria
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// Questo è l'URL del file da caricare.
$indirizzo_base = "reports/";
$inputFileName = $indirizzo_base.$latest_filename; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

include('exceltoarray.php');

// ultimo indice utile
// move the internal pointer to the end of the array


	// INIZIO ALGORITMO
	$foglio = excelToArray($inputFileName, FALSE);
	end($foglio);
	$righeFoglio = key($foglio);
	
	/* echo 'Record presenti nel file: ';
	echo $righeFoglio;
	echo '<pre>';
	print_r($foglio); 
	echo '</pre>'; */

	//riporto il puntatore al primo elemento dell'array
	reset($foglio);
	
	//in questo momento tutto il file excel è in un'array associativo dalla forma [int][A-Z];
	
	//provo a stampare delle informazioni dall'array. Ad esempio: Nome Cognome e Order Number
	//li salvo prima
	//operazione di efficienza sul database perchè lavoro su un set di risultati più piccolo...
	/* for($i=$num_righe;$i<=$righeFoglio;$i++){
		$orderNumber[$i] = $foglio[$i]['F'];
		$orderStatus[$i]= $foglio[$i]['G'];
	} */
	
	//unifica tutto in un solo array associativo [Order Number, Order Status] di tutto il foglio.
	//coppie chiave, valore 
	/* $app = array_combine($orderNumber, $orderStatus);  */
	/* $ris = array_keys($app); */
	
	//in ris ci sono le coppie intero -> Order Number per iterare meglio.
	//$app diventa un array temporanea che contiene le coppie Order Number, Order Status dal file.
	
	//ora devo verificare se sono presenti nel database. se no, le inserisco.
	
	//INIZIO QUERY
	
	//limite dell'array di supporto dove ci sono tutte le coppie ON, OS presenti nel file da checkare.
	/* end($ris);
	$nlim = key($ris); */
		
	
	for($j=4; $j <= $righeFoglio; $j = $j + 1){
		$queryIfExist = "SELECT * FROM reports WHERE `Order Number` = '".$foglio[$j]['F']."' LIMIT 1;";
		$resultIfExist = $conn->query($queryIfExist);
		if($resultIfExist->num_rows > 0){
			/* echo '</br>';
			echo '</br>';
			echo '</br>';
			echo '</br>';
			echo '</br>';
			echo '</br>';
			echo '</br>';
			echo 'Order Number: ' .$foglio[$j]['F']. ' già presente nel sistema.  ';
			echo 'Order Status di inserimento: ' .$foglio[$j]['G'] ;
			echo '</br>';
			echo 'Verifico lo stato precedente del contratto...';
			echo '</br>'; */
			
			// Prelevo lo stato dal database.
			$querySelectOrderStatus = "SELECT `Order Status` FROM reports WHERE `Order Number` = '".$foglio[$j]['F']."' LIMIT 1;" ;
			$resultSelectOrderStatus = $conn->query($querySelectOrderStatus);
			
			if($resultSelectOrderStatus){
			$arrayresultSelectOrderStatus = $resultSelectOrderStatus->fetch_assoc();
			$statoPrecedente = $arrayresultSelectOrderStatus['Order Status'];
			/* echo '</br>'; */
			/* echo 'Lo stato precedente del contratto era:  '.$statoPrecedente;
			echo '</br>'; */
			}
			else{
				echo '</br>';
				echo 'Ho riscontrato errore in prelievo Stato.';
				echo '</br>';
			}
			
			$statoInserimento = $foglio[$j]['G'];
			
			//Verifico se e' cambiato lo stato
			if(strcasecmp($statoInserimento, $statoPrecedente) == 0){
				/* echo '</br>';
				echo 'Non ci sono cambiamenti nello stato del contratto.';
				echo '</br>'; */
			}
			else{
				echo '</br>';
				echo 'Stato cambiato da '.$statoPrecedente.' in '.$statoInserimento.'.';
				echo '</br>';
				$numCambiati++;
				//inserisco la data del cambiamento stato e aggiorno lo stato nel db
				switch ($statoInserimento) {
					case "Pre-Order":
						$queryInsertPreOrderDate = "UPDATE `reports` SET `Data PreOrder` = '".date('Y-m-d')."', `Order Status`= '".$statoInserimento."' WHERE `Order Number` = '".$foglio[$j]['F']. "' ;";
						$resultInsertPreOrderDate = $conn->query($queryInsertPreOrderDate);
						if($resultInsertPreOrderDate){
							$preOrderDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento PreOrderDate query.';
						}
						break;
					case "In-transit":
						$queryInsertInTransitDate = "UPDATE `reports` SET `Data InTransit` = '".date('Y-m-d')."', `Order Status`= '".$statoInserimento."' WHERE `Order Number` = '".$foglio[$j]['F']. "' ;";
						$resultInsertInTransitDate = $conn->query($queryInsertInTransitDate);
						if($resultInsertInTransitDate){
							$inTransitDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento InTransitDate query.';
						}
						break;
					case "In-Transit":
						$queryInsertInTransitDate = "UPDATE `reports` SET `Data InTransit` = '".date('Y-m-d')."', `Order Status`= '".$statoInserimento."' WHERE `Order Number` = '".$foglio[$j]['F']. "' ;";
						$resultInsertInTransitDate = $conn->query($queryInsertInTransitDate);
						if($resultInsertInTransitDate){
							$inTransitDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento InTransitDate query.';
						}
						break;
					case "Cancelled":
						$queryInsertCancelledDate = "UPDATE `reports` SET `Data Cancelled` = '".date('Y-m-d')."', `Order Status`= '".$statoInserimento."' WHERE `Order Number` = '".$foglio[$j]['F']. "' ;";
						$resultInsertCancelledDate = $conn->query($queryInsertCancelledDate);
						if($resultInsertCancelledDate){
							$cancelledDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento CancelledDate query.';
						}
						break;
					case "Complete":
						$queryInsertCompleteDate = "UPDATE `reports` SET `Data Complete` = '".date('Y-m-d')."', `Order Status`= '".$statoInserimento."'  WHERE `Order Number` = '".$foglio[$j]['F']. "' ;";
						$resultInsertCompleteDate = $conn->query($queryInsertCompleteDate);
						if($resultInsertCompleteDate){
							$completeDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento Complete query.';
						}
						break;
				}
			}
			
		}
		else{
			$queryNotExist = "INSERT INTO `reports`(`Retailer Code`, `Ragione Sociale`, `Nome Retailer`, `Cognome Retailer`, `Telefono`, `Order Number`, `Order Status`, `Preorder Reason`, `Order_Date_Day`, `Order_Date_yyyymm`, `Product_Activation_Date`, `Prodotto`, `Division`, `Cognome`, `Nome`, `Main Phone Number`, `Codice Fiscale`, `Numero Cliente`, `Risposta su ordine`, `Data inserimento report`) VALUES ('".$foglio[$j]["A"]."','".$foglio[$j]["B"]."','".$foglio[$j]["C"]."','".$foglio[$j]["D"]."','".$foglio[$j]["E"]."','".$foglio[$j]["F"]."','".$foglio[$j]["G"]."','".$foglio[$j]["H"]."','".$foglio[$j]["I"]."','".$foglio[$j]["J"]."','".$foglio[$j]["K"]."','".$foglio[$j]["L"]."','".$foglio[$j]["M"]."','".addslashes($foglio[$j]["N"])."','".addslashes($foglio[$j]["O"])."','".$foglio[$j]["P"]."','".$foglio[$j]["Q"]."','".$foglio[$j]["R"]."','".$foglio[$j]["S"]."','".date('Y-m-d')."');";
			$resultqueryNotExist = $conn->query($queryNotExist);
			
			if($resultqueryNotExist){
			/* 				echo '</br>';
						echo '</br>';
			echo '</br>';
			echo '</br>';
			echo '</br>';
			echo '</br>';
			echo '</br>'; */
				/* echo 'Il record non esisteva...'; */
				/* echo 'Il record viene correttamente inserito nel sistema.'; */
				$numInseriti++;
				$retailerCodeIns = $foglio[$j]["A"];
				$cognomeIns = $foglio[$j]["N"];
				$nomeIns = $foglio[$j]["O"];
				$orderNumberIns = $foglio[$j]["F"];
				$statoIns = $foglio[$j]["G"];
				
				echo '</br>';
				echo 'Informazioni sul contratto inserito. ';
				echo $retailerCodeIns.' '.$cognomeIns.' '.$nomeIns.' '.$orderNumberIns.' '.$statoIns;
				echo '</br>';
				
				//inserimento della data rispetto ad uno specifico stato
				switch ($statoIns) {
					case "Pre-Order":
						$queryInsertPreOrderDate = "UPDATE `reports` SET `Data PreOrder` = '".date('Y-m-d')."' WHERE `Order Number` = '".$orderNumberIns. "' ;";
						$resultInsertPreOrderDate = $conn->query($queryInsertPreOrderDate);
						if($resultInsertPreOrderDate){
							$preOrderDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento PreOrderDate query.';
						}
						break;
					case "In-Transit":
						$queryInsertInTransitDate = "UPDATE `reports` SET `Data InTransit` = '".date('Y-m-d')."' WHERE `Order Number` = '".$orderNumberIns. "' ;";
						$resultInsertInTransitDate = $conn->query($queryInsertInTransitDate);
						if($resultInsertInTransitDate){
							$inTransitDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento InTransitDate query.';
						}
						break;
					case "In-transit":
						$queryInsertInTransitDate = "UPDATE `reports` SET `Data InTransit` = '".date('Y-m-d')."' WHERE `Order Number` = '".$orderNumberIns. "' ;";
						$resultInsertInTransitDate = $conn->query($queryInsertInTransitDate);
						if($resultInsertInTransitDate){
							$inTransitDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento InTransitDate query.';
						}
						break;
					case "Cancelled":
						$queryInsertCancelledDate = "UPDATE `reports` SET `Data Cancelled` = '".date('Y-m-d')."' WHERE `Order Number` = '".$orderNumberIns. "' ;";
						$resultInsertCancelledDate = $conn->query($queryInsertCancelledDate);
						if($resultInsertCancelledDate){
							$cancelledDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento CancelledDate query.';
						}
						break;
					case "Complete":
						$queryInsertCompleteDate = "UPDATE `reports` SET `Data Complete` = '".date('Y-m-d')."' WHERE `Order Number` = '".$orderNumberIns. "' ;";
						$resultInsertCompleteDate = $conn->query($queryInsertCompleteDate);
						if($resultInsertCompleteDate){
							$completeDate = date('Y-m-d');
						}
						else{
							echo 'Errore inserimento Complete query.';
						}
						break;
				}
			}
			else{
				echo "Ho riscontrato errore in inserimento della query";
			}
		}
	}

$changeMsg = '<div style="Padding:20px 0 0 0;">Sono cambiati '.$numCambiati.' contratti.</div>';
$insertedMsg = '<div style="Padding:20px 0 0 0;">Sono stati inseriti '.$numInseriti.' nuovi contratti.</div>';
$msg = 'Operazioni completate. <div style="Padding:20px 0 0 0;"><a href="upload.html">Torna indietro</a></div>';
$msg2 = 'Passa alla ricerca. <div style="Padding:20px 0 0 0;"><a href="/portal_php/search_file/search.php">Cerca</a></div>';
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$msg."</div>";
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$changeMsg."</div>"; 
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$insertedMsg."</div>"; 
echo '</br>';
echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$msg2."</div>"; 

?>