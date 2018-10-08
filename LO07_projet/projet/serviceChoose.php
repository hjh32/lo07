<?php
echo "Vous choisissez le ";
$service = $_POST["service"];
echo $service;
$name_u = $_POST["name_u"];


if ($service == "service1") {
?>
<html>
  <head>
      <title>Garde ponctuelle</title>
      <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
      <h1>Vous choisissez le service: Garde ponctuelle</h1>
      <form method="post" action="Garde ponctuelle.php">
        <label>Date:</label>
        <input type="text" name="date"><p/>
        <label>La plage horaire de la garde</label>
        <label>heureDebut</label>
        <input type="text" name="debut"><p/>
        <label>heureFin</label>
        <input type="text" name="fin"><p/>
        <label>Combien d'enfants?</label>
        <input type="text" name="number"><p/>
        <label>les enfants concernés(prenom)</label>
        <input type="text" name="enfant"><p/>
        <input type="hidden" name=name_u value="<?php echo $name_u?>">

        <input type="submit" value="confirmer"/>
        <input type="reset" value="anuuler"/>
      </form>
  </body>
</html>

<?php
}
elseif ($service == "service2") {
?>
<html>
  <head>
      <title>Garde d’enfant en langues étrangères</title>
  </head>
  <body>
      <h1>Vous choisissez le service: Garde d’enfant en langues étrangères</h1>
      <form method="post" action="service2.php">
        <input type="checkbox" name="langue[]" value="chinois"/>chinois
        <input type="checkbox" name="langue[]" value="arabe"/>arabe
        <input type="checkbox" name="langue[]" value="japonais"/>japonais
        <input type="checkbox" name="langue[]" value="italien"/>italien
        <input type="checkbox" name="langue[]" value="allemand"/>allemand
        <input type="checkbox" name="langue[]" value="portugais"/>portugais
        <input type="checkbox" name="langue[]" value="espagnol"/>espagnol
        <input type="checkbox" name="langue[]" value="anglais"/>anglais
        <input type="hidden" name=name_u value="<?php echo $name_u?>">

        <input type="submit" value="confirmer"/>
        <input type="reset" value="anuuler"/>
      </form>
  </body>
</html>
<?php
}
elseif ($service == "service3") {
?>
<html>
  <head>
      <title>Garde d’enfant régulière (sorties d’école, de crèche)</title>
  </head>
  <body>
      <h1>Vous choisissez le service: Garde d’enfant régulière (sorties d’école, de crèche)</h1>
      <form method="post" action="service3.php">
        <label>type:</label>
        <input type="checkbox" name="jour[]" value="lundi"/>lundi
        <input type="checkbox" name="jour[]" value="mardi"/>mardi
        <input type="checkbox" name="jour[]" value="mercredi"/>mercredi
        <input type="checkbox" name="jour[]" value="jeudi"/>jeudi
        <input type="checkbox" name="jour[]" value="vendredi"/>vendredi
        <input type="checkbox" name="jour[]" value="samedi"/>samedi
        <input type="checkbox" name="jour[]" value="dimanche"/>dimanche
        <p/>
        <label>heureDebut</label>
        <input type="number" name="debut"><br/>
        <p/>
        <label>heureFin</label>
        <input type="number" name="fin"><br/>
        <p/>
        <input type="hidden" name=name_u value="<?php echo $name_u?>">

        <input type="submit" value="confirmer"/>
        <input type="reset" value="anuuler"/>
      </form>
  </body>
</html>
<?php
}
elseif ($service == "service4") {
?>
  <html>
    <head>
        <title>Évaluation</title>
    </head>
    <body>
        <h1>Vous choisissez le service: Évaluation</h1>
        <form method="post" action="evaluation.php">
          <label><h2>La situation actuelle</h2></label><br/>
          <label>Combien d'enfants</label>
          <input type="number" name="enfant"><p/>
          <label>La plage horaire de la garde</label><br/><p/>
          <label>L’heure de début</label>
          <input type="text" name="debut"><p/>
          <label>L’heure de fin</label>
          <input type="text" name="fin"><p/>

          <label>Evaluation</label>
          <label>Note(entre 0 et 5 biberons)</label>
          <input type="number" name="number"><p/>
          <textarea name="textarea" rows="4" cols="50"></textarea><p/>

          <input type="hidden" name=name_u value="<?php echo $name_u?>">

          <input type="submit" value="confirmer"/>
          <input type="reset" value="anuuler"/>
        </form>
    </body>
  </html>
<?php
}
?>
