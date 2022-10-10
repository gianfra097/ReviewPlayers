<!DOCTYPE html>
<html lang="it">
 <head>
 	
    <meta charset="UTF-8">

 	<title> ReviewPlayers - News </title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> <!-- Importo la libreria JQuery -->

    <script>
    $(document).ready(function(){   //Parte di codice che deve comprendere il codice jQuery per farlo eseguire nel momento opportuno e non appena si apre la pagina
        $('.search-box-news input[type="text"]').on("keyup input", function(){ //Quando nella classe search-box-news il cui input è di tipo text viene inserito un carattere
            var inputVal = $(this).val(); //Memorizzo l'input nella variabile
            var searchResult = $(this).siblings(".resultnews");   //Cerca i figli del this nel DOM HTML e li inserisce nella classe .resultnews
            if(inputVal.length){    //Se l'input ha una lunghezza (quindi non è nullo)
                $.get("cercanews.php", {term: inputVal})   //Carica i dati dal server utilizzando una richiesta HTTP GET
                    .done(function(data){  //Dati ricevuti
                        //Visualizza i dati restituiti nel browser
                        searchResult.html(data);
                });
            } else{
                searchResult.empty();    //Input vuoto
            }
        });
        
        //Imposta il valore di ricerca al click su una voce
        $(document).on("click", ".resultnews p", function(){   //Al click
            $(this).parents(".search-box-news").find('input[type="text"]').val($(this).text());   //Prendo il valore corrispondente (genitore) del valore inserito
            $(this).parent(".resultnews").empty();   //Non faccio comparire altro nella barra di ricerca grazie ad empty che toglie i figli non corrispondenti
        });   
    });
    </script>

 	<!-- Metadata e descrizione pagina -->
 	<meta name="author" content="Gianfranco"/>
 	<meta name="description" content="Questo e' un sito che tratta videogiochi di qualsiasi piattaforma, se vuoi rimanere aggiornato sulle ultime uscite o leggere delle recensioni, clicca in alto!"/>
 	<meta name="keywords" content="giochi,videogiochi,videogames,console"/>

 	<!--Collego css e html-->
 	<link rel="stylesheet" type="text/css" href="../css/stylenews.css?version=2.5"/>
    <!-- Aggiorno il css con ?version= -->

 	<!-- Collego il css per il mobile -->
 	<link rel="stylesheet" media="screen and (max-width:655px)" href="../css/mobile.css?version=1.0">

 	<!--Collego il font che voglio usare-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Press+Start+2P&display=swap" rel="stylesheet">

    <!-- Collego fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

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
            <?php
                session_start();//Inizio sessione
                if(isset($_SESSION['username'])) { //Se l'utente ha già effettuato l'accesso compare l'arcade box con scritto logout
                    ?>
                    <a href="accesso.php"><img src="../images/admin1.png" onmouseover="src='../images/out.png'" onmouseout="src='../images/admin1.png'"></a>  
                    <?php           
                } else { //Altrimenti compare l'arcade box con scritto login
                    ?>
                    <a href="accesso.php"><img src="../images/admin1.png" onmouseover="src='../images/admin2.png'" onmouseout="src='../images/admin1.png'"></a>
                <?php 
            }
            ?>
        </div>  

 	</header> 

 	<!-- Creo lo spazio per il contenuto del sito -->
    <div class="content">
        <div id="testoecerca"> 
		    <div id="novita"><h1 class="novita">NEWS:</h1></div>
            <!-- Inserisco una barra di ricerca -->
            <div class="search-box-news">
                <input type="text" autocomplete="off" name="testo" class="search-txt-news" placeholder="Cerca...">
                <div class="resultnews"></div>
            </div>  
        </div>
		<hr class="orizzontalenews">
        <?php //Sessione aperta precedentemente
            if(isset($_SESSION['username'])) {  //Se l'utente ha effettuato l'accesso puo leggere ed inserire news
                include('../include/inserimento/inserimentonews.php'); //Collego la pagina di inserimento 
                include('../include/lettura/letturanews.php');  //Collego la pagina di lettura
            } else {   //Se l'utente non ha effettuato l'accesso, visualizza le news
                ?>
                <div id="post">
                    <?php
                        include('../include/lettura/letturanews.php');
                    ?>
                </div>
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
