<?php
session_start();
session_unset();				// Cancella tutte le variabili di sessione
session_destroy(); 				// Termina la sessione
header("Location: ../../index.php"); 	// Reindirizza alla home page
?>