<?php session_start();

    // Connexion à la base de donnée en MySQLi

    $servername = "localhost";
    $username = "ISN";
    $password = "stjo";
    $dbname = "csv_db";
    $conn = new mysqli($servername, $username, $password, $dbname);

      // Test de la connexion à la base de donnée

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Requête SQL afin de selectionner les élèves présents par classe //

    $sql = "SELECT * FROM tbl_name WHERE presence = 'X' ORDER BY classe";
    $result = $conn->query($sql);

    // Récupération de l'heure locale //

    $hete = strftime('%H')+1;
    setlocale(LC_TIME, 'fra_fra'); 
    $date_test = strftime('%Y-%m-%d');
    $good_format = strtotime ($date_test);
    
    // Structure conditionnelle, Si l'heure est plus petit que 13 ALORS //

	if ($hete < 13 ) {

    // On ouvre le fichier de la semaine ou on le créé s'il n'existe pas //
		
		$monfichier = fopen('Archive/'.'Semaine '.date('W',$good_format).'.arc', 'a+');

    // On crée l'en-tête de l'heure puis on l'ajoute dans le fichier //

		$heure = PHP_EOL.'//  '.strftime('%A %d %B %Y, ').$hete.':05  ----  '.PHP_EOL.PHP_EOL;
    	fputs($monfichier, $heure);

      // Structure conditionnelle testant si il y a des valeurs reçu lors de la commande SQL //

    	if ($result->num_rows > 0) {

        // Boucle affichant dans le fichier le prénom, le nom, le numéro de la carte, la classe et la salle de chaque élève présent //
      		while($row = $result->fetch_assoc()) {
        		$eleve = $row['id']. " - " . $row['prenom']. " - " . $row['nom']. " - ".$row['classe']. " - ". $row['salle'].PHP_EOL;
        		fputs($monfichier, $eleve);
      		}

          // On ferme le fichier //

		fclose($monfichier);
		}

    // SINON //

	}elseif ($hete > 13 ) {

     // On ouvre le fichier de la semaine ou on le créé s'il n'existe pas //

		$monfichier = fopen('Archive/'.'Semaine '.date('W',$good_format).'.arc', 'a+');

     // On crée l'en-tête de l'heure puis on l'ajoute dans le fichier //

		$heure = PHP_EOL.'//  '.strftime('%A %d %B %Y, ').$hete.':45  ----  '.PHP_EOL.PHP_EOL;
    	fputs($monfichier, $heure);

      // Structure conditionnelle testant si il y a des valeurs reçu lors de la commande SQL //

    	if ($result->num_rows > 0) {

          // Boucle affichant dans le fichier le prénom, le nom, le numéro de la carte, la classe et la salle de chaque élève présent //

      		while($row = $result->fetch_assoc()) {
        		$eleve = $row['id']. " - " . $row['prenom']. " - " . $row['nom']. " - ".$row['classe']. " - ". $row['salle'].PHP_EOL;
        		fputs($monfichier, $eleve);
      		}

          // On ferme le fichier //

		fclose($monfichier);
		}
	}	

  // On redirige vers la page index.php //

header("refresh:0;url=index.php");?>