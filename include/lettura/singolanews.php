<!DOCTYPE html>
<html lang="it">
 <head>

    <meta charset="UTF-8">
    
    <title> ReviewPlayers - Articolo </title>

    <!-- Metadata e descrizione pagina -->
    <meta name="author" content="Gianfranco"/>
    <meta name="description" content="Questo e' un sito che tratta videogiochi di qualsiasi piattaforma, se vuoi rimanere aggiornato sulle ultime uscite o leggere delle recensioni, clicca in alto!"/>
    <meta name="keywords" content="giochi,videogiochi,videogames,console"/>

    <!-- Collego il css -->
    <link rel="stylesheet" type="text/css" href="../../css/styleleggitutto.css?version=1.2>">
    <!-- Aggiorno il css con ?version= -->

    <!-- Collego il css per il mobile -->
    <link rel="stylesheet" media="screen and (max-width:670px)" href="../../css/mobile.css?version=1.2">
    
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
                <li><a href="../../pagine/recensioni.php">RECENSIONI</a></li>
                <li><a href="../../pagine/news.php">NEWS</a></li>
                <li><a href="#chisiamo">ABOUT</a></li>
            </ul>
        </nav>

        <!-- Immagine per login che cambia colore al movimento del cursore -->
        <div class="admin">
            <?php
                session_start();//Inizio sessione
                if(isset($_SESSION['username'])) { //Se l'utente ha già effettuato l'accesso compare l'arcade box con scritto logout
                    ?>
                    <a href="../../pagine/accesso.php"><img src="../../images/admin1.png" onmouseover="src='../../images/out.png'" onmouseout="src='../../images/admin1.png'"></a>  
                    <?php           
                } else { //Altrimenti compare l'arcade box con scritto login
                    ?>
                    <a href="../../pagine/accesso.php"><img src="../../images/admin1.png" onmouseover="src='../../images/admin2.png'" onmouseout="src='../../images/admin1.png'"></a>
                <?php 
            }
            ?>
        </div>  

    </header> 

    <!-- Creo lo spazio per il contenuto del sito -->
    <div class="content">
        <?php
            include('../dbconfig.php');      
            $id = $_GET['id']; //Assegno l'id corrispondente all'articolo che l'utente vuole leggere
            $sqllettura = "SELECT * FROM news WHERE news_id='$id'"; //Seleziono l'articolo con id uguale a quello che l'utente ha cliccato
            $risultatiagg = mysqli_query($connection,$sqllettura) or die(mysqli_error($connection));  //Inserisco i dati all'interno della variabile risultati
            if (mysqli_num_rows($risultatiagg) > 0) {                  //Se c'è almeno una riga
                while($row = mysqli_fetch_assoc($risultatiagg)) {           //Fornisce i dati e li associa ai nomi delle colonne del database

                    //Titolo
                    $ontitlen = "<span style=\"color:red\">NEWS: </span>"; //Coloro di rosso la scritta news
                    //Immagine
                    $imgnews = $row["news_immagini"];
                    //Data
                    $data = $row['news_data'];
                    $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
                    $scrittoda = "<b> Scritto da: ".$row["news_autore"]."</b>"; //Inserisco all'interno della variabile l'autore in grassetto
                    $il = "<b>, il: " .$data . "</b>";
                    
                    ?> 
                    <!--STAMPA DATI-->
                    <b><p class="newstitolo" style="text-transform:uppercase;"> <!--Titolo recensione in grassetto-->
                    <?php echo $ontitlen . $row["news_titolo"]; ?>
                    </b></p>

                    <p class="newsarticolo" align='justify'> <!-- Immagine e articolo a fianco -->
                        <img class="image" src="../../images/imgpost/<?=$imgnews;?>" align="left" hspace="10"> 
                        <?php echo $row['news_articolo']; ?>
                    </p>

                    <p class="firma" align='right'><?php echo $scrittoda . $il ?></p>
                    <hr>
                    <?php
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

 <style>
    hr{
        background: linear-gradient(to bottom, #efefef 0%, #a2a2a2 100%);
        border: none;
        border-top: 1px solid hsla(200, 10%, 80%, 100);
        max-width: 96%;
        margin-right: 3%;
    }
    img.image{
        width: 350px;
        height: 200px;
    }
    a {
        text-decoration: none; /* Tolgo la sottolineatura da tutti i link*/
        color: black;
    }
    p.newstitolo{
        color: red;
        text-align: left;
        padding-left: 15px;
        font-size: 20px
    }
    p.newsarticolo{
        padding-right: 15px;
    }
    p.firma{
        padding-right: 20px;
        font-size: 15px;
    }
</style>

</html>
                