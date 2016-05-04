<?php
	/*$xml=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");
	print_r("Bonsoir vous aller bien ?");
  	$cible = $xml->getElementById("Name");
	echo $cible;
	print($cible);*/

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	include("connect.php");
	echo "Lecture Fichier XML<br />";
	#$dom=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");
	$dom = new DomDocument;
	$dom->load("./datas/Restaurants.xml") or die("Error: Cannot create object");
	$today = date("Y-m-d");
	/*$listePays = $dom->getElementsByTagName('Street');
	foreach($listePays as $pays)
		echo $pays->firstChild->nodeValue . "<br />";*/

	echo "*** LECTURE RESTAU XML ***<br />";

	$listResto = $dom->getElementsByTagName('Restaurant');
	foreach ($listResto as $resto) {
		//echo $resto->nodeName . "<br />" . $resto->nodeValue . "<br />" . "<br />";

		$date = $resto->getAttribute('creationDate');
		echo "Date création : " . $date . "<br />";

		$admin = $resto->getAttribute('nickname');
		echo "Admin : " . $admin . "<br />";
		/*try{
			$isAdmin=1;
			$sql = 'INSERT INTO Utilisateur (identifiant,mot_de_passe,email,dateCreation,isAdmin) VALUES ("'.$admin.'","'.$admin.'","'.$admin.'@email.com","'.$today.'","'.$isAdmin.'")';
    		$conn->exec($sql);
			echo "Insert Utilisateur Admin SUCCESS <br/>";
		}
		catch(PDOException $e) {
			echo "Insert Utilisateur FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}*/
		$date = str_replace("/", "-", $date);
		$date = date("Y-m-d", strtotime($date));
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
		}
		catch(PDOException $e) {
			echo "GET ID ADMIN FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
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
		/*
		 * ICI ON VA INSERT DANS LA TABLE ETABLISSEMENT
		 */
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
		}
		else {
			$site="";
			echo "Site : Aucun site web n'est présent<br />";
		}
		/*try{
			$sql = 'INSERT INTO Etablissement (nom,rue,numero,codePostal,localite,longitude,latitude,telephone,lienWeb,type) VALUES ("'.$restoName.'","'.$street.'","'.(int)$num.'","'.(int)$zip.'","'.$city.'","'.(float)$longitude.'","'.(float)$latitude.'","'.$tel.'","'.$site.'","Restaurant")';
    		$conn->exec($sql);
			echo "Insert Etablissement SUCCESS <br/>";
		}
		catch(PDOException $e) {
			echo "Insert Etablissement FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}*/
		try{
			$sql = 'SELECT ID FROM Etablissement WHERE nom="'.$restoName.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result==""){
				echo "ETABLISSEMENT DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO Etablissement (nom,rue,numero,codePostal,localite,longitude,latitude,telephone,lienWeb,type) VALUES ("'.$restoName.'","'.$street.'","'.(int)$num.'","'.(int)$zip.'","'.$city.'","'.(float)$longitude.'","'.(float)$latitude.'","'.$tel.'","'.$site.'","Restaurant")';
    			$conn->exec($sql);
				echo "INSERT ETABLISSEMENT SUCCESS <br/>";
				$sql = 'SELECT ID FROM Etablissement WHERE nom="'.$restoName.'"';
				$stmt = $conn->prepare($sql); 
				$stmt->execute();
				$result=$stmt->fetch();
				}
			else{
				echo "ETABLISSEMENT ALREADY EXIST <br/>";
			}
			$etablissementID=$result[0];
			echo "GET ID ETABLISSEMENT SUCCESS ".$result[0]." <br/>";
		}
		catch(PDOException $e) {
			echo "GET ID ETABLISSEMENT FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
		//insert des modification Admin
		try{
			//$sql = 'INSERT INTO ModificationAdmin (etablissementID,adminID,dateCreation) VALUES ("'.$etablissementID.'","'.$adminID.'","'.$date.'")'; 
    		//$conn->exec($sql);
			//echo "Insert ModificationAdmin SUCCESS <br/>";
		//}
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
		/*
		 * ICI ON VA INSERT DANS LA TABLE RESTAURANT
		 */

		$dayList = $resto->getElementsByTagName('On');
		$days = array ('0', '0', '0', '0', '0', '0', '0');

		foreach ($dayList as $day) {
			$dayNumber = $day->getAttribute('day');
			echo "day : " . $dayNumber;

			if ($day->hasAttribute('hour') && $day->getAttribute('hour') == "am") {
				$days[(int)$dayNumber] = 2;
				echo " am<br/>";
			}
			elseif ($day->hasAttribute('hour') && $day->getAttribute('hour') == "pm") {
				$days[(int)$dayNumber] = 3;
				echo " pm<br/>";
			}
			else {
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
		}
		else {
			$delivery=0;
			echo "Delivery : False <br />";
		}

		$price = $resto->getElementsByTagName('PriceRange')->item(0);
		$price=$price->nodeValue;
		echo "Price : " . $price . "<br />";

		$banquet = $resto->getElementsByTagName('Banquet')->item(0);
		$banquet=$banquet->getAttribute('capacity');
		echo "Banquet : " . $banquet . "<br />";

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
		}
		catch(PDOException $e) {
			echo "INSERT RESTAURANT FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
  
  		/*
  		 * ICI ON VA INSERER LES COMMENTAIRE MAIS AUSSI LES UTILISATEUR QUI ONT DEJA COMMENTE
  		 *
  		 */
		echo "--- COMMENT SECTION --- <br/>";
		$commentList = $resto->getElementsByTagName('Comment');
		foreach ($commentList as $comment) {
			$nickname = $comment->getAttribute('nickname');
		try{
			$sql = 'SELECT ID FROM Utilisateur WHERE identifiant="'.$nickname.'"';
			$stmt = $conn->prepare($sql); 
			$stmt->execute();
			$result=$stmt->fetch();
			if ($result==""){
				echo "CLIENT DOESN'T EXIST <br/>";
				$sql = 'INSERT INTO Utilisateur (identifiant,mot_de_passe,email,dateCreation) VALUES ("'.$nickname.'","'.$nickname.'","'.$nickname.'@email.com","'.$today.'")';
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
		}
		catch(PDOException $e) {
			echo "GET ID CLIENT FAIL :";
    		echo "Error: " . $e->getMessage()."<br/>";
		}
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
		echo "***<br/>";
		}
		$tagList = $resto->getElementsByTagName('Tag');
		foreach ($tagList as $tag) {
			$nameTag = $tag->getAttribute('name');
			echo "Name Tag : " . $nameTag . "<br/>";

			$userList = $tag->getElementsByTagName('User');
			foreach ($userList as $user) {
				echo "&nbsp User : " . $user->getAttribute('nickname') . "<br/>";
			}
		}

		echo "<br/>--- FIN DU RESTAU<br/><br/>";
	}
/*
	echo "<br/>*** LECTURE FICHIER CAFE XML ***<br/>";

	$dom = new DomDocument;
	$dom->load("./datas/Cafes.xml") or die("Error: Cannot create object");

	$listCafe = $dom->getElementsByTagName('Cafe');
	foreach ($listCafe as $cafe) {

		$date = $cafe->getAttribute('creationDate');
		echo "Date création : " . $date . "<br />";

		$admin = $cafe->getAttribute('nickname');
		echo "Admin : " . $admin . "<br/>";

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

		$tel = $cafe->getElementsByTagName('Zip')->item(0)->nodeValue;
		echo "Tel : " . $tel . "<br/>";

		$smoking = $cafe->getElementsByTagName('Smoking')->item(0);
		if ($smoking->nodeName) {
			echo "Smoking : TRUE<br/>";
			#TODO: Envoyer TRUE
		}
		else {
			echo "Smoking : FALSE<br />";
			#TODO: Envoyer FALSE
		}

		$snack = $cafe->getElementsByTagName('Snack')->item(0);
		if ($snack->nodeName) {
			echo "Snack : TRUE<br/>";
			#TODO: Envoyer TRUE
		}
		else {
			echo "Snack : FALSE<br/>";
			#TODO: Envoyer FALSE
		}

		echo "--- COMMENT SECTION --- <br/>";
		$commentList = $cafe->getElementsByTagName('Comment');
		foreach ($commentList as $comment) {
			$nickname = $comment->getAttribute('nickname');
			$dateComment = $comment->getAttribute('date');
			$score = $comment->getAttribute('score');
			$commentText = $comment->nodeValue;

			echo "&nbspNickname : " . $nickname . "<br/>";
			echo "&nbspDate : " . $dateComment . "<br/>";
			echo "&nbspScore : " . $score . "<br/>";
			echo "&nbspComment : " . $commentText . "<br />";
			echo "***<br/>";
		}

		$tagList = $cafe->getElementsByTagName('Tag');
		foreach ($tagList as $tag) {
			$nameTag = $tag->getAttribute('name');
			echo "Name Tag : " . $nameTag . "<br/>";

			$userList = $tag->getElementsByTagName('User');
			foreach ($userList as $user) {
				$userName = $user->getAttribute('nickname');
				echo "&nbsp User : " . $userName . "<br/>";
			}
		}

		echo "<br/>--- FIN DU CAFE ---<br/><br/>";
	}*/
?>






















