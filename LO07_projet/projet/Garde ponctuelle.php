<?php
error_reporting(0);
  $user='root';
  $pass='';
  $dsn="mysql:host=localhost;dbname=projet_lo07";

  try {
      $dbh = new PDO($dsn, $user, $pass);
      } catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
      }

  $date = $_POST["date"];
  $enfant = $_POST["enfant"];
  $debut = $_POST["debut"];
  $fin = $_POST["fin"];
  $name_u = $_POST["name_u"];
  $sql1 = "SELECT id_nd,jourDispon,heureDebut,heureFin,jourReserve,id_i FROM nounou_dispon WHERE '1'!=bloque";
  $resultat = $dbh->query($sql1);
  $nounou = array();
  while($ID2 = $resultat->fetch()){
      $id_i = $ID2["id_i"];
      $id_nd = $ID2["id_nd"];
      $jourDispon = $ID2["jourDispon"];
      $heureDebut = $ID2["heureDebut"];
      $heureFin = $ID2["heureFin"];
      $jourReserve = $ID2["jourReserve"];
      if (($date == $jourDispon)and($debut >= $heureDebut)and($fin <= $heureFin)and($jourReserve == 0)) {
        $nounou[] = $id_i;

      }
  }
?>
<html>
  <head>
      <title>Garde ponctuelle</title>
      <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
      <h1>Les nounous disponibles</h1>
      <form method="post" action="service1.php">
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
          for ($i=0; $i<count($nounou); $i++) {
            $ID4 = $nounou[$i];
            $sql2 = "SELECT name_u FROM nounou_inscrite WHERE '$ID4'=id_i";
            $resultat2 = $dbh->query($sql2);
            while($information1 = $resultat2->fetch()){
              global $nameuser;
              $nameuser = $information1["name_u"];
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
        <input type="hidden" name=date value="<?php echo $date?>">
        <?php
        for ($i=0; $i<count($nounou) ; $i++) {

        ?>
        <input type="hidden" name=text[] value="<?php echo $nounou[$i]?>">
        <?php
        }
        ?>

        <input type="submit" value="transmettre"/>
        <input type="reset" value="anuuler"/>
      </form>
  </body>
</html>
