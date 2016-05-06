<html>
    <head>
        <title>Creation compte</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="formulaire">
        <form name="inscription" method="post" action="create_account.php">
            Identifiant : <input type="text" name="identifiant"/> <br/>
            Password : <input type="password" name="password"/><br/>
            email : <input type="email" name="email"/> <br/>    
            <div class="button">
                <input type="submit" name="register" value="Register"/>
            <div>
        </form>
        <div>
        <?php
        include("../connect.php");
        $date=date("Y-m-d");
        if(isset($_POST['register'])) {
            $pseudo = $_POST['identifiant'];
            $password = $_POST['password'];
            $email=$_POST['email'];

            if (empty($pseudo) or empty($password) or empty($email)) {
                echo '<script language="javascript">';
                echo 'alert("login, password or email empty !")';
                echo '</script>';
            }
            else {

                try{
                    $sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$pseudo.'"';
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $result=$stmt->fetch();
                    if ($result>0){
                        echo '<script language="javascript">';
                        echo 'alert("login exist !")';
                        echo '</script>';
                    }
                    else{
                    $sql = 'INSERT INTO Utilisateur (identifiant,mot_de_passe,email,dateCreation) VALUES ("'.$pseudo.'","'.$password.'","'.$email.'","'.$date.'")';
                    $conn->exec($sql);
                    $sql = 'SELECT ID,isAdmin FROM Utilisateur WHERE identifiant="'.$pseudo.'" AND mot_de_passe="'.$password.'"';
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $result=$stmt->fetch();
                    if ($result==""){
                        echo '<script language="javascript">';
                        echo 'alert("Something went wrong. We are sorry. Please try again later.")';
                        echo '</script>';
                        }
                    $clientID=$result[0];
                    $isAdmin=$result[1];
                    echo '<meta http-equiv="Refresh" content="0;URL=./index.php?pseudo='.$pseudo.'&isAdmin='.$isAdmin.'&action=added">';
                }}
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage()."<br/>";
                    }
                }
            }
        ?>
    </body>
</html>