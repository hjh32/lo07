<html>
  <head>
      <title>Garde d’enfant régulière</title>
      <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
      <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
      <h1>Les nounous disponibles</h1>
<?php
error_reporting(0);
echo "Vous avez choisi： ";
echo "<br/>";
$name_u = $_POST["name_u"];
$jour = array();
$jour = $_POST["jour"];
$op = "";
$combien = 0;
foreach ($jour as $value)
{
echo "<br/>";
$op.=$value;
$op.=" ";
$combien++;
}
echo $op;
echo "<br/>";

$heureDebut = $_POST["debut"];
echo $heureDebut;
echo "<br/>";
$heureFin = $_POST["fin"];
echo $heureFin;
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

$sql1 = "SELECT jourDispon,heureDebut,heureFin,jourReserve,id_i FROM nounou_dispon WHERE bloque!='1'";
$resultats100 = $dbh->query($sql1);
global $nounou1;
$nounou1 = array();
global $nounou2;
$nounou2 = array();

while($result100 = $resultats100->fetch()){
  $jourDispon = $result100["jourDispon"];
  $heureDebut2 = $result100["heureDebut"];
  $heureFin2 = $result100["heureFin"];
  $jourReserve = $result100["jourReserve"];
  $id_i2 = $result100["id_i"];
  if (($heureDebut2<=$heureDebut)and($heureFin2>=$heureFin)and($jourReserve==0)and(strpos($op,$jourDispon)!==false)) {
     $nounou1[] = $id_i2;
  }
}

$nounou_time = array();
foreach ($nounou1 as $key10) {
    $b = (int)$nounou_time["$key10"];
    $a = "1";
    $b = $b + (int)$a;
    $nounou_time["$key10"] = (string)$b;
}
foreach ($nounou_time as $key8=> $value8) {
    if ($value8 == $combien) {
      $nounou2[] = $key8;
    }
}
?>
        <form method="post" action="service0.php">
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
                  <th>photo</th>
          		</tr>
          	</thead>
          	<tbody>
          <?php
            for ($i=0; $i <count($nounou2); $i++) {
              $ID4 = $nounou2[$i];
              $sql0 = "SELECT name_u FROM nounou_inscrite WHERE '$ID4'=id_i";
              $resultat0 = $dbh->query($sql0);
              while($information0 = $resultat0->fetch()){
                global $nameuser;
                $nameuser = $information0["name_u"];
              }

              $sql3 = "SELECT nom,prenom,ville,email,portable,langue,age,experience,presentation,evaluation FROM info_nounou WHERE '$nameuser'=name_u";
              $resultat3 = $dbh->query($sql3);
              while($information2 = $resultat3->fetch()){
            ?>
            <tr>
              <td><?php echo $information2[0] ?></td>
              <td><?php echo $information2[1] ?></td>
              <td><?php echo $information2[2] ?></td>
              <td><?php echo $information2[3] ?></td>
              <td><?php echo $information2[4] ?></td>
              <td><?php echo $information2[5] ?></td>
              <td><?php echo $information2[6] ?></td>
              <td><?php echo $information2[7] ?></td>
              <td><?php echo $information2[8] ?></td>
              <td><?php echo $information2[9] ?></td>
            <?php
              }
              $sql4 = "SELECT photo FROM photo WHERE '$nameuser'=name_u";
              $resultat4 = $dbh->query($sql4);
              while($information3 = $resultat4->fetch()){
                   $imagename = "img/";
                   $imagename.= "$information3[0]";
                  ?>
                  <td><img src="<?php echo $imagename ?>"></td>
                  </tr>
              <?php
            }
            }
          ?>
            </tbody>
          </table>
          <label>Quelle nounou avez-vous besoin? Commencez à partir d'un </label>
          <input type="number" name="choose">
          <input type="hidden" name=name_u value="<?php echo $name_u?>">

          <?php
          for ($i=0; $i<count($nounou2) ; $i++) {
          ?>
          <input type="hidden" name=text[] value="<?php echo $nounou2["$i"]?>">
          <?php
          }
          ?>
          <?php
          for ($j=0; $j<count($jour) ; $j++) {
          ?>
          <input type="hidden" name=jour[] value="<?php echo $jour["$j"]?>">
          <?php
          }
          ?>
          <input type="submit" value="transmettre"/>
          <input type="reset" value="anuuler"/>
        </form>
    </body>
</html>
