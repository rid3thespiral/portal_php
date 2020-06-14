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
          <a class="navbar-brand" href="#"><img style="width: 40%;" src="threeminds_logo.jpg"></a>
		  </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-2">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.html">Home</a></li>
            <li><a href="#">Contatti</a></li>
            <li><a href="registrati.html">Registrati</a></li>
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

<link href="css/login.css" rel="stylesheet" type="text/css">
<link href="css/bottone_bello.css" rel="stylesheet" type="text/css">

<section id="login">

    <div class="container">

    	<div class="row">

    	    <div class="col-xs-12">

        	    <div class="form-wrap">

				<h1 id="intro">Benvenuto! <?php echo '<p name="message">'.$_SESSION['username'].'</p>'; ?></h1>

                <h1>Accedi ai tuoi servizi: </h1>
				<div class="centerer">
				<div class="wrap">
				<a class="btn-6" href="upload_file/upload.html">Match<span></span></a>
				<a class="btn-6" href="search_file/search.php">Cerca<span></span></a>
				<a class="btn-6" href="#">Statistiche<span></span></a>
				<a class="btn-6" href="#">Canvas<span></span></a>
				
				</div>
				</div>

                    </div>

    		</div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
</html>