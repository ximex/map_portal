<li><a href="index.php?page=home">Home</a></li>
<li><a href="index.php?page=maps">Kartenübersicht</a></li>
<?php if ($signedIn) { ?>
    <li><a href="index.php?page=mymaps">Meine Karten</a></li>
    <li><a href="index.php?page=newmap">Karte anlegen</a></li>
<?php } ?>