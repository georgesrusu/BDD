<?php
	/*$xml=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");
	print_r("Bonsoir vous aller bien ?");
  	$cible = $xml->getElementById("Name");
	echo $cible;
	print($cible);*/

	echo "Début Teste<br />";
	#$dom=simplexml_load_file("./datas/Restaurants.xml") or die("Error: Cannot create object");

	$dom = new DomDocument;
	$dom->load("./datas/Restaurants.xml");
	$listePays = $dom->getElementsByTagName('Street');
	foreach($listePays as $pays)
		echo $pays->firstChild->nodeValue . "<br />";

	echo "--- <br />";

	$listResto = $dom->getElementsByTagName('Restaurant');
	foreach ($listResto as $resto) {
		echo $resto->nodeName . "<br />" . $resto->nodeValue . "<br />" . "<br />";

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

		#TODO: Condition: Si le site existe
		#$site = $resto->getElementsByTagName('Site')->item(0);
		#echo "Site : " . $site->getAttribute('link') . "<br />";

		#TODO: Récupération des heures

		#TODO: Condition si TakeAway et Delivery Existe

		$price = $resto->getElementsByTagName('PriceRange')->item(0);
		echo "Price : " . $price->nodeValue . "<br />";

		$banquet = $resto->getElementsByTagName('Banquet')->item(0);
		echo "Banquet : " . $banquet->getAttribute('capacity') . "<br />";

		#TODO: Liste pour récuperer les comment
		/*$comment = $resto->getElementsByTagName('Comment')->item(1);
		echo "Comment 2 : " . $comment->getAttribute('nickname') . "<br />";*/

		#TODO: Même chose pour les tag et les user    

		echo "<br/>--- <br/><br/>";

	}


?>