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
        
        $q = $_GET['fullname'];
        $result = explode(" ", $q);
        $nom = $result[1];
        $prenom = $result[0];
        //更新info_nounou的etat
        $sql = "UPDATE info_nounou SET etat = 'inscrit' WHERE nom = '$nom' and prenom='$prenom'";
        $nb_row = $dbh->exec($sql);
        
        //加入nounou_inscrite表
        $sql2 = "select name_u from `info_nounou` where nom='$nom' and prenom='$prenom'";       
        $row = $dbh->query($sql2);
        $row = $row->fetchAll();
        
        $name_u = $row[0]['name_u'];
        $sql3 = "INSERT INTO `nounou_inscrite` (`nom`, `prenom`, `name_u`) VALUES ('$nom', '$prenom', '$name_u')";
        
        $result2 = $dbh->exec($sql3);
        
        echo "$nb_row";
        echo $result2;
        ?>
    </body>
</html>
