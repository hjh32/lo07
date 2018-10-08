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
print_r($prenom);

$sql1 = "UPDATE nounou_dispon SET bloque = '1' WHERE nom ='$nom' AND prenom='$prenom'";
$sql2 = "UPDATE info_nounou SET bloque = '1' WHERE nom ='$nom' AND prenom='$prenom'";
$dbh->exec($sql1);
$dbh->exec($sql2);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

