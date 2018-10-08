<?php
echo "Vous avez choisi ";
echo $_POST["choose"];
echo " ème nounou ";
echo "<br/>";


$name_u = $_POST["name_u"];
$user='root';
$pass='';
$dsn="mysql:host=localhost;dbname=projet_lo07";

try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
}

$text = array();
$text = $_POST["text"];

$jour = array();
$jour = $_POST["jour"];


$number = $_POST["choose"];
$number0 = $text[$number-1];

for ($j=0; $j<count($jour) ; $j++) {
$jour1 = $jour[$j];
$sql1 = "UPDATE nounou_dispon SET jourReserve = '1' WHERE id_i ='$number0' AND jourDispon='$jour1'";
$dbh->exec($sql1);
}

$sql2 = "INSERT INTO enregistrements (nameP,nameN,service) VALUES ('$name_u','$number0','service3')";
$dbh->exec($sql2);

echo "Vous avez choisi avec succès une nounou";
?>
