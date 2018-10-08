<?php
$name_u = $_GET["name_u"];
?>
<html>
  <head>
      <title>Inscription</title>
  </head>
  <body>
      <h1>Inscription</h1>
      <form method="post" action="parent_Inscrire.php">
        <label>Nom de famille</label>
        <input type="text" name="nom"><p/>
        <label>Ville</label>
        <input type="text" name="ville"><p/>
        <label>Email</label>
        <input type="email" name="email"><p/>
        <label>Liste des enfants avec leur prenom, date de naissance, restrictions alimentaires</label>
        <p/>
        <ul>
            <li><label>prenom</label><input type="text" name="prenom"></li>
            <li><label>date de naissance</label><input type="date" name="naissance"></li>
            <li><label>restrictions alimentaires</label><input type="text" name="alimentaires"></li>
        </ul>
        <p/>
        <label>Information generale</label><p/>
        <textarea name="textarea" rows="4" cols="50"></textarea>
        <p/>
        <input type="hidden" name=name_u value="<?php echo $name_u?>">
        <input type="submit" value="transmettre"/>
        <input type="reset" value="anuuler"/>
      </form>
  </body>
</html>
