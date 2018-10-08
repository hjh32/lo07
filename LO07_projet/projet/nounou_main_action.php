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
        <script>
         
        </script>
    </head>
    <body>
        <?php
        $name_u = $_GET['name_u'];        
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
        
        $sql = "select id_i from `nounou_inscrite` where name_u='$name_u'";       
        $row = $dbh->query($sql);
        $row = $row->fetchAll();
        $id_i = $row[0]['id_i'];
                
        $sql2 = "select jourDispon,heureDebut,heureFin,jourReserve from `nounou_dispon` where id_i=$id_i";
        $row = $dbh->query($sql2);
        $row = $row->fetchAll();
        
        foreach ($row as $key => $value) {
            if($value['jourReserve'] == 0){
                printf("<p>%s de %s à %s</p>", $value['jourDispon'],$value['heureDebut'],$value['heureFin']);
            }
        }                             
        ?>
    </body>
</html>
