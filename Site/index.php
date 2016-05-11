<?php
session_start();
if (!isset($_SESSION['pseudo'])){
	$_SESSION['pseudo'] = $_GET['pseudo'];
}
if (!isset($_SESSION['isAdmin'])){
	$_SESSION['isAdmin'] = $_GET['isAdmin'];
}

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
<title>Eureka-Home</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
<?php
	include("../connect.php");
	try{
		$stmt = $conn->prepare("SELECT * FROM Etablissement"); 
		$stmt->execute();

    // set the resulting array to associative
		$etablissementList = $stmt->fetchall(); //fetch
	}
	catch(PDOException $e) {
        echo "Error: " . $e->getMessage()."<br/>";
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
				<li class="current_page_item"><a href="index.php" accesskey="1" title="">Homepage</a></li>
				<li><a href="./search.php" accesskey="2" title="Type here to research something">Research</a></li>
				<li><?php
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
		<div id="welcome">
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
                
				<h2>Bienvenue sur Eureka</h2>
				<span class="byline"></span>
			</div>

			<p>Vous voici sur Eureka, le site web du référencement d'établissement publique de consommation.  Vous trouverez ici tous les restaurants, bars ou hotels les plus aventageux de Bruxelles !</p>

			<p>Rechercher dés maintenant un établissement : <a href="./search.php">Research</a></p>

			</br>
			<p>Quelques nouveaux établissements : </p>
			<?php
				for ($elem=sizeof($etablissementList); $elem > sizeof($etablissementList) - 3; $elem--) { 
					$temp = $elem - 1;
					$etablissementID=$etablissementList[$temp][0];
					echo "<hr>";
					echo "<p><strong>".$etablissementList[$temp][1]."</strong></p>";
					echo "<p>".$etablissementList[$temp][10]."</p>";
					echo "<p>".$etablissementList[$temp][2]." ".$etablissementList[$temp][3].", ".$etablissementList[$temp][5]." - ".$etablissementList[$temp][4]."</p>";
					echo "<p>telephone : ".$etablissementList[$temp][8]."</p>";
					$siteWeb=$etablissementList[$temp][9]!=""?$etablissementList[$temp][9]:"aucun";
					echo "<p>site web : ".$siteWeb."</p>";
					echo '<strong><a href=./exemple.php?etablissementID='.$etablissementID.'>Plus de details ...</a></strong>';
					echo "<hr>";
					echo "</br>";
				}
			?>

			<br/>
		</div>

		<br/><br/><br/><br/>
		<div id="copyright">
			<span>&copy; Eureka. All rights reserved. <a href="http://eureka.com/"></a></span>
			<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
		</div>
	</div>
</div>
</body>
</html>
