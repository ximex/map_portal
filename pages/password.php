<?php

if ($signedIn) {
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        require_once('classes/DBUser.php');
        require_once('classes/User.php');

        $dbUser = new DBUser();
        $userPw = $dbUser->getPasswordBySessionId($_SESSION['id']);
        $dbUser = null;

        if (password_verify($_POST['password_old'], $userPw['password']) && strlen($_POST['password']) >= 8 && $_POST['password'] === $_POST['password2']) {
            $oldSession = $_SESSION['id'];
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            session_regenerate_id(true);
            $_SESSION['id'] = session_id();

            $dbUser = new DBUser();
            $dbUser->updateSession($oldSession, $_SESSION['id']);
            $dbUser->updatePassword($_SESSION['id'], $password_hash);
            $dbUser = null;

            $text = 'Passwort geändert!';
        } else {
            $text = 'Ein oder mehrere Daten nicht korrekt!';
        }
    }
?>
    <form method="post" action="index.php?page=password">
        <fieldset>
            <legend>Passwort</legend>
            <ul>
                <?php if (isset($_POST['save'])) {
                    print('<li><span style="color: #cc0000; font-weight: bold">' . $text . '</span></li>');
                } ?>
                <li><label>Passwort Alt: <input type="password" id="password_old" name="password_old"
                                                required="required"/></label></li>
                <li><label>Passwort: <input type="password" id="password" name="password" required="required"/></label>
                </li>
                <li><label>Passwort (2): <input type="password" id="password2" name="password2"
                                                required="required"/></label></li>
            </ul>
        </fieldset>
        <input type="submit" id="save" name="save" value="Speichern"/>
    </form>
<?php

} else {
    require_once('pages/failure.php');
}

?>