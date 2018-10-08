<?php
$user='root';
$pass='';
$dsn="mysql:host=localhost;dbname=projet_lo07";

try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
}

$text = array();
$text = $_POST["text"];//nounou name_u
$name_u = $_POST["name_u"];//parent name_u
$number = $_POST["choose"];
$jour = $_POST["jour"];
$number0 = $text[$number-1];


echo "Vous avez choisi l'ID de la nounou: ";
echo $number0;
echo " ";
$sql1 = "SELECT id_i FROM nounou_inscrite WHERE name_u='$number0'";
$resultats = $dbh->query($sql1);

while($result = $resultats->fetch()){
  global $id_i;
  $id_i = $result["id_i"];
}

$sql3 = "UPDATE nounou_dispon SET jourReserve = '1' WHERE id_i ='$id_i' AND jourDispon='$jour'";
$dbh->exec($sql3);

$sql2 = "INSERT INTO enregistrements (nameP,nameN,service) VALUES ('$name_u','$id_i','service2')";
$dbh->exec($sql2);

echo "Vous avez choisi avec succès une nounou";
?>
