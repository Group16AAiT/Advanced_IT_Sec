<?php

declare(strict_types=1);

require '../vendor/autoload.php';
include "../Manager/session.php";
$sessionClass = new sessionClass();


$secret = 'XVQ2UIGO75XRUKJO';

// $secret = $g->generateSecret();
$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('Group 16', $secret, 'Advanced IT Sec project');
if (isset($_POST["user_2fa_next"])) {
    echo "here";
    $code = $_POST['usercode'];
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
    if ($g->checkCode($secret, $code)) {
        $sessionClass->setCode($code);
       header("Location: index.php");
       exit();
    } else {
        echo 'Incorrect or expired code!';
    }
}
echo "<img src=" . $link . ">";


// include_once '../vendor/sonata-project/google-authenticator/src/FixedBitNotation.php';
// include_once '../vendor/sonata-project/google-authenticator/src/GoogleAuthenticatorInterface.php';
// include_once '../vendor/sonata-project/google-authenticator/src/GoogleAuthenticator.php';
// include_once '../vendor/sonata-project/google-authenticator/src/GoogleQrUrl.php';

// $g = new \Google\Authenticator\GoogleAuthenticator();
// $salt = '7WAO342QFANY6IKBF7L7SWEUU79WL3VMT920VB5NQMW';
// $secret = $username.$salt;
// echo '<img src="'.$g->getURL($username, 'example.com', $secret).'" />';
?>
<form method="post" action="2FA.php">
    <div class='form'>

        <div class="row">
            <div class="input-field col s12">
                <input id="code" name="usercode">
                <label for="code">Code</label>
            </div>
        </div>

        <div class="row">

            <div class="input-field col s12">

                <input type="submit" name="user_2fa_next" class="btn" value="Next">

            </div>


        </div>
    </div>
</form>