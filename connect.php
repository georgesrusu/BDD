<?php
	include ("header_connect.php");
	$dbname = "Eureka";

	try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn_succes=1;
		}
	catch(PDOException $e) {
		$conn_succes=0;
    	echo "Error: " . $e->getMessage();
	}
?>