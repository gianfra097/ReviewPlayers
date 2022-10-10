<?php
class Database {

    //Stabilisco la connessione con il server
    //Istanziamo gli attributi della classe con private, rendendo l'attributo privato quindi utilizzabile solo all'interno di questa classe
    private $host = "localhost"; 		//Nome server
    private $db_name = "ReviewPlayers";	//Nome db
    private $username = "Gianfranco";	//Nome utente db 
    private $password = "gianfranco10";	//Password utente db 
    public $conn;   //Attributo utilizzabile all'esterno della classe

    // Prendo la connessione al database
    public function getConnection() {

        $this->conn = null; //Con $this ci riferiamo all’istanza ($conn) corrente che stiamo utilizzando, cioè l'istanza della classe corrente.
        
        //Utilizzo le eccezioni nel caso in cui la connessione potrebbe non avvenire
        try  //Provo ad eseguire quello che c'è all'interno del try
            {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);  //PDO consente di accedere al db tramite dsn(data source name)
            $this->conn->exec("set names utf8");
            }
        catch(PDOException $exception)  //Nel caso ci sia un eccezione specificata nel PDO del try, la catturo con catch
            { //Se la connessione è fallita
            echo "Errore di connessione: " . $exception->getMessage(); //getMessage cattura il messaggio di errore in questo caso
            }

        return $this->conn;

        }
    }
?>