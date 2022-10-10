<?php

//Questi header, rendono accessibile la pagina read.php a qualsiasi dominio (*) e restituiscono
//un contenuto JSON, codificato in UTF-8 al client. L'asterisco * indica tutti i domini
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
//Includiamo database.php e apirecensioni.php per poterli usare
include_once '../config/database.php';  
include_once '../objects/apirecensioni.php';

//Creiamo un nuovo oggetto Database e ci colleghiamo al nostro database con getConnection();  
$database = new Database();
$db = $database->getConnection();

//Creiamo un nuovo oggetto recensioni  
$recensioni = new Recensioni($db);
  
//Otteniamo i dati pubblicati in formato json
$data = json_decode(file_get_contents("php://input"));
  
//Controlliamo che i dati non siano vuoti
if(
    !empty($data->rec_id) &&
    !empty($data->rec_autore) &&
    !empty($data->rec_titolo) &&
    !empty($data->rec_articolo) &&
    !empty($data->rec_immagini) &&
    !empty($data->rec_data) 
){
  
    //Imposto i valori
    $recensioni->rec_id = $data->rec_id;
    $recensioni->rec_autore = $data->rec_autore;
    $recensioni->rec_titolo = $data->rec_titolo;
    $recensioni->rec_articolo = $data->rec_articolo;
    $recensioni->rec_immagini = $data->rec_immagini;
    $recensioni->rec_data = $data->rec_data;
  
    //Creo la recensione
    if($recensioni->create()){
  
        //Risposta - 201 creata
        http_response_code(201);
  
        //Messaggio all'utente "recensione creata"
        echo json_encode(array("message" => "Recensione creata."));
    }
  
    //Se non è possibile crearla
    else{
  
        //Errore 503 servizio non disponibile
        http_response_code(503);
  
        //Messaggio all'utente
        echo json_encode(array("message" => "Impossibile creare la recensione."));
    }
}
  
//Se i dati sono incompleti
else{
  
    //Risposta - 400 bad request
    http_response_code(400);
  
    //Messaggio all'utente
    echo json_encode(array("message" => "Dati incompleti."));
}
?>