<?php
$name_u = $_GET["name_u"];

?>
<html>
  <head>
      <title>Service</title>
  </head>
  <body>
      <form method="post" action="serviceChoose.php">
        <label><h1>Quel service voulez-vous choisir?</h1></label>
        <input type="radio" name="service" value="service1"/>Garde ponctuelle<br/>
        <input type="radio" name="service" value="service2"/>Garde d'enfant en langues etrangeres<br/>
        <input type="radio" name="service" value="service3"/>Garde d'enfant reguliere (sorties d'ecole, de creche)<br/>
        <input type="radio" name="service" value="service4"/>Evaluation<br/>
        <p/>
        <input type="hidden" name=name_u value="<?php echo $name_u?>">
        <p/>
        <input type="submit" value="transmettre"/>
        <input type="reset" value="annuler"/>
      </form>
  </body>
</html>
