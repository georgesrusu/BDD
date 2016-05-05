<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="formulaire">
        <form name="inscription" method="post" action="login.php">
            Identifiant : <input type="text" name="identifiant"/> <br/>
            Password : <input type="password" name="password"/><br/>
            <div class="button">
            <input type="submit" name="connexion" value="Connexion"/>
            <input type="submit" name="register" value="Register"/>
            <div>
        </form>
        <div>

        <?php
        if(isset($_POST['connexion'])){
            $pseudo=$_POST['identifiant'];
            $password=$_POST['password'];
            echo "Connexion de $pseudo avec le password : $password";

            if (empty($pseudo) or empty($password)) {
                echo '<script language="javascript">';
                echo 'alert("Identifiant or password empty !")';
                echo '</script>';
            }
            else {
                #TODO: QUERY BDD et verifier admin
                if ($pseudo == "Max") {
                    echo "<br/>Ouverture de l'index admin<br/>";
                    echo '<meta http-equiv="Refresh" content="0;URL=adminIndex.php">';            
                }
                else {
                    echo '<meta http-equiv="Refresh" content="0;URL=index.php">';       
                }
            }
        }

        #TODO: QUERY creation de compte
        if(isset($_POST['register'])) {
            $pseudo = $_POST['identifiant'];
            $password = $_POST['password'];
            echo "Création du compte $pseudo avec le password : $password";
        }
        ?>
    </body>
</html>
