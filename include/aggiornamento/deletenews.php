<!DOCTYPE html>
<html lang="it">
 <head>
    
    <title> ReviewPlayers - Elimina News </title>

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

            $id = $_GET['id'];
            $sqldel = "DELETE FROM `news` WHERE `news_id` = '$id'";
            $risultatidel = mysqli_query($connection, $sqldel);
            if($risultatidel) {
                header("Location: ../../index.php");
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

            
