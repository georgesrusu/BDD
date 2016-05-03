<?php
	include("connect.php");
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

?>