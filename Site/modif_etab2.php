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

			<?php echo "<h2>Modifier un etablissement</h2>";?>
			<br/>
		</div>
		<?php
		if (!isset($_SESSION['table2'])){
           	$_SESSION['table2']=unserialize(urldecode($_GET['parama']));
        }
       	if(isset($_SESSION['table2'])){
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
        		//echo "<th>Fermeture</th>";
        	echo "</tr>";
        	echo "<tr>";
        			echo '<td><input type="number" min="0" name="price"/></td>';
        			echo '<td><input type="number" min="0" name="banquet"/></td>';

        			//$emporter =$result[3]==1?"Oui":"Non";
       				echo '<td><input type="radio" name="takeAway" value="1" checked> Oui';
       				echo '<input type="radio" name="takeAway" value="0" checked> Non<br></td>';
       				//$livraison =$result[3]==1?"Oui":"Non";
       				echo '<td><input type="radio" name="delivery" value="1" checked> Oui';
            		echo '<input type="radio" name="delivery" value="0" checked> Non<br></td>';
       				//echo "<td>".$result[5]."</th>"; //fermeture
                //echo '<td><input type="number" name="closedDays"/></td>';
       				//fermeture a faire
       			echo "</tr>";
            echo "</table><br/>";
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
       			echo '<td><input type="number" min="0" name="price"/></td>';
        		echo '<td><input type="number" min="0" name="bedRooms"/></td>';
        		echo '<td><input type="number" min="0" name="stars"/></td>';
 			echo "</tr>";    	
        }
        echo "</table>";
        echo '<div class="button">';
            	echo '<input type="submit" name="update" value="Update"/>';
            	echo '<input type="submit" name="cancel" value="Annuler"/>';
      		echo '</div></form>';
        echo "</div>";

        if(isset($_POST['update'])){
			unset($_SESSION['table2']);
			$date=Date("Y-m-d");
			if (!empty($name) or !empty($street) or !empty($num) or !empty($zip) or !empty($city) or !empty($longitude) or !empty($latitude) or !empty($tel) or !empty($site)) {
				$sql='UPDATE Etablissement SET ';
				$cut=0;
				if ($name!=""){
					$sql=$sql.'nom="'.$name.'", ';
					$cut=1;
				}
				if($street!=""){
					$sql=$sql.'rue="'.$street.'", ';
					$cut=1;
				}
				if($num!=""){
					$sql=$sql.'numero="'.$num.'", ';
					$cut=1;
				}
				if($zip!=""){
					$sql=$sql.'codePostal="'.$zip.'", ';
					$cut=1;
				}
				if($city!=""){
					$sql=$sql.'localite="'.$city.'", ';
					$cut=1;
				}
				if($longitude!=""){
					$sql=$sql.'longitude="'.$longitude.'", ';
					$cut=1;
				}
				if($latitude!=""){
					$sql=$sql.'latitude="'.$latitude.'", ';
					$cut=1;
				}
				if($tel!=""){
					$sql=$sql.'telephone="'.$tel.'", ';
					$cut=1;
				}
				if($site!=""){
					$sql=$sql.'lienWeb="'.$site.'", ';
					$cut=1;
				}
				if($cut){
					$sql=substr($sql, 0, -2);
   					$sql=$sql.' WHERE ID="'.$ID.'"';
   				}
   				echo $sql;
				try {
					$conn->exec($sql);
					if($type="Hotel"){
						$hotel_status=1;
					}
				}catch(PDOException $e) {
                	echo "Error: " . $e->getMessage()."<br/>";
            	}
   			}

   			echo $type;
			if ($type=="Restaurant"){
				$price=$_POST['price'];
				$banquet=$_POST['banquet'];
				$takeAway=$_POST['takeAway'];
				$delivery=$_POST['delivery'];
        $lu = $_POST['lundi'];
        $ma = $_POST['mardi'];
        $me = $_POST['mercredi'];
        $je = $_POST['jeudi'];
        $vdd = $_POST['vendredi'];
        $sa = $_POST['samedi'];
        $di = $_POST['dimanche'];
        $closedDays = $lu . $ma . $me . $je . $vdd . $sa . $di;
				$sql = 'UPDATE Restaurant SET ';
				if ($price!=""){
					$sql=$sql.'prix="'.$price.'" ,';
				}
				if ($banquet!=""){
					$sql=$sql.'placesBanquet="'.$banquet.'" ,';
				}	
				if ($takeAway!=""){
					$sql=$sql.'emporter="'.$takeAway.'" ,';
				}	
				if ($delivery!=""){
					$sql=$sql.'livraison="'.$delivery.'" ,';
				}	
				//clossed days,
				if ($closedDays!=""){
					$sql=$sql.'fermeture="'.$closedDays.'" ,';
				}
				$sql=substr($sql, 0, -1);
   				$sql=$sql.' WHERE ID="'.$ID.'"';
   				echo "<br/>";
				try {
					$conn->exec($sql);
					echo "<p style=\"color:blue;\">Etablissement modifie avec succes !</p>";
				}catch(PDOException $e) {
               		echo "Error: " . $e->getMessage()."<br/>";
           		}
				
			}
    		elseif($type=="Bar"){
    			$smoking=$_POST['smoking'];
    			$snack=$_POST['snack'];
   				$sql = 'UPDATE Bar SET ';
   				if ($smoking!=""){
					$sql=$sql.'fumeur="'.$smoking.'" ,';
				}
				if ($snack!=""){
					$sql=$sql.'petiteRestauration="'.$snack.'" ,';
				}
				$sql=substr($sql, 0, -1);
   				$sql=$sql.' WHERE ID="'.$ID.'"';
   				echo "<br/>";
   				try {
					$conn->exec($sql);
					echo "<p style=\"color:blue;\">Etablissement modifie avec succes !</p>";
				}catch(PDOException $e) {
               		echo "Error: " . $e->getMessage()."<br/>";
           		}

   			}
   			elseif($type=="Hotel"){
    			$price=$_POST['price'];
    			$bedRooms=$_POST['bedRooms'];
   				$stars=$_POST['stars'];
   				if (!empty($price) OR !empty($bedRooms) OR !empty($stars)){
   					$sql = 'UPDATE Hotel SET ';
   					if ($price!=""){
						$sql=$sql.'prix="'.$price.'" ,';
					}
					if ($bedRooms!=""){
						$sql=$sql.'nbChambres="'.$bedRooms.'" ,';
					}	
					if ($stars!=""){
						$sql=$sql.'nbEtoiles="'.$stars.'" ,';
					}
					$sql=substr($sql, 0, -1);
   					$sql=$sql.' WHERE ID="'.$ID.'"';
   					echo "<br/>";
   					try {
						$conn->exec($sql);
						echo "<p style=\"color:blue;\">Etablissement modifie avec succes !</p>";
					}catch(PDOException $e) {
                		echo "Error: " . $e->getMessage()."<br/>";
            		}
   				}
   				if($hotel_status){
   					echo "<p style=\"color:blue;\">Etablissement modifie avec succes !</p>";
   				}
   			}

           
    	}elseif(isset($_POST['cancel'])) {
        	unset($_SESSION['table2']);
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
