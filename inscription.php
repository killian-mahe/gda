<?php session_start(); ?>
<?php

		// Récupération des valeurs transmises par la page "index.php" via la méthode "POST"

	$salle = $_POST['salle'];

		// On passe les mots de passe dans la fonction de hachage cryptographique "sha1" assurant une meilleur sécurité

	$mdp = sha1($_POST['mdp']);
	$rmdp = sha1($_POST['rmdp']);

		// Structure conditionnelle testant si le mot de passe entré et bien le même dans les deux champs

	if ($mdp == $rmdp) {

			// Si oui alors connexion à la base de donnée

		$servername = "localhost";
		$username = "ISN";
		$password = "stjo";
		$dbname = "csv_db";

		$conn = new mysqli($servername, $username, $password, $dbname);

			// On test si la connexion a été réalisée avec succès (sinon on affiche un message d'erreur)

		if ($conn->connect_error) {

    		die("Connection failed: " . $conn->connect_error);
		}

			// On insére par la suite les valeurs contenant la salle et le mot de passe dans la table 'user_db' gérant les différents comptes

		$sql = "INSERT INTO user_db (salle, mdp) VALUES ('" . $salle . "', '" . $rmdp . "')";

			// On teste ensuite si la commande SQL a bien été réalisée

		if ($conn->query($sql) === TRUE) {

				// Si oui on démarre donc la session et on initialise des vaiables supergobales

    		session_start();
			$_SESSION['connect'] = 1;
			$_SESSION['salle'] = $salle;

		} else {

				// Si non on affiche un message d'erreur

   			echo "Error updating record: " . $conn->error;
		}
		
	}else{

			// Si non on affiche un messgae d'erreur

		echo "Vous n'avez pas saisie le même mot de passe... Veuillez reéssayer";
	}

		// On redirige automatiquement vers la page "index.php"

	header("refresh:0;url=index.php");?>