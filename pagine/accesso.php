<?php
	include("../include/session.php"); //Tramite questo include, controllo se l'utente ha già effettuato l'acesso, per reindirizzarlo alle pagine corrette.

	//CONTROLLA LOGIN
    
    include('../include/dbconfig.php');

    if(isset($_POST['username']) && isset($_POST['password'])) {

	    //Acquisisco i dati dal form HTML e li inserisco nelle variabili $
	    $username = $_POST["username"];
	    $password = $_POST["password"];

	    //Protezione per SQL injection
	    $username = stripslashes($username);
	    $password = stripslashes($password);

	    //Nel caso in cui ci siano apici
	    $username = mysqli_real_escape_string($connection, $username);
	    $password = mysqli_real_escape_string($connection, $password);

	    //Cripto la password inserita per poi vedere se corrisponde a quella del database
	    $passwordcriptata = md5($password);

	    //Lettura della tabella utenti
	    $sql = "SELECT * FROM utenti WHERE username ='" . $username . "' AND password = '" . $passwordcriptata . "'"; 
	    $result = mysqli_query($connection, $sql);    
	    $conta = mysqli_num_rows($result);   //Inserisco i dati all'interno della variabile
        $row = mysqli_fetch_assoc($result);   //Associa i dati ai nomi delle colonne del database
	    if($conta == 1) {         //Se è stato trovato un risultato, è quello corrispondente ai dati inseriti
	        session_start();      //Quindi apre la sessione e inizializza le variabili username e password
	        $_SESSION['username'] = $username;   
	        $_SESSION['password'] = $passwordcriptata;
            if($row['permesso'] == 1){       //In più, se "permesso" è uguale a 1, inizializza la variabile di sessione $_SESSION['grant']
               $_SESSION['grant'] = "ok";
            }
	       header("Location: utente/login.php");  //Se ci sono corrispondenze, reindirizza l'utente alla pagina di login
	    } else if(empty($username) || empty($password)) {   
	    	$login_error = "Non puoi lasciare campi vuoti!"; //Se ci sono campi vuoti, stampa l'errore
	    } else if($conta!=1) {
	    	$login_error = "Username e/o Password errati!";	//Se non ci sono corrispondenze, stampa l'errore
	    }
	}
?>

<!DOCTYPE html>
<html lang="it">
 <head>
 	
 	<title> ReviewPlayers - Log-in </title>

 	<!-- Metadata e descrizione pagina -->
 	<meta name="author" content="Gianfranco"/>
 	<meta name="description" content="Questo e' un sito che tratta videogiochi di qualsiasi piattaforma, se vuoi rimanere aggiornato sulle ultime uscite o leggere delle recensioni, clicca in alto!"/>
 	<meta name="keywords" content="giochi,videogiochi,videogames,console"/>

 	<!--Collego css e html-->
 	<link rel="stylesheet" type="text/css" href="../css/styleaccesso.css?version=2.6"/>
    <!-- Aggiorno il css con ?version= -->

 	<!-- Collego il css per il mobile -->
 	<link rel="stylesheet" media="screen and (max-width:655px)" href="../css/mobile.css?version=1.0">

 	<!--Collego il font che voglio usare-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Press+Start+2P&display=swap" rel="stylesheet">

 </head>
 
 <!-- Corpo -->
 <body>

    <header>

        <!-- Logo del sito, che se cliccato porta alla home -->
        <div class="logo">
            <a href="../index.php"><img src="../images/logo.png" alt="logo"/></a>
        </div>

        <!--Creo il menù con i collegamenti alle varie pagine(dentro l'header)--> 
        <nav>
            <ul>
                <li><a href="../index.php">HOME</a></li>
                <li><a href="recensioni.php">RECENSIONI</a></li>
                <li><a href="news.php">NEWS</a></li>
                <li><a href="#chisiamo">ABOUT</a></li>
            </ul>
        </nav>

        <!-- Immagine per login che cambia colore al movimento del cursore -->
        <div class="admin">
            <a href="accesso.php"><img src="../images/admin1.png" onmouseover="src='../images/admin2.png'" onmouseout="src='../images/admin1.png'"></a>
        </div>  

    </header> 
    
    <!-- Carico l'immagine per il login e la centro senza l'uso del css -->
    <div id="arcadebox">
        
        <!-- Creo la sezione di Login -->
        <div id="login">
            <form action="#" method="post"> 
                <div id="dati">  		
                	<?php if(isset($login_error)){ ?>
                		<p class="error"> <?php echo $login_error ?> </p>
                	<?php } ?>
                	<br>
                    <input type="text" id="username" placeholder="USERNAME" name="username">
                    <br>
                    <input type="password" id="password" placeholder="PASSWORD" name="password">
                    <br> 
                    <button type="submit" id="accedi" name="accedi">ACCEDI</button>
                </div>     
            </form>
        </div>

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