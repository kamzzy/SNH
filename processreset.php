<?php

include_once('lib/header.php');
// collecting  the data

$errorCount = 0;

if(!$_SESSION['loggedin']){
$token = $_POST['token'] != "" ? $_POST['token'] : $errorCount++;

}
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['token'] = $token;
$_SESSION['email'] = $email;

if ($errorCount > 0) {

    $session_error = "You Have " . $errorCount . " error";
    if ($errorCount > 1) {
        $session_error .= "s";
    }
    $session_error .= " in your form submission";
    $_SESSION["error"] = $session_error;

    header("Location: reset.php ");
} else {
    // TODO: do actual reset things here

    // check that the email is registered in token's folder
    $allUserTokens = scandir("db/token/");
    $countAllUserTokens = count($allUserTokens);
    // check if the content of the registered token (in our folder) is the same as $token

    for ($counter = 0; $counter < $countAllUserTokens; $counter++) {
        $currentTokenFile = $allUserTokens[$counter];

        if ($currentTokenFile == $email . ".json") {
            //    check if the token in the currentTokenFile is the same as $token

            $tokenContent = file_get_contents("db/token/" . $currentTokenFile);
            $tokenObject = json_decode($tokenContent);
            $tokenFromDb = $tokenObject->token;

            // TODO: check for fix  later
            if(!$_SESSION['loggedin']){
                $checkToken = true;
            }else{
                $checkToken = $tokenFromDb == $token;
            }


            if ($checkToken) {

                $allUsers = scandir("db/users/");
                $countAllUsers = count($allUsers);

                for ($counter = 0; $counter < $countAllUsers; $counter++) {

                    $currentUser = $allUsers[$counter];

                    if ($currentUser == $email . ".json") {

                        $userString = file_get_contents("db/users/" . $currentUser);
                        $userObject = json_decode($userString);

                        $userObject->password = password_hash($password, PASSWORD_DEFAULT);

                        unlink('db/users/' . $currentUser);  //file delete, user data deleted
                        file_put_contents("db/users/" . $email . ".json", json_encode($userObject));

                        $_SESSION['message'] = "password reset successful, you can now login ";

                       /**
                        *  inform user of password reset via email
                        */ 

                        $subject = "Password reset successful";
                        $message = "Your account on snh has been updated, your password has changed,if you did not initiate the password reset, please visit snh.org and reset your password immediately";
                          
                        $headers = "From: no-reply@snh.org" . "\r\n" .
                            "CC: ziri@snh.org";

                        $try = mail($email, $subject, $message, $headers);
                        /**
                         * inform user of password reset end
                         */

                        header("Location: login.php");
                        die();
                    }
                }
            }
        }
    }
    $_SESSION['error'] = "Password reset failed, token/email invalid or expired";
    header("Location: login.php");
}
