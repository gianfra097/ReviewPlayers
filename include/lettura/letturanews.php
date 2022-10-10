<?php
include('../include/dbconfig.php');                      //Collego il db
$sql = "SELECT * FROM news ORDER BY news_data DESC"; //Seleziono l'intera tabella news
$risultati = mysqli_query($connection,$sql) or die(mysqli_error($connection));         //Inserisco i dati all'interno della variabile risultati
if (mysqli_num_rows($risultati) > 0) {                  //Se c'è almeno una riga
    while($row = mysqli_fetch_assoc($risultati)) {      //Fornisce i dati e li associa ai nomi delle colonne del database

        $id = $row['news_id'];
        
        //Salviamo la data nella variabile e formattiamola nel formato europeo
        $data = $row['news_data'];
        $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);

        $imgnews = $row["news_immagini"];
        $scrittoda = "<b> Scritto da: ".$row["news_autore"]."</b>"; //Inserisco all'interno della variabile l'autore in grassetto
        $il = "<b>, il: " .$data . "</b>"; //Stessa cpsa faccio per la data

        ?>

        <b><p class="newstitolo" style="text-transform:uppercase;"> <!--Titolo in grassetto-->
        <?php echo $row["news_titolo"]; 
        if(isset($_SESSION['username'])) { //Se l'utente ha effettuato il login può modificare l'articolo
            ?>
            <br><button class="mod" type="button" id="modifica" name="modifica"> <a href="../include/aggiornamento/aggiornanews.php?id=<?php echo $id; ?>">Modifica Articolo</a> </button>
            <button class="del" onclick="return(confirm('Sei sicuro di voler eliminare questa news?'))" type="button" id="elimina" name="elimina"> <a href="../include/aggiornamento/deletenews.php?id=<?php echo $id; ?>">Elimina Articolo</a> </button>
            <?php //Bottoni collegati alla pagina di aggiornamento ed eliminazione recensione
        }
        ?>
        </b></p>
        
        <p class="newsarticolo" align='justify'> <!-- Immagine e articolo a fianco -->
            <img class="imgnews" src="../images/imgpost/<?=$imgnews;?>" align="left" hspace="15">
            <?php echo $row["news_articolo"]?>
        <br>

        <p class="firma" align='right'><?php echo $scrittoda . $il ?></p> 
        </p>
        
        <hr class="hrletturanews">
        
            
        <style>
        hr.hrletturanews{
            background: linear-gradient(to bottom, #efefef 0%, #a2a2a2 100%);
            border: none;
            border-top: 1px solid hsla(200, 10%, 80%, 100);
            max-width: 96%;
            margin-right: 3%;
        }
        img.imgnews{
            width: 330px;
            height: 200px;
        }
        a{
            text-decoration: none; /* Tolgo la sottolineatura da tutti i link*/
            color: black;
        }
        p.newstitolo{
            color: red;
            text-align: left;
            padding-left: 15px;
            font-size: 18px
        }
        p.newsarticolo{
            padding-right: 15px;
        }
        p.firma{
            padding-right: 20px;
            font-size: 15px;
        }
        </style>
        <?php
   }
} //Stampo i risultati
mysqli_close($connection); //Chiudo la connessione
?>