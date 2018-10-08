<?php
//工资是增加！！！！！！！！！！！！！
//第二个功能没写完
$user='root';
$pass='';
$dsn="mysql:host=localhost;dbname=projet_lo07";

try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
}
$debut = $_POST["debut"];
$fin = $_POST["fin"];
$number = $_POST["number"];
$text = $_POST["textarea"];
$enfant = $_POST["enfant"];
$name_parent = $_POST["name_u"];//父母号码

$sql0 = "SELECT nameN,service FROM enregistrements WHERE nameP='$name_parent'";
$result0 = $dbh->query($sql0);
global $nameService;
$nameNounou = array();
global $nameNounou;
$nameService = array();
while($ID0 = $result0->fetch()){
  $nameNounou[] = $ID0["nameN"];
  $nameService[] = $ID0["service"];
}

global $name_u;//nounou   id_i
global $service;//service号码

foreach ($nameNounou as $key0 ) {
$name_u = $key0;
}

foreach ($nameService as $key1 ) {
$service = $key1;
}


if ($service == "service1") {
  $time = ceil($fin-$debut);
  $revenu = $time*(7+4*($enfant-1));
  echo "Vous devez payer：";
  echo $revenu;
  echo("<br/>");


  global $revenu1;
  $sql6 = "SELECT revenu FROM nounou_inscrite WHERE '$name_u'=id_i";
  $resultat11 = $dbh->query($sql6);
  while($eva1 = $resultat11->fetch()){
    $revenu1 = $eva1["revenu"];
  }
  $revenu2 = (int)$revenu1 + (int)$revenu;
  $revenu3 = (string)$revenu2;
  $sql7 = "UPDATE nounou_inscrite SET revenu='$revenu3' WHERE '$name_u'=id_i";
  $dbh->exec($sql7);


  global $name_nounou;
  $sql8 = "SELECT name_u FROM nounou_inscrite WHERE '$name_u'=id_i";
  $resultat12 = $dbh->query($sql8);
  while($eva2 = $resultat12->fetch()){
    $name_nounou = $eva2["name_u"];
  }

  $sql9 = "UPDATE info_nounou SET revenu='$revenu3' WHERE '$name_nounou'=name_u";
  $dbh->exec($sql9);
}
elseif ($service == "service2") {
  $time = ceil($fin-$debut);
  $revenu = $time*$enfant*15;
  echo "Vous devez payer：";
  echo $revenu;
  echo("<br/>");

  global $revenu6;
  $sql6 = "SELECT revenu FROM nounou_inscrite WHERE '$name_u'=id_i";
  $resultat11 = $dbh->query($sql6);
  while($eva1 = $resultat11->fetch()){
    $revenu6 = $eva1["revenu"];
  }
  $revenu2 = (int)$revenu6 + (int)$revenu;
  $revenu3 = (string)$revenu2;
  $sql7 = "UPDATE nounou_inscrite SET revenu='$revenu3' WHERE '$name_u'=id_i";
  $dbh->exec($sql7);


  global $name_nounou1;
  $sql8 = "SELECT name_u FROM nounou_inscrite WHERE '$name_u'=id_i";
  $resultat12 = $dbh->query($sql8);
  while($eva2 = $resultat12->fetch()){
    $name_nounou1 = $eva2["name_u"];
  }

  $sql9 = "UPDATE info_nounou SET revenu='$revenu3' WHERE '$name_nounou1'=name_u";
  $dbh->exec($sql9);
}
elseif ($service == "service3") {
  $time = ceil($fin-$debut);
  $revenu = $time*(10+5*($enfant-1));
  echo "Vous devez payer：";
  echo $revenu;
  echo("<br/>");

  global $revenu7;
  $sql6 = "SELECT revenu FROM nounou_inscrite WHERE '$name_u'=id_i";
  $resultat11 = $dbh->query($sql6);
  while($eva1 = $resultat11->fetch()){
    $revenu7 = $eva1["revenu"];
  }
  $revenu2 = (int)$revenu7 + (int)$revenu;
  $revenu3 = (string)$revenu2;
  $sql7 = "UPDATE nounou_inscrite SET revenu='$revenu3' WHERE '$name_u'=id_i";
  $dbh->exec($sql7);


  global $name_nounou2;
  $sql8 = "SELECT name_u FROM nounou_inscrite WHERE '$name_u'=id_i";
  $resultat12 = $dbh->query($sql8);
  while($eva2 = $resultat12->fetch()){
    $name_nounou2 = $eva2["name_u"];
  }

  $sql9 = "UPDATE info_nounou SET revenu='$revenu3' WHERE '$name_nounou2'=name_u";
  $dbh->exec($sql9);
}



global $evaluation;
global $name_nounou3;

$sql11 = "SELECT name_u FROM nounou_inscrite WHERE '$name_u'=id_i";
$resultat13 = $dbh->query($sql11);
while($eva3 = $resultat13->fetch()){
  $name_nounou3 = $eva3["name_u"];
}

$sql12 = "SELECT evaluation FROM info_nounou WHERE '$name_nounou3'=name_u";
$resultat14 = $dbh->query($sql12);

while($eva4 = $resultat14->fetch()){
  $evaluation = $eva4["evaluation"];
}

$evaluation.="     ";
$evaluation.=$number;
$evaluation.=" ";
$evaluation.=$text;

$sql2 = "UPDATE info_nounou SET evaluation = '$evaluation' WHERE '$name_nounou3'=name_u";
$dbh->exec($sql2);
?>
