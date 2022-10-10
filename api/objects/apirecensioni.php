<?php  
class Recensioni{

	private $conn;  //$conn è pubblica sul file "database.php"
	private $table_name = "recensioni";

	//Proprietà di una recensione
	public $rec_id;
	public $rec_autore;
	public $rec_titolo;
	public $rec_articolo;
	public $rec_immagini;
	public $rec_data;
	
	//Costruttore che inizializza le proprietà dell'oggetto $conn con $db come connessione
	public function __construct($db){
		$this->conn = $db;
	}

	//READ RECENSIONE
	function read(){

		//Query sql che seleziona tutti i dati della tabella recensioni
		$query = "SELECT * FROM ".$this->table_name." "; 

		//Prepara l'istruzione della query e la invia al database
		$stmt = $this->conn->prepare($query);
		
		//Esegue la query
		$stmt->execute();
		
		return $stmt;
	}

	//CREA RECENSIONE
	function create(){

	    //Query per inserire i record nella tabella recensioni
	    $query = "INSERT INTO ". $this->table_nome ."

	                SET
	                  rec_id=:rec_id, rec_autore=:rec_autore, rec_titolo=:rec_titolo, rec_articolo=:rec_articolo, rec_immagini=:rec_immagini, rec_data=:rec_data";

	      //Prepara l'istruzione della query e la invia al database
	      $stmt = $this->conn->prepare($query);

	    //Tramite la funzione strip_tags rimuovo i tag HTML e PHP dall'input passato
	    //La funzione htmlspecialchars invece converte i caratteri speciali in caratteri HTML

	    $this->rec_id=htmlspecialchars(strip_tags($this->rec_id));
	    $this->rec_autore=htmlspecialchars(strip_tags($this->rec_autore));
	    $this->rec_titolo=htmlspecialchars(strip_tags($this->rec_titolo));
	    $this->rec_articolo=htmlspecialchars(strip_tags($this->rec_articolo));
	    $this->rec_immagini=htmlspecialchars(strip_tags($this->rec_immagini));
	    $this->rec_data=htmlspecialchars(strip_tags($this->rec_data));

	    //Lega i valori
	    $stmt->bindParam(':rec_id', $this->rec_id);
	    $stmt->bindParam(':rec_autore', $this->rec_autore);
	    $stmt->bindParam(':rec_titolo', $this->rec_titolo);
	    $stmt->bindParam(':rec_articolo', $this->rec_articolo);
	    $stmt->bindParam(':rec_immagini', $this->rec_immagini);
	    $stmt->bindParam(':rec_data', $this->rec_data);


	    //Esecuzione query
	    if($stmt->execute()){
	        return true;
	    }

	    return false;

	}

	//Questa funzione viene utilizzata durante la compilazione del modulo di aggiornamento
	function readOne(){
	  
	    //Query per leggere i record
	    $query = "SELECT * FROM " . $this->table_name . " WHERE rec_id = ? LIMIT 0,1";
	  
	    //Prepara l'istruzione della query e la invia al database
	    $stmt = $this->conn->prepare( $query );
	  
	    //Collego l'id del prodotto da aggiornare
	    $stmt->bindParam(1, $this->id);
	  
	    //Esecuzione query
	    if($stmt->execute()){

	    	$numrows = $stmt->rowCount();  //numrighe

	    	if($numrows > 0) {
	  
	    		//Recupero la riga
	    		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	  
			    //Inserisco i valori delle proprietà dell'oggetto
			    $this->rec_id = $row['rec_id'];
			    $this->rec_autore = $row['rec_autore'];
			    $this->rec_titolo = $row['rec_titolo'];
			    $this->rec_articolo = $row['rec_articolo'];
			    $this->rec_immagini = $row['rec_immagini'];
			    $this->rec_data = $row['rec_data'];
			}

		}

		return false;
	}

	//Aggiorniamo la recensione
	function update(){
	  
	    // update query
	    $query = "UPDATE
	                " . $this->table_name . "
	            SET
	                rec_autore = :rec_autore,
	                rec_titolo = :rec_titolo,
	                rec_articolo = :rec_articolo,
	                rec_data = :rec_data
	            WHERE
	                rec_id = :rec_id";
	  
	    //Prepara l'istruzione della query
	    $stmt = $this->conn->prepare($query);
	  
	    //Tramite la funzione strip_tags rimuovo i tag HTML e PHP dall'input passato
	    //La funzione htmlspecialchars invece converte i caratteri speciali HTML
	    $this->rec_id=htmlspecialchars(strip_tags($this->rec_id));
	    $this->rec_autore=htmlspecialchars(strip_tags($this->rec_autore));
	    $this->rec_titolo=htmlspecialchars(strip_tags($this->rec_titolo));
	    $this->rec_articolo=htmlspecialchars(strip_tags($this->rec_articolo));
	    $this->rec_data=htmlspecialchars(strip_tags($this->rec_data));
	  
	    //Legge i valori
	    $stmt->bindParam(':rec_id', $this->rec_id);
	    $stmt->bindParam(':rec_autore', $this->rec_autore);
	    $stmt->bindParam(':rec_titolo', $this->rec_titolo);
	    $stmt->bindParam(':rec_articolo', $this->rec_articolo);
	    $stmt->bindParam(':rec_data', $this->rec_data);
	  
	    //Esecuzione query
	    if($stmt->execute()){
	        return true;
	    }
	  
	    return false;
	}

	//Elimina recensione
	function delete(){
	  
	    //Query per eliminare recensione
	    $query = "DELETE FROM recensioni WHERE rec_id = ?";
	  
	    //Prepara l'istruzione della query
	    $stmt = $this->conn->prepare($query);
	  
	    //Tramite la funzione strip_tags rimuovo i tag HTML e PHP dall'input passato
	    //La funzione htmlspecialchars invece converte i caratteri speciali HTML
	    $this->rec_id=htmlspecialchars(strip_tags($this->rec_id));
	  
	    // bind id of record to delete
	    $stmt->bindParam(1, $this->rec_id);
	  
	    // execute query
	    if($stmt->execute()){
	        return true;
	    }
	  
	    return false;
	}

}

//Attraverso la connessione al db, leggiamo le recensioni della tabella recensioni, tramite una query SQL 
//Come risultato avremo i dati in formato JSON

?>

