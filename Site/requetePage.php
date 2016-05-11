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
<title>Eureka-Request</title>
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
			<h1><a href="index.php">Eureka</a></h1>
			<span>Created for <a href="https://www.ulb.ac.be" rel="nofollow">ULB Project</a></span>
		</div>
		<div id="menu">
			<ul>
				<li><a href="index.php" accesskey="1" title="">Homepage</a></li>
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
				<li class="current_page_item"><a href="./requetePage.php" accesskey="4" >Request</a></li>
			</ul>
		</div>
	</div>
	<div id="main">
		<div id="banner">
			<img src="" alt="" class="image-full" />
		</div>
		<div id="welcome">
			<div class="title">
            	<h2>Requests Selector</h2>
				<span class="byline"></span>
			</div>

			<p>Veuillez choisir une requete dans le menu déroulant :
			<form name="requete" method="post" action="./requetePage.php">
				<select name="request">
					<option value="request1">Request n°1</option>
					<option value="request2">Request n°2</option>
					<option value="request3">Request n°3</option>
					<option value="request4">Request n°4</option>
					<option value="request5">Request n°5</option>
					<option value="request6">Request n°6</option>
				</select>
			</p>
			<div>
			<input type="submit" name="executer" value="Executer"/>
		</div></form>
			<?php
				if (isset($_POST['executer'])) {
					if($_POST['request']=="request1"){
						echo "<p><strong>La requete 1 est :</strong> Tous les utilisateurs qui apprécient au moins 3 établissements que l’utilisateur \"Brenda\" apprécie.</p>";
						$sql='SELECT identifiant FROM Utilisateur WHERE ID IN (SELECT clientID FROM Commentaire WHERE etablissementID IN (SELECT etablissementID FROM Commentaire WHERE clientID IN (SELECT ID FROM Utilisateur WHERE identifiant="Brenda") AND score>=4) GROUP BY clientID HAVING count(etablissementID)>=3)';
					}
					elseif($_POST['request']=="request2"){
						echo "<p><strong>La requete 2 est :</strong> Tous les établissements qu’apprécie au moins un utilisateur qui apprécie tous les établissements que
						\"Brenda\" apprécie.<p>";
						$sql='SELECT nom FROM Etablissement WHERE ID IN(SELECT DISTINCT etablissementID FROM Commentaire WHERE clientID IN (SELECT DISTINCT clientID FROM Commentaire WHERE etablissementID IN(SELECT etablissementID FROM Commentaire WHERE clientID IN (SELECT ID FROM Utilisateur WHERE identifiant="Brenda") AND score>=4) group by clientID having count(DISTINCT etablissementID)>=(SELECT count(etablissementID) FROM Commentaire WHERE clientID IN (SELECT ID FROM Utilisateur WHERE identifiant="Brenda") AND score>=4)));';
					}
					elseif($_POST['request']=="request3"){
						echo "<p><strong>La requete 3 est :</strong> Tous les établissements pour lesquels il y a au plus un commentaire.</p>";
						$sql='SELECT nom FROM Etablissement WHERE ID IN (SELECT DISTINCT e.ID FROM Etablissement e WHERE NOT EXISTS (SELECT * FROM Commentaire c WHERE c.etablissementID=e.ID) OR EXISTS (SELECT * FROM Commentaire c WHERE c.etablissementID=e.ID GROUP BY e.ID HAVING count(*)<=1))';
					}
					elseif($_POST['request']=="request4"){
						echo "<p><strong>La requete 4 est :</strong> La liste des administrateurs n’ayant pas commenté tous les établissements qu’ils ont crées.</p>";
						$sql='SELECT identifiant FROM Utilisateur WHERE ID IN (SELECT m.adminID FROM ModificationAdmin m WHERE not exists (SELECT * FROM Commentaire WHERE clientID=m.adminID AND etablissementID=m.etablissementID))';
					}
					elseif($_POST['request']=="request5"){
    					$sql = "SET sql_mode = ''";
    					$conn->exec($sql);	//sinon erreur group by clause chez george pie seulement
						echo "<p><strong>La requete 5 est :</strong> La liste des établissements ayant au minimum trois commentaires, classée selon la moyenne des scores attribués.</p>";
						$sql='SELECT nom,c.score FROM Etablissement e,Commentaire c WHERE e.ID=c.etablissementID GROUP BY c.etablissementID HAVING count(*)>=3 ORDER BY avg(c.score) DESC';
						$expl="Classe dans l'ordre decroissant.";
						$mode=1;
					}
					elseif($_POST['request']=="request6"){
						$sql = "SET sql_mode = ''";
    					$conn->exec($sql);
						echo "<p><strong>La requete 6 est :</strong> La liste des labels étant appliqués à au moins 5 établissements, classée selon la moyenne des scores des établissements ayant ce label.</p>";
						$sql='SELECT l.texte,AVG(c.score) FROM Label l,Commentaire c WHERE l.etablissementID=c.etablissementID GROUP BY texte HAVING count(DISTINCT l.etablissementID)>=5 ORDER BY avg(c.score) DESC';
						$expl="Classe dans l'ordre decroissant.";
						$mode=2;
					}
					try{
						$stmt = $conn->prepare($sql); 
            			$stmt->execute();
            			$result=$stmt->fetchall();
            			echo "<p><strong>Les resultat sont:</strong></p>";
            			echo '<p>'.sizeof($result).' resultat trouvé</p>';
            			if($expl!=""){
            				echo "<p>".$expl."</p>";
            			}
            			for($i=0;$i<sizeof($result);++$i){
            				$res.=$result[$i][0]."<br/>";
            				if($mode==1){
            					$res=substr($res, 0, -5);
            					$res.=" : <div class=\"star\"<span style=\"color:orange\"></span>";
            					//echo $res;
            					$numberStar = $result[$i][1];
								for ($star = 0; $star < 5; $star++) {
									if ($star < $numberStar) {
										$res.=" &#9733 ";
									}
									else {
										$res.=" &#9734 ";
									}
								}
            					$res.=" </div><br/> ";
            				}
            				elseif($mode==2){
            					$res=substr($res, 0, -5);
            					$res.=" : <strong>".$result[$i][1]."</strong><br/> ";
            				}
            			}
            			echo $res;
					}catch(PDOException $e) {
         			echo "Error: " . $e->getMessage()."<br/>";
         			}
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
