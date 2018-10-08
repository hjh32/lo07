<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$dbms='mysql';     
$host='localhost'; 
$dbName='projet_lo07';    
$user='root';     
$pass='';       
$dsn="$dbms:host=$host;dbname=$dbName";
    
try {
    $dbh = new PDO($dsn, $user, $pass); 
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">  
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function info_nounou(){
                var options = $('#nounou_cand option:selected');
                var text = options.text();
                $.get("info_nounou.php?fullname="+text, function(result){
                    $('#info').html(result);
                });
            }
            function info_nounou2(){
                var options = $('#nounou_inscrit option:selected');
                var text = options.text();
                $.get("info_nounou.php?fullname="+text, function(result){
                    $('#info').html(result);
                });
            }
            function change_etat(){
                var options = $('#nounou_cand option:selected');
                var text = options.text();
                $.get("change_etat.php?fullname="+text, function(result){
                    $('#changeEtat').html(result);
                });
                alert("L'etat est changé");
            }
            function bloquer(){
                var options = $('#nounou_inscrit option:selected');
                var text = options.text();
                $.get("bloquer.php?fullname="+text, function(result){
                    $('#bloque').html(result);
                });
                alert("Bloque");
            }
            function debloquer(){
                var options = $('#nounou_inscrit option:selected');
                var text = options.text();
                $.get("debloquer.php?fullname="+text, function(result){
                    $('#debloque').html(result);
                });
                alert("Debloque");
            }
        </script>
    </head>
    <body>
        <?php
        //Nombre de candidatures de nounous
        $sql1 = "select count(*) as nb_cand from `info_nounou` where etat='cand'";
        $result1 = $dbh->query($sql1);
        $result1 = $result1->fetchAll();
        echo('Nombre de candidatures de nounous:'.$result1[0][0].'<br>');
        
        //nombre de nounous inscrites
        $sql2 = "select count(*) as nb_cand from `info_nounou` where etat='inscrit'";
        $result2 = $dbh->query($sql2);
        $result2 = $result2->fetchAll();
        echo('Nombre de nounous inscrites:'.$result2[0][0].'<br><br>');
        
        $sql3 = "select nom, prenom from `info_nounou` where etat='cand'";
        $result3 = $dbh->query($sql3);
        $result3 = $result3->fetchAll();       
        
        $sql4 = "select nom, prenom from `info_nounou` where etat='inscrit'";
        $result4 = $dbh->query($sql4);
        $result4 = $result4->fetchAll();
        
        echo '<div style="width: 30%">';
            echo "<form role='form'>";
            echo "<div class='form-group'>";
                echo "<label for='nounou_cand'>Liste des nounous candidates:</label>";
                echo ("<select id='nounou_cand' name='nounou_cand' class='form-control'>");
                    foreach ($result3 as $key => $value){
                        printf("<option>%s</option>", $result3[$key]['prenom'].' '.$result3[$key]['nom']);
                    }
                echo("</select>");
            echo "</div>";
            echo "</form>";           
        echo '</div>';              
        ?>       
        <button type='button' class="btn btn-primary" onclick='info_nounou()'>Voir son information</button>
        <button type="button" id="inscrit" class="btn btn-success" onclick="change_etat()">Changer état à 'inscrit'(Accepter)</button>
        
        <?php
        echo '<div style="width:30%">';
            echo "<form role='form'>";
            echo "<div class='form-group'>";
                echo "<label for='nounou_inscrit'>Liste des nounous inscrites:</label>";
                echo ("<select id='nounou_inscrit' name='nounou_inscrit' class='form-control'>");
                    foreach ($result4 as $key => $value){
                        printf("<option>%s</option>", $result4[$key]['prenom'].' '.$result4[$key]['nom']);
                    }
                echo("</select>");
            echo "</div>";
            echo "</form>";
        echo '</div>';              
        ?>       
        <button type='button' class="btn btn-primary" onclick='info_nounou2()'>Voir son information</button>
        <button type="button" id="bloquer" class="btn btn-success" onclick="bloquer()">Bloquer</button>
        <button type="button" id="debloquer" class="btn btn-fail" onclick="debloquer()">Debloquer</button>
        
        <div id='info'></div>
        
        <p id="changeEtat"></p>
        <p id="bloque"></p>
        <p id="debloque"></p>
        
    </body>
</html>
