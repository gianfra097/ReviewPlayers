<?php 

	include('../include/dbconfig.php');  //Connessione al db

    if(isset($_REQUEST["term"])){     //Se è stato inizializzato il termine

        //Creo la query
        $sql_cerca = "SELECT * FROM recensioni WHERE rec_titolo LIKE ?";

        //mysqli_prepare, prepara un istruzione SQL per l'esecuzione
        if($stmt = mysqli_prepare($connection, $sql_cerca)){

            //Con mysqli_stmt_bind_param, associo la variabile $param_term allo statement preparato come parametro. Utilizzo "s" perché è stringa
            mysqli_stmt_bind_param($stmt, "s", $param_term);

            //Imposto il parametro che comprenda quello che l'utente scrive nella barra di ricerca
            $param_term = '%' . $_REQUEST["term"] . '%';

            //Con mysqli_stmt_execute eseguo lo statement preparato precedentemente da mysqli_prepare e do il risultato con stmt_get_result
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                //Controllo il numero di righe della query
                if(mysqli_num_rows($result) > 0){  //Se maggiore di 0 inizia il loop

                    echo "<h2 style='padding-left: 15px; padding-top:35px;'><b>RISULTATI DELLA TUA RICERCA:</b></h2>";

                    echo "<p style='padding-left: 15px;'>Trovate <b>" .mysqli_num_rows($result). "</b> voci per il termine: <b>" .$_REQUEST["term"]. "</b></p>";

                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){   //Finchè ci sono risultati

                        //Recupero delle variabili che mi servono per la stampa dei risultati
                        $imgcerca = $row["rec_immagini"];
                        $rec_id = $row["rec_id"];  

                        ?>

                        <hr class="hrcerca" style="border-color: grey; opacity: 0.5;">

                        <a href="../include/lettura/singolarec.php?id=<?php echo "$rec_id" ?>">
                            <div id="titoloeimgrec" style="display: flex; justify-content:flex-start;">
                                <img src="../images/imgpost/<?=$imgcerca;?>" width="20%" align="left" hspace="10"> 
                                <h3 class="titolo" style="text-transform: uppercase; padding-left: 10px;"> <b> <?php echo $row["rec_titolo"]; ?> </b> </h3>                                    
                            </div> <br>
                        </a>

                        <?php

                        }

                    } else{
                        //Nel caso in cui non ci siano corrispondenze, non verrà visualizzato nessun risultato
                    }

                } else {
                        echo "ERRORE: Impossibile eseguire $sql . ".mysqli_error($connection);
                }

            }

        //Chiudo lo statement
        mysqli_stmt_close($stmt);
    }

//Chiudo la connessione
mysqli_close($connection);

?>

