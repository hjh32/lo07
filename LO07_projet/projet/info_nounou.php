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
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">         
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
        $sql = "select ville, email, portable, langue, age, experience, presentation,"
                . " evaluation, revenu from `info_nounou` where nom='$nom' and prenom='$prenom'";
        $row = $dbh->query($sql);
        $row = $row->fetchAll();
        $info = $row[0];     
        
        echo "<table class='table' style='width: 70%'>";
        echo '<caption>Information de nounou candidate vous choisissez:</caption>';
            echo "<thead>";
            echo "<tr>";
                echo "<th>Nom</th>";
                echo "<th>Prénom</th>";
                echo "<th>Ville</th>";
                echo "<th>Email</th>";
                echo "<th>Portable</th>";
                echo "<th>Langue</th>";
                echo "<th>Age</th>";
                echo "<th>Expérience</th>";
                echo "<th>Présentation</th>";
                echo "<th>Evaluation</th>";
                echo "<th>Revenue</th>";
            echo "</tr>";
            echo "</thead>";
            
            echo "<tbody>";
            echo "<tr>";
                echo "<th>$result[1]</th>";
                echo "<th>$result[0]</th>";                              
                echo "<th>$info[0]</th>";
                echo "<th>$info[1]</th>";
                echo "<th>$info[2]</th>";
                echo "<th>$info[3]</th>";
                echo "<th>$info[4]</th>";
                echo "<th>$info[5]</th>";
                echo "<th>$info[6]</th>";
                echo "<th>$info[7]</th>";
                echo "<th>$info[8]</th>";
            echo "</tr>";
            echo "</tbody>";
        echo "</table>";                 
        ?>
        
    </body>
</html>
