<?php
$user='root';
$pass='';
$dsn="mysql:host=localhost;dbname=projet_lo07";
$name_u = $_POST["name_u"];
try {
    $dbh = new PDO($dsn, $user, $pass);
    echo "connect successfully<br/>";
  } catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
    }

    $nom = $_POST["nom"];
    $ville = $_POST["ville"];
    $email = $_POST["email"];
    $prenom = $_POST["prenom"];
    $naissance = $_POST["naissance"];
    $alimentaires = $_POST["alimentaires"];
    $textarea=$_POST["textarea"];

    $sql1 = "INSERT INTO parent (nom,ville,email,textarea,name_u) VALUES ('$nom','$ville','$email','$textarea','$name_u')";
    $dbh->exec($sql1);


    $sql2 = "SELECT MAX(id) FROM parent";
    $resultats = $dbh->query($sql2);

    while($ID2 = $resultats->fetch()){
      global $ID3;
      $ID3 = $ID2[0];
    }


    $sql3 = "INSERT INTO enfant (ParentID,prenom,naissance,alimentaires) VALUES ('$ID3','$prenom','$naissance','$alimentaires')";
    $dbh->exec($sql3);
?>

<html>
  <head>
      <title>Inscription</title>
  </head>
  <body>
      <h1></h1>
      <form method="get" action="serviceParent.php">
        <h1>Vous avez terminé votre inscription avec succès</h1><p/>
        <h1>Vous pouvez maintenant choisir les services dont vous avez besoin</h1>
        <input type="hidden" name=name_u value="<?php echo $name_u?>">

        <input type="submit" value="choisir les services"/>
      </form>
  </body>
</html>
