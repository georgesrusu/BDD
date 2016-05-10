<?php
	include ("header_connect.php");
//Creation de Eureka
	echo "Creating Database status: ";
	try {
    	$conn = new PDO("mysql:host=$servername", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "CREATE DATABASE Eureka";
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
	echo "Creating table Utilisateur status: ";
	try {
    	$sql = "CREATE TABLE Utilisateur (ID INT UNSIGNED NOT NULL AUTO_INCREMENT,identifiant VARCHAR(30) NOT NULL UNIQUE,mot_de_passe VARCHAR(30) NOT NULL,email VARCHAR(50) NOT NULL,dateCreation DATE NOT NULL,isAdmin TINYINT(1) NOT NULL DEFAULT 0,PRIMARY KEY (id,identifiant))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}

	echo "Creating table Etablissement status: ";
	try {

    	$sql = "CREATE TABLE Etablissement (ID INT UNSIGNED NOT NULL AUTO_INCREMENT,nom VARCHAR(50) NOT NULL UNIQUE,rue VARCHAR(50) NOT NULL,numero INT UNSIGNED NOT NULL,codePostal INT UNSIGNED NOT NULL,localite VARCHAR(30) NOT NULL,longitude FLOAT NOT NULL,latitude FLOAT NOT NULL,telephone VARCHAR(15) NOT NULL,lienWeb VARCHAR(100),type VARCHAR(10) NOT NULL,PRIMARY KEY (ID,nom,type))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
			
	echo "Creating table Bar status: ";
	try {
    	$sql = "CREATE TABLE Bar (ID INT UNSIGNED PRIMARY KEY NOT NULL,fumeur TINYINT(1) NOT NULL,petiteRestauration TINYINT(1) NOT NULL,FOREIGN KEY (ID) REFERENCES Etablissement(ID))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	echo "Creating table Hotel status: ";
	try {
    	$sql = "CREATE TABLE Hotel (ID INT UNSIGNED PRIMARY KEY NOT NULL,prix FLOAT UNSIGNED NOT NULL,nbChambres INT UNSIGNED NOT NULL,nbEtoiles INT UNSIGNED NOT NULL,FOREIGN KEY (ID) REFERENCES Etablissement(ID))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	echo "Creating table Restaurant status: ";
	try {
    	$sql = "CREATE TABLE Restaurant (ID INT UNSIGNED PRIMARY KEY NOT NULL,prix FLOAT UNSIGNED NOT NULL,placesBanquet INT NOT NULL,emporter TINYINT(1) NOT NULL,livraison TINYINT(1) NOT NULL,fermeture VARCHAR(7) NOT NULL,FOREIGN KEY (ID) REFERENCES Etablissement(ID))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	echo "Creating table ModificationAdmin status: ";
	try {
    	$sql = "CREATE TABLE ModificationAdmin (etablissementID INT UNSIGNED NOT NULL,adminID INT UNSIGNED NOT NULL,dateCreation DATE NOT NULL,PRIMARY KEY (etablissementID,adminID,dateCreation),FOREIGN KEY (etablissementID) REFERENCES Etablissement(ID),FOREIGN KEY (adminID) REFERENCES Utilisateur(ID))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	echo "Creating table Label status: ";
	try {
    	$sql = "CREATE TABLE Label (etablissementID INT UNSIGNED NOT NULL,clientID INT UNSIGNED NOT NULL,texte VARCHAR(50) NOT NULL,PRIMARY KEY (etablissementID,clientID,texte),FOREIGN KEY (etablissementID) REFERENCES Etablissement(ID),FOREIGN KEY (clientID) REFERENCES Utilisateur(ID))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}
	//Creation de table Commentaire	
	echo "Creating table Commentaire status: ";
	try {
    	$sql = "CREATE TABLE Commentaire (etablissementID INT UNSIGNED NOT NULL,clientID INT UNSIGNED NOT NULL,dateCreation DATE NOT NULL,texte VARCHAR(1000) NOT NULL,score INT(1) NOT NULL,PRIMARY KEY (etablissementID,clientID,dateCreation),FOREIGN KEY (etablissementID) REFERENCES Etablissement(ID),FOREIGN KEY (clientID) REFERENCES Utilisateur(ID))ENGINE=InnoDB";
    	$conn->exec($sql);
    	echo "Table created successfully<br>";
		
		}
	catch(PDOException $e) {
    	echo "Error: " . $e->getMessage();
    	echo "<br>";
	}

?>