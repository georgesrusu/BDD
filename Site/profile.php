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
<title>Mon profile</title>
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
			<h1><a href="index.php">Eureka</a></h1>
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

			<?php echo '<h2>Profile de '.$_SESSION["pseudo"].'</h2>';?>
			<br/>
		</div>
		<p><strong>Mes information :</strong></p>
		<?php
		try{
			$sql = 'SELECT * FROM Utilisateur WHERE identifiant="'.$_SESSION['pseudo'].'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			$ID=$result[0];
			//$identifiant=$result[1];
			$mot_de_passe=$result[2];
			$email=$result[3];
			$dateCreation=$result[4];
		}catch(PDOException $e) {
         	echo "Error: " . $e->getMessage()."<br/>";
        }
        echo "<table>";
        	echo "<tr>";
        		echo "<th>Identifiant</th>";
        		echo "<th>Mot de passe</th>";
       			echo "<th>Email</th>";
        		echo "<th>Date de Creation du compte</th>";
        	echo "</tr>";
        	echo "<tr>";
        		echo "<td>".$_SESSION['pseudo']."</td>";
        		echo "<td>";
        		$mot_masc=str_repeat("*",strlen($mot_de_passe));
        		echo $mot_masc;
        		echo "</td>";
       			echo "<td>".$email."</td>";
        		echo "<td>".$dateCreation."</td>";
        	echo "</tr>";

        echo "</table>";
		?>
		<br/>
		<p><strong>Action :</strong></p>
		<a href="./deconnexion.php"><p>Se deconnecter</p></a>
		<a href="./mod_mdp.php"><p>Modifier mot de passe</p></a>
		<a href="./mod_email.php"><p>Modifier email</p></a>
		<a href="./hist_acti.php"><p>Voir historique de mon activité</p></a>
		<?php
		if ($_SESSION["isAdmin"]==1){
			echo '<a href="./ajout_etab.php"><p>Ajouter un etablissement</p></a>';
			echo '<a href="./modif_etab.php"><p>Modifier un etablissement</p></a>';
			echo '<a href="./suppr_etab.php"><p>Supprimer un etablissement</p></a>';
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
