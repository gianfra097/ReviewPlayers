<?php

    session_start();
    
    if(!isset($_SESSION['username']) || !isset($_SESSION['grant']) ) { //Se l'utente non ha effettuato l'accesso o non ha i permessi, visualizza un errore con script in JavaScript
        ?> <script> alert("Non hai l'autorizzazione per svolgere questa funzione!"); window.location = "../../pagine/utente/utenti.php"; </script> <?php
    }else {  //Se l'utente ha effettuato l'accesso, visualizza la pagina di uscita.
        ?>

        <!DOCTYPE html>

        <html lang="it">
            
            <head>
            
            <title> ReviewPlayers - Elimina utenti </title>

            <div class="content">
                <?php

                    include('../dbconfig.php'); //Collego il database

                    $id = $_GET['id'];
                    $sqldel = "DELETE FROM `utenti` WHERE `id` = '$id'";
                    $risultatidel = mysqli_query($connection, $sqldel);
                    if($risultatidel) {
                        header("Location: ../../pagine/utente/utenti.php");
                    }
                    mysqli_close($connection); //Chiudo la connessione
                ?>
            </div>

            </head>

        </html>
            
        <?php
    }
?>
            