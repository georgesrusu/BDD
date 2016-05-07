<?php
session_start();
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
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

<?php
	include("../connect.php");
	$stmt = $conn->prepare("SELECT * FROM Etablissement"); 
	$stmt->execute();

    // set the resulting array to associative
	$result = $stmt->fetchall(); //fetch

	$i = $_GET['etablissementID']-1;
	$idEtablissement = $result[$i][0];
	$typeEtablissement = $result[$i][10];

	$stmt = $conn->prepare("SELECT * FROM Commentaire"); 
	$stmt->execute();
	$commentList = $stmt->fetchall(); //fetch

	$stmt = $conn->prepare("SELECT * FROM Utilisateur"); 
	$stmt->execute();
	$userList = $stmt->fetchall(); //fetch

	$stmt = $conn->prepare("SELECT * FROM Label"); 
	$stmt->execute();
	$labelList = $stmt->fetchall(); //fetch


	if ($typeEtablissement == "Restaurant") {
		$stmt = $conn->prepare("SELECT * FROM Restaurant"); 
		$stmt->execute();

		$restaurantList = $stmt->fetchall();

		for ($rest=0; $rest < sizeof($restaurantList); $rest++) { 
			if ($idEtablissement == $restaurantList[$rest][0]) {
				$indexTable = $rest;
			}
		}
	}
	#TODO: D'abord trouver la place des etablissement dans les tables spécidique
	elseif ($typeEtablissement == "Bar") {
		$stmt = $conn->prepare("SELECT * FROM Bar"); 
		$stmt->execute();

		$restaurantList = $stmt->fetchall();

		for ($bar=0; $bar < sizeof($restaurantList); $bar++) { 
			if ($idEtablissement == $restaurantList[$bar][0]) {
				$indexTable = $bar;
			}
		}
	}

	elseif ($typeEtablissement == "Hotel") {
		$stmt = $conn->prepare("SELECT * FROM Hotel"); 
		$stmt->execute();

		$restaurantList = $stmt->fetchall();

		for ($hot=0; $hot < sizeof($restaurantList); $hot++) { 
			if ($idEtablissement == $restaurantList[$hot][0]) {
				$indexTable = $hot;
			}
		}
	}

	function closedPrint($day, $id) {
		if ($id == "0") {
			echo "		<tr>
							<td class=\"daysClosed\">"  . $day . "</td>
							<td>am : <span class=\"t\">Ouvert</span></td>
							<td>pm : <span class=\"t\">Ouvert</span></td>
						</tr>";
		}
		elseif ($id == "1") {
			echo "		<tr>
							<td class=\"daysClosed\">"  . $day . "</td>
							<td>am : Fermé</td>
							<td>pm : Fermé</td>
						</tr>";
		}
		elseif ($id == "2") {
			echo "		<tr>
							<td class=\"daysClosed\">"  . $day . "</td>
							<td>am : Fermé</td>
							<td>pm : <span class=\"t\">Ouvert</span></td>

						</tr>";				
		}
		else {
			echo "		<tr>
							<td class=\"daysClosed\">"  . $day . "</td>
							<td>am : <span class=\"t\">Ouvert</span></td>
							<td>pm : Fermé</td>
						</tr>";
		}
	}
?>

