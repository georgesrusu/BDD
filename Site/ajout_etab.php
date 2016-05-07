<?php
session_start();
include("../connect.php");
				error_reporting(E_ALL);
       			ini_set('display_errors', 1);
//if(!isset($_SESSION['cart_items'])){
    //$_SESSION['cart_items'] = array();
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
					echo '<a href="./Profile.php" accesskey="3" title="Connexion to our database">';
					echo "Profil";
				}
				else{
					echo '<a href="./login.php" accesskey="3" title="Connexion to our database">';
					echo "Connexion";
				}
				 ?></a></li>

			</ul>
		</div>
	</div>
	<div id="main">
		<div id="banner">
			<img src="" alt="" class="image-full" />
		</div>
		<div id="profile">
			<div class="title">
				<h1>
				<?php 
					if(isset($_GET['action'])){
						$action = $_GET['action'];
						if ($action=="login"){
                        	echo "<div class='alert alert-info'>";
                        	echo "<font size=5> Content de vous revoir ".$_SESSION['pseudo']."!</font>";
                        	echo "</div>";
                    }elseif($action="added"){
                    	echo "<div class='alert alert-info'>";
                        echo "<font size=5> Bienvenu parmis nous, ".$_SESSION['pseudo']."!</font>";
                        echo "</div>";
                    }
                }
                    ?></h1>
			</div>

			<?php echo "<h2>Ajouter un etablissement</h2>";?>
			<br/>

			<!--<p>This is <strong>Privy</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
			<ul class="actions">
				<li><a href="#" class="button">Etiam posuere</a></li>
			</ul>-->
		</div>
		<p>
		<div class="formulaire">
        <form name="etablissement" method="post" action="ajout_etab.php">
            Nom de l'etablissement : <input type="text" name="name"/> <br/>
            Rue : <input type="text" name="street"/><br/>
            Numero : <input type="text" name="num"/><br/>
            Code Postal : <input type="text" name="zip"/><br/>
            Localite : <input type="text" name="city"/><br/>
            Longitude : <input type="text" name="longitude"/><br/>
            Latitude : <input type="text" name="latitude"/><br/>
            Telephone : <input type="text" name="tel"/><br/>
            Site : <input type="text" name="site"/><br/>
            Type : <input type="text" name="type"/><br/>
            <div class="button">
            <input type="submit" name="next" value="Ajouter"/>
            <input type="submit" name="cancel" value="Annuler"/>
            <div>
        </form></p>
        <?php
        if(isset($_POST['next'])){
            $name=$_POST['name'];
            $street=$_POST['street'];
            $numt=$_POST['num'];
            $zip=$_POST['zip'];
            $city=$_POST['city'];
            $longitude=$_POST['longitude'];
            $latitude=$_POST['latitude'];
            $tel=$_POST['tel'];
            $site=$_POST['site'];
            $type=$_POST['type'];
            $date=Date("Y-m-d");
            echo '<p><div class="formulaire">';
            echo '<form name="etabtype" method="post" action="ajout_etab.php">';
            if ($type=="Restaurant"){
            	echo ' Prix : <input type="number" name="price"/> <br/>';
            	echo ' Nombre de place pour un Banquet : <input type="number" name="banquet"/> <br/>';
            	echo ' Emporter : ';
            	echo '<input type="radio" name="takeAway" value="1" checked> Oui<br>';
            	echo '<input type="radio" name="takeAway" value="0" checked> Non<br>';
            	echo ' Livraison : ';
            	echo '<input type="radio" name="delivery" value="1" checked> Oui<br>';
            	echo '<input type="radio" name="delivery" value="0" checked> Non<br>';
            	//closedDays
            }
    		elseif($type=="Bar"){
    			echo ' Fumeur : ';
            	echo '<input type="radio" name="smoking" value="1" checked> Oui<br>';
            	echo '<input type="radio" name="smoking" value="0" checked> Non<br>';
            	echo ' Snack : ';
            	echo '<input type="radio" name="snack" value="1" checked> Oui<br>';
            	echo '<input type="radio" name="snack" value="0" checked> Non<br>';
            }
    		elseif($type=="Hotel"){
    			echo ' Prix : <input type="number" name="price"/> <br/>';
    			echo ' Nombre de chambre : <input type="number" name="bedRooms"/> <br/>';
    			echo ' Nombre d\'etoile : <input type="number" name="stars"/> <br/>';
        	}
            echo ' <div class="button">';
            echo ' <input type="submit" name="add" value="Ajouter"/>';
            echo ' <input type="submit" name="cancel" value="Annuler"/>';
            echo ' <div>';
        	echo ' </form></p>';
		}
		if(isset($_POST['add']))
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
					echo "ETABLISSEMENT DOESN'T EXIST <br/>";
					$sql = 'INSERT INTO Etablissement (nom,rue,numero,codePostal,localite,longitude,latitude,telephone,lienWeb,type) VALUES ("'.$name.'","'.$street.'","'.(int)$num.'","'.(int)$zip.'","'.$city.'","'.(float)$longitude.'","'.(float)$latitude.'","'.$tel.'","'.$site.'","'.$type.'")';
    				$conn->exec($sql);
					echo "INSERT ETABLISSEMENT SUCCESS <br/>";
					$sql = 'SELECT ID FROM Etablissement WHERE nom="'.$name.'"';
					$stmt = $conn->prepare($sql); 
					$stmt->execute();
					$result=$stmt->fetch();
				}
				else{
					echo "ETABLISSEMENT ALREADY EXIST <br/>";
				}
				$etablissementID=$result[0];
				echo "GET ID ETABLISSEMENT SUCCESS ".$result[0]." <br/>";
				if ($type=="Restaurant"){
					$sql = 'INSERT INTO Restaurant (ID,prix,placesBanquet,emporter,livraison,fermeture) VALUES ("'.$etablissementID.'","'.$price.'","'.$banquet.'","'.$takeAway.'","'.$delivery.'","'.$closedDays.'")';
    			}
    			elseif($type=="Bar"){
    				$sql = 'INSERT INTO Bar (ID,fumeur,petiteRestauration) VALUES ("'.$etablissementID.'","'.$smoking.'","'.$snack.'")';
    			}
    			elseif($type=="Hotel"){
    				$sql = 'INSERT INTO Hotel (ID,prix,nbChambres,nbEtoiles) VALUES ("'.$etablissementID.'","'.(float)$price.'","'.(int)$bedRooms.'","'.(int)$stars.'")';
    			}
    			$conn->exec($sql);
				echo "INSERT etab SUCCESS <br/>";
				$sql = 'INSERT INTO ModificationAdmin (etablissementID,adminID,dateCreation) VALUES ("'.$etablissementID.'","'.$adminID.'","'.$date.'")';
    			$conn->exec($sql);
		}
		catch(PDOException $e) {
         	echo "Error: " . $e->getMessage()."<br/>";
        }


        
        elseif(isset($_POST['cancel'])) {
            echo '<meta http-equiv="Refresh" content="0;URL=./index.php?pseudo='.$_SESSION["pseudo"].'&isAdmin='.$_SESSION["isAdmin"].'">';
        }
        ?>
 		
		<!--<div id="featured">
			<div class="title">
				<h2>Maecenas lectus sapien</h2>
				<span class="byline">Integer sit amet aliquet pretium</span>
			</div>
			<ul class="style1">
				<li class="first">
					<p class="date"><a href="#">Jan<b>05</b></a></p>
					<h3>Amet sed volutpat mauris</h3>
					<p><a href="#">Consectetuer adipiscing elit. Nam pede erat, porta eu, lobortis eget, tempus et, tellus. Etiam neque. Vivamus consequat lorem at nisl. Nullam non wisi a sem semper eleifend. Etiam non felis. Donec ut ante.</a></p>
				</li>
				<li>
					<p class="date"><a href="#">Jan<b>03</b></a></p>
					<h3>Sagittis diam dolor amet</h3>
					<p><a href="#">Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie. Donec leo, vivamus fermentum nibh in augue praesent congue rutrum.</a></p>
				</li>
				<li>
					<p class="date"><a href="#">Jan<b>01</b></a></p>
					<h3>Amet sed volutpat mauris</h3>
					<p><a href="#">Consectetuer adipiscing elit. Nam pede erat, porta eu, lobortis eget, tempus et, tellus. Etiam neque. Vivamus consequat lorem at nisl. Nullam non wisi a sem semper eleifend. Etiam non felis. Donec ut ante.</a></p>
				</li>
				<li>
					<p class="date"><a href="#">Dec<b>31</b></a></p>
					<h3>Sagittis diam dolor amet</h3>
					<p><a href="#">Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Mauris quam enim, molestie. Donec leo, vivamus fermentum nibh in augue praesent congue rutrum.</a></p>
				</li>
			</ul>
		</div>-->
		<br/><br/><br/><br/>
		<div id="copyright">
			<span>&copy; Eureka. All rights reserved. <a href="http://eureka.com/"></a></span>
			<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
		</div>
	</div>
</div>
</body>
</html>