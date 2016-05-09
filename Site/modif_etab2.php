<?php
session_start();
include("../connect.php");
				error_reporting(E_ALL);
       			ini_set('display_errors', 1);
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
<title>Modifier un etablissement</title>
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
			</div>

			<?php echo "<h2>Modifier un etablissement</h2>";?>
			<br/>

			<!--<p>This is <strong>Privy</strong>, a free, fully standards-compliant CSS template designed by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>. The photos in this template are from <a href="http://fotogrph.com/"> Fotogrph</a>. This free template is released under the <a href="http://templated.co/license">Creative Commons Attribution</a> license, so you're pretty much free to do whatever you want with it (even use it commercially) provided you give us credit for it. Have fun :) </p>
			<ul class="actions">
				<li><a href="#" class="button">Etiam posuere</a></li>
			</ul>-->
		</div>
		<?php
		if (!isset($_SESSION['table2'])){
        	echo "not set";
           	$_SESSION['table2']=unserialize(urldecode($_GET['parama']));
        }
       	if(isset($_SESSION['table2'])){
        	echo "set";
    		$table= $_SESSION['table2'];
    		$ID=$table[0];
        	$name=$table[1];
    		$street=$table[2];
    		$num=$table[3];
    		$zip=$table[4];
    		$city=$table[5];
    		$longitude=$table[6];
    		$latitude=$table[7];
    		$tel=$table[8];
    		$site=$table[9];
    		$type=$table[10];
    	}
    	echo "<div style=\"overflow-x:scroll\">";
    	echo "<table>";
        if ($type=="Restaurant"){
            echo "<tr>";
        		echo "<th>Prix</th>";
       			echo "<th>Places banquet</th>";
        		echo "<th>Emporter</th>";
        		echo "<th>Livraison</th>";
        		echo "<th>Fermeture</th>";
        	echo "</tr>";
        	try{
		    	$sql = 'SELECT * FROM Restaurant WHERE ID="'.$ID.'"';
            	$stmt = $conn->prepare($sql); 
            	$stmt->execute();
            	$result=$stmt->fetch();
        		echo "<tr>";
        			echo "<th>".$result[1]."</th>";
        			echo "<th>".$result[2]."</th>";
        			//$emporter =$result[3]==1?"Oui":"Non";
       				echo "<th>".$emporter =$result[3]==1?"Oui":"Non"."</th>";
       				//$livraison =$result[3]==1?"Oui":"Non";
       				echo "<th>".$livraison =$result[3]==1?"Oui":"Non"."</th>";
       				echo "<th>".$result[5]."</th>"; 
       				//fermeture a faire
       			echo "</tr>";
        	}
        	catch(PDOException $e) {
         		echo "Error: " . $e->getMessage()."<br/>";
       		}
        }
    	elseif($type=="Bar"){
    		echo "<tr>";
        		echo "<th>Fumeur</th>";
       			echo "<th>Petite Restauration</th>";
        	echo "</tr>";
    		try{
		    	$sql = 'SELECT * FROM Bar WHERE ID="'.$ID.'"';
            	$stmt = $conn->prepare($sql); 
            	$stmt->execute();
            	$result=$stmt->fetch();
        		echo "<tr>";
        		// $emporter =$result[3]==1?"Oui":"Non";
        			echo "<th>".$fumeur =$result[1]==1?"Oui":"Non"."</th>";
        			echo "<th>".$petiteRestauration=$result[2]==1?"Oui":"Non"."</th>";
       			echo "</tr>";
        	}
        		catch(PDOException $e) {
         			echo "Error: " . $e->getMessage()."<br/>";
        		}		
        }
    	elseif($type=="Hotel"){
    		echo "<tr>";
        	echo "<th>Prix</th>";
       		echo "<th>Nombre de chambres</th>";
       		echo "<th>Nombre d'etoiles'</th>";
        	echo "</tr>";
    		try{
		    	$sql = 'SELECT * FROM Hotel WHERE ID="'.$ID.'"';
            	$stmt = $conn->prepare($sql); 
            	$stmt->execute();
            	$result=$stmt->fetch();
        		echo "<tr>";
        			echo "<th>".$result[1]."</th>";
        			echo "<th>".$result[2]."</th>";
        			echo "<th>".$result[3]."</th>";
       			echo "</tr>";
        	}
        	catch(PDOException $e) {
         		echo "Error: " . $e->getMessage()."<br/>";
       		}		
       	}
        echo "</table>";
        echo "</div>";
        echo "<br/>";
        echo "<p>Veuillez remplir les colonnes que vous voulez modifier </p>";
        echo '<form name="modif_etab2" method="post" action="modif_etab2.php">';
      	echo "<div style=\"overflow-x:scroll\">";
    	echo "<table>";
        if ($type=="Restaurant"){
            echo "<tr>";
        		echo "<th>Prix</th>";
       			echo "<th>Places banquet</th>";
        		echo "<th>Emporter</th>";
        		echo "<th>Livraison</th>";
        		echo "<th>Fermeture</th>";
        	echo "</tr>";
        	echo "<tr>";
        			echo '<td><input type="number" name="price"/></td>';
        			echo '<td><input type="number" name="banquet"/></td>';

                    //TODO: MAX COMPLETER
                    //echo '<td><input type="number" name="fermeture"/></td>';

        			//$emporter =$result[3]==1?"Oui":"Non";
       				echo '<td><input type="radio" name="takeAway" value="1" checked> Oui';
       				echo '<input type="radio" name="takeAway" value="0" checked> Non<br></td>';
       				//$livraison =$result[3]==1?"Oui":"Non";
       				echo '<td><input type="radio" name="delivery" value="1" checked> Oui';
            		echo '<input type="radio" name="delivery" value="0" checked> Non<br></td>';
       				echo "<td>".$result[5]."</th>"; //fermeture
       				//fermeture a faire
       			echo "</tr>";
        	
        }elseif($type=="Bar"){
    		echo "<tr>";
        		echo "<th>Fumeur</th>";
       			echo "<th>Petite Restauration</th>";
        	echo "</tr>";
        	echo "<tr>";
       			echo '<td><input type="radio" name="smoking" value="1" checked> Oui';
       			echo '<input type="radio" name="smoking" value="0" checked> Non<br></td>';
       			//$livraison =$result[3]==1?"Oui":"Non";
       			echo '<td><input type="radio" name="snack" value="1" checked> Oui';
           		echo '<input type="radio" name="snack" value="0" checked> Non<br></td>';
 			echo "</tr>";    		
        }
    	elseif($type=="Hotel"){
    		echo "<tr>";
        		echo "<th>Prix</th>";
       			echo "<th>Nombre de chambres</th>";
       			echo "<th>Nombre d'etoiles'</th>";
        	echo "</tr>";
        	echo "<tr>";
       			echo '<td><input type="number" name="price"/></td>';
        		echo '<td><input type="number" name="bedRooms"/></td>';
        		echo '<td><input type="number" name="stars"/></td>';
 			echo "</tr>";    	
        }
        echo "</table>";
        echo '<div class="button">';
            	echo '<input type="submit" name="update" value="Ok"/>';
            	echo '<input type="submit" name="cancel" value="Annuler"/>';
      		echo '</div></form>';
        echo "</div>";

        if(isset($_POST['update'])){
			unset($_SESSION['table2']);
			$date=Date("Y-m-d");
			$sql='UPDATE Etablissement WHERE ID="'.$ID.'" SET ';
			if ($name!=""){
				$sql=$sql.'nom="'.$name.'", ';
			}
			if($street!=""){
				$sql=$sql.'rue="'.$street.'", ';
			}
			if($num!=""){
				$sql=$sql.'numero="'.$num.'", ';
			}
			if($zip!=""){
				$sql=$sql.'codePostal="'.$zip.'", ';
			}
			if($city!=""){
				$sql=$sql.'localite="'.$city.'", ';
			}
			if($longitude!=""){
				$sql=$sql.'longitude="'.$longitude.'", ';
			}
			if($latitude!=""){
				$sql=$sql.'latitude="'.$latitude.'", ';
			}
			if($tel!=""){
				$sql=$sql.'telephone="'.$tel.'", ';
			}
			if($site!=""){
				$sql=$sql.'lienWeb="'.$site.'", ';
			}
			$sql=substr($sql, 0, -2);
			try {
				$conn->exec($sql);
			}catch(PDOException $e) {
                echo "Error: " . $e->getMessage()."<br/>";
            }


			if ($type=="Restaurant"){
				$price=$_POST['price'];
				$banquet=$_POST['banquet'];
				$takeAway=$_POST['takeAway'];
				$delivery=$_POST['delivery'];
				$closedDays="13512"; //a faire ---
				$sql = 'UPDATE Restaurant WHERE ID="'.$ID.'" SET ';
				if ($price!=""){
					$sql=$sql.'prix="'.$price.'", ';
				}
				if ($banquet!=""){
					$sql=$sql.'banquet="'.$banquet.'", ';
				}	
				if ($takeAway!=""){
					$sql=$sql.'emporter="'.$takeAway.'", ';
				}	
				if ($delivery!=""){
					$sql=$sql.'livraison="'.$delivery.'", ';
				}	
				//clossed days,
				if ($closedDays!=""){
					$sql=$sql.'fermeture="'.$closedDays.'", ';
				}
				
			}
    		elseif($type=="Bar"){
    			$smoking=$_POST['smoking'];
    			$snack=$_POST['snack'];
   				$sql = 'UPDATE Bar WHERE ID="'.$ID.'" SET ';
   				if ($smoking!=""){
					$sql=$sql.'fumeur="'.$smoking.'", ';
				}
				if ($snack!=""){
					$sql=$sql.'petiteRestauration="'.$snack.'", ';
				}	

   			}
   			elseif($type=="Hotel"){
    			$price=$_POST['price'];
    			$bedRooms=$_POST['bedRooms'];
   				$stars=$_POST['stars'];
   				$sql = 'UPDATE Hotel WHERE ID="'.$ID.'" SET ';
   				if ($price!=""){
					$sql=$sql.'prix="'.$price.'", ';
				}
				if ($bedRooms!=""){
					$sql=$sql.'nbChambres="'.$bedRooms.'", ';
				}	
				if ($stars!=""){
					$sql=$sql.'nbEtoiles="'.$stars.'", ';
				}
   			}
   			$sql=substr($sql, 0, -2);
   			try {
				$conn->exec($sql);
				echo "<p style=\"color:blue;\">Etablissement ajouté avec succes !</p>";
			}catch(PDOException $e) {
                echo "Error: " . $e->getMessage()."<br/>";
            }

            /*try{
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
					$sql = 'INSERT INTO Restaurant (ID,prix,placesBanquet,emporter,livraison,fermeture) VALUES ("'.$etablissementID.'","'.$price.'","'.$banquet.'","'.$takeAway.'","'.$delivery.'","'.$closedDays.'")';
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
        }*/
    	}elseif(isset($_POST['cancel'])) {
        	unset($_SESSION['table2']);
            echo '<meta http-equiv="Refresh" content="0;URL=./index.php">';
        }
    	
        	?>
        	
     	 <?php/*try{
		    $sql = 'SELECT * FROM Etablissement';
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            $result=$stmt->fetchall();
            echo "<div style=\"overflow-x:scroll\">";
            echo "<table>";
        	echo "<tr>";
        		echo "<th>ID</th>";
        		echo "<th>Nom</th>";
       			echo "<th>Rue</th>";
        		echo "<th>Numero</th>";
        		echo "<th>CodePostal</th>";
        		echo "<th>Localite</th>";
        		echo "<th>Longitude</th>";
        		echo "<th>Latitude</th>";
        		echo "<th>Telephone</th>";
        		echo "<th>Site</th>";
        	echo "</tr>";
        	for ($i=0;$i<sizeof($result);++$i){
        		echo "<tr>";
        			echo "<th>".$result[$i][0]."</th>";
        			echo "<th>".$result[$i][1]."</th>";
       				echo "<th>".$result[$i][2]."</th>";
        			echo "<th>".$result[$i][3]."</th>";
        			echo "<th>".$result[$i][4]."</th>";
        			echo "<th>".$result[$i][5]."</th>";
        			echo "<th>".$result[$i][6]."</th>";
        			echo "<th>".$result[$i][7]."</th>";
        			echo "<th>".$result[$i][8]."</th>";
        			echo "<th>".$result[$i][9]."</th>";
        		echo "</tr>";
        	}
        	echo "</table>";
        	echo "</div>";
            }
            catch(PDOException $e) {
         	echo "Error: " . $e->getMessage()."<br/>";
        	}
        	echo "<br/>";
        	echo "<h2>Choisir un etablissement</h2>";
        	echo "<p>Veuillez choisir l'etablissement avec l'id et completer uniquement les colonnes que vous voulez modifier </p>";
       
        	if (!isset($_SESSION['table'])){
        		echo "not set";
           		$_SESSION['table']=unserialize(urldecode($_GET['param']));
        	}
        	if(isset($_SESSION['table'])){
        		echo "set";
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
        	?>
            <div>
        </form></p>
        <?php
		*/
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
