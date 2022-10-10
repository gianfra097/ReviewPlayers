<?php

//Questi header, rendono accessibile la pagina read.php a qualsiasi dominio (*) e restituiscono
//un contenuto JSON, codificato in UTF-8 al client. L'asterisco * indica tutti i domini
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//Includiamo database.php e apirecensioni.php per poterli usare
include_once '../config/database.php';
include_once '../objects/apirecensioni.php';

//Creiamo un nuovo oggetto Database e ci colleghiamo al nostro database con getConnection();
$database = new Database();
$db = $database->getConnection();

//Creiamo un nuovo oggetto recensioni 
$recensioni = new Recensioni($db);

//Chiamiamo la funzione read che leggerà i dati del database e inseriamo numero di righe in $num
$stmt = $recensioni->read();
$num = $stmt->rowCount();

//Se vengono trovate recensioni nel database (righe)
if($num>0){
    $recensioni_arr=array();	    		//Array di recensioni
    $recensioni_arr["records"] = array();   //Aggiungiamo ogni record all'array
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){  //Finchè restituisce una riga dal set di risultati
        extract($row);              //Estrae i dati contenuti all'interno di $row
        $recensioni_item = array(
            "rec_id" => $rec_id,
            "rec_autore" => $rec_autore,
            "rec_titolo" => $rec_titolo,
            "rec_articolo" => $rec_articolo,
            "rec_immagini" => $rec_immagini,
            "rec_data" => $rec_data
        );
        array_push($recensioni_arr["records"], $recensioni_item); //Aggiungiamo ai records gli items, quindi {"records":[{"rec_id":"1","rec_autore":"gianfry097".. ecc
    }

    //Risposta positiva 
    http_response_code(200);
    
    echo json_encode($recensioni_arr);  //Codifica array in oggetto JSON

}

else{
  
    //Risposta negativa 404 Not found
    http_response_code(404);
  
    //Nessuna recensione trovata
    echo json_encode(
        array("message" => "Nessuna recensione trovata.")    //Codifica array in oggetto JSON
    );
}

?>