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
<title>Supprimer un etablissement</title>
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

			<?php echo "<h2>Supprimer un etablissement</h2>";?>
			<br/>
            <?php 
            $action=$_GET['action'];
            if($action=="deleted"){
                echo "<p style=\"color:blue;\">Etablissement supprime avec succes !</p>";
            }
            ?>
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
        	echo "<p>Veuillez choisir l'etablissement l'id de l'etablissement a supprimer.</p>";
        	?>
        	<form name="modif_etab" method="post" action="suppr_etab.php">
        	<div style="overflow-x:scroll">
            <table>
        		<tr>
        			<th>ID</th>
        		</tr>
        		<tr>
        			<td><input type="number" name="ID"/></td>
        		</tr>
        	</table>
        	<div class="button">
            	<input type="submit" name="del" value="Supprimer"/>
            	<input type="submit" name="cancel" value="Annuler"/>
      		</div></form>
      	</div>
      	<?php
 		if(isset($_POST['del'])){
            if (empty($_POST['ID'])) {
                echo '<script language="javascript">';
                echo 'alert("ID is missing !")';
                echo '</script>';
            }
            else {
 			    try{
                    $sql = 'SELECT type FROM Etablissement WHERE ID="'.$_POST['ID'].'"';
                    $stmt = $conn->prepare($sql); 
                    $stmt->execute();
                    $result=$stmt->fetch();
                    $type=$result[0];
                    if($type!=""){
                         $sql = 'DELETE FROM Commentaire WHERE etablissementID="'.$_POST['ID'].'"';
                        $conn->exec($sql);
                        $sql = 'DELETE FROM Label WHERE etablissementID="'.$_POST['ID'].'"';
                        $conn->exec($sql);
                        $sql = 'DELETE FROM '.$type.' WHERE ID="'.$_POST['ID'].'"';
                        $conn->exec($sql);
                        $sql = 'DELETE FROM ModificationAdmin WHERE etablissementID="'.$_POST['ID'].'"';
                        $conn->exec($sql);
 				        $sql = 'DELETE FROM Etablissement WHERE ID="'.$_POST['ID'].'"';
                        $conn->exec($sql);
                    }
                    else{
                        echo '<script language="javascript">';
                        echo 'alert("ID doesn\'t exist !")';
                        echo '</script>';
                    }
                    echo '<meta http-equiv="Refresh" content="0;URL=./suppr_etab.php?action=deleted">';
 			    }catch(PDOException $e) {
             		echo "Error: " . $e->getMessage()."<br/>";
            	}   
            }
        }
        elseif(isset($_POST['cancel'])) {
            echo '<meta http-equiv="Refresh" content="0;URL=./index.php">';
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
