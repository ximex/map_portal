<?php

require_once('classes/DBMap.php');

$dbMap = new DBMap();
$maps = $dbMap->getAllActiveMaps();
$dbMap = null;

?>
<h1>Aktive Karten</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Author</th>
            <th>Erstelldatum</th>
            <th>Anfragen</th>
            <th>Bounds</th>
            <th>Startpunkt</th>
            <th>Zur Karte</th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ($maps as $map) {
    echo('<tr>');
    echo('<td>' . $map['name'] . '</td>');
    echo('<td>' . $map['username'] . '</td>');
    echo('<td>' . $map['build'] . '</td>');
    echo('<td>' . $map['requests'] . '</td>');
    echo('<td>' . $map['bounds'] . '</td>');
    echo('<td>' . $map['startpoint'] . '</td>');
    echo('<td><a href="index.php?page=map&mapid=' . $map['id'] . '">zur Karte...</a></td>');
    echo('</tr>');
}

?>
    </tbody>
</table>