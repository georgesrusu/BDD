<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modification email</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="formulaire">
        <form name="inscription" method="post" action="mod_email.php">
            <p>Veuillez saisir le nouveau email :</p>
            email : <input type="email" name="email"/> <br/>
            Confirmation : <input type="email" name="email2"/><br/>
            <div class="button">
            <input type="submit" name="update" value="Confirmer"/>
            <input type="submit" name="cancel" value="Annuler"/>
            <div>
        </form>
        <div>
    <?php
        include("../connect.php");
        if(isset($_POST['update'])) {
            $email = $_POST['email'];
            $email2 = $_POST['email2'];
            if ($email!=$email2){

                echo '<script language="javascript">';
                echo 'alert("Email not matching!")';
                echo '</script>';
            }
            else{
                try{
                    $sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$_SESSION["pseudo"].'"';
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $result=$stmt->fetch();
                    if ($result>0){
                        $sql = 'UPDATE Utilisateur SET email="'.$email.'" WHERE identifiant="'.$_SESSION["pseudo"].'"';
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
