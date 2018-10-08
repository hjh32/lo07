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
            echo "connect successfully<br/>";
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }

        $name = $_POST["username"];
        $password = $_POST["pwd"];
        $type = $_POST["type"];
        $sql = "INSERT INTO `users` (`name`, `password`, `type`) VALUES ('$name', '$password', '$type')";
        $result = $dbh->exec($sql);       
        echo 'inscrire successfully';       
        ?>
        
        <button type='button' onclick="location.href='user_login.html'">login</button>
    </body>
</html>
