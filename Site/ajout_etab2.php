<?php
session_start();
include("../connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Skeleton 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130902

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajouter un etablissement</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
</head>
<body>
<div id="page" class="container">
	<div id="header">
		<div id="logo">
			<img src="" alt="" />
			<h1><a href="#">Eureka</a></h1>
			<span>Created for <a href="https://www.ulb.ac.be" rel="nofollow">ULB Project</a></span>
		</div>
		<div id="menu">
			<ul>
				<li><a href="./index.php" accesskey="1" title="">Homepage</a></li>
				<li><a href="./search.php" accesskey="2" title="Type here to research something">Research</a></li>
				<li class="current_page_item"><?php
				if(isset($_SESSION['pseudo'])) {
					//$pseudo = $_GET['pseudo'];
					echo '<a href="./profile.php" accesskey="3" title="Connexion to our database">';
					echo "Profil";
				}
				else{
					echo '<a href="./login.php" accesskey="3" title="Connexion to our database">';
					echo "Connexion";
				}
				 ?></a></li>
                <li><a href="./requetePage.php" accesskey="4" >Request</a></li>
			</ul>
		</div>
	</div>
	<div id="main">
		<div id="banner">
			<img src="" alt="" class="image-full" />
		</div>
		<div id="profile">
			<div class="title">
			</div>

			<?php echo "<h2>Ajouter un etablissement</h2>";?>
			<br/>

		</div>
		<p>
		<div class="formulaire">
        <form name="etablissement" method="post" action="ajout_etab2.php?">
        	<?php
        	if (!isset($_SESSION['table'])){
           		$_SESSION['table']=unserialize(urldecode($_GET['param']));
        	}
        	if(isset($_SESSION['table'])){
    			$table= $_SESSION['table'];
        		$name=$table[0];
    			$street=$table[1];
    			$num=$table[2];
    			$zip=$table[3];
    			$city=$table[4];
    			$longitude=$table[5];
    			$latitude=$table[6];
    			$tel=$table[7];
    			$site=$table[8];
    			$type=$table[9];
    	}
        	if ($type=="Restaurant"){
            	echo ' Prix : <input type="number" min="0" name="price"/> <br/>';
            	echo ' Nombre de place pour un Banquet : <input type="number" min="0" name="banquet"/> <br/>';
            	echo ' Emporter : ';
            	echo '<input type="radio" name="takeAway" value="1" checked> Oui';
            	echo '<input type="radio" name="takeAway" value="0" checked> Non<br>';
            	echo ' Livraison : ';
            	echo '<input type="radio" name="delivery" value="1" checked> Oui';
            	echo '<input type="radio" name="delivery" value="0" checked> Non<br>';
               
                echo '<p> Ouverture : </p>';
                echo "<table class=\"tableH\" border=\"0\" style=\"width:100%\">";
                echo '<tr><td>Lundi : </td>';
                echo '<td><input type="radio" name="lundi" value="0" checked> Toute la journée</td>';
                echo '<td><input type="radio" name="lundi" value="1" checked> Fermé toute la journée</td>';
                echo '<td><input type="radio" name="lundi" value="3" checked> Matin</td>';
                echo '<td><input type="radio" name="lundi" value="2" checked> Après-midi</td></br>';
                echo "</tr>";

                echo '<tr><td>Mardi : </td>';
                echo '<td><input type="radio" name="mardi" value="0" checked> Toute la journée</td>';
                echo '<td><input type="radio" name="mardi" value="1" checked> Fermé toute la journée</td>';
                echo '<td><input type="radio" name="mardi" value="3" checked> Matin</td>';
                echo '<td><input type="radio" name="mardi" value="2" checked> Après-midi</td></br>';
                echo '</tr>';

                echo '<tr><td>Mercredi</td>';
                echo '<td><input type="radio" name="mercredi" value="0" checked> Toute la journée</td>';
                echo '<td><input type="radio" name="mercredi" value="1" checked> Fermé toute la journée</td>';
                echo '<td><input type="radio" name="mercredi" value="3" checked> Matin</td>';
                echo '<td><input type="radio" name="mercredi" value="2" checked> Après-midi</td></br>';
                echo '</tr>';

                echo '<tr><td>Jeudi : </td>';
                echo '<td><input type="radio" name="jeudi" value="0" checked> Toute la journée</td>';
                echo '<td><input type="radio" name="jeudi" value="1" checked> Fermé toute la journée</td>';
                echo '<td><input type="radio" name="jeudi" value="3" checked> Matin</td>';
                echo '<td><input type="radio" name="jeudi" value="2" checked> Après-midi</td></br>';
                echo '</tr>';

                echo '<tr><td>Vendredi</td>';
                echo '<td><input type="radio" name="vendredi" value="0" checked> Toute la journée</td>';
                echo '<td><input type="radio" name="vendredi" value="1" checked> Fermé toute la journée</td>';
                echo '<td><input type="radio" name="vendredi" value="3" checked> Matin</td>';
                echo '<td><input type="radio" name="vendredi" value="2" checked> Après-midi</td></br>';
                echo '</tr>';

                echo '<tr><td>Samedi :</td> ';
                echo '<td><input type="radio" name="samedi" value="0" checked> Toute la journée</td>';
                echo '<td><input type="radio" name="samedi" value="1" checked> Fermé toute la journée</td>';
                echo '<td><input type="radio" name="samedi" value="3" checked> Matin</td>';
                echo '<td><input type="radio" name="samedi" value="2" checked> Après-midi</td></br>';
                echo '</tr>';

                echo '<tr><td>Dimanche</td>';
                echo '<td><input type="radio" name="dimanche" value="0" checked> Toute la journée</td>';
                echo '<td><input type="radio" name="dimanche" value="1" checked> Fermé toute la journée</td>';
                echo '<td><input type="radio" name="dimanche" value="3" checked> Matin</td>';
                echo '<td><input type="radio" name="dimanche" value="2" checked> Après-midi</td>';
                echo '</tr></table>';
            	//closedDays
            }
    		elseif($type=="Bar"){
    			echo ' Fumeur : ';
            	echo '<input type="radio" name="smoking" value="1" checked> Oui';
            	echo '<input type="radio" name="smoking" value="0" checked> Non<br>';
            	echo ' Snack : ';
            	echo '<input type="radio" name="snack" value="1" checked> Oui';
            	echo '<input type="radio" name="snack" value="0" checked> Non<br>';
            }
    		elseif($type=="Hotel"){
    			echo ' Prix : <input type="number" min="0" name="price"/> <br/>';
    			echo ' Nombre de chambre : <input type="number" min="0" name="bedRooms"/> <br/>';
    			echo ' Nombre d\'etoile : <input type="number" min="0" name="stars" min="0" max="5"/> <br/>';
        	}
            echo ' <div class="button">';
            echo ' <input type="submit" name="add" value="Ajouter"/>';
            echo ' <input type="submit" name="cancel" value="Annuler"/>';
            echo ' <div>';
        	echo ' </form></p>';
        	?>
            <div>
        </form></p>
        <?php
		if(isset($_POST['add'])){
            $canLaunchQuery = 0;
            if ($type == "Restaurant") {
                $price = $_POST['price'];
                $banquet = $_POST['banquet'];
                $takeAway = $_POST['takeAway'];
                $delivery = $_POST['delivery'];

                //*** ECRITURE OUVERTURE ***

                $lu = $_POST['lundi'];
                $ma = $_POST['mardi'];
                $me = $_POST['mercredi'];
                $je = $_POST['jeudi'];
                $vdd = $_POST['vendredi'];
                $sa = $_POST['samedi'];
                $di = $_POST['dimanche'];

                $fermetureDays = $lu . $ma . $me . $je . $vdd . $sa . $di;

                if (empty($price) or empty($banquet)) {
                    echo '<script language="javascript">';
                    echo 'alert("Il manque quelque chose!")';
                    echo '</script>';
                }
                else {
                    $canLaunchQuery = 1;
                }
            }
            elseif ($type == "Bar") {
                $smoking = $_POST['smoking'];
                $snack = $_POST['snack'];
                $canLaunchQuery = 1;
            }
            elseif ($type == "Hotel") {
                $price = $_POST['price'];
                $bedRooms = $_POST['bedRooms'];
                $stars = $_POST['stars'];

                if (empty($price) or empty($bedRooms) or empty($stars)) {
                    echo '<script language="javascript">';
                    echo 'alert("Il manque quelque chose!")';
                    echo '</script>';
                }
                else {
                    $canLaunchQuery = 1;
                }
            }
            if ($canLaunchQuery) {
    			unset($_SESSION['table']);
    			$date=Date("Y-m-d");
                try{
    		    	$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$_SESSION["pseudo"].'"';
                   	$stmt = $conn->prepare($sql); 
                   	$stmt->execute();
                    $result=$stmt->fetch();
                    $adminID=$result[0];

                    $sql = 'SELECT ID FROM Etablissement WHERE nom="'.$name.'"';
    				$stmt = $conn->prepare($sql); 
    				$stmt->execute();
    				$result=$stmt->fetch();
    				if ($result==""){
    					$sql = 'INSERT INTO Etablissement (nom,rue,numero,codePostal,localite,longitude,latitude,telephone,lienWeb,type) VALUES ("'.$name.'","'.$street.'","'.(int)$num.'","'.(int)$zip.'","'.$city.'","'.(float)$longitude.'","'.(float)$latitude.'","'.$tel.'","'.$site.'","'.$type.'")';
        				$conn->exec($sql);
    					$sql = 'SELECT ID FROM Etablissement WHERE nom="'.$name.'"';
    					$stmt = $conn->prepare($sql); 
    					$stmt->execute();
    					$result=$stmt->fetch();
    				}
    				$etablissementID=$result[0];
    				if ($type=="Restaurant"){
    					$price=$_POST['price'];
    					$banquet=$_POST['banquet'];
    					$takeAway=$_POST['takeAway'];
    					$delivery=$_POST['delivery'];
    					$closedDays="13512"; //a faire
    					$sql = 'INSERT INTO Restaurant (ID,prix,placesBanquet,emporter,livraison,fermeture) VALUES ("'.$etablissementID.'","'.$price.'","'.$banquet.'","'.$takeAway.'","'.$delivery.'","'.$fermetureDays.'")';
        			}
        			elseif($type=="Bar"){
        				$smoking=$_POST['smoking'];
        				$snack=$_POST['snack'];
        				$sql = 'INSERT INTO Bar (ID,fumeur,petiteRestauration) VALUES ("'.$etablissementID.'","'.$smoking.'","'.$snack.'")';
        			}
        			elseif($type=="Hotel"){
        				$price=$_POST['price'];
        				$bedRooms=$_POST['bedRooms'];
        				$stars=$_POST['stars'];
        				$sql = 'INSERT INTO Hotel (ID,prix,nbChambres,nbEtoiles) VALUES ("'.$etablissementID.'","'.(float)$price.'","'.(int)$bedRooms.'","'.(int)$stars.'")';
        			}
        			$conn->exec($sql);
    				$sql = 'INSERT INTO ModificationAdmin (etablissementID,adminID,dateCreation) VALUES ("'.$etablissementID.'","'.$adminID.'","'.$date.'")';
        			$conn->exec($sql);
        			echo "<p style=\"color:blue;\">Etablissement ajouté avec succes !</p>";
    		    }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage()."<br/>";
                }
            }
        }

        
        elseif(isset($_POST['cancel'])) {
        	unset($_SESSION['table']);
            echo '<meta http-equiv="Refresh" content="0;URL=./index.php">';
        }
        ?>
		<br/><br/><br/><br/>
		<div id="copyright">
			<span>&copy; Eureka. All rights reserved. <a href="http://eureka.com/"></a></span>
			<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
		</div>
	</div>
</div>
</body>
</html>
