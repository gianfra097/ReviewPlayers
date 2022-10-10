<?php
	//Stabilisco la connessione con il server specificando i parametri
	$dbhost = "localhost";          //Nome server
	$dbname = "reviewplayers";      //Nome db
	$dbuser ="gianfranco";			//Nome utente db 
	$dbpassword = "root";	//Password utente db 
	$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
	//Controllo esito connessione
	mysqli_select_db($connection, "reviewplayers");
	if (!$connection) {
		die("Connessione fallita: " . mysqli_connect_error());
		//Se la connessione non va = connessione fallita 
	}
?>  
