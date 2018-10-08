<html>
  <head>
      <title>Garde d’enfant en langues étrangères</title>
      <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
      <h1>Garde d’enfant en langues étrangères</h1>
      <table class="table">
      	<thead>
      		<tr>
              <th>nom</th>
              <th>prenom</th>
              <th>ville</th>
              <th>email</th>
              <th>portable</th>
              <th>langue</th>
              <th>age</th>
              <th>experience</th>
              <th>presentation</th>
              <th>evaluation</th>
              <th>jourDispon</th>
              <th>heureDebut</th>
              <th>heureFin</th>
              <th>jourReserve</th>
              <th>photo</th>
      		</tr>
      	</thead>
      	<tbody>
<?php
echo "Vous avez choisi： ";


$name_u = $_POST["name_u"];
$langues = array();
$langues = $_POST["langue"];
$op="";
foreach ($langues as $value)
{

$op.=$value;
$op.=" ";
}
echo $op;
echo "<br/>";

$user='root';
$pass='';
$dsn="mysql:host=localhost;dbname=projet_lo07";

try {
    $dbh = new PDO($dsn, $user, $pass);
    //echo "connect successfully<br/>";
} catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
}

$sql1 = "SELECT langue,name_u FROM info_nounou WHERE etat='inscrit' AND bloque!='1'";
$resultats = $dbh->query($sql1);


$nounou = array();
while($result = $resultats->fetch()){
  $lag = $result["langue"];
  $name = $result["name_u"];
  if (strpos($lag,$op) !== false) {
     $nounou[] = $name;
  }
}

foreach ($nounou as $key) {
  global $i;
  $sql3 = "SELECT id_i FROM nounou_inscrite WHERE '$key'=name_u";
  $resultats2 = $dbh->query($sql3);
  while($information2 = $resultats2->fetch()){
    global $id;
    $id = $information2["id_i"];
  }
  $sql6 = "SELECT COUNT(*) FROM nounou_dispon WHERE '$id'=id_i";
  $resultats5 = $dbh->query($sql6);
  while($information5 = $resultats5->fetch()){
    $i = $information5[0];
  }
for($a=1;$a<=$i;$a++) {
  $sql2 = "SELECT nom,prenom,ville,email,portable,langue,age,experience,presentation,evaluation FROM info_nounou WHERE '$key'=name_u";
  $resultats1 = $dbh->query($sql2);
  while($information = $resultats1->fetch()){
    ?>
        <tr>
          <td><?php echo $information[0] ?></td>
          <td><?php echo $information[1] ?></td>
          <td><?php echo $information[2] ?></td>
          <td><?php echo $information[3] ?></td>
          <td><?php echo $information[4] ?></td>
          <td><?php echo $information[5] ?></td>
          <td><?php echo $information[6] ?></td>
          <td><?php echo $information[7] ?></td>
          <td><?php echo $information[8] ?></td>
          <td><?php echo $information[9] ?></td>
    <?php
  }
  global $information3;
  $sql4 = "SELECT jourDispon,heureDebut,heureFin,jourReserve FROM nounou_dispon WHERE '$id'=id_i";
  $resultats3 = $dbh->query($sql4);
  for ($j=0; $j < $a; $j++) {
    $information3 = $resultats3->fetch();
  }
      if($information3["jourReserve"] == 0){
?>
        <td><?php echo $information3[0] ?></td>
        <td><?php echo $information3[1] ?></td>
        <td><?php echo $information3[2] ?></td>
<?php        if($information3[3]){
?>
          <td><?php echo "pas disponible"?></td>
<?php
        }
        else{
?>
          <td><?php echo "disponible"?></td>
<?php
        }
      }

  $sql5 = "SELECT photo FROM photo WHERE '$key'=name_u";
  $resultat4 = $dbh->query($sql5);
  while($information4 = $resultat4->fetch()){
    $imagename = "img/";
    $imagename.= "$information4[0]";
?>
      <td><img src="<?php echo $imagename ?>" ></td>
    </tr>
<?php
}
}
}
?>
</tbody>
</table>
      <form method="post" action="service5.php">
        <label>Pour chaque nounou, nous pensons que les nombres sont les mêmes. Choisir la nounou, quelle nounou avez-vous besoin? Commencez à partir d'un</label><P/>
        <input type="number" name="choose">
        <P/>

        <label>Pour cette nounou, quel jour avez-vous besoin?</label><P/>
        <input type="text" name="jour">
        <P/>

        <input type="hidden" name=name_u value="<?php echo $name_u?>">
        <?php
        for ($i=0; $i<count($nounou) ; $i++) {//nounou name_u
        ?>
        <input type="hidden" name=text[] value="<?php echo $nounou["$i"]?>">
        <?php
        }
        ?>

        <input type="submit" value="transmettre"/>
        <input type="reset" value="anuuler"/>
      </form>
  </body>
</html>
