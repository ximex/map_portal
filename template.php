<?php

if (isset($_GET['page'])) {
    if (isset($_POST['login']) && $_GET['page'] === 'maps' && !$loginAllowed) {
        $page = 'login';
    }
    $page = $_GET['page'];
} else {
    $page = 'home';
}

$pageFile = 'pages/' . $page . '.php';
if (!file_exists($pageFile)) {
    $pageFile = 'pages/failure.php';
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Map Portal</title>

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css"/>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

    <script defer="defer" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script defer="defer" src="//cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/leaflet.js"></script>
</head>
<body>
<div id="container">
    <header>
        <nav id="nav">
            <?php require_once('nav.php'); ?>
        </nav>
        <nav id="auth">
            <?php require_once('auth.php'); ?>
        </nav>
        <span class="clear"></span>
    </header>
    <section id="main" class="clear">
        <?php require_once($pageFile); ?>
    </section>
    <footer>
        &copy; 2014 Thomas Rupprecht
    </footer>
</div>
</body>
</html>