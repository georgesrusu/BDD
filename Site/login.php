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
            Mot de passe : <input type="password" name="password"/><br/>
            <div class="button">
            <input type="submit" name="connexion" value="Connexion"/>
            <input type="submit" name="register" value="Enregistrer"/>
            <div>
        </form>
        <div>

        <?php
        include("../connect.php");
        if(isset($_POST['connexion'])){
            $pseudo=$_POST['identifiant'];
            $password=$_POST['password'];

            if (empty($pseudo) or empty($password)) {
                echo '<script language="javascript">';
                echo 'alert("Il manque quelque chose!")';
                echo '</script>';
            }
            else {
                try{
                    $sql = 'SELECT ID,isAdmin FROM Utilisateur WHERE identifiant="'.$pseudo.'" AND mot_de_passe="'.$password.'"';
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $result=$stmt->fetch();
                    if ($result==""){
                        echo '<script language="javascript">';
                        echo 'alert("Il ya une erreur quelque part!")';
                        echo '</script>';
                    }
                    $clientID=$result[0];
                    $isAdmin=$result[1];
                    if ($clientID>0){
                        echo '<meta http-equiv="Refresh" content="0;URL=./index.php?pseudo='.$pseudo.'&isAdmin='.$isAdmin.'&action=login">';
                    }
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage()."<br/>";
                }
            }
        }
        elseif(isset($_POST['register'])) {
            $pseudo = $_POST['identifiant'];
            $password = $_POST['password'];
            echo '<meta http-equiv="Refresh" content="0;URL=./create_account.php">';
        }
        ?></body>
</html>
