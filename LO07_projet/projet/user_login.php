<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if($_POST['username'] == 'admin' && $_POST['pwd'] == 'secret'){
    header("location:administrateur.php");
}else{   
    $dbms='mysql';     
    $host='localhost'; 
    $dbName='projet_lo07';    
    $user='root';     
    $pass='';       
    $dsn="$dbms:host=$host;dbname=$dbName";

    try {
        $dbh = new PDO($dsn, $user, $pass); 

        $isuser = 0;
        $isnounou = 0;
        $isparent = 0;
        $type;
        
        //user登录
        foreach ($dbh->query('SELECT name,password,type from users') as $row) {          
            if($row['name'] == $_POST['username'] && $row['password'] == $_POST['pwd']){
                echo 'Connexion réussie';
                echo '<br>';
                $isuser = 1;
                if($row['type'] == 'nounou'){
                    $type = 'nounou';
                }else if($row['type'] == 'parent'){
                    $type = 'parent';
                }
                break;
            }else{
                continue;
            }           
        } 
        
        if(!$isuser){
            echo 'Connexion échouée, inscrire svp';
            //header("location:inscrire.html"); 
        }else{          
            if($type == 'nounou'){     //nounou登录
                foreach ($dbh->query('SELECT name_u, etat from info_nounou') as $row){
                    if($row['name_u'] == $_POST['username']){                        
                        echo 'vous êtes une nounou';
                        echo '<br>';
                        $isnounou = 1; 
                        if($row['etat'] == 'cand'){
                            echo "Vous n'êtes pas encore inscrite";
                        } else {
                            echo 'Vous êtes une nounou inscrite';
                            $name_u = $row['name_u'];
                            header("location: nounou_main.php?name_u=$name_u");
                        }
                        break;
                    }else{
                        continue;
                    }                              
                }               
                if(!$isnounou){      //user登录了但没申请nounou
                    $name_u = $_POST['username'];
                    header("location:cand_nounou.php?name_u=$name_u");//跳转到candidat_nounou
                }
            }elseif ($type == 'parent') {     //parent登录
                foreach ($dbh->query('SELECT name_u from parent') as $row){
                    if($row['name_u'] == $_POST['username']){
                        echo '<p>vous etes un parent</p>';
                        $isparent = 1;
                        header("location: serviceParent.php?name_u=$name_u");
                        break;
                    }else{
                        continue;
                    }                              
                }
                if(!$isparent){    //parent登录了但没填信息
                    $name_u = $_POST['username'];
                    header("location:parent.php?name_u=$name_u");
                }
            }          
        }                            
    } catch (PDOException $e) {
        die ("Error!: " . $e->getMessage() . "<br/>");
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
    </body>
</html>
