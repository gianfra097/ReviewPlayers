<?php

//Questi header, rendono accessibile la pagina read.php a qualsiasi dominio e restituiscono
//un contenuto JSON, codificato in UTF-8. Formato JSON prima di essere restituiti al client. GET
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
  
//Prendiamo l'id dell'elemento da aggiornare
$data = json_decode(file_get_contents("php://input"));
  
//Impostiamo la proprietà dell'id da modificare
$recensioni->rec_id = $data->rec_id;
  
//Impostiamo i valori
$recensioni->rec_autore = $data->rec_autore;
$recensioni->rec_titolo = $data->rec_titolo;
$recensioni->rec_articolo = $data->rec_articolo;
$recensioni->rec_data = $data->rec_data;
  
//Aggiorniamo la recensione
if($recensioni->update()){
  
    //Codice di risposta - 200 ok
    http_response_code(200);
  
    //Messaggio per l'utente
    echo json_encode(array("message" => "Recensione aggiornata."));
}
  
//Se non è possibile aggioranre la recensione
else{
  
    //Codice per l'utente - 503 service unavailable
    http_response_code(503);
  
    //Messaggio per l'utente
    echo json_encode(array("message" => "Impossibile aggiornare recensione."));
}
?>