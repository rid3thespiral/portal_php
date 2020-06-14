<?php
session_start();
if(!isset($_SESSION['username'])){
header("Location:wrong.html");
exit();
}
?>

<html>
<!-- Second navbar for sign in -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link href="//netdna.bootstrapcdn.com/bootst..." rel="stylesheet" id="bootstrap-css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- Fogli di stile CSS -->
<link href="css/top_navbar.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
    <nav class="navbar navbar-default">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img style="width: 40%;" src="/portal_php/threeminds_logo.jpg"></a>
		  </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-2">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/portal_php/index.html">Home</a></li>
            <li><a href="#">Contatti</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li>
             </li>
          </ul>

        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
	  </nav><!-- /.navbar -->
	  </div><!-- /.container-fluid -->
</html>



<!DOCTYPE html>
<html lang="en">
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- CSS -->
<link href="css/search.css">

<script src="js/jquery-3.1.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

		<!-- Website CSS style -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/search.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=latin-ext" rel="stylesheet">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
	 
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/b-1.2.4/b-colvis-1.2.4/b-html5-1.2.4/b-print-1.2.4/cr-1.3.2/r-2.1.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/b-1.2.4/b-colvis-1.2.4/b-html5-1.2.4/b-print-1.2.4/cr-1.3.2/r-2.1.0/datatables.min.js"></script>

	  
	  
	  
	  <!-- Datatables: plug-in Jquery -->
		<script>
		$(document).ready(function() {
		$('#reports').dataTable( {
			dom: 'Bfrtip',
			buttons: [
            'excel'
        ],
			"ajax": "getData.php",
				"columns": [
				{ "data": "Retailer Code" },
				{ "data": "Ragione Sociale" },
				{ "data": "Order Number" },
				{ "data": "Order Status" },
				{ "data": "Nome" },
				{ "data": "Cognome" },
				{ "data": "Telefono" },
				{ "data": "Numero Cliente" },
				{ "data": "Data PreOrder" },
				{ "data": "Data InTransit" },
				{ "data": "Data Cancelled" },
				{ "data": "Data Complete" }
				]
		} );
} );
</script>


		
		<title>Cerca contratto</title>
	</head>
	<body>
		<div class="container" style="margin: 25px auto;">
	    <table id="reports" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Retailer Code</th>
                <th>Ragione Sociale</th>
                <th>Order Number</th>
				<th>Order Status</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Telefono</th>
                <th>Numero Cliente</th>
                <th>Data PreOrder</th>
				<th>Data InTransit</th>
				<th>Data Cancelled</th>
				<th>Data Complete</th>
            </tr>
        </thead>
        <tbody> 
        </tbody>
    </table>
		
        </div><!--container-->  
      	</body>
</html>