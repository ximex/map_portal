<?php

if ($signedIn) {

    require_once('classes/DBMap.php');

    $dbUser = new DBUser();
    $user = $dbUser->getUserBySessionId($_SESSION['id']);
    $dbUser = null;

    $dbMap = new DBMap();
    $maps = $dbMap->getAllOwnMaps($user['id']);
    $dbMap = null;

?>
    <h1>Meine Karten</h1>
    <table>
        <thead>
        <tr>
            <th>Name</th>
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
<?php

} else {
    require_once('pages/failure.php');
}

?>