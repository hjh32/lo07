<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        
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
        
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $sql = "select id_i from `nounou_inscrite` where nom='$nom' and prenom='$prenom'";       
        $row = $dbh->query($sql);
        $row = $row->fetchAll();
        $id_i = $row[0]['id_i'];
        
        if (!array_key_exists("jours",$_GET)){
            $jours = $_GET["jour"];
            $debut = $_GET["heureDebut"];
            $fin = $_GET["heureFin"];         
            
            if($jours == 'Tous les jours'){
                $semaineArr = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                foreach ($semaineArr as $value) {
                    $sql = "INSERT INTO `nounou_dispon` (`nom`, `prenom`, `jourDispon`, `heureDebut`, `heureFin`, `id_i`, `bloque`) VALUES ('$nom', '$prenom', '$value', '$debut', '$fin', '$id_i', '0')";                   
                    $result = $dbh->exec($sql);                   
                }               
            }elseif($jours == 'Tous les jours travaillés') {
                $semaineArr = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi'];
                foreach ($semaineArr as $value) {
                    $sql = "INSERT INTO `nounou_dispon` (`nom`, `prenom`, `jourDispon`, `heureDebut`, `heureFin`, `id_i`, `bloque`) VALUES ('$nom', '$prenom', '$value', '$debut', '$fin', '$id_i', '0')";
                    $result = $dbh->exec($sql);                   
                }
            }                        
            echo 'Vous avez choisi la disponibilité avec succès!';
            echo "les jours: $jours";
            echo "le temps: de $debut a $fin";
        }else{

            $jour='';
            foreach ($_GET['jours'] as $key => $value) {                          
                if($value == 'lundi'){
                    $debut = $_GET['debuts'][0]; //10
                    $fin = $_GET['fins'][0];
                }elseif($value == 'mardi'){
                    $debut = $_GET['debuts'][1]; //10
                    $fin = $_GET['fins'][1]; //12
                }elseif($value == 'mercredi'){
                    $debut = $_GET['debuts'][2]; //10
                    $fin = $_GET['fins'][2];
                }elseif($value == 'jeudi'){
                    $debut = $_GET['debuts'][3]; //14
                    $fin = $_GET['fins'][3];  //16
                }elseif ($value == 'vendredi') {
                    $debut = $_GET['debuts'][4]; //14
                    $fin = $_GET['fins'][4];
                }elseif($value == 'samedi') {
                    $debut = $_GET['debuts'][5]; //14
                    $fin = $_GET['fins'][5];
                }elseif ($value == 'dimanche') {
                    $debut = $_GET['debuts'][6]; //14
                    $fin = $_GET['fins'][6];
                }              
                $sql = "select id_i from `nounou_inscrite` where nom='$nom' and prenom='$prenom'";       
                $row = $dbh->query($sql);
                $row = $row->fetchAll();
                $id_i = $row[0]['id_i'];
                
                $sql2 = "INSERT INTO `nounou_dispon` (`nom`, `prenom`, `jourDispon`, `heureDebut`, `heureFin`, `id_i`, `bloque`) VALUES ('$nom', '$prenom', '$value', '$debut', '$fin', '$id_i', '0')";
                $result = $dbh->exec($sql2);
            }
                echo 'Vous avez choisi la disponibilité avec succès!';
                echo "Vous avez choisi:";
                $sql3 = "select jourDispon,heureDebut,heureFin from `nounou_dispon` where nom='$nom' and prenom='$prenom'";
                $row = $dbh->query($sql3);
                $row = $row->fetchAll();
                foreach ($row as $key => $value) {
                    $jourDispon = $row[$key]['jourDispon'];
                    echo '<br>';
                    $heureDebut2 = $row[$key]['heureDebut'];
                    $heureFin2 = $row[$key]['heureFin'];
                    echo "$jourDispon ";
                    echo "de $heureDebut2 à $heureFin2";
                }
        }       
        ?>
    </body>
</html>
