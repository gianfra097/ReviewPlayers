<?php
	session_start();
    if(!isset($_SESSION['username'])) { //Se l'utente non ha effettuato l'accesso visualizza un errore con script in JavaScript
        ?> <script> alert("Non hai l'autorizzazione per accedere a questa pagina!"); window.location = "../../index.php"; </script> <?php
    } else {  //Se l'utente ha effettuato l'accesso, visualizza la pagina di uscita.
    	?>
    	<!DOCTYPE html>
        <html lang="it">
         <head>
         	
         	<title> ReviewPlayers - Utenti </title>

         	<!-- Metadata e descrizione pagina -->
         	<meta name="author" content="Gianfranco"/>
         	<meta name="description" content="Questo e' un sito che tratta videogiochi di qualsiasi piattaforma, se vuoi rimanere aggiornato sulle ultime uscite o leggere delle recensioni, clicca in alto!"/>
         	<meta name="keywords" content="giochi,videogiochi,videogames,console"/>

         	<!--Collego css e html-->
         	<link rel="stylesheet" type="text/css" href="../../css/styleutenti.css?version=3.9"/>
            <!-- Aggiorno il css con ?version= -->

         	<!-- Collego il css per il mobile -->
         	<link rel="stylesheet" media="screen and (max-width:800px)" href="../../css/mobileuscita.css?version=5.0">

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
                        <li><a href="../recensioni.php">RECENSIONI</a></li>
                        <li><a href="../news.php">NEWS</a></li>
                        <li><a href="#chisiamo">ABOUT</a></li>
                    </ul>
                </nav>

                <!-- Immagine per login che cambia colore al movimento del cursore -->
                <div class="admin">  <!-- Essendo l'utente già loggato, mostro l'immagine di logout -->
                    <a href="../accesso.php"><img src="../../images/admin1.png" onmouseover="src='../../images/out.png'" onmouseout="src='../../images/admin1.png'"></a>
                </div>  

            </header> 

            <div class="content">
                <?php
                    include('../../include/dbconfig.php'); //Collego il database

                    ?>
                    <table border="1" cellspacing="3" align="center" background="white">   <!-- Inizio a creare una tabella con username e password per capire cosa si vuole modificare -->
                        <tr>
                            <td align="center"> ID: </td>
                            <td align="center"> USERS: </td>
                            <td align="center"> PERMESSO: </td>
                            <td colspan="5" align="center"> OPERAZIONI: </td>
                        </tr>
                    <?php

                    $sql = "SELECT * FROM utenti"; //Seleziono l'intera tabella utenti
                    $risultati = mysqli_query($connection,$sql) or die(mysqli_error($connection));  //Inserisco i dati all'interno della variabile risultati
                    if (mysqli_num_rows($risultati) > 0) {                  //Se c'è almeno una riga
                        while($row = mysqli_fetch_assoc($risultati)) {      //Fornisce i dati e li associa ai nomi delle colonne del database

                            $id = $row['id'];
                            $user = $row['username'];
                            $permesso = $row['permesso'];

                            //Creo un ciclo in modo che se il permesso è uno, la variabile grant conterrà "Si"
                            //e verrà visualizzato nella tabella utenti
                            if($permesso == 1){
                            	$grant = "Si";
                            } else {
                            	$grant = "No";
                            }
                            
                            //Stampo all'interno della tabella tutti gli username e le password
                            echo "                        
                            <tr> 
                            <td> ".$id."  </td>
                            <td> ".$user."  </td>
                            <td align='center'> ".$grant."  </td>
                            <td class='mod' align='center'> <a href='../../include/aggiornamento/modificautenti.php?id=$id'> MODIFICA </a> </td>
                            <td class='del' align='center'> <a href='../../include/aggiornamento/deleteutenti.php?id=$id' onClick='return del();'> ELIMINA </a> </td>
                            </tr>";    
                        }
                    }

                    ?> 

                    <!-- Creo un alert di conferma in javascript prima di eliminare l'utente -->
                    <script type="text/javascript">
                        function del(event){
                            return(confirm('Sei sicuro di voler eliminare questo utente?'));
                        }               
                    </script>

                    <!-- Chiudo la tabella -->
                    </table> <br><br>

                    <!-- Testo per far capire che è anche possibile aggiungere un utente -->
                    <p class="clicktoadd" align="center">OPPURE AGGIUNGI UN UTENTE:</p> <br>

                    <?php

                    if(isset($_POST['aggiungi'])) {  //Se è stato premuto il bottone aggiungi, aggiungi l'utente

                        //Inizializzo le variabili user, password e permesso
                        $newuser = $_POST['user'];
                        $newpass = $_POST['password'];
                        $newpermesso = $_POST['permesso'];

                        //Protezione per SQL injection
                        $newuser = stripslashes($newuser);
                        $newpass = stripslashes($newpass);

						//Nome utente che PUO' contenere lettere maiuscole,minuscole e/o numeri. Minimo 6 caratteri, massimo 15
						$pattern = '/^[A-Za-z0-9]{6,15}$/';

						//Password che DEVE contenere lettere maiuscole,minuscole,numeri ed un carattere speciale. Minimo 6 caratteri, massimo 15
						$pattern2 = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[_.\-()?#;:!@])[0-9A-Za-z_.\-()?#;:!@]{6,15}$/'; //Tra l'inizio e la fine della stringa deve avere

                        if (empty($newuser) || empty($newpass)) {
        					?> <script> window.alert('Non puoi lasciare campi vuoti!'); window.location.href='utenti.php'; </script> <?php
    					} else if (strlen($newuser) < 6) {
    						?> <script> window.alert('Username non valido. Deve contenere almeno 6 caratteri'); window.location.href='utenti.php'; </script> <?php ;
    					} else if (strlen($newpass) < 6) {
    						?> <script> window.alert('Password non valida. Deve contenere almeno 6 caratteri'); window.location.href='utenti.php'; </script> <?php ;
    					} else if (!preg_match($pattern, $newuser)) {
    						?> <script> window.alert('Username non valido. Hai inserito caratteri speciali o hai superato i 15 caratteri!'); window.location.href='utenti.php'; </script> <?php ;
    					} else if (!preg_match($pattern2, $newpass)) {
    						?> <script> window.alert('Password non valida. Inserisci numeri, lettere, carattere speciale e non superare 15 caratteri!'); window.location.href='utenti.php'; </script> <?php ;
    					} else {
    						//Cripto la password inserita
                        	$newpasscriptata = md5($newpass);   
                        	$sqladduser = "INSERT INTO utenti (username, password, permesso) VALUES ('$newuser','$newpasscriptata', '$newpermesso')";  //Query per aggiungere l'user*/
                        	$risultatiagg = mysqli_query($connection,$sqladduser) or die(mysqli_error($connection));  //Inserisco i dati all'interno della variabile risultati
                        	if($risultatiagg) {
                            	echo ("<script LANGUAGE='JavaScript'> window.alert('Utente inserito con successo!'); window.location.href='utenti.php'; </script>"); 
                        	}						
    					}

                    } else{
                        ?>
                        <center>
                        <form action="" method="post">   
                        <b>Username:</b> <br>
                        <input name="user" type="text" id="user" class="newutentename"> <br><br> <!-- Username o Nuovo username modificato -->
                        <b>Password:</b> <br>
                        <input name="password" type="password" id="password" class="newutentepass"> <br><br>
                        <b>Permesso:</b> <br>
                        <input name="permesso" type="number" id="permesso" class="newutentepermesso" placeholder="0 = No, 1 = Si" min="0" max="1"> <br><br>
                        <input class="aggiungi" onclick="return(confirm('Sei sicuro di voler aggiungere questo utente?'))" type="submit" name="aggiungi" value="Aggiungi"> <br><br>
                        </form>         
                        </center>    
                        <?php
                    }
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