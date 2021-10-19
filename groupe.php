<?php 
	
		// Connexion à la base de donnée en MySQLi

	$servername = "localhost";
	$gp = $_POST['groupe'];
	$username = "ISN";
	$password = "stjo";
	$dbname = "csv_db";

	$conn = new mysqli($servername, $username, $password, $dbname);

		// Test de la connexion à la base de donnée

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}

$req1 = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='terminale'";
$result1 = $conn->query($req1);

while($row = $result1->fetch_assoc()) {

$sql = "SELECT Nom, Prenom FROM terminale WHERE `".$row[COLUMN_NAME]."` = 'X'";
$result = $conn->query($sql);

$gp = $row[COLUMN_NAME];

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
       $req = "INSERT INTO eleve (Nom, Prenom, Groupe) Values ('".$row['Nom']."', '".$row['Prenom']."', '".$gp."')";
       $conn->query($req);

    }
}
}
$conn->close();
header("refresh:0;url=index.php");?>