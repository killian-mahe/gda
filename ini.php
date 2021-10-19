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

		// Requête SQL changeant les attributs "presence" et "salle" en, respectivement "0" et "NULL"

	$sql = "UPDATE tbl_name SET presence = 0, salle = null ";

		// Test pour savoir si la requête a bien été éxécutée

	if ($conn->query($sql) === TRUE) {

			// Si oui alors 'ne rien faire'

	} else {

			// Sinon afficher un message d'erreur

    	echo "Error updating record: " . $conn->error;
	}

		// Fermer la connexion à la base de donnée

	$conn->close();

		// Redirection automatique vers la page "index.php" //

	header("refresh:0;url=index.php");?>