<?php
$xml=simplexml_load_file("./datas/Cafes.xml") or die("Error: Cannot create object");
print_r($xml);
?>