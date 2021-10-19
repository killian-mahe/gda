<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Test</title>
    <meta charset="utf-8">
  </head>
  <body>
  <?php

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

      // Récupération des valeurs entrées dans la page "index.php" transmis via la méthode "POST"

    $bc = $_POST['codebarre'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

      // Structure conditionelle afin de tester si l'utilisateur a entré l'id de sa carte ou bien son nom et prénom 

    if ($nom == "0" AND $prenom == "0") {

        // Requête SQL afin de changer au niveau de la ligne correspondant à l'id entré, l'attribut "presence" en 'X' et l'attribut "salle" en fonction du lieux
        // de connexion

      $sql = "UPDATE tbl_name SET presence = 'X', salle ='".$_SESSION['salle']."' WHERE id=".$bc;
      
        // Test pour savoir si la requête a bien été éxécutée

      if ($conn->query($sql) === TRUE) {

          // Si oui alors on ferme la connexion à la base de donnée

        $conn->close();
      } else {

          // Sinon affichage du message d'erreur et fermeture de la connexion à la base de donnée

        echo "XError updating record: " . $conn->error;
        $conn->close();
      }

    }else{

        // Requête SQL afin de changer au niveau de la ligne correspondant au nom et prénom entré, l'attribut "presence" en 'X' et l'attribut "salle" en fonction
        // du lieu de connexion

	     $sql = "UPDATE tbl_name SET presence = 'X', salle = '".$_SESSION['salle']."' WHERE nom ='".$nom."' AND prenom ='".$prenom."'";
    
        // Test pour savoir si la requête a bien été éxécutée

      if ($conn->query($sql) === TRUE) {

          // Si oui alors 'ne rien faire'

      } else {

          // Sinon affichage du message d'erreur et fermeture de la connexion à la base de donnée

        echo "XError updating record: " . $conn->error;
        $conn->close();
      }
    }

      // Redirection automatique vers la page "index.php"

    header("refresh:0;url=index.php");?>
  </body>
</html>