<?php

require_once('classes/DBMap.php');

$dbMap = new DBMap();
$maps = $dbMap->getBestMaps();
$dbMap = null;

?>
<h1>Willkommen im Map-Portal!</h1>
<h3>Folgende Karten können wir empfehlen:</h3>
<ul>
<?php

foreach ($maps as $map) {
    echo('<li><a href="index.php?page=map&mapid=' . $map['id'] . '">' . $map['name'] . '</a> - ' . $map['description'] . '</li>');
}

?>
</ul>