<?php
include('../include/dbconfig.php');                      //Collego il db
$sql = "SELECT * FROM recensioni ORDER BY rec_id DESC"; //Seleziono l'intera tabella recensioni
$risultati = mysqli_query($connection,$sql) or die(mysqli_error($connection));            //Inserisco i dati all'interno della variabile risultati
if (mysqli_num_rows($risultati) > 0) {                  //Se c'è almeno una riga
    while($row = mysqli_fetch_assoc($risultati)) {      //Fornisce i dati e li associa ai nomi delle colonne del database

        $id = $row['rec_id'];

        //Salviamo la data nella variabile e formattiamola nel formato europeo
        $data = $row['rec_data'];
        $data = preg_replace('/^(.{4})-(.{2})-(.{2})$/','$3-$2-$1', $data);
        
        $imgrec = $row["rec_immagini"];
        $scrittoda = "<b> Scritto da: ".$row["rec_autore"]."</b>"; //Inserisco all'interno della variabile l'autore in grassetto
        $il = "<b>, il: " .$data . "</b>";

        ?>

        <b><p class="rectitolo" style="text-transform:uppercase;"> <!--Titolo in grassetto-->
        <?php echo $row["rec_titolo"];
        if(isset($_SESSION['username'])) { //Se l'utente ha effettuato il login può modificare l'articolo
            ?>
            <br><button class="mod" type="button" id="modifica" name="modifica"> <a href="../include/aggiornamento/aggiornarecensione.php?id=<?php echo $id; ?>">Modifica Articolo</a> </button>
            <button onclick="return(confirm('Sei sicuro di voler eliminare questa recensione?'))" class="del" type="button" id="elimina" name="elimina"> <a href="../include/aggiornamento/deleterec.php?id=<?php echo $id; ?>">Elimina Articolo</a> </button>
            <?php //Bottoni collegati alla pagina di aggiornamento ed eliminazione recensione
        }
        ?>
        </b></p>
        
        <p class="articolo" align='justify'> <!-- Immagine e articolo a fianco -->
            <img class="imgrece" src="../images/imgpost/<?=$imgrec;?>" align="left" hspace="15">
            <?php echo $row["rec_articolo"]; ?>         
        <br>

        <p class="firma" align='right'><?php echo $scrittoda . $il ?></p>
        </p>
            
        <hr>

        <style>
        hr{
            background: linear-gradient(to bottom, #efefef 0%, #a2a2a2 100%);
            border: none;
            border-top: 1px solid hsla(200, 10%, 80%, 100);
            max-width: 96%;
            margin-right: 3%;
        }
        img.imgrece{
   			width: 330px;
   			height: 200px;
        }
        a {
            text-decoration: none; /* Tolgo la sottolineatura da tutti i link*/
            color: black;
        }
        p.rectitolo{
            color: red;
            text-align: left;
            padding-left: 15px;
            font-size: 20px
        }
        p.articolo{
            padding-right: 15px;
        }
        p.firma{
            padding-right: 20px;
            font-size: 15px;
        }
        button.mod{
        	cursor: pointer;
        }
        </style>
        <?php
   }
} 
mysqli_close($connection); //Chiudo la connessione
?>