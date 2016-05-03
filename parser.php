<?php
	/*$xml=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");
	print_r("Bonsoir vous aller bien ?");
  	$cible = $xml->getElementById("Name");
	echo $cible;
	print($cible);*/

	echo "Lecture Fichier XML<br />";
	#$dom=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");

	$dom = new DomDocument;
	$dom->load("./datas/Restaurants.xml") or die("Error: Cannot create object");
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

		$restoName = $resto->getElementsByTagName('Name')->item(0);
		echo "Name : " . $restoName->nodeValue . "<br />";

		$street = $resto->getElementsByTagName('Street')->item(0);
		echo "Street : " . $street->nodeValue . "<br />";

		$num = $resto->getElementsByTagName('Num')->item(0);
		echo "Num : " . $num->nodeValue . "<br />";

		$zip = $resto->getElementsByTagName('Zip')->item(0);
		echo "Zip : " . $zip->nodeValue . "<br/>";

		$city = $resto->getElementsByTagName('City')->item(0);
		echo "City : " . $city->nodeValue . "<br/>";

		$longitude = $resto->getElementsByTagName('Longitude')->item(0);
		echo "Longitude : " . $longitude->nodeValue . "<br />";

		$latitude = $resto->getElementsByTagName('Latitude')->item(0);
		echo "Latitude : " . $latitude->nodeValue . "<br />";

		$tel = $resto->getElementsByTagName('Tel')->item(0);
		echo "Tel : " . $tel->nodeValue . "<br />";

		$site = $resto->getElementsByTagName('Site')->item(0);
		if ($site->nodeName) {
			echo "Site : " . $site->getAttribute('link') . "<br />";
		}
		else {
			echo "Site : Aucun site web n'est présent<br />";
		}

		#TODO: Récupération des heures

		$takeAway = $resto->getElementsByTagName('TakeAway')->item(0);
		if ($takeAway->nodeName) {
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
	}
?>






















