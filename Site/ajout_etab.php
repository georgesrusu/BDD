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
            Nom de l'etablissement : <input type="text" name="name" placeholder="Champ obligatoire"/> <br/>
            Rue : <input type="text" name="street" placeholder="Champ obligatoire"/><br/>
            Numero : <input type="number" name="num" placeholder="Champ obligatoire"/><br/>
            Code Postal : <input type="number" name="zip" placeholder="Champ obligatoire"/><br/>
            Localite : <input type="text" name="city" placeholder="Champ obligatoire"/><br/>
            Longitude : <input type="number" name="longitude" placeholder="Champ obligatoire"/><br/>
            Latitude : <input type="number" name="latitude" placeholder="Champ obligatoire"/><br/>
            Telephone : <input type="text" name="tel" placeholder="Champ obligatoire"/><br/>
            Site : <input type="text" name="site"/><br/>
            Type : <select name="type">
            			<option value=""></option>
    					<option value="Restaurant">Restaurant</option>
    					<option value="Bar">Bar</option>
    					<option value="Hotel">Hotel</option>
  					</select><br/>
            <div class="button">
            <input type="submit" name="next" value="Ajouter"/>
            <input type="submit" name="cancel" value="Annuler"/>
            <div>
        </form></p>
        <?php
        if(isset($_POST['next'])){
        	$nameEta = $_POST['name'];
        	$street = $_POST['street'];
        	$num = $_POST['num'];
        	$zip = $_POST['zip'];
        	$city = $_POST['city'];
        	$long = $_POST['longitude'];
        	$lat = $_POST['latitude'];
        	$tel = $_POST['tel'];
        	$site = $_POST['site'];
        	$typeEta = $_POST['type'];
        	if (empty($nameEta) or empty($street) or empty($num) or empty($zip) or empty($city) or empty($long) or empty($lat) or empty($tel) or empty($typeEta)) {
        		echo '<script language="javascript">';
                echo 'alert("Something missing !")';
                echo '</script>';

        	}
        	else {
	        	$table=array($nameEta,$street,$num,$zip,$city,$long,$lat,$tel,$site,$typeEta);
				$url = urlencode(serialize($table));
	            echo '<meta http-equiv="Refresh" content="0;URL=./ajout_etab2.php?param='.$url.'">';
	       	}
        }
        elseif(isset($_POST['cancel'])) {
            echo '<meta http-equiv="Refresh" content="0;URL=./index.php">';
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
