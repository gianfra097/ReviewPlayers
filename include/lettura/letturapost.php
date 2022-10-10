<?php
include('include/dbconfig.php');                        //Collego il db
$sql = "SELECT * FROM recensioni LEFT JOIN news ON rec_id = news_id 		
		UNION SELECT * FROM recensioni RIGHT JOIN news ON rec_id = news_id 
		ORDER BY news_id DESC"; 			//Seleziono le due tabelle e le ordino
$risultati = mysqli_query($connection,$sql);            //Inserisco i dati all'interno della variabile risultati
if (mysqli_num_rows($risultati) > 0) {                  //Se c'è almeno una riga
    while($row = mysqli_fetch_assoc($risultati)) {      //Fornisce i dati e li associa ai nomi delle colonne del database

        //RECENSIONI
        $ontitler = "<span style=\"color:red\">Recensione: </span>"; //Coloro di rosso la scritta recensione
        $imgrec = $row["rec_immagini"];
        $rec_id = $row["rec_id"];  //Inizializzo la variabile $rec_id
        $linkrec = "...<a href=\"include/lettura/singolarec.php?id=$rec_id\"> <i>Leggi tutto</i></a>"; //Creo un link che porta alla rispettiva recensione
       
        //ANTEPRIMA RECENSIONE
        $anteprimarec = substr($row["rec_articolo"],0,550); //Variabile per l'anteprima del testo
        $ultimospaziorec = strrpos($anteprimarec," ");
        $anteprimaokrec = substr($anteprimarec, 0, $ultimospaziorec); //Anteprima senza tagliare parole
        
        //NEWS
        $ontitlen = "<span style=\"color:red\">NEWS: </span>"; //Coloro di rosso la scritta news
        $imgnews = $row["news_immagini"];
        $news_id = $row["news_id"]; //Stessa cosa per $news_id   
        $linknews = "...<a href=\"include/lettura/singolanews.php?id=$news_id\"> <i>Leggi tutto</i></a>"; //Creo un link che porta alla rispettiva news

        //AMTEPRIMA NEWS
        $anteprimanews = substr($row["news_articolo"],0,550); //Variabile per l'anteprima del testo
        $ultimospazionews = strrpos($anteprimanews," ");
        $anteprimaoknews = substr($anteprimanews, 0, $ultimospazionews); //Anteprima senza tagliare parole

        
        if($imgrec == '' || $rec_id == '' || $row["rec_articolo"] == '' || $row["rec_autore"] == '' || $row["rec_titolo"] == '' || $row["rec_data"] == ''){
            ?> <!-- Se le recensioni sono vuote, allora si parla di news, e stampo le news -->
            <!-- NEWS -->
            <b><p class="newstitolo" style="text-transform:uppercase;"> <!--Titolo news in grassetto-->
            <?php echo $ontitlen . $row["news_titolo"]; ?>
            </b></p>

            <p class="newsarticolo" align='justify'> <!-- Immagine e articolo a fianco -->
                <img class="image" src="images/imgpost/<?=$imgnews;?>" width="25%" align="left" hspace="10"> 
                <?php echo $anteprimaoknews . $linknews ?> <!-- Unisco l'anteprima del testo con il link che mi porta alla rispettiva news -->
            </p>

            <hr class="hrletturapost">
            <?php
        } else if($imgnews == '' || $news_id == '' || $row["news_articolo"] == '' || $row["news_autore"] == '' || $row["news_titolo"] == '' || $row["news_data"] == ''){
                ?> <!-- Se le news sono vuote, allora si parla di recensioni, e stampo le recensioni -->
                <!-- RECENSIONI -->
                <b><p class="rectitolo" style="text-transform:uppercase;"> <!--Titolo recensione in grassetto-->
                <?php echo $ontitler . $row["rec_titolo"]; ?>
                </b></p>

                <p class="recarticolo" align='justify'> <!-- Immagine e articolo a fianco -->
                    <img class="image" src="images/imgpost/<?=$imgrec;?>" width="25%" align="left" hspace="10"> 
                    <?php echo $anteprimaokrec . $linkrec ?> <!-- Unisco l'anteprima del testo con il link che mi porta alla rispettiva recensione -->
                </p>

                <hr class="hrletturapost">
                <?php
        } else {
                
                ?>
                <!-- NEWS -->
                <b><p class="newstitolo" style="text-transform:uppercase;"> <!--Titolo news in grassetto-->
                <?php echo $ontitlen . $row["news_titolo"]; ?>
                </b></p>

                <p class="newsarticolo" align='justify'> <!-- Immagine e articolo a fianco -->
                    <img class="image" src="images/imgpost/<?=$imgnews;?>" width="25%" align="left" hspace="10"> 
                    <?php echo $anteprimaoknews . $linknews ?> <!-- Unisco l'anteprima del testo con il link che mi porta alla rispettiva news -->
                </p>

                <hr class="hrletturapost">

                <!-- RECENSIONI -->
                <b><p class="rectitolo" style="text-transform:uppercase;"> <!--Titolo recensione in grassetto-->
                <?php echo $ontitler . $row["rec_titolo"]; ?>
                </b></p>

                <p class="recarticolo" align='justify'> <!-- Immagine e articolo a fianco -->
                    <img class="image" src="images/imgpost/<?=$imgrec;?>" width="25%" align="left" hspace="10"> 
                    <?php echo $anteprimaokrec . $linkrec ?> <!-- Unisco l'anteprima del testo con il link che mi porta alla rispettiva recensione -->
                </p>

                <hr class="hrletturapost">
                <?php
        } ?>
        
        <!-- STILE -->        
        <style>
        hr .hrletturapost{
            border: none;
            border-top: 1px solid hsla(200, 10%, 70%,100);
            max-width: 100%;
            height: 0.5px;
            margin-right: 3%;
        }
        a {
  			text-decoration: none; /* Tolgo la sottolineatura da tutti i link*/
  			color: black;
  			font-weight: bold; 
		}
        img.image{
   			width: 310px;
   			height: 180px;
        }
        p.rectitolo{
            text-align: left;
            font-size: 20px
        }
        p.recarticolo{
            padding-right: 15px;
        } 
        p.newstitolo{
            text-align: left;
            font-size: 20px
        }
        p.newsarticolo{
            padding-right: 15px;
        } 
        </style>
        <?php
   }
} //Stampo i risultati
mysqli_close($connection); //Chiudo la connessione
?>