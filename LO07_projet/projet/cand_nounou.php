<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$name_u = $_GET['name_u'];

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo ("<form name='form' method='post' action='cand_nounou_action.php?name_u=$name_u' enctype='multipart/form-data'>");
        ?>
            <p>nom: <input type="text" name="nom" id="nom"></p>
            <br>
            <p>prénom: <input type="text" name="prenom" id="prenom"></p>
            <br>
            <p>ville: <input type="text" name="ville" id="ville"></p>
            <br>
            <p>email: <input type="text" name="email" id="email"></p>
            <br>
            <p>portable: <input type="text" name="portable" id="portable"></p>
            <br>
            <p>langue:
                <label class="checkbox-inline">
                    <input type="checkbox"  name="langues[]" value="chinois">chinois
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="langues[]" value="arabe">arabe
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="langues[]" value="japonais">japonais
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="langues[]" value="italien">italien
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="langues[]" value="allemand">allemand
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="langues[]" value="portugais">portugais
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="langues[]" value="espagnol">espagnol
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" name="langues[]" value="anglais">anglais
                </label>
            </p>
            <p>age: <input type="text" name="age" id="age"></p>
            <br>
            expérience:
            <textarea cols="10" rows="5" name="experience">  </textarea>
            <br>
            Une phrase de présentation:
            <textarea cols="10" rows="3" name="presentation">  </textarea>
            <br>
            Votre photo: <input class="form-control" type="file" name="file">
            <input type="submit" name="submit" value="login" id="submit">
        </form>
    </body>
</html>
