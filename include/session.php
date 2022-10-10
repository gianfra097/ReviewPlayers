<?php
session_start();//Inizio sessione
if(isset($_SESSION['username'])){ //Se l'utente ha già effettuato l'accesso
	header('Location: ../include/uscita.php'); //Reindirizzamento al tasto logout!
	exit;
}
?>