<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
function initialize() {
  var mapProp = {
    center:new google.maps.LatLng(<?=$result[$i][7]?>,<?=$result[$i][6]?>),
    zoom:18,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

</head>
<body>
<div id="page" class="container">
	<div id="header">
		<div id="logo">
			<img src="" alt="" />
			<h1><a href="index.php">Eureka</a></h1>
			<span>Created for <a href="https://www.ulb.ac.be" rel="nofollow">ULB Project</a></span>
		</div>
		<div id="menu">
			<ul>
				<li><a href="./index.php" accesskey="1" title="">Homepage</a></li>
				<li class="current_page_item"><a href="./search.php" accesskey="2" title="Type here to research something">Research</a></li>
				<li><?php
				if(isset($_SESSION['pseudo'])) {
					echo '<a href="./profile.php" accesskey="3" title="Connexion to our database">';
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
		<div id="welcome">
			<div class="title">
				<?php echo "<h2>".$result[$i][1]."</h2>";?>
				<span class="byline"></span>
			</div>
			<h2 class="infos">Informations sur leurs services:</h2>
				<?php

				if ($typeEtablissement == "Restaurant") {

					if ($restaurantList[$indexTable][3]) {
						echo "<p>TakeAway : Oui</p>";
					}
					else {
						echo "<p>TakeAway : Non</p>";
					}
					if ($restaurantList[$indexTable][4]) {
						echo "<p>Livraison à domicile : Oui</p>";
					}
					else {
						echo "<p>Livraison à domicile : Non</p>";
					}
					echo "<p>Fourchette de prix : " . $restaurantList[$indexTable][1] . "€</p>";
					echo "<p>Banquet maximum : " . $restaurantList[$indexTable][2] . " personnes</p>";
				}
				elseif ($typeEtablissement == "Bar") {
					if ($restaurantList[$indexTable][1]) {
						echo "<p>Smoking : Oui</p>";
					}
					else {
						echo "<p>Smoking : Non</p>";
					}

					if ($restaurantList[$indexTable][2]) {
						echo "<p>Snack : Oui<p>";
					}
					else {
						echo "<p>Snack : Non</p>";
					}
				}
				elseif ($typeEtablissement == "Hotel") {
					echo "<p>Etoiles : " . $restaurantList[$indexTable][3] . "</p>";
					echo "<p>Capacité : " . $restaurantList[$indexTable][2] . " chambres</p>";
					echo "<p>Fourchette de prix : " . $restaurantList[$indexTable][1] . "€</p>";
				}
				?>

			<br/>

			<?php 
				if ($typeEtablissement == "Restaurant") {
					echo "<h2 class=\"infos\">Ouverture:</h2>";
					$ouverture = (string)$restaurantList[$indexTable][5];

					if (strlen($ouverture) < 7) {
						$numberOfMiss = 7 - strlen($ouverture);
						for ($elem=0; $elem < $numberOfMiss; $elem++) { 
							$ouverture = "0" . $ouverture;
						}
					}

					echo "	<table border=0 style=\"width:40%\">";
					closedPrint("Lundi", $ouverture[0]);
					closedPrint("Mardi", $ouverture[1]);
					closedPrint("Mercredi", $ouverture[2]);
					closedPrint("Jeudi", $ouverture[3]);
					closedPrint("Vendredi", $ouverture[4]);
					closedPrint("Samedi", $ouverture[5]);
					closedPrint("Dimanche", $ouverture[6]);
					echo "</table>";
					echo "<br/>";
				}
			?>

			<h2 class="infos">Localisation:</h2>
				<?php 
				echo "<p>" . $result[$i][2] . " " . $result[$i][3] . ", " . $result[$i][5] . " - " . $result[$i][4] . "</p>";
				echo "<p>Coordonnées : " . $result[$i][7] . " - " . $result[$i][6] . "</p>";
				?>
				<div id="googleMap" style="width:400;height:250px;"></div>

			<h2 class="infos">Contact:</h2>
				<?php
				echo "<p>Téléphone : " . $result[$i][8] ."</p>";
				echo "<p>Site web : ";
				if ($result[$i][9]) {
					echo $result[$i][9];
				}
				else {
					echo "Aucun";
				}
				echo "</p>";
				?>

			<h2 class="infos">Commentaires:</h2>
				<?php
					for ($comment = 0; $comment < sizeof($commentList); $comment++) {
						if ($commentList[$comment][0] == $idEtablissement) {
							echo "<div class=\"comment\">";
							echo "<p class=\"nameComment\">" . $userList[$commentList[$comment][1]-1][1] . "</p>";
							echo "<p>" . $commentList[$comment][2] . "</p>";
							echo "<p class=\"star\"><span style=\"color:black\">Score :</span>";
							$numberStar = $commentList[$comment][4];
							for ($star = 0; $star < 5; $star++) {
								if ($star < $numberStar) {
									echo "&#9733;";
								}
								else {
									echo "&#9734";
								}
							} 
							echo "<p>" . $commentList[$comment][3] . "</p>";
							echo "</div>";
						}
					}
				?>

			<h2 class="infos">Tags de l'établissement:</h2>
			<table width="50%" border="1" align="center">
				<tr>
					<th>Label</th>
					<th>Apposé</th>
				</tr>
			<?php
				$labelArray = array();
				$countArray = array();
				for ($label = 0; $label < sizeof($labelList); $label++) {
					if ($labelList[$label][0] == $idEtablissement) {
						if (!in_array($labelList[$label][2], $labelArray)) {
							array_push($labelArray, $labelList[$label][2]);
							array_push($countArray, (int)1);
						}
						else {
							$idArray = array_keys($labelArray, $labelList[$label][2]);
							$countArray[$idArray[0]] = $countArray[$idArray[0]] + 1;
						}
					}
				}
				for ($label=0; $label < count($labelArray); $label++) { 
					echo "	<tr>
								<td>" . $labelArray[$label] . "</td>
								<td>" . $countArray[$label] . "</td>
							</tr>";
				}
			?>
			</table>
		</div>

		<br/><br/><br/><br/>
		<div id="copyright">
			<span>&copy; Untitled. All rights reserved. | Photos by <a href="http://fotogrph.com/">Fotogrph</a></span>
			<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
		</div>
	</div>
</div>
</body>
</html>
