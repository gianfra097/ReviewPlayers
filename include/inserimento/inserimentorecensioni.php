<?php //Sessione aperta precedentemente
            
    include('../include/dbconfig.php'); //Collego il database

    if(isset($_SESSION['username'])) { //Se l'utente ha effettuato l'accesso inserisci i dati nella tabella e/o avvia il form

        //Inizializziamo le variabili con i dati ricevuti dal form
        if(isset($_POST['submit']) && isset($_FILES['img'])) { //Se è stato cliccato invia e caricata l'immagine
           
            $autore = addslashes($_SESSION['username']);  //L'autore sarà automaticamente l'username

            //Inizializzo le variabili per l'immagine
            $target = "C:/xampp/htdocs/ReviewPlayers/images/imgpost/" .basename($_FILES['img']['name']);
            $img_name = $_FILES['img']['name'];
            $img_size = $_FILES['img']['size'];
            $img_ext = explode('.', $img_name);
            $img_ext_min = strtolower(end($img_ext)); //Converto l'estensione in minuscolo per una generalizzazione
            $ext_ok = array('jpg','png','jpeg');  //Scrivo quali sono le estensioni consentite

            //Inizializzo le variabili articolo e titolo e impongo un formato all'img
            if(isset($_POST['titolo'])) {
                $titolo = addslashes($_POST['titolo']);
            }
            
            if(isset($_POST['articolo'])) {
                $articolo = addslashes($_POST['articolo']);
                $parolerec = strlen($articolo);
            }
            
            //Se titolo, articolo o immagine sono stati lasciati vuoti visualizza un errore e refresha alla pagina recensioni
            if($titolo == '' || $articolo == '' || $img_name == '') {
            	echo ("<script LANGUAGE='JavaScript'> window.alert('Non puoi lasciare campi vuoti!'); window.location.href='recensioni.php'; </script>"); 

            //Se l'estensione non è supportata, visualizza un errore e refresha alla pagina recensioni
            } else if(!in_array($img_ext_min, $ext_ok)) {
            	echo ("<script LANGUAGE='JavaScript'> window.alert('Formato immagine non supportato! I formati supportati sono: jpg, png e jpeg'); window.location.href='recensioni.php'; </script>");

            } else if($parolerec < 776){
                echo ("<script LANGUAGE='JavaScript'> window.alert('Inserisci minimo 10 righe!'); window.location.href='recensioni.php'; </script>"); 

            } else { //Altrimenti, se i campi inseriti non sono vuoti, ed il file è supportato, procedi con l'inserimento

                move_uploaded_file($_FILES['img']['tmp_name'], $target);

                //Inseriamo i dati nella tabella recensioni
                $sql = "INSERT INTO recensioni (rec_autore, rec_titolo, rec_articolo, rec_immagini, rec_data) VALUES ('$autore', '$titolo', '$articolo', '$img_name', now())";

                //Se l'inserimento ha avuto successo, inviamo una notifica
                if (@mysqli_query($connection, $sql) or die (mysqli_connect_error())){
                    echo ("<script LANGUAGE='JavaScript'> window.alert('Articolo inserito con successo!'); window.location.href='recensioni.php'; </script>"); 
                }
            }
        
        } else {  //Se non sono stati inviati dati (o dopo averli inviati) esegui il form
            ?>
            <style>
                input{
                    margin-left: 15px;
                }
                textarea{
                    margin-left: 15px;
                }
                b.titolo, b.articolo, b.autore, b.img{
                    padding-left: 15px;
                }
                input.scegli, input.send{
                    cursor: pointer;
                }
            </style>
            <form action="recensioni.php" method="post" enctype="multipart/form-data">
            <b class="autore">Autore:</b><br>
            <input name="autore" type="text" size="20" value="<?php echo $_SESSION['username'];?>" disabled="disabled"> <br><br> <!-- Scrivo il nome dell'autore loggato-->
            <b class="titolo">Titolo:</b><br>
            <input name="titolo" type="text" size="30"> <br><br>
            <b class="articolo">Articolo:</b><br>
            <textarea name="articolo" cols="40" rows="10" maxlength="1091" placeholder="Minimo 10 righe e massimo 15!"></textarea> <br>
            <b class="img">Scegli immagine: </b>
            <input class="scegli" type="file" name="img"/> <br><br>
            <input class="send" type="submit" name="submit" value="Invia"> <br><br>
            </form>
            <?php
            }
        }
?>