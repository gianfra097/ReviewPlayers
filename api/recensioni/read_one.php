<?php

//Questi header, rendono accessibile la pagina read.php a qualsiasi dominio e restituiscono
//un contenuto JSON, codificato in UTF-8. Formato JSON prima di essere restituiti al client. GET
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
//Includiamo database.php e apirecensioni.php per poterli usare
include_once '../config/database.php';
include_once '../objects/apirecensioni.php';
  
//Creiamo un nuovo oggetto Database e ci colleghiamo al nostro database con getConnection();
$database = new Database();
$db = $database->getConnection();
  
//Creiamo un nuovo oggetto recensioni
$recensioni = new Recensioni($db);

//Impostiamo l'id da leggere  
$recensioni->id = isset($_GET['id']) ? $_GET['id'] : die();
  
//Leggiamo i dettagli del prodotto da modificare
$recensioni->readOne();
  
if($recensioni->rec_autore!=null){
    //Creiamo l'array recensione corrispondente
    $recensioni_arr = array(
        "rec_id" =>  $recensioni->rec_id,
        "rec_autore" => $recensioni->rec_autore,
        "rec_titolo" => $recensioni->rec_titolo,
        "rec_articolo" => $recensioni->rec_articolo,
        "rec_immagini" => $recensioni->rec_immagini,
        "rec_data" => $recensioni->rec_data
  
    );
  
    //Risposta positiva - 200 OK
    http_response_code(200);
  
    //Rendiamo l'array in formato json
    echo json_encode($recensioni_arr);
}
  
else{
    //Risposta negativa - 404 Not found
    http_response_code(404);
  
    //Messaggio per informare l'utente
    echo json_encode(array("message" => "Recensione non esistente."));
}
?>