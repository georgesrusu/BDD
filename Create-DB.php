<?php
	$servername = "192.168.2.100";
	$username = "george";
	$password = "abbaabba";
//Creation de Eureka
	echo "Creating Database status: ";
	try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "CREATE DATABASE Eureka";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Database created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	$sql = "USE Eureka";
    //selecting DB
    $conn->exec($sql);
//Creation de table Commentaire	
	echo "Creating table Commentaire status: ";
	try {
    	$sql = "CREATE TABLE Commentaire (etablissementID INT UNSIGNED NOT NULL,clientID INT UNSIGNED NOT NULL,dateCreation DATETIME,texte VARCHAR(300) NOT NULL,score INT(1) NOT NULL,PRIMARY KEY (etablissementID,clientID,dateCreation))";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}

	echo "Creating table Utilisateur status: ";
	try {
    	$sql = "CREATE TABLE Utilisateur (ID INT UNSIGNED NOT NULL,identifiant VARCHAR(30) NOT NULL,mot_de_passe VARCHAR(30) NOT NULL,email VARCHAR(50) NOT NULL,dateCreation DATETIME,isAdmin BOOLEAN NOT NULL,PRIMARY KEY (id,identifiant))";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}

	echo "Creating table Tag status: ";
	try {
    	$sql = "CREATE TABLE Tag (ID INT UNSIGNED NOT NULL,label VARCHAR(30) NOT NULL,etablissementID INT UNSIGNED NOT NULL,clientID INT UNSIGNED NOT NULL,PRIMARY KEY (id,label,etablissementID,clientID))";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	
?>