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
<title>Historique d'activite</title>
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

			<?php echo "<h2>Historique de l'activite de ".$_SESSION["pseudo"]."</h2>";?>
			<br/>

		</div>
		<p><strong>Commentaires :</strong></p>
		<?php

		    try{
		    	$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$_SESSION["pseudo"].'"';
               	$stmt = $conn->prepare($sql); 
               	$stmt->execute();
                $result=$stmt->fetch();
                $clientID=$result[0];

               	$sql = 'SELECT * FROM Commentaire WHERE clientID="'.$clientID.'" ORDER BY dateCreation DESC';
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $result=$stmt->fetchall();
                echo "<br/>";
                echo "<br/>";
                if (sizeof($result)==0){
                	echo "<hr>";
                	echo "<p><strong><a>Il n'y a aucune activité </a></strong></p>";
                	echo "<hr>";
                }
                else{
                	echo "<hr>";
                	echo "<p><strong><a>".sizeof($result)." commentaires trouvé </a></strong></p>";
                	echo "<hr>";
                	for ($i=0;$i<sizeof($result);++$i){
      					$etablissementID=$result[$i][0];
      					//$clientID=$result[$i][1];
      					$sql = 'SELECT nom FROM Etablissement WHERE ID="'.$etablissementID.'"';
                		$stmt = $conn->prepare($sql); 
                		$stmt->execute();
                		$query=$stmt->fetch();

      					echo "<hr>";
      					echo "<p><strong>".$query[0]."</strong></p>";
      					echo "<p>".$result[$i][2]."</p>";
           				echo "<p class=\"star\"><span style=\"color:black\">Score :</span>";
						$numberStar = $result[$i][4];
						for ($star = 0; $star < 5; $star++) {
							if ($star < $numberStar) {
								echo "&#9733;";
							}
							else {
								echo "&#9734";	
							}
						}
           				echo "<p>".$result[$i][3]."</p>";
           				echo '<strong><a href=./exemple.php?etablissementID='.$etablissementID.'>Voir dans le contexte ...</a></strong>';
           				echo "<hr>";
           				}
                }
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage()."<br/>";
            }
            ?>
           <br/>
		<p><strong>Tags :</strong></p>
		<?php
		    try{
               	$sql = 'SELECT * FROM Label WHERE clientID="'.$clientID.'"';
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $result=$stmt->fetchall();
                echo "<br/>";
                echo "<br/>";
                if (sizeof($result)==0){
                	echo "<hr>";
                	echo "<p><strong><a>Il n'y a aucune activité </a></strong></p>";
                	echo "<hr>";
                }
                else{
                	echo "<hr>";
                	echo "<p><strong><a>".sizeof($result)." tags trouvé </a></strong></p>";
                	echo "<hr>";
                	for ($i=0;$i<sizeof($result);++$i){
      					$etablissementID=$result[$i][0];
      					//$clientID=$result[$i][1];
      					$sql = 'SELECT nom FROM Etablissement WHERE ID="'.$etablissementID.'"';
                		$stmt = $conn->prepare($sql); 
                		$stmt->execute();
                		$query=$stmt->fetch();

      					echo "<hr>";
      					echo "<p><strong>".$query[0]."</strong></p>";
      					echo "<p>".$result[$i][2]."</p>";
           				echo '<strong><a href=./exemple.php?etablissementID='.$etablissementID.'>Voir dans le contexte ...</a></strong>';
           				echo "<hr>";
           				}
                }
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage()."<br/>";
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
