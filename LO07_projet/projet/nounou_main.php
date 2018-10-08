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
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>          
            function showDispon(){
                var name_u = document.getElementById("input1").value;
                $.get("nounou_main_action.php?name_u="+name_u, function(result){
                    $('#showDispon').html(result);                    
                });
                $.get("nounou_main_action_reserve.php?name_u="+name_u, function(result){
                    $('#showReserve').html(result);
                });  
            }           
        </script>
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
        $name_u = $_GET['name_u'];
        echo "bienvenue $name_u !";
        // put your code here
        ?>
        
        <div>           
            <button type='button' class="btn btn-primary" onclick="location.href='choisir_dispo.html'">choisir disponibilité</button>
            <button type='button' class="btn btn-primary" onclick="showDispon()">montrer disponibilite</button>
            <?php
            echo "<input id='input1' type='text' hidden='hidden' value='$name_u'>";
            ?>
        </div>
        
        <p>votre temps disponibles sont:</p>
        <div id="showDispon" style="color: green"></div>       
        <p>votre temps reserves sont:</p>           
        <div id="showReserve" style="color: red">           
        </div>
        
        
    </body>
</html>
