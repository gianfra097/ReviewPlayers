<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header("Location: ../accesso.php");
	}
?>

<!DOCTYPE html>
<html lang="it">
 <head>

    <meta charset="UTF-8">
 	
 	<title> ReviewPlayers - Benvenuto! </title>

 	<script type="text/javascript" src="loginanimate.js"></script>

 	<!-- Metadata e descrizione pagina -->
 	<meta name="author" content="Gianfranco"/>
 	<meta name="description" content="Questo e' un sito che tratta videogiochi di qualsiasi piattaforma, se vuoi rimanere aggiornato sulle ultime uscite o leggere delle recensioni, clicca in alto!"/>
 	<meta name="keywords" content="giochi,videogiochi,videogames,console"/>

 	<!-- Collego il css -->
 	<link rel="stylesheet" type="text/css" href="../../css/stylelogin.css?version=2.6>">
 	<!-- Aggiorno il css con ?version= -->
 	
 	<!-- Collego il font che voglio usare -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Press+Start+2P&display=swap" rel="stylesheet">

 </head>
 
 <!-- Corpo -->
 <body>

 	<header>

 		<!-- Logo del sito, che se cliccato porta alla home -->
 		<div class="logo">
 			<a href="../../index.php"><img src="../../images/logo.png" alt="logo"/></a>
 		</div>

 		<!--Creo il menù con i collegamenti alle varie pagine(dentro l'header)--> 
 		<nav>
 			<ul>
 				<li><a href="../../index.php">HOME</a></li>
 				<li><a href="../recensioni.php">RECENSIONI</a></li>
 				<li><a href="../news.php">NEWS</a></li>
 				<li><a href="#chisiamo">ABOUT</a></li>
 			</ul>
    	</nav>

    	<!-- Immagine per login che cambia colore al movimento del cursore -->
 		<div class="admin">
 			<a href="../accesso.php"><img src="../../images/admin1.png" onmouseover="src='../../images/out.png'" onmouseout="src='../../images/admin1.png'"></a>	
 		</div>	

 	</header> 

 	<!-- Creo un div per inserire l'immagine dell'arcadebox -->
 	<div id="arcadein">

 		<!-- Creo un div per l'innerHTML -->
 		<div id="text"></div>

 		<!-- Creo uno script in javascript dove inserisco una funzione che scrive del testo -->
 		<script type="text/javascript">
			var i = 0, text;
			text = "IDENTIFICAZIONE UTENTE RIUSCITA! BENVENUTO NELL'AREA RISERVATA. VERRAI REINDIRIZZATO AUTOMATICAMENTE ALLA HOME TRA QUALCHE SECONDO. SE INVECE VUOI EFFETTUARE IL LOGOUT, CLICCA L'ICONA CON L'ARCADE BOX IN ALTO A DESTRA PER DISCONNETTERTI"

			function typing(){
				if(i<text.length){
					document.getElementById("text").innerHTML += text.charAt(i);
					i++;
					setTimeout(typing,30);
				}
			}
			typing();
		</script>

	</div>

		<?php
	  	header("Refresh: 10; Url=../../index.php"); //Faccio refreshare la pagina automaticamente dopo 15 secondi (tempo lettura del testo)
		?>

    <!-- Creo i due footer -->

    <!-- Primo footer grigio -->
    <footer id="footer1">
        <div id="chisiamo"> <!-- Creo un id per farmi reindirizzare qui dalla nav -->
            <h1 id="titolo1">Chi Siamo:</h1>
            <p class="info1">Review Players è un blog dedicato agli amanti dei videogiochi, il suo scopo è quello di recensire più titoli possibili per le varie console, ed aggiornare i videogiocatori sulle nuove uscite o sulle notizie più importanti del mondo dei videogiochi.</p>
        </div>
    </footer>

    <!-- Secondo footer nero -->
    <footer id="footer2">
        <h1 id="titolo2">Copyright &copy - 2021 Gianfranco Iaria</h1>
        <p class="info2">Sito creato da Gianfranco Iaria, come progetto per l'esame di programmazione 3. Docente: Nucita Andrea.</p>
    </footer>		

 </body>

</html>