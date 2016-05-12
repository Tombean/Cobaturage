<?php

echo "<h1> Voila le test d acces à AnnoncesVue !!! </h1>";

$url = ($_SERVER['REQUEST_URI']);
echo $url;
echo ' <br> ';

$racine = "/adupp/";

$uri ="";

$url = str_replace($racine,"", $url);
echo $url;
echo ' <br> ';

if ($url != "/") {
    $uri = explode("/", $url);
}

echo $uri[0];
echo ' <br> ';
if ($uri[0] == "Vue") {
    echo ' Le IF fonctionne ';
	echo ' <br> ';
}
?>