<?php
include("../connect.php");
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
<title>Search</title>
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
				<li class="current_page_item"><a href="#" accesskey="2" title="Type here to research something">Research</a></li>
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
		<div id="search">
			<div class="title">
				<h1>
					<form name="forme_search" method="post" action="./search.php">
                        <select name="type" >
                            <option default value="">Type de l'etablissement</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Bar">Bar</option>
                            <option value="Hotel">Hotel</option>
                        </select>
					   <!--<input type="text" name="type" value="" placeholder="Type de l'etablissement" />-->

						<input type="text" name="name" value="" placeholder="Nom de l'Etablissement" />
						<input type="text" name="zip" value="" placeholder="Commune de l'Etablissement" />
						<input type="text" name="label" value="" placeholder="Label" />
						<input type="submit" name="rechercher" value="Rechercher" />
					</form>
				</h1>
				<?php
				if(isset($_POST['rechercher'])){
            		$type=$_POST['type'];
            		$name=$_POST['name'];
            		$zip=$_POST['zip'];
            		$label=$_POST['label'];
            		//SELECT * FROM Etablissement where type="Bar" AND localite="Ixelles" AND ID IN (select etablissementID FROM Label WHERE texte="Fumeur");
            		$sql='SELECT * FROM Etablissement E ';
            		$alone=true;
            		if( ($type!="") OR ($name!="") OR ($zip!="") OR ($label!="")){
            			$sql=$sql."WHERE ";
            		}
            		if ($type!=""){
            			$sql=$sql.'E.type="'.$type.'" AND ';
            			$alone=false;
            		}
            		if($name!=""){
            			$sql=$sql.'E.nom="'.$name.'" AND ';
            			$alone=false;
            		}
            		if($zip!=""){
            			$sql=$sql.'E.localite="'.$zip.'" AND ';
            			$alone=false;
            		}
            		if($label!=""){
            			$sql=$sql.'E.ID IN (SELECT L.etablissementID FROM Label L WHERE L.texte="'.$label.'") ';
            			$alone=true;
            		}
            		if (!$alone){
            			$sql=substr($sql, 0, -4);
            		}
            		$stmt = $conn->prepare($sql); 
                	$stmt->execute();
                	$result=$stmt->fetchall();
                	echo "<br/>";
                	echo "<br/>";
                	if (sizeof($result)==0){
                		echo "<hr>";
                		echo "<p><strong><a>0 resultat trouvé ";
                		if( ($type!="") OR ($name!="") OR ($zip!="") OR ($label!="")){
            				echo "pour ";
                			if ($type!=""){
                				echo $type;
                			}
                			echo " ";
                			if ($name!=""){
                				echo $name;
                			}
                			echo " ";
                			if($zip!=""){
                				echo $zip;
                			}
                			echo " ";
                			if($label!=""){
                				echo $label;
                			}
                		}
                		echo "</a></strong></p>";
                		echo "<hr>";
                	}
                	else{
                		echo "<hr>";
                		echo "<p><strong><a>".sizeof($result)." resultat trouvé ";
                		if( ($type!="") OR ($name!="") OR ($zip!="") OR ($label!="")){
            				echo "pour ";
                			if ($type!=""){
                				echo $type;
                			}
                			echo " ";
                			if ($name!=""){
                				echo $name;
                			}
                			echo " ";
                			if($zip!=""){
                				echo $zip;
                			}
                			echo " ";
                			if($label!=""){
                				echo $label;
                			}
                		}
                		echo "</a></strong></p>";
                		echo "<hr>";
      					for ($i=0;$i<sizeof($result);++$i){
      						$etablissementID=$result[$i][0];
      						echo "<hr>";
      						echo "<p><strong>".$result[$i][1]."</strong></p>";
      						echo "<p>".$result[$i][10]."</p>";
           					echo "<p>".$result[$i][2]." ".$result[$i][3].", ".$result[$i][5]." - ".$result[$i][4]."</p>";
           					echo "<p>telephone : ".$result[$i][8]."</p>";
           					$siteWeb=$result[$i][9]!=""?$result[$i][9]:"aucun";
           					echo "<p>site web : ".$siteWeb."</p>";
                            $etab_envoye=$etablissementID+1;
           					echo '<strong><a href=./exemple.php?etablissementID='.$etablissementID.'>Plus de details ...</a></strong>';
           					echo "<hr>";
           				}
   					}    				
      			}
				?>
		</div>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<div id="copyright">
			<span>&copy; Eureka. All rights reserved. <a href="http://eureka.com/"></a></span>
			<span>Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</span>
		</div>
	</div>
</div>
</body>
</html>
