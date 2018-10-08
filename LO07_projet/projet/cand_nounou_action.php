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
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$ville = $_POST["ville"];
$email = $_POST["email"];
$portable = $_POST["portable"];
$langue = $_POST["langues"];
$age = $_POST["age"];
$exp = $_POST["experience"];
$present = $_POST["presentation"];

$target_dir = "img/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, the image ".basename( $_FILES["file"]["name"])." already exists.";
    $uploadOk = 0;
    echo "<br />";
}
// Check file size
if ($_FILES["file"]["size"] > 100000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    echo "<br />";
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    echo "<br />";
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    echo "<br />";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";echo "<br />";
    } else {
        echo "Sorry, there was an error uploading your file.";echo "<br />";
    }
    }






$image = $_FILES["file"]["name"];
//插入到info_nounou表中
global $langues;
$langues = '';
foreach ($langue as $key => $value) {
    $langues .= $value;
    $langues .= ' ';
}
print_r($langues);

$sql = "INSERT INTO info_nounou(nom,prenom,ville,email,portable,langue,age,experience,presentation,etat,bloque,name_u)
        VALUES ('$nom','$prenom','$ville','$email','$portable', '$langues', '$age', '$exp', '$present', 'cand', '0', '$name_u')";
$sqlstr = "insert into photo(name_u,photo) values ('$name_u','$image')";
$result = $dbh->exec($sql);
$result2 = $dbh->exec($sqlstr);

echo "Candidature réussie, veuillez attendre que l'administrateur accepte que vous deveniez nounou";
?>
