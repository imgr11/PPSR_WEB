
<?php

// Prendo i dati inseriti nelle text
$username = $_POST['user'];
$password1 = $_POST['password'];



/*

    creazione di un database con MySQLi.
  La prima operazione richiesta sarà quella relativa alla definizione
  del blocco dei parametri per la connessione
*/

// nome di host
$host = 'localhost';
// username dell'utente in connessione
$user = 'root';
// password dell'utente
$password = '';
// nome del database
$db = 'test';

// stringa di connessione al DBMS
$connessione = new mysqli($host, $user, $password, $db);


	
	
	//definizione costanti
	define('ZERO', 0);
	define('DUE', 2);
	define('UNO', 1);




$query1= sprintf(
	"SELECT * FROM utenti WHERE email = '%s' AND password = '%s'",
	mysqli_real_escape_string($connessione,$username),
	mysqli_real_escape_string($connessione,$password1)
	);
	
//$query= $connessione->query($query1);
	
	$query= mysqli_query($connessione, $query1);
	

//$query = $connessione->query("SELECT * FROM utenti WHERE email = '$username' AND password = '$password1'");
if($query->num_rows) {  
    //echo "Accesso consentito...benvenuto " .$username ;	//eliminare
	
		$queryAdmin= sprintf(
			"SELECT admin FROM utenti WHERE email = '%s' AND password = '%s'",
			mysqli_real_escape_string($connessione,$username),
			mysqli_real_escape_string($connessione,$password1)
		);
		
		//$queryAdmin= "SELECT admin FROM utenti WHERE email = '$username' AND password = '$password1'";
		//$admin = $connessione->query($queryAdmin);
		$admin= mysqli_query($connessione, $queryAdmin);
		while ($row1 = $admin->fetch_array(MYSQLI_NUM)){
		
		
		
		if($row1[ZERO] == ZERO){
		
			$id = sprintf(
				"SELECT id FROM utenti WHERE email = '%s' AND password = '%s'",
					mysqli_real_escape_string($connessione,$username),
					mysqli_real_escape_string($connessione,$password1)
			);
			//per passare l'id della tabella
			//$id = "SELECT id FROM utenti WHERE email = '$username' AND password = '$password1'";
			//$result = $connessione->query($id);
			$result= mysqli_query($connessione, $id);
			while($row = $result->fetch_array(MYSQLI_NUM)){
			
				session_start();
				$_SESSION['lol'] = $row[0];
			
				}
				
				header("location: cliente.php");	//chiama lista 
				

		} else if ($row1[ZERO] == UNO){
			
			header("location: dipendente.php");
			
		} else if ($row1[ZERO] == DUE){
			
			header("location: amministratore.php");

		}
	}
	
	
	
    
    
   
} else {
    
	header("location: accesso_negato.html");
}








// chiusura della connessione
$connessione->close();
?>