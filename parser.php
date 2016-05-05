<?php
	function add_admin($conn,$date,$admin){
		/*
		 *	AJOUT DS ADMIN ET VERIFICATION QU'ILS SONT ADMIN
		 */
		$isAdmin=1;
		try{
			$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$admin.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result==""){
				echo "ADMIN DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO Utilisateur (identifiant,mot_de_passe,email,dateCreation,isAdmin) VALUES ("'.$admin.'","'.$admin.'","'.$admin.'@email.com","'.$date.'","'.$isAdmin.'")';
    			$conn->exec($sql);
				echo "INSERT UTILISATEUR ADMIN SUCCESS <br/>";
				$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$admin.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
				}
			else{
				echo "ADMIN ALREADY EXIST <br/>";
				$sql = 'UPDATE Utilisateur SET isAdmin="'.$isAdmin.'" WHERE ID="'.$result[0].'"';
    			$stmt = $conn->prepare($sql); 
				$stmt->execute();
			}
			$adminID=$result[0];
			echo "GET ID ADMIN SUCCESS ".$result[0]." <br/>";
			return $adminID;
		}
		catch(PDOException $e) {
			echo "GET ID ADMIN FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
	}

	function verify_admin_date($conn,$date,$adminID){
		/*
		 *	 VERIFICATION DES DATES DE CREATION
		 */
		try{
			echo "VERIFICATION DATECREATION UTILISATEUR ADMIN<br/>";
			$sql='SELECT dateCreation FROM Utilisateur WHERE ID="'.$adminID.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			$dateAdmin=$result[0];
			if ($date<$dateAdmin){
				echo "DATECREATION ETABLISSEMENT OLDEST <br/>";
				$sql = 'UPDATE Utilisateur SET dateCreation="'.$date.'" WHERE ID="'.$adminID.'"';
    			$stmt = $conn->prepare($sql); 
				$stmt->execute();
				echo "DATECREATION UTILISATEUR ADMIN UPDATED SUCCESS <br/>";
			}
			else{
				echo "DATECREATION UTILISATEUR ADMIN OLDEST <br/>";
			}
		}
		catch(PDOException $e) {
			echo "UPDATE DATE FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
	}
	function create_etablissement($conn,$etabName,$street,$num,$zip,$city,$longitude,$latitude,$tel,$site,$type){
		/*
		 * AJOUT DES ETABLISSEMENT SI PAS DEJA EXISTANT
		 */
		try{
			$sql = 'SELECT ID FROM Etablissement WHERE nom="'.$etabName.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result==""){
				echo "ETABLISSEMENT DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO Etablissement (nom,rue,numero,codePostal,localite,longitude,latitude,telephone,lienWeb,type) VALUES ("'.$etabName.'","'.$street.'","'.(int)$num.'","'.(int)$zip.'","'.$city.'","'.(float)$longitude.'","'.(float)$latitude.'","'.$tel.'","'.$site.'","'.$type.'")';
    			$conn->exec($sql);
				echo "INSERT ETABLISSEMENT SUCCESS <br/>";
				$sql = 'SELECT ID FROM Etablissement WHERE nom="'.$etabName.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
				}
			else{
				echo "ETABLISSEMENT ALREADY EXIST <br/>";
			}
			$etablissementID=$result[0];
			echo "GET ID ETABLISSEMENT SUCCESS ".$result[0]." <br/>";
			return $etablissementID;
		}
		catch(PDOException $e) {
			echo "GET ID ETABLISSEMENT FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
	}
	function add_modification_admin($conn,$etablissementID,$adminID,$date){
		/*
		 * AJOUT DES MODIFICATION FAIT PAR LES ADMIN
		 */
		try{
			$sql = 'SELECT * FROM ModificationAdmin WHERE etablissementID="'.$etablissementID.'" AND adminID="'.$adminID.'" AND dateCreation="'.$date.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result==""){
				echo "MODIFICATIONADMIN DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO ModificationAdmin (etablissementID,adminID,dateCreation) VALUES ("'.$etablissementID.'","'.$adminID.'","'.$date.'")';
    			$conn->exec($sql);
				echo "INSERT MODIFICATIONADMIN SUCCESS <br/>";
				}
			else{
				echo "MODIFICATIONADMIN ALREADY EXIST <br/>";
			}
		}
		catch(PDOException $e) {
			echo "INSERT MODIFICATIONADMIN FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
	}
	function add_client($conn,$nickname,$date){
		/*
		 * UTILISATEUR SI EXISTE PAS DANS LA DB
		 */
		try{
			$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$nickname.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result==""){
				echo "CLIENT DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO Utilisateur (identifiant,mot_de_passe,email,dateCreation) VALUES ("'.$nickname.'","'.$nickname.'","'.$nickname.'@email.com","'.$date.'")';
    			$conn->exec($sql);
				echo "INSERT UTILISATEUR CLIENT SUCCESS <br/>";
				$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$nickname.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
				}
			else{
				echo "CLIENT ALREADY EXIST <br/>";
			}
			$clientID=$result[0];
			echo "GET ID CLIENT SUCCESS ".$result[0]." <br/>";
			return $clientID;
		}
		catch(PDOException $e) {
			echo "GET ID CLIENT FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
	}
	function add_comm_verif_date($conn,$etablissementID,$clientID,$dateComment,$comment,$score){
				/*
		 *	COMMENTAIRE SI N'EXISTE PAS DANS LA DB
		 */
		
		try{
			$sql = 'SELECT * FROM Commentaire WHERE etablissementID="'.$etablissementID.'" AND clientID="'.$clientID.'" AND dateCreation="'.$dateComment.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result==""){
				echo "COMMENTAIRE DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO Commentaire (etablissementID,clientID,dateCreation,texte,score) VALUES ("'.$etablissementID.'","'.$clientID.'","'.$dateComment.'","'.$comment.'","'.$score.'")';
    			$conn->exec($sql);
				echo "INSERT COMMENTAIRE SUCCESS <br/>";
				}
			else{
				echo "COMMENTAIRE ALREADY EXIST <br/>";
			}
		}
		catch(PDOException $e) {
			echo "INSERT COMMENTAIRE FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
		/*
		 *	 VERIFICATION DES DATES DE CREATION
		 */
		try{
			echo "VERIFICATION DATECREATION UTILISATEUR <br/>";
			$sql='SELECT dateCreation FROM Utilisateur WHERE ID="'.$clientID.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			$dateUtilisateur=$result[0];
			if ($dateComment<$dateUtilisateur){
				echo "DATECREATION COMMENTAIRE OLDEST <br/>";
				$sql = 'UPDATE Utilisateur SET dateCreation="'.$dateComment.'" WHERE ID="'.$clientID.'"';
    			$stmt = $conn->prepare($sql); 
				$stmt->execute();
				echo "DATECREATION UTILISATEUR CLIENT UPDATED SUCCESS <br/>";
			}
			else{
				echo "DATECREATION UTILISATEUR CLIENT OLDEST <br/>";
			}
		}
		catch(PDOException $e) {
			echo "UPDATE DATE FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
	}

	function add_tag($conn,$user,$date,$etablissementID,$nameTag){
		try{
			$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$user.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result[0]==""){
				echo "CLIENT DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO Utilisateur (identifiant,mot_de_passe,email,dateCreation) VALUES ("'.$user.'","'.$user.'","'.$user.'@email.com","'.$date.'")';
    			$conn->exec($sql);
				echo "INSERT UTILISATEUR CLIENT SUCCESS <br/>";
				$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$user.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
			}
			$userID=$result[0];
			$sql = 'SELECT * FROM Label WHERE etablissementID="'.$etablissementID.'" AND  clientID="'.$userID.'" AND texte="'.$nameTag.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result[0]==""){
				echo "TAG DOESN'T EXIST<br/>";
				$sql = 'INSERT INTO Label (etablissementID,clientID,texte) VALUES ("'.$etablissementID.'","'.$userID.'","'.$nameTag.'")';
    			$conn->exec($sql);
    			echo "INSERT TAG SUCCESS <br/>";
			}
			else{
				echo "TAG ALREADY EXIST<br/>";
			}
    	}
		catch(PDOException $e) {
			echo "INSERT TAG FAIL ";
    		echo "Error: " . $e->getMessage()."<br/>";
    	}	
	}
	function resto_xml($conn){
		$dom = new DomDocument;
		$dom->load("./datas/Restaurants.xml") or die("Error: Cannot create object");
		echo "*** LECTURE RESTAU XML ***<br />";
		$listResto = $dom->getElementsByTagName('Restaurant');
		foreach ($listResto as $resto) {
			$date = $resto->getAttribute('creationDate');
			echo "Date création : " . $date . "<br />";
			$admin = $resto->getAttribute('nickname');
			echo "Admin : " . $admin . "<br />";
			$date = str_replace("/", "-", $date);
			$date = date("Y-m-d", strtotime($date));
			$adminID=add_admin($conn,$date,$admin);//ajout des admin
			verify_admin_date($conn,$date,$adminID);//verification date de creation etablissement avec date de creation utilisatuer
			//ICI ON VA INSERT DANS LA TABLE ETABLISSEMENT
			$restoName = $resto->getElementsByTagName('Name')->item(0);
			$restoName=$restoName->nodeValue;
			echo "Name : " . $restoName . "<br />";
			$street = $resto->getElementsByTagName('Street')->item(0);
			$street=$street->nodeValue;
			echo "Street : " . $street . "<br />";
			$num = $resto->getElementsByTagName('Num')->item(0);
			$num=$num->nodeValue;
			echo "Num : " . $num . "<br />";
			$zip = $resto->getElementsByTagName('Zip')->item(0);
			$zip=$zip->nodeValue;
			echo "Zip : " . $zip . "<br/>";
			$city = $resto->getElementsByTagName('City')->item(0);
			$city=$city->nodeValue;
			echo "City : " . $city . "<br/>";
			$longitude = $resto->getElementsByTagName('Longitude')->item(0);
			$longitude=$longitude->nodeValue;
			echo "Longitude : " . $longitude . "<br />";
			$latitude = $resto->getElementsByTagName('Latitude')->item(0);
			$latitude=$latitude->nodeValue;
			echo "Latitude : " . $latitude . "<br />";
			$tel = $resto->getElementsByTagName('Tel')->item(0);
			$tel=$tel->nodeValue;
			echo "Tel : " . $tel . "<br />";
			$site = $resto->getElementsByTagName('Site')->item(0);
			if ($site->nodeName) {
				$site=$site->getAttribute('link');
				echo "Site : " . $site. "<br />";
			}else {
				$site="";
				echo "Site : Aucun site web n'est présent<br />";
			}
			$type="Restaurant";
			$etablissementID=create_etablissement($conn,$restoName,$street,$num,$zip,$city,$longitude,$latitude,$tel,$site,$type); //ajout etablissement
			add_modification_admin($conn,$etablissementID,$adminID,$date); //ajout dans la table ModificationAdmin
			//ICI ON VA INSERT DANS LA TABLE RESTAURANT
			$dayList = $resto->getElementsByTagName('On');
			$days = array ('0', '0', '0', '0', '0', '0', '0');
			foreach ($dayList as $day) {
				$dayNumber = $day->getAttribute('day');
				echo "day : " . $dayNumber;
				if ($day->hasAttribute('hour') && $day->getAttribute('hour') == "am") {
					$days[(int)$dayNumber] = 2;
					echo " am<br/>";
				}elseif ($day->hasAttribute('hour') && $day->getAttribute('hour') == "pm") {
					$days[(int)$dayNumber] = 3;
					echo " pm<br/>";
				}else {
					$days[(int)$dayNumber] = 1;
					echo "<br/>";
				}
			}
			$closedDays="";
			echo "[ ";
			for ($i = 0; $i <= 6; $i++) {
    			echo $days[$i];
    			$closedDays=$closedDays.$days[$i];
			}
			echo "]<br/>";	
			$takeAway = $resto->getElementsByTagName('TakeAway')->item(0);
			if ($takeAway->nodeName) {
				$takeAway=1;
				echo "Take away : True <br />";
			}
			else {
				$takeAway=0;
				echo "Take away : False <br />";
			}
			$delivery = $resto->getElementsByTagName('Delivery')->item(0);
			if ($delivery->nodeName) {
				$delivery=1;
				echo "Delivery : True <br />";
			}else {
				$delivery=0;
				echo "Delivery : False <br />";
			}
			$price = $resto->getElementsByTagName('PriceRange')->item(0);
			$price=$price->nodeValue;
			echo "Price : " . $price . "<br />";
			$banquet = $resto->getElementsByTagName('Banquet')->item(0);
			$banquet=$banquet->getAttribute('capacity');
			echo "Banquet : " . $banquet . "<br />";
			//AJOUT DES ETABLISSEMENT SUITE POUR LE RESTAURANT
			try{
				$sql = 'SELECT * FROM Restaurant WHERE ID="'.$etablissementID.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
				if ($result==""){
					echo "RESTAURANT DOESN'T EXIST <br/>";
					$sql = 'INSERT INTO Restaurant (ID,prix,placesBanquet,emporter,livraison,fermeture) VALUES ("'.$etablissementID.'","'.$price.'","'.$banquet.'","'.$takeAway.'","'.$delivery.'","'.$closedDays.'")';
    				$conn->exec($sql);
					echo "INSERT RESTAURANT SUCCESS <br/>";
				}
				else{
					echo "RESTAURANT ALREADY EXIST <br/>";
				}
			}catch(PDOException $e) {
				echo "INSERT RESTAURANT FAIL :";
    			echo "Error: " . $e->getMessage()."<br/>";
			}
  			//ICI ON VA INSERER LES COMMENTAIRE MAIS AUSSI LES UTILISATEUR QUI ONT DEJA COMMENTE
			echo "--- COMMENT SECTION --- <br/>";
			$commentList = $resto->getElementsByTagName('Comment');
			foreach ($commentList as $comment) {
				$nickname = $comment->getAttribute('nickname');
				$clientID=add_client($conn,$nickname,$date); //ajout des personne dans la data base
				$dateComment = $comment->getAttribute('date');
				$score = $comment->getAttribute('score');
				$comment=$comment->nodeValue;
				echo "Nickname : " . $nickname . "<br/>";
				echo "Date : " . $dateComment . "<br/>";
				echo "Score : " . $score . "<br/>";
				echo "Comment : " . $comment . "<br />";
				$comment = addcslashes($comment,'"');
				$dateComment = str_replace("/", "-", $dateComment);
				$dateComment = date("Y-m-d", strtotime($dateComment));
				add_comm_verif_date($conn,$etablissementID,$clientID,$dateComment,$comment,$score);
				echo "***<br/>";
			}
			//ICI ON VA INSERER LES TAG
			$tagList = $resto->getElementsByTagName('Tag');
			foreach ($tagList as $tag) {
				$nameTag = $tag->getAttribute('name');
				echo "Name Tag : " . $nameTag . "<br/>";
				$userList = $tag->getElementsByTagName('User');
				foreach ($userList as $user) {
					$user=$user->getAttribute('nickname');
					echo "&nbsp User : " . $user."  ";
					add_tag($conn,$user,$date,$etablissementID,$nameTag);
				}
			}
			echo "<br/>--- FIN DU RESTAU<br/><br/>";
		}
	}
	function bar_xml($conn){
    	echo "<br/>*** LECTURE FICHIER CAFES XML ***<br/>";
    	$dom = new DomDocument;
    	$dom->load("./datas/Cafes.xml") or die("Error: Cannot create object");
    	$listCafe = $dom->getElementsByTagName('Cafe');
    	foreach ($listCafe as $cafe) {
        	$date = $cafe->getAttribute('creationDate');
        	echo "Date création : " . $date . "<br />";
        	$admin = $cafe->getAttribute('nickname');
        	echo "Admin : " . $admin . "<br/>";
        	$date = str_replace("/", "-", $date);
			$date = date("Y-m-d", strtotime($date));
			$adminID=add_admin($conn,$date,$admin);//ajout des admin
			verify_admin_date($conn,$date,$adminID);//verification date de creation etablissement avec date de creation utilisatuer
			//ICI ON VA INSERT DANS LA TABLE ETABLISSEMENT
        	$cafeName = $cafe->getElementsByTagName('Name')->item(0)->nodeValue;
        	echo "Name : " . $cafeName . "<br />"; 
        	$street = $cafe->getElementsByTagName('Street')->item(0)->nodeValue;
        	echo "Street : " . $street . "<br/>";
        	$num = $cafe->getElementsByTagName('Num')->item(0)->nodeValue;
        	echo "Num : " . $num . "<br/>";
        	$zip = $cafe->getElementsByTagName('Zip')->item(0)->nodeValue;
        	echo "Zip : " . $zip . "<br/>";
        	$city = $cafe->getElementsByTagName('City')->item(0)->nodeValue;
        	echo "City : " . $city . "<br/>";
        	$longitude = $cafe->getElementsByTagName('Longitude')->item(0)->nodeValue;
        	echo "Longitude : " . $longitude . "<br/>";
        	$latitude = $cafe->getElementsByTagName('Latitude')->item(0)->nodeValue;
        	echo "Latitude : " . $latitude . "<br/>";
        	$tel = $cafe->getElementsByTagName('Tel')->item(0)->nodeValue;
        	echo "Tel : " . $tel . "<br/>";
        	$site = $cafe->getElementsByTagName('Site')->item(0);
        	if ($site->nodeName) {
            	$site=$site->getAttribute('link');
            	echo "Site : " . $site. "<br />";
        	}else {
            	$site="";
            	echo "Site : Aucun site web n'est présent<br />";
        	}
        	$type="Bar";
        	$etablissementID=create_etablissement($conn,$cafeName,$street,$num,$zip,$city,$longitude,$latitude,$tel,$site,$type); //ajout etablissement
			add_modification_admin($conn,$etablissementID,$adminID,$date); //ajout dans la table ModificationAdmin
			//ICI ON VA INSERT DANS LA TABLE BAR
        	$smoking = $cafe->getElementsByTagName('Smoking')->item(0);
        	if ($smoking->nodeName) {
        		$smoking=1;
            	echo "Smoking : TRUE<br/>";
        	}else {
        		$smoking=0;
            	echo "Smoking : FALSE<br />";
        	}
 
    		$snack = $cafe->getElementsByTagName('Snack')->item(0);
        	if ($snack->nodeName) {
        		$snack=1;
            	echo "Snack : TRUE<br/>";
        	}else {
        		$snack=0;
            	echo "Snack : FALSE<br/>";
        	}
			try{
				$sql = 'SELECT * FROM Bar WHERE ID="'.$etablissementID.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
				if ($result==""){
					echo "BAR DOESN'T EXIST <br/>";
					$sql = 'INSERT INTO Bar (ID,fumeur,petiteRestauration) VALUES ("'.$etablissementID.'","'.$smoking.'","'.$snack.'")';
    				$conn->exec($sql);
					echo "INSERT BAR SUCCESS <br/>";
				}
				else{
					echo "BAR ALREADY EXIST <br/>";
				}
			}catch(PDOException $e) {
				echo "INSERT BAR FAIL :";
    			echo "Error: " . $e->getMessage()."<br/>";
			}
			//ICI ON VA INSERER LES COMMENTAIRE MAIS AUSSI LES UTILISATEUR QUI ONT DEJA COMMENTE
        	echo "--- COMMENT SECTION --- <br/>";
        	$commentList = $cafe->getElementsByTagName('Comment');
        	foreach ($commentList as $comment) {
        		$nickname = $comment->getAttribute('nickname');
        		$clientID=add_client($conn,$nickname,$date); //ajout des personne dans la data base
        	    $dateComment = $comment->getAttribute('date');
        	    $score = $comment->getAttribute('score');
        	    $comment = $comment->nodeValue;
        	    echo "&nbspNickname : " . $nickname . "<br/>";
        	    echo "&nbspDate : " . $dateComment . "<br/>";
            	echo "&nbspScore : " . $score . "<br/>";
            	echo "&nbspComment : " . $comment . "<br />";
            	$comment = addcslashes($comment,'"');
				$dateComment = str_replace("/", "-", $dateComment);
				$dateComment = date("Y-m-d", strtotime($dateComment));
        		add_comm_verif_date($conn,$etablissementID,$clientID,$dateComment,$comment,$score);
            	echo "***<br/>";
        	}
        	//ICI ON VA INSERER LES TAG
        	$tagList = $cafe->getElementsByTagName('Tag');
        	foreach ($tagList as $tag) {
        	    $nameTag = $tag->getAttribute('name');
        	    echo "Name Tag : " . $nameTag . "<br/>";
            	$userList = $tag->getElementsByTagName('User');
            	foreach ($userList as $user) {
            	    $user = $user->getAttribute('nickname');
            	    echo "&nbsp User : " . $user . "<br/>";
            	    add_tag($conn,$user,$date,$etablissementID,$nameTag);
            	}
        	}
        	echo "<br/>--- FIN DU CAFE ---<br/><br/>";
    	}
    }
    function hotel_xml($conn){
 		echo "<br/>*** LECTURE FICHIER HOTELS XML ***<br/>";
    	$dom = new DomDocument;
    	$dom->load("./datas/Hotels.xml") or die("Error: Cannot create object");	
    	$listHotel = $dom->getElementsByTagName('Hotel');
    	foreach ($listHotel as $hotel) {	
        	$date = $hotel->getAttribute('creationDate');
        	echo "Date création : " . $date . "<br />";
        	$admin = $hotel->getAttribute('nickname');
        	echo "Admin : " . $admin . "<br/>";
        	$date = str_replace("/", "-", $date);
			$date = date("Y-m-d", strtotime($date));
			$adminID=add_admin($conn,$date,$admin);//ajout des admin
			verify_admin_date($conn,$date,$adminID);//verification date de creation etablissement avec date de creation utilisatuer
			//ICI ON VA INSERT DANS LA TABLE ETABLISSEMENT
        	$hotelName = $hotel->getElementsByTagName('Name')->item(0)->nodeValue;
        	echo "Name : " . $hotelName . "<br />"; 
        	$street = $hotel->getElementsByTagName('Street')->item(0)->nodeValue;
        	echo "Street : " . $street . "<br/>";
        	$num = $hotel->getElementsByTagName('Num')->item(0)->nodeValue;
        	echo "Num : " . $num . "<br/>";
        	$zip = $hotel->getElementsByTagName('Zip')->item(0)->nodeValue;
        	echo "Zip : " . $zip . "<br/>";
        	$city = $hotel->getElementsByTagName('City')->item(0)->nodeValue;
        	echo "City : " . $city . "<br/>";
        	$longitude = $hotel->getElementsByTagName('Longitude')->item(0)->nodeValue;
        	echo "Longitude : " . $longitude . "<br/>";
        	$latitude = $hotel->getElementsByTagName('Latitude')->item(0)->nodeValue;
        	echo "Latitude : " . $latitude . "<br/>";
        	$tel = $hotel->getElementsByTagName('Tel')->item(0)->nodeValue;
        	echo "Tel : " . $tel . "<br/>";
        	$site = $hotel->getElementsByTagName('Site')->item(0);
        	if ($site->nodeName) {
            	$site=$site->getAttribute('link');
            	echo "Site : " . $site. "<br />";
        	}else {
            	$site="";
            	echo "Site : Aucun site web n'est présent<br />";
        	}
        	$type="Hotel";
        	$etablissementID=create_etablissement($conn,$hotelName,$street,$num,$zip,$city,$longitude,$latitude,$tel,$site,$type); //ajout etablissement
			add_modification_admin($conn,$etablissementID,$adminID,$date); //ajout dans la table ModificationAdmin
			//ICI ON VA INSERT DANS LA TABLE HOTEL
        	$stars = $hotel->getElementsByTagName('Stars')->item(0);
        	$stars = $stars->getAttribute('number');
        	echo "Stars : " . $stars . "<br/>";
        	$bedRooms = $hotel->getElementsByTagName('Bedrooms')->item(0);
        	$bedRooms = $bedRooms->getAttribute('capacity');
        	echo "Capacity : " . $bedRooms . "<br/>";
        	$price = $hotel->getElementsByTagName('PriceRange')->item(0);
        	$price = $price->nodeValue;
        	echo "Price : " . $price . "<br />";
        	try{
				$sql = 'SELECT * FROM Hotel WHERE ID="'.$etablissementID.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
				if ($result==""){
					echo "HOTEL DOESN'T EXIST <br/>";
					$sql = 'INSERT INTO Hotel (ID,prix,nbChambres,nbEtoiles) VALUES ("'.$etablissementID.'","'.(float)$price.'","'.(int)$bedRooms.'","'.(int)$stars.'")';
    				$conn->exec($sql);
					echo "INSERT HOTEL SUCCESS <br/>";
				}else{
					echo "HOTEL ALREADY EXIST <br/>";
				}
			}catch(PDOException $e) {
				echo "INSERT HOTEL FAIL :";
    			echo "Error: " . $e->getMessage()."<br/>";
			}
        	echo "--- COMMENT SECTION --- <br/>";
        	$commentList = $hotel->getElementsByTagName('Comment');
        	foreach ($commentList as $comment) {
            	$nickname = $comment->getAttribute('nickname');
				$clientID=add_client($conn,$nickname,$date); //ajout des personne dans la data base
            	$dateComment = $comment->getAttribute('date');
            	$score = $comment->getAttribute('score');
            	$comment=$comment->nodeValue;
            	echo "&nbspNickname : " . $nickname . "<br/>";
            	echo "&nbspDate : " . $dateComment . "<br/>";
            	echo "&nbspScore : " . $score . "<br/>";
            	echo "&nbspComment : " . $comment . "<br />";
            	$comment = addcslashes($comment,'"');
				$dateComment = str_replace("/", "-", $dateComment);
				$dateComment = date("Y-m-d", strtotime($dateComment));
				add_comm_verif_date($conn,$etablissementID,$clientID,$dateComment,$comment,$score);
            	echo "***<br/>";
        	}
			//ICI ON VA INSERER LES TAG
        	$tagList = $hotel->getElementsByTagName('Tag');
        	foreach ($tagList as $tag) {
        	    $nameTag = $tag->getAttribute('name');
        	    echo "Name Tag : " . $nameTag . "<br/>";	
        	    $userList = $tag->getElementsByTagName('User');
        	    foreach ($userList as $user) {
        	        $user = $user->getAttribute('nickname');
        	        echo "&nbsp User : " . $user . "<br/>";
        	    	add_tag($conn,$user,$date,$etablissementID,$nameTag);
        	    }
        	}
        	echo "<br/>--- FIN DE L'HOTEL ---<br/><br/>";
    	}
	}
	function parse(){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		include("connect.php");
		if ($conn_succes){
			echo "CONNEXION SUCCESS<br/>";
			echo "Lecture Fichier XML<br />";
			resto_xml($conn);
			bar_xml($conn);
			hotel_xml($conn);
		}else{
			echo "CONNEXION NON ETABLIE!";
		}
	}
	parse();
?>