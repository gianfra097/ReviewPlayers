<?php
	session_start();
    if(!isset($_SESSION['username']) || !isset($_SESSION['grant']) ) { //Se l'utente non ha effettuato l'accesso o non ha i permessi, visualizza un errore con script in JavaScript
        ?> <script> alert("Non hai l'autorizzazione per accedere a questa pagina!"); window.location = "../../index.php"; </script> <?php
    }else {  //Se l'utente ha effettuato l'accesso, visualizza la pagina di uscita.
    	?>
		<!DOCTYPE html>
		<html lang="it">
 		<head>
    
    		<title> ReviewPlayers - Modifica Utenti </title>

	    	<!-- Metadata e descrizione pagina -->
	    	<meta name="author" content="Gianfranco"/>
	    	<meta name="description" content="Questo e' un sito che tratta videogiochi di qualsiasi piattaforma, se vuoi rimanere aggiornato sulle ultime uscite o leggere delle recensioni, clicca in alto!"/>
	    	<meta name="keywords" content="giochi,videogiochi,videogames,console"/>

	    	<!--Collego css e html-->
	    	<link rel="stylesheet" type="text/css" href="../../css/stylemodificautenti.css?version=2.0"/>
	    	<!-- Aggiorno il css con ?version= -->

	    	<!-- Collego il css per il mobile -->
	    	<link rel="stylesheet" media="screen and (max-width:655px)" href="../../css/mobile.css?version=1.0">

	    	<!--Collego il font che voglio usare-->
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
		                <li><a href="../../pagine/recensioni.php">RECENSIONI</a></li>
		                <li><a href="../../pagine/news.php">NEWS</a></li>
		                <li><a href="#chisiamo">ABOUT</a></li>
		            </ul>
		        </nav>

		        <!-- Immagine per login che cambia colore al movimento del cursore -->
		        <div class="admin">  <!-- Essendo l'utente già loggato, mostro l'immagine di logout -->
		            <a href="../../pagine/accesso.php"><img src="../../images/admin1.png" onmouseover="src='../../images/out.png'" onmouseout="src='../../images/admin1.png'"></a>
		        </div>  

		    </header> 

		    <div class="content">
		        <?php

		            include('../dbconfig.php'); //Collego il database

		            $id = $_GET['id'];

		            $sql = "SELECT * FROM utenti WHERE id ='$id'"; //Seleziono l'intera tabella utenti
		            $risultati = mysqli_query($connection,$sql) or die(mysqli_error($connection));  //Inserisco i dati all'interno della variabile risultati
		            if (mysqli_num_rows($risultati) > 0) {                  //Se c'è almeno una riga
		            while($row = mysqli_fetch_assoc($risultati)) {      //Fornisce i dati e li associa ai nomi delle colonne del database
		                
		                if(isset($_POST['aggiorna'])) {  //Se è stato premuto il bottone aggiorna, aggiorna le variabili 

		                   //Inizializzo le variabili id, user e password
		                	$updateid = $_POST['id'];
		                    $updateuser = $_POST['user'];
		                    $updatepass = $_POST['password'];
		                    $updatepermesso = $_POST['permesso'];

		                    //Protezione per SQL injection
		                    $updateuser = stripslashes($updateuser);
		                    $updatepass = stripslashes($updatepass);

							//Nome utente che PUO' contenere lettere maiuscole,minuscole e/o numeri. Minimo 6 caratteri, massimo 15
							$pattern = '/^[A-Za-z0-9]{6,15}$/';

							//Password che DEVE contenere lettere maiuscole,minuscole,numeri ed un carattere speciale. Minimo 6 caratteri, massimo 15
							$pattern2 = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[_.\-()?#;:!@])[0-9A-Za-z_.\-()?#;:!@]{6,15}$/'; //Tra l'inizio e la fine della stringa deve avere		

							if (empty($updateuser) || empty($updatepass)) {
								?> <script> window.alert('Non puoi lasciare campi vuoti!'); window.location.href='../../pagine/utente/utenti.php'; </script> <?php
						    } else if (strlen($updateuser) < 6) {
								?> <script> window.alert('Username non valido. Deve contenere almeno 6 caratteri'); window.location.href='../../pagine/utente/utenti.php'; </script> <?php ;
							} else if (strlen($updatepass) < 6) {
							    ?> <script> window.alert('Password non valida. Deve contenere almeno 6 caratteri'); window.location.href='../../pagine/utente/utenti.php'; </script> <?php ;
							} else if (!preg_match($pattern, $updateuser)) {
							    ?> <script> window.alert('Username non valido. Hai inserito caratteri speciali o hai superato il massimo di 15 caratteri!'); window.location.href='../../pagine/utente/utenti.php'; </script> <?php ;
							} else if (!preg_match($pattern2, $updatepass)) {
							    ?> <script> window.alert('Password non valida. Inserisci numeri, lettere ed un carattere speciale, e non superare i 15 caratteri!'); window.location.href='../../pagine/utente/utenti.php'; </script> <?php ;							                    
							} else {
    							//Cripto la password inserita
    							$passwordcriptata = md5($updatepass);
		                    	$sqlaggiornauser = "UPDATE `utenti` SET `id` = '$updateid', `username` = '$updateuser', `password` = '$passwordcriptata', `permesso` = '$updatepermesso' WHERE `id`='$id'";  //Query per aggiornare l'user*/
		                    	$risultatiagg = mysqli_query($connection,$sqlaggiornauser) or die(mysqli_error($connection));  //Inserisco i dati all'interno della variabile risultati
		                    	if($risultatiagg) {
		                        	echo ("<script LANGUAGE='JavaScript'> window.alert('Utente inserito con successo!'); window.location.href='../../pagine/utente/utenti.php'; </script>");
		                    	}
		                    }

		                } else{
		                    ?>
		                    <center>
		                    <form action="" method="post">   
		                    <b>Id:</b><br>
		                    <input name="id" type="number" id="id" value="<?php echo $row["id"];?>"> <br><br>
		                    <b>Username:</b><br>
		                    <input name="user" type="text" id="user" class="userinput" value="<?php echo $row["username"];?>"> <br><br> <!-- Username o Nuovo username modificato -->
		                    <b>Permesso:</b><br>
		                    <input name="permesso" type="number" id="permesso" class="newutentepermesso" placeholder="0 = No, 1 = Si" min="0" max="1" value="<?php echo $row["permesso"];?>"> <br><br>
		                    <b>Password:</b><br>
		                    <input name="password" type="password" id="password" class="passinput"> <br><br>
		                    <input class="aggiorna" onclick="return(confirm('Sei sicuro di voler applicare le modifiche?'))" type="submit" name="aggiorna" value="Aggiorna"> <br><br>
		                    </form>         
		                    </center>    

		                    <p class="userlists" align="center"><a href='../../pagine/utente/utenti.php' class='add' align='center'>LISTA UTENTI</a></p> <!-- Faccio tornare l'utente alla lista -->       
		                    <?php
		                }
		            }
		        } 
		        mysqli_close($connection); //Chiudo la connessione
		        ?>
		    </div>

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
		<?php
	}
?>
		            
