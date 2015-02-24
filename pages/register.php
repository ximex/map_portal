<?php

$text = '';
$registrationSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    require_once('classes/User.php');

    $newUser = new User($_POST['email'], $_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['birthday']);

    if ($newUser->checkRequired() && $newUser->checkIfExisting() && $newUser->checkPassword($_POST['password'], $_POST['password2']) && $newUser->checkOptional()) {
        print_r('done');
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        require_once('classes/DBUser.php');
        $dbUser = new DBUser();
        $dbUser->insertNewUser($newUser, $password_hash);
        $dbUser = null;

        $registrationSuccess = true;
    } else {
        $text = '<li><span style="color: #cc0000; font-weight: bold">Ein oder mehrere Daten nicht korrekt!</span></li>';
    }
}
if ($registrationSuccess) {
?>
    <h1>Erfolgreich registriert</h1>
    <p>Sie können sich nun <a href="index.php?page=login">hier</a> einloggen.</p>
<?php

} else {

?>
    <form method="post" action="index.php?page=register">
        <fieldset>
            <legend>Grunddaten</legend>
            <ul>
                <?php if (isset($_POST['register'])) {
                    print($text);
                } ?>
                <li><label>Email: <input type="email" id="email" name="email" required="required"
                                         autofocus="autofocus"/></label></li>
                <li><label>Username: <input type="text" id="username" name="username" required="required"/></label></li>
                <li><label>Passwort: <input type="password" id="password" name="password" required="required"/></label>
                </li>
                <li><label>Passwort (2): <input type="password" id="password2" name="password2"
                                                required="required"/></label></li>
            </ul>
        </fieldset>
        <fieldset>
            <legend>Optional</legend>
            <ul>
                <li><label>Vorname: <input type="text" id="first_name" name="first_name"/></label></li>
                <li><label>Nachname: <input type="text" id="last_name" name="last_name"/></label></li>
                <li><label>Adresse: <input type="text" id="address" name="address"/></label></li>
                <li><label>Geburtstag: <input type="date" id="birthday" name="birthday"/></label></li>
            </ul>
        </fieldset>
        <input type="submit" id="register" name="register" value="Registrieren"/>
    </form>
<?php

}

?>