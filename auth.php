<?php if ($signedIn) { ?>
    <li><a href="index.php?page=profile">Profil</a></li>
    <li><a href="index.php?page=home&logout=logout">Logout</a></li>
<?php } else { ?>
    <li><a href="index.php?page=register">Registrieren</a></li>
    <li><a href="index.php?page=login">Login</a></li>
<?php } ?>