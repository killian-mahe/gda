<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Présence</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="icon" type="image/png" href="loggba.png" />
  </head>
  <body>
  <header>
    <nav>
    <a href="index.php">Présence</a>
    <a href="archive.php">Archives</a>
    <a href="contacts.php">Contacts</a>
    <a href="info.php">Informations</a>
  </nav>
  <div id="haut_de_page">
    <img src="Images/stjo_lamballe_logo.png" width="275px" height="79px">
    <img src="Images/loggba.png" width="100px" height="100px">
    <div id="compte">

    <?php 

      if ($_SESSION['connect'] == 0) {  

      echo '<h3>S\'enregistrer</h3>
              <form action="inscription.php" method="POST" id="inscription">
                <label for="salle">Votre salle (CDI ou PERM) : </label><input type="text" name="salle"><br/>
                <label for="mdp">Votre mot de passe : </label><input type="password" name="mdp">
                <label for="rmdp">Confirmation de votre mdp : </label><input type="password" name="rmdp">
                <input type="submit" value="S\'inscrire" class="button">
              </form>
            <h3>Se connecter</h3>
              <form action="connexion.php" method="POST" id="connexion">
                <label for="salle">Votre salle : </label><input type="text" name="salle">
                <label for="mdp">Votre mot de passe : </label><input type="password" name="mdp">
                <input type="submit" value="Connexion" class="button">
              </form>';
      }else{

        echo '<form action="deco.php" method="POST" id="deco">
                <input type="submit" name="deco" value="Déconnexion" class="button">
              </form>';
        echo 'Connecté en tant que '. $_SESSION['salle'];

    }
    ?>
  </div>
  </div> 
  </header>  
  <section id="logiciel">
  <?php

    if ($_SESSION['connect'] == 1) { 

      echo '<div id="fonction">
              <form action="codebarre.php" method="POST" id="entrercodebarre">
                <label for="codebarre">Entrer le code barre : </label><input type="text" name="codebarre" autofocus>                
                <label for="nom">Entrer le nom : </label><input type="text" name="nom" value="0">
                <label for="prenom">Entrer le prénom : </label><input type="text" name="prenom" value="0">
                <label for="pasdecarte"></label><input type="submit" name="pasdecarte" value="Pas de Carte" class="button"> 
              </form>     
            </div>';}
  ?>

  <form action="ini.php" method="POST" id="ini">
    <input type="submit" name="ini" value="Initialiser" class="button">
  </form>

  <form action="archiver.php" method="POST" id="archive">
    <input type="submit" name="archive" value="Archiver" class="button">
  </form>

<div id="date">
  <p>
  <?php

    $hete = strftime('%H')+1;
    setlocale(LC_TIME, 'fra_fra'); 
    echo strftime('%A %d %B %Y, ').$hete.strftime(':%M');
  ?>
  </p>
</div>
<div id="presence">
    <h3>Elèves présents</h3>
    <p>
  <?php
    $servername = "localhost";
    $username = "ISN";
    $password = "stjo";
    $dbname = "csv_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM tbl_name WHERE presence = 'X' ORDER BY classe";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo $row['id']. " - " . "<strong>" . $row['prenom']. " - " . $row['nom']."</strong>". " - ".$row['classe']. " - ". $row['salle'].  "<br/>";
      }
    } else {
      echo "Aucun élève n'est enregistrer.";
    }
  ?>
  </p>
</div>
  </section>
  <footer>
  <div id="liensutiles">
    <h4>Liens utiles</h4>
    <ul>
      <li id="fb"><a href="https://www.facebook.com/saintjosephlamballe/" target="bank">Facebook</a></li>
      <li id="ent"><a href="https://www.lycee-saintjoseph-lamballe.net" target="bank">ENT</a></li>
    </ul>
  </div>
  <div id="liensreseaux">
    <h4>Retrouver-nous</h4>
    <ul>
      <li><a href="mailto:p.bonnard9@hotmail.com">BONNARD Paul</a></li>
      <li><a href="mailto:lecuit.arthur.b.m@gmail.com">LECUIT Arthur</a></li>
      <li><a href="mailto:killianmahe22@gmail.com">MAHE Killian</a></li>
    </ul>
  </div>
  </footer>
</body>
</html>