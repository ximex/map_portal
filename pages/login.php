<?php

?>
<form method="post" action="index.php?page=maps">
    <fieldset>
        <legend>Login</legend>
        <ul>
            <?php if (isset($_POST['login']) && !$loginAllowed) {
                print('<li><span style="color: #cc0000; font-weight: bold">User/Passwort falsch!</span></li>');
            } ?>
            <li><label>User: <input type="text" id="user" name="user" required="required" autofocus="autofocus"/></label></li>
            <li><label>Passwort: <input type="password" id="password" name="password" required="required"/></label></li>
        </ul>
    </fieldset>
    <input type="submit" id="login" name="login" value="Login"/>
</form>