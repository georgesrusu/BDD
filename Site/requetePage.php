<?php
session_start();
if (!isset($_SESSION['pseudo'])){
	$_SESSION['pseudo'] = $_GET['pseudo'];
}
if (!isset($_SESSION['isAdmin'])){
	$_SESSION['isAdmin'] = $_GET['isAdmin'];
}

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

			<select name="request">
				<option value="request1">Request n°1</option>
				<option value="request2">Request n°2</option>
				<option value="request3">Request n°3</option>
				<option value="request4">Request n°4</option>
				<option value="request5">Request n°5</option>
				<option value="request6">Request n°6</option>
			</select>
			</p>
			<input type="submit" name="executer" value="Executer" action="requetePage.php"/>

			<?php
				if (isset($_POST['executer'])) {
					#TODO: LANCER LES PAGES DE REQUETES
					echo "<p>TESTE : " . $_POST['request'] . "</p>";
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
