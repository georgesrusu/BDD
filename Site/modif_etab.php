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

			<?php echo "<h2>Modifer un etablissement</h2>";?>
			<br/>
		</div>
		<?php
		try{
		    $sql = 'SELECT * FROM Etablissement';
            $stmt = $conn->prepare($sql); 
            $stmt->execute();
            $result=$stmt->fetchall();
            echo "<div style=\"overflow-x:scroll\">";
            echo "<table>";
        	echo "<tr>";
        		echo "<th>ID</th>";
        		echo "<th>Nom</th>";
       			echo "<th>Rue</th>";
        		echo "<th>Numero</th>";
        		echo "<th>CodePostal</th>";
        		echo "<th>Localite</th>";
        		echo "<th>Longitude</th>";
        		echo "<th>Latitude</th>";
        		echo "<th>Telephone</th>";
        		echo "<th>Site</th>";
        	echo "</tr>";
        	for ($i=0;$i<sizeof($result);++$i){
        		echo "<tr>";
        			echo "<td>".$result[$i][0]."</td>";
        			echo "<td>".$result[$i][1]."</td>";
       				echo "<td>".$result[$i][2]."</td>";
        			echo "<td>".$result[$i][3]."</td>";
        			echo "<td>".$result[$i][4]."</td>";
        			echo "<td>".$result[$i][5]."</td>";
        			echo "<td>".$result[$i][6]."</td>";
        			echo "<td>".$result[$i][7]."</td>";
        			echo "<td>".$result[$i][8]."</td>";
        			echo "<td>".$result[$i][9]."</td>";
        		echo "</tr>";
        	}
        	echo "</table>";
        	echo "</div>";
            }
            catch(PDOException $e) {
         	echo "Error: " . $e->getMessage()."<br/>";
        	}
        	echo "<br/>";
        	echo "<h2>Choisir un etablissement</h2>";
        	echo "<p>Veuillez choisir l'etablissement avec l'id et completer uniquement les colonnes que vous voulez modifier </p>";
        	?>
        	<form name="modif_etab" method="post" action="modif_etab.php">
        	<div style="overflow-x:scroll;">
            <table>
        		<tr>
        			<th>ID</th>
        			<th>Nom</th>
    	   			<th>Rue</th>
        			<th>Numero</th>
        			<th>CodePostal</th>
      	  			<th>Localite</th>
        			<th>Longitude</th>
        			<th>Latitude</th>
        			<th>Telephone</th>
        			<th>Site</th>
        		</tr>
        		<tr>
        				<td><input type="number" name="ID"/></td>
        				<td><input type="text" name="name"/></td>
        				<td><input type="text" name="street"/></td>
        				<td><input type="number" name="num"/></td>
        				<td><input type="number" name="zip"/></td>
        				<td><input type="text" name="city"/></td>
        				<td><input type="number" name="longitude"/></td>
        				<td><input type="number" name="latitude"/></td>
        				<td><input type="text" name="tel"/></td>
        				<td><input type="text" name="site"/></td>
        		</tr>
        	</table>
        	</div>
        	<div class="button">
            	<input type="submit" name="next" value="Modifier"/>
            	<input type="submit" name="cancel" value="Annuler"/>
      		</div></form>
      	<?php
 		if(isset($_POST['next'])){
 			try{
 				if (empty($_POST['ID'])) {
        			echo '<script language="javascript">';
                	echo 'alert("ID is missing !")';
                	echo '</script>';
        		}
        		else {
        			echo $_POST['ID'];
 					$sql = 'SELECT type FROM Etablissement WHERE ID="'.$_POST['ID'].'"';
            		$stmt = $conn->prepare($sql); 
            		$stmt->execute();
            		$result=$stmt->fetch();
            		$type=$result[0];
            		echo $type;
            		if ($type!=""){
            			$table=array($_POST['ID'],$_POST['name'],$_POST['street'],$_POST['num'],$_POST['zip'],$_POST['city'],$_POST['longitude'],$_POST['latitude'],$_POST['tel'],$_POST['site'],$type);
            			$url = urlencode(serialize($table));
            			echo '<meta http-equiv="Refresh" content="0;URL=./modif_etab2.php?parama='.$url.'">';
           	 		}
           	 		else{
						echo '<script language="javascript">';
                		echo 'alert("ID doesn\'t exist !")';
                		echo '</script>';
           	 		}
           	 	}

 			}catch(PDOException $e) {
         		echo "Error: " . $e->getMessage()."<br/>";
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
