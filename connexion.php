<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Connexion</title>
		<meta charset="utf-8">
	</head>
	<body>
	<?php 	// Code php utiliser pour se connecter à un compte péalablement crée //
		
			// Connexion à la base de donnée en MySQLi //

		$servername = "localhost";
		$username = "ISN";
		$password = "stjo";
		$dbname = "csv_db";

		$conn = new mysqli($servername, $username, $password, $dbname);

			// Test de la connexion à la base de donnée //

		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		}

			// Récupération des valeurs entrées dans la page "index.php" transmis via la méthode "POST"//

		$salle = $_POST['salle'];
		$mdp = sha1($_POST['mdp']);

			// Requête SQL afin de sélectionner les valeurs de tous les attributs où les attributs "salle" et "mdp" correspondent aux valeurs entrées //

		$req = "SELECT * FROM user_db WHERE"." salle ='".$salle."' AND mdp='".$mdp."'";
		$reponse = $conn->query($req);

			// Structure conditionnelle testant le nombre de résultats renvoyés //

		if ($reponse->num_rows > 0) {

				// Si ce nombre est strictement supérieur à 0 alors on démarre une session et on initialise des variables superglobales //

			session_start();
			$_SESSION['connect'] = 1;
			$_SESSION['salle'] = $salle;		
		}
    	else{    

    			// Sinon on afficher un message d'erreur //

			echo "Mauvais identifiant ou mot de passe ! ";
		}

			// Fermer la connexion à la base de donnée

		$conn->close();

			// Redirection automatique vers la page "index.php" //

		header("refresh:0;url=index.php");?>
	</body>
</html>