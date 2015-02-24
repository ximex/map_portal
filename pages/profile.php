<?php

if ($signedIn) {

    require_once('classes/DBUser.php');
    require_once('classes/User.php');

    $dataCorrect = false;

    $dbUser = new DBUser();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
        $updatedUser = new User($_POST['email'], $_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['birthday']);
        if ($updatedUser->checkOptional()) {
            $dbUser->updateUser($_SESSION['id'], $updatedUser);

            $dataCorrect = true;
        }
    }
    $user = $dbUser->getUserBySessionId($_SESSION['id']);
    $dbUser = null;

    ?>
    <form method="post" action="index.php?page=profile">
        <p><a href="index.php?page=password">Passwort ändern...</a></p>
        <fieldset>
            <legend>Grunddaten</legend>
            <ul>
                <li><label>Email: <input type="email" id="email" name="email" required="required" maxlength="64" autofocus="autofocus"
                                         disabled="disabled" value="<?= $user['email'] ?>"/></label></li>
                <li><label>Username: <input type="text" id="username" name="username" required="required" maxlength="32"
                                            disabled="disabled" value="<?= $user['username'] ?>"/></label></li>
            </ul>
        </fieldset>
        <fieldset>
            <legend>Optional</legend>
            <ul>
                <?php if (isset($_POST['save']) && !$dataCorrect) {
                    print('<li><span style="color: #cc0000; font-weight: bold">Ein oder mehrere Daten nicht korrekt!</span></li>');
                } ?>
                <li><label>Vorname: <input type="text" id="first_name" name="first_name" maxlength="24"
                                           value="<?= $user['first_name'] ?>"/></label></li>
                <li><label>Nachname: <input type="text" id="last_name" name="last_name" maxlength="24"
                                            value="<?= $user['last_name'] ?>"/></label></li>
                <li><label>Adresse: <input type="text" id="address" name="address" maxlength="128"
                                           value="<?= $user['address'] ?>"/></label></li>
                <li><label>Geburtstag: <input type="date" id="birthday" name="birthday" maxlength="10"
                                              value="<?= $user['birthday'] ?>"/></label></li>
            </ul>
        </fieldset>
        <input type="submit" id="save" name="save" value="Speichern"/>
    </form>
<?php

} else {
    require_once('pages/failure.php');
}

?>