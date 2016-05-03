<?php
	/*$xml=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");
	print_r("Bonsoir vous aller bien ?");
  	$cible = $xml->getElementById("Name");
	echo $cible;
	print($cible);*/
	echo "Lecture Fichier XML<br />";
	#$dom=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");
	$dom = new DomDocument;
	$dom->load("./datas/Restaurants.xml");
	/*$listePays = $dom->getElementsByTagName('Street');
	foreach($listePays as $pays)
		echo $pays->firstChild->nodeValue . "<br />";*/

	echo "--- <br />";

	$listResto = $dom->getElementsByTagName('Restaurant');
	foreach ($listResto as $resto) {
		//echo $resto->nodeName . "<br />" . $resto->nodeValue . "<br />" . "<br />";

		$date = $resto->getAttribute('creationDate');
		echo "Date création : " . $date . "<br />";

		$admin = $resto->getAttribute('nickname');
		echo "Admin : " . $admin . "<br />";

		$restoName = $resto->getElementsByTagName('Name')->item(0);
		echo "Name : " . $restoName->nodeValue . "<br />";

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
			$site=$site->getAttribute('link')
			echo "Site : " . $site . "<br />";
		}
		else {
			$site="";
			echo "Site : Aucun site web n'est présent<br />";
		}
		//$stmt = $conn->prepare("INSERT INTO Etablissement (nom,rue,numero,codePostal,localite,longitude,latitude,telephone,lienWeb,type) VALUES (".$restoName.",".$street.",".$num.",".$zip.",".$city.",".$longitude.",".$latitude.",".$tel.",".$site.")"; 
		//$stmt->execute();
		#TODO: Récupération des heures

		$takeAway = $resto->getElementsByTagName('TakeAway')->item(0);
		if ($site->nodeName) {
			echo "Take away : True <br />";
		}
		else {
			echo "Take away : False <br />";
		}

		$delivery = $resto->getElementsByTagName('Delivery')->item(0);
		if ($delivery->nodeName) {
			echo "Delivery : True <br />";
		}
		else {
			echo "Delivery : False <br />";
		}

		$price = $resto->getElementsByTagName('PriceRange')->item(0);
		echo "Price : " . $price->nodeValue . "<br />";

		$banquet = $resto->getElementsByTagName('Banquet')->item(0);
		echo "Banquet : " . $banquet->getAttribute('capacity') . "<br />";
  
		echo "--- COMMENT SECTION --- <br/>";
		$commentList = $resto->getElementsByTagName('Comment');
		foreach ($commentList as $comment) {
			$nickname = $comment->getAttribute('nickname');
			$dateComment = $comment->getAttribute('date');
			$score = $comment->getAttribute('score');

			echo "Nickname : " . $nickname . "<br/>";
			echo "Date : " . $dateComment . "<br/>";
			echo "Score : " . $score . "<br/>";
			echo "Comment : " . $comment->nodeValue . "<br />";
			echo "***<br/>";
		}

		#TODO: Récupérer les TAGS

		echo "<br/>--- <br/><br/>";

	}


?>