<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modification mot de passe</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="formulaire">
        <form name="inscription" method="post" action="mod_mdp.php">
            <p>Veuillez saisir le nouveau mot de passe :</p>
            Mot de passe : <input type="password" name="password"/> <br/>
            Confirmation : <input type="password" name="password2"/><br/>
            <div class="button">
            <input type="submit" name="update" value="Confirmer"/>
            <input type="submit" name="cancel" value="Annuler"/>
            <div>
        </form>
        <div>
    <?php
        include("../connect.php");
        if(isset($_POST['update'])) {
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            if ($password!=$password2){

                echo '<script language="javascript">';
                echo 'alert("Les mot de passe ne se resemble pas!")';
                echo '</script>';
            }
            else{
                try{
                    $sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$_SESSION["pseudo"].'"';
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $result=$stmt->fetch();
                    if ($result>0){
                        $sql = 'UPDATE Utilisateur SET mot_de_passe="'.$password.'" WHERE identifiant="'.$_SESSION["pseudo"].'"';
                        $stmt = $conn->exec($sql); 
                        echo '<meta http-equiv="Refresh" content="0;URL=./index.php">';
                    }
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage()."<br/>";
                }
            }
        }
        if(isset($_POST['cancel'])) {
            echo '<meta http-equiv="Refresh" content="0;URL=./index.php">';
        }
        ?>
        </body>
</html>
