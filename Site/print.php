<?php
	include("../connect.php");
	$stmt = $conn->prepare("SELECT * FROM Etablissement"); 
	$stmt->execute();

        // set the resulting array to associative
	$result = $stmt->fetchall(); //fetch
	echo sizeof($result);
	echo sizeof($result[0]);
	for($j=0;$j<sizeof($result);++$j){
		echo " | ";
		for ($i=0;$i<sizeof($result[$j]);++$i){
			echo $result[$j][$i];
			echo " | ";
		}
		echo "<br/>";
	}

	for ($i=0; $i < sizeof($result) ; $i++) { 
		echo "<p>Nom du resto :" . $result[$i][1] . "</p>"; 
	}

	$stmt = $conn->prepare("SELECT * FROM Restaurant"); 
	$stmt->execute();

	echo "<br/><br/><br/>---------------------<br/><br/><br/>";

	$restaurantList = $stmt->fetchall();
	for($j=0;$j<sizeof($restaurantList);++$j){
		echo " | ";
		for ($i=0;$i<sizeof($restaurantList[$j]);++$i){
			echo $restaurantList[$j][$i];
			echo " | ";
		}
		echo "<br/>";
	}

	$stmt = $conn->prepare("SELECT * FROM Bar"); 
	$stmt->execute();

	echo "<br/><br/><br/>---------------------<br/><br/><br/>";

	$restaurantList = $stmt->fetchall();
	for($j=0;$j<sizeof($restaurantList);++$j){
		echo " | ";
		for ($i=0;$i<sizeof($restaurantList[$j]);++$i){
			echo $restaurantList[$j][$i];
			echo " | ";
		}
		echo "<br/>";
	}

	$stmt = $conn->prepare("SELECT * FROM Hotel"); 
	$stmt->execute();

	echo "<br/><br/><br/>---------------------<br/><br/><br/>";

	$restaurantList = $stmt->fetchall();
	for($j=0;$j<sizeof($restaurantList);++$j){
		echo " | ";
		for ($i=0;$i<sizeof($restaurantList[$j]);++$i){
			echo $restaurantList[$j][$i];
			echo " | ";
		}
		echo "<br/>";
	}

?>