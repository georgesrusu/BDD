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
    	$sql = "CREATE TABLE Commentaire (etablissementID INT UNSIGNED NOT NULL,clientID INT UNSIGNED NOT NULL,dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,texte VARCHAR(300) NOT NULL,score INT(1) NOT NULL,PRIMARY KEY (etablissementID,clientID,dateCreation))";
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
    	$sql = "CREATE TABLE Utilisateur (ID INT UNSIGNED NOT NULL,identifiant VARCHAR(30) NOT NULL,mot_de_passe VARCHAR(30) NOT NULL,email VARCHAR(50) NOT NULL,dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,isAdmin BOOLEAN NOT NULL DEFAULT 0,PRIMARY KEY (id,identifiant))";
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
    	$sql = "CREATE TABLE Tag (ID INT UNSIGNED NOT NULL,label VARCHAR(30) NOT NULL,etablissementID INT UNSIGNED NOT NULL,clientID INT UNSIGNED NOT NULL,PRIMARY KEY (ID,label,etablissementID,clientID))";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}

	echo "Creating table Etablissement status: ";
	try {
    	$sql = "CREATE TABLE Etablissement (ID INT UNSIGNED NOT NULL AUTO_INCREMENT,nom VARCHAR(50) NOT NULL UNIQUE,rue VARCHAR(50) NOT NULL,numero INT UNSIGNED NOT NULL,codePostal INT UNSIGNED NOT NULL,localite VARCHAR(30) NOT NULL,longitude FLOAT NOT NULL,latitude FLOAT NOT NULL,telephone VARCHAR(15) NOT NULL,lienWeb VARCHAR(100),type VARCHAR(10) NOT NULL,PRIMARY KEY (ID,nom,type))";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
			
	echo "Creating table Bar status: ";
	try {
    	$sql = "CREATE TABLE Bar (ID INT UNSIGNED PRIMARY KEY NOT NULL,fumeur BOOLEAN NOT NULL,petiteRestauration BOOLEAN NOT NULL)";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	echo "Creating table Hotel status: ";
	try {
    	$sql = "CREATE TABLE Hotel (ID INT UNSIGNED PRIMARY KEY NOT NULL,prix FLOAT UNSIGNED NOT NULL,nbChambre INT UNSIGNED NOT NULL,nbEtoiles INT UNSIGNED NOT NULL)";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	echo "Creating table Restaurant status: ";
	try {
    	$sql = "CREATE TABLE Restaurant (ID INT UNSIGNED PRIMARY KEY NOT NULL,prix FLOAT UNSIGNED NOT NULL,placesBanquet INT NOT NULL,emporter TINYINT(1) NOT NULL,livraison TINYINT(1) NOT NULL,fermeture INT(6) UNSIGNED NOT NULL)";
    // use exec() because no results are returned
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
?>