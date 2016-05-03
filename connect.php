<?php
	$servername = "192.168.2.100";
	$username = "george";
	$password = "abbaabba";
	$dbname = "Eureka";

	try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connexion succes<br/>";
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
	}
?>