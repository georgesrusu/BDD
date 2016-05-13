<?php
session_start();
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
		$ID = $_GET['etablissementID'];

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
				 <li><a href="./requetePage.php" accesskey="4" >Request</a></li>
			</ul>
		</div>
	</div>
	<div id="main">
		<div id="banner">
			<img src="" alt="" class="image-full" />
		</div>
		<div id="welcome">
			<div class="title">
				<?php 
				try{
					$sql = 'SELECT * FROM Etablissement WHERE ID="'.$ID.'"';
                   	$stmt = $conn->prepare($sql); 
                   	$stmt->execute();
                    $result=$stmt->fetch();
				}
				catch(PDOException $e) {
        			echo "Error: " . $e->getMessage()."<br/>";
    			}

				echo "<h2>".$result[1]."</h2>";?>
				<span class="byline"></span>
			</div>
			<?php 
			$action=$_GET['action'];
			if ($action=="com_added"){
				echo "<p style=\"color:blue;\">Commentaire ajoute avec succes !</p>";
			}elseif($action=="label_added"){
				echo "<p style=\"color:blue;\">Label ajoute avec succes !</p>";
			}
			?>
			<h2 class="infos">Informations sur leurs services:</h2>
				<?php
				try{
					$sql = 'SELECT * FROM '.$result[10].' WHERE ID="'.$ID.'"';
                   	$stmt = $conn->prepare($sql); 
                   	$stmt->execute();
                    $etab=$stmt->fetch();
				}
				catch(PDOException $e) {
        			echo "Error: " . $e->getMessage()."<br/>";
    			}
				if ($result[10] == "Restaurant") {
					if ($etab[3]) {
						echo "<p>TakeAway : Oui</p>";
					}
					else {
						echo "<p>TakeAway : Non</p>";
					}
					if ($etab[4]) {
						echo "<p>Livraison à domicile : Oui</p>";
					}
					else {
						echo "<p>Livraison à domicile : Non</p>";
					}
					echo "<p>Fourchette de prix : " . $etab[1] . "€</p>";
					echo "<p>Banquet maximum : " . $etab[2] . " personnes</p><br/>";
					echo "<h2 class=\"infos\">Ouverture:</h2>";
					$ouverture = (string)$etab[5];

					if (strlen($ouverture) < 7) {
						$numberOfMiss = 7 - strlen($ouverture);
						for ($elem=0; $elem < $numberOfMiss; $elem++) { 
							$ouverture = "0" . $ouverture;
						}
					}

					echo "	<table class=\"tableH\" border=\"0\" style=\"width:40%\">";
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
				elseif ($result[10] == "Bar") {

					if ($etab[1]) {
						echo "<p>Smoking : Oui</p>";
					}
					else {
						echo "<p>Smoking : Non</p>";
					}

					if ($etab[2]) {
						echo "<p>Snack : Oui<p>";
					}
					else {
						echo "<p>Snack : Non</p>";
					}
				}
				elseif ($result[10] == "Hotel") {
					echo "<p>Etoiles : " . $etab[3] . "</p>";
					echo "<p>Capacité : " . $etab[2] . " chambres</p>";
					echo "<p>Fourchette de prix : " . $etab[1] . "€</p>";
				}
				?>

			<br/>

			<h2 class="infos">Localisation:</h2>
				<?php 
				echo "<p>" . $result[2] . " " . $result[3] . ", " . $result[5] . " - " . $result[4] . "</p>";
				echo "<p>Coordonnées : " . $result[7] . " - " . $result[6] . "</p>";
				?>
				<div id="googleMap" style="width:400;height:250px;">
				<script src="http://maps.googleapis.com/maps/api/js"></script>
				<script>
				function initialize() {
  					var mapProp = {
    				center:new google.maps.LatLng(<?=$result[7]?>,<?=$result[6]?>),
    				zoom:18,
    				mapTypeId:google.maps.MapTypeId.ROADMAP
  					};
  					var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
					}
					google.maps.event.addDomListener(window, 'load', initialize());
				</script></div>
				<br/>

			<h2 class="infos">Météo aujourd'hui:</h2>
			<?php
				echo '<iframe id="forecast_embed" type="text/html" frameborder="0" height="245" width="100%" src="http://forecast.io/embed/#lat='.$result[7].'&lon='.$result[6].'&name='.$result[5].'&units=ca"> </iframe>';
        		?>
        		<br/>


			<h2 class="infos">Contact:</h2>
				<?php
				echo "<p>Téléphone : " . $result[8] ."</p>";
				echo "<p>Site web : ";
				if ($result[9]) {
					echo '<a href="'.$result[9].'">'.$result[9].'</a>';
				}
				else {
					echo "Aucun";
				}
				echo "</p>";
				?>

			<h2 class="infos">Commentaires:</h2>
				<?php
				try{
					$sql = 'SELECT * FROM Commentaire WHERE etablissementID="'.$ID.'" ORDER BY dateCreation DESC';
                   	$stmt = $conn->prepare($sql); 
                   	$stmt->execute();
                    $com=$stmt->fetchall();
				}
				catch(PDOException $e) {
        			echo "Error: " . $e->getMessage()."<br/>";
    			}
				for ($i = 0; $i < sizeof($com); ++$i) {
						echo "<div class=\"comment\">";
						try{
							$sql = 'SELECT identifiant FROM Utilisateur WHERE ID="'.$com[$i][1].'"';
                   			$stmt = $conn->prepare($sql); 
                   			$stmt->execute();
                    		$nom=$stmt->fetch();
						}
						catch(PDOException $e) {
        				echo "Error: " . $e->getMessage()."<br/>";
    					}
						echo "<p class=\"nameComment\">" . $nom[0] . "</p>";
						echo "<p>" . $com[$i][2] . "</p>";
						echo "<p class=\"star\"><span style=\"color:black\">Score :</span>";
						$numberStar = $com[$i][4];
						for ($star = 0; $star < 5; $star++) {
							if ($star < $numberStar) {
								echo "&#9733;";
							}
							else {
								echo "&#9734";
							}
						} 
						echo "<p>" . $com[$i][3] . "</p>";
						echo "</div>";
					}
				?>
				</br>
				<p><strong>Moyenne des scores : </strong> <?php 
				try{
					$sql='SELECT AVG(score) FROM Commentaire WHERE etablissementID="'.$ID.'"';
					$stmt = $conn->prepare($sql); 
            		$stmt->execute();
            		$result=$stmt->fetch();
            		$moyenne_stars=$result[0];
            		echo "<p class=\"star\"><span style=\"color:black\"></span>";
					for ($star = 0; $star < 5; $star++) {
						if ($star < $moyenne_stars) {
							echo "&#9733;";
						}
						else {
							echo "&#9734";
						}
					} 
				}catch(PDOException $e) {
         				echo "Error: " . $e->getMessage()."<br/>";
        			}
				?></p>

				</br>
				<p><strong>Ajouter un commentaire : </strong></p>
				<?php 
				if(isset($_SESSION['pseudo'])) {
					echo '<form name="commentaire" method="post" action="exemple.php?etablissementID='.$ID.'">';
						echo '<p>Score : <input type="number" min="0" max="5" value="0" name="score"/></p>';
						echo '<p><textarea rows="6" cols="75" name="commentaire" placeholder="Votre commentaire"></textarea></p>';
						echo '<div class="button">';
							echo '<input type="submit" name="comment" value="Commenter">';
						echo '</div></form>';
					try{
						$sql='SELECT ID FROM Utilisateur WHERE identifiant="'.$_SESSION['pseudo'].'"';
						$stmt = $conn->prepare($sql); 
            			$stmt->execute();
            			$result=$stmt->fetch();
           				$clientID=$result[0];
           			}catch(PDOException $e) {
         				echo "Error: " . $e->getMessage()."<br/>";
        			}
				}
				else{
					//Si non connecté
					echo '<p>Veuillez vous connecter</p>';
				}
				if(isset($_POST['comment'])){
					$score=$_POST['score'];
					$texte=$_POST['commentaire'];
					$date=date("Y-m-d");
					try{
						$sql = 'SELECT * FROM Commentaire WHERE etablissementID="'.$ID.'" AND clientID="'.$clientID.'" AND dateCreation="'.$date.'"';
            			$stmt = $conn->prepare($sql); 
            			$stmt->execute();
            			$result=$stmt->fetch();
            			if($result[0]==""){
            				$sql='INSERT INTO Commentaire (etablissementID,clientID,dateCreation,texte,score) VALUES ("'.$ID.'","'.$clientID.'","'.$date.'","'.$texte.'","'.$score.'")';
            				$conn->exec($sql);
            				echo '<meta http-equiv="Refresh" content="0;URL=./exemple.php?etablissementID='.$ID.'&action=com_added">';
            			}
            			else{
            				echo '<script language="javascript">';
                			echo 'alert("Vous ne pouvez plus faire un Commentaire aujourd\'hui!")';
                			echo '</script>';
            			}
            		}catch(PDOException $e) {
         				echo "Error: " . $e->getMessage()."<br/>";
        			}
				}
				?>
				</br>

			<h2 class="infos">Tags de l'établissement:</h2>
			<table width="50%" border="1" align="center">
				<tr>
					<th>Label</th>
					<th>Apposé</th>
				</tr>
			<?php
				try{
					$sql = 'SELECT * FROM Label WHERE etablissementID="'.$ID.'"';
                   	$stmt = $conn->prepare($sql); 
                   	$stmt->execute();
                    $label=$stmt->fetchall();
				}
				catch(PDOException $e) {
        			echo "Error: " . $e->getMessage()."<br/>";
    			}
    			$labelArray=array();
				$countArray = array();
				for ($i = 0; $i < sizeof($label); $i++) {
					if (!in_array($label[$i][2], $labelArray)) {
						array_push($labelArray, $label[$i][2]);
						array_push($countArray, (int)1);
					}
					else {
						$idArray = array_keys($labelArray, $label[$i][2]);
						$countArray[$idArray[0]] = $countArray[$idArray[0]] + 1;
					}
				
				}
				for ($i=0; $i < count($labelArray); ++$i) { 
					echo "	<tr>
								<td>" . $labelArray[$i] . "</td>
								<td>" . $countArray[$i] . "</td>
							</tr>";
				}
			?>
			</table>

			<p><strong>Ajouter un tag : </strong></p>
			<?php 
				if(isset($_SESSION['pseudo'])) {
					echo '<form name="label" method="post" action="./exemple.php?etablissementID='.$ID.'">';
					echo '<select name="labelSelect">';
					for ($i = 0; $i < count($labelArray); ++$i) {
						echo '<option value="'.$labelArray[$i].'">' . $labelArray[$i] . '</option>';
					}
					echo '</select>';
					echo '
					<div class="button">
            		<input type="submit" name="envoyer" value="Envoyer"/>
      				</div>';
					//echo '</form>';

					//echo '<form name="labelAutre" method="post" action="exemple.php?etablissementID='.$etablissementID.'">';
					echo '</br><input type="text" name="labelText" placeholder="Nouveau label">';
					echo '<div class="button">';
					echo '<input type="submit" name="labelAutreSend" value="Envoyer">';
					echo '</div></form>';
				}
				else{
					//Si non connecté
					echo '<p>Veuillez vous connecter</p>'; 
				}
				
				if (isset($_POST['envoyer'])) {
					try{
						$sql = 'SELECT * FROM Label WHERE etablissementID="'.$ID.'" AND clientID="'.$clientID.'" AND texte="'.$_POST['labelSelect'].'"';
            			$stmt = $conn->prepare($sql); 
            			$stmt->execute();
            			$result=$stmt->fetch();
            			if($result[0]==""){
            				$sql='INSERT INTO Label (etablissementID,clientID,texte) VALUES ("'.$ID.'","'.$clientID.'","'.$_POST['labelSelect'].'")';
            				$conn->exec($sql);
            				echo '<meta http-equiv="Refresh" content="0;URL=./exemple.php?etablissementID='.$ID.'&action=label_added">';
            			}
            			else{
            				echo '<script language="javascript">';
                			echo 'alert("Vous ne pouvez plus apposer ce tag !")';
                			echo '</script>';
            			}
            		}catch(PDOException $e) {
         				echo "Error: " . $e->getMessage()."<br/>";
        			}
				}
				elseif (isset($_POST['labelAutreSend'])) {
					if($_POST['labelText']!=""){
						$sql='INSERT INTO Label (etablissementID,clientID,texte) VALUES ("'.$ID.'","'.$clientID.'","'.$_POST['labelText'].'")';
            			$conn->exec($sql);
            			echo '<meta http-equiv="Refresh" content="0;URL=./exemple.php?etablissementID='.$ID.'&action=label_added">';
            		}
            		else{
            			echo '<script language="javascript">';
               			echo 'alert("Le Tag est vide !")';
               			echo '</script>';
            		}
				}

			?>

		</div>
		<script type="text/javascript" src="http://100widgets.com/js_data.php?id=259"></script>
		<script type="text/javascript" src="http://100widgets.com/js_data.php?id=73"></script>

		<br/><br/><br/><br/>
		<div id="copyright">
			<span>&copy; Untitled. All rights reserved.</span>
			<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
		</div>
	</div>
</div>
</body>
</html>
