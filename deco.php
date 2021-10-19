<?php session_start();

	// Détruit la session en cours et redirige vers la page "index.php" //

session_destroy();
header("refresh:0;url=index.php");?>