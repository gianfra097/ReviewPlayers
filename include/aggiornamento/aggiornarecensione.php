<!DOCTYPE html>
<html lang="it">
 <head>
    
    <title> ReviewPlayers - Modifica Articolo </title>

    <!-- Metadata e descrizione pagina -->
    <meta name="author" content="Gianfranco"/>
    <meta name="description" content="Questo e' un sito che tratta videogiochi di qualsiasi piattaforma, se vuoi rimanere aggiornato sulle ultime uscite o leggere delle recensioni, clicca in alto!"/>
    <meta name="keywords" content="giochi,videogiochi,videogames,console"/>

    <!--Collego css e html-->
    <link rel="stylesheet" type="text/css" href="../../css/styleaggiornamento.css?version=1.4"/>
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

            $id = $_GET['id']; //Assegno l'id corrispondente all'articolo che l'utente vuole modificare
            
            if(!isset($_GET["id"])){
                ?> <script> alert("Non hai l'autorizzazione per accedere a questa pagina! Prima devi effettuare il login!"); window.location = "../../pagine/accesso.php"; </script> <?php
            } //Se l'id non è stato inizializzato, significa che non è stato cliccato alcun articolo da modificare e quindi un utente non autorizzato vuole accedere alla pagina.
              //Appunto per questo, se non è stato inizializzato l'id, compare un alert in javascript che poi ci spedisce alla pagina di accesso

            $sqlmod = "SELECT * FROM recensioni WHERE rec_id='$id'"; //Seleziono l'articolo con id uguale a quello che l'utente ha cliccato
            $risultatiagg = mysqli_query($connection,$sqlmod) or die(mysqli_error($connection));  //Inserisco i dati all'interno della variabile risultati
            if (mysqli_num_rows($risultatiagg) > 0) {                  //Se c'è almeno una riga
            while($row = mysqli_fetch_assoc($risultatiagg)) {      //Fornisce i dati e li associa ai nomi delle colonne del database
                
                if(isset($_POST['aggiorna'])) {  //Se è stato premuto il bottone invia, aggiorna le variabili

                    //Inizializzo le variabili articolo e titolo
                    $newtitolo = addslashes($_POST['titolo']);
                    $newarticolo = addslashes($_POST['articolo']);
                    $parolerec = strlen($newarticolo); //Conto le parole dell'articolo 

                    //Se l'utente ha inserito più di 10 righe allora può modificare l'articolo
                    if (empty($newarticolo)) {
                        echo ("<script LANGUAGE='JavaScript'> window.alert('Non puoi lasciare campi vuoti!'); window.location.href='../../pagine/recensioni.php'; </script>");     
                    } else if($parolerec < 776){
                        echo ("<script LANGUAGE='JavaScript'> window.alert('Inserisci minimo 10 righe!'); window.location.href='../../pagine/recensioni.php'; </script>");
                    } else{
                        $sqlaggiornarec = "UPDATE `recensioni` SET `rec_titolo` = '$newtitolo', `rec_articolo` = '$newarticolo' WHERE `rec_id`='$id'";  //Query per aggiornare la recensione*/
                        $risultatiagg = mysqli_query($connection,$sqlaggiornarec) or die(mysqli_error($connection));  //Inserisco i dati all'interno della variabile risultati
                        if($risultatiagg) {
                            header("Location: ../../pagine/recensioni.php");
                        }                       
                    }                    

                } else{
                    ?>
                    <form action="" method="post">
                    <b>Autore:</b><br>
                    <input name="autore" type="text" size="20" value="<?php echo $row["rec_autore"];?>" disabled="disabled"> <br><br> <!-- Scrivo il nome dell'autore loggato-->
                    <b>Titolo:</b><br>
                    <input name="titolo" value="<?php echo $row["rec_titolo"];?>" type="text" size="30"> <br><br>
                    <b>Articolo:</b> <font color="red"> Inserisci minimo 10 righe e massimo 15! </font> <br>
                    <textarea name="articolo" cols="100" rows="15" maxlength="1091"><?php echo $row["rec_articolo"];?></textarea> <br><br>
                    <input class="agg" onclick="return(confirm('Sei sicuro di voler applicare le modifiche?'))" type="submit" name="aggiorna" value="Aggiorna"> <br><br>
                    </form>                         
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

            
