<?php 

include_once('lib/header.php');
// collecting  the data
 
$errorCount = 0;

$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$_SESSION['email'] = $email;

if($errorCount > 0) {
    // redirect back and display error
    $session_error = "You Have " . $errorCount . " error";
   if ($errorCount > 1) { 
       $session_error .="s";
}
$session_error .= " in your form submission";
$_SESSION["error"] = $session_error;

    header("Location: forgot.php ");
}else{
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);

    for($counter = 0; $counter < $countAllUsers; $counter++) {
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
        //  send the email and redirect to the reset password page

        /** 
         * 
         * Generating token code starts here
         * 
         **/
        $token =    "";   
        $alphabets =['a','b','c', 'd','e','f', 'g', 'h', 'i', 'j', 'k', 
        'l', 'm','n','o','p','q','r','s','t','u','v','w','A','B',
        'C','D','E','F','G','H','I','J','K','L','M','N','O','P',
        'Q','R','S','T','U','V','W','X','Y','Z'];
        
        //   get random number
        for ($i = 0; $i < 20; $i++){
        // get element in aplhapets at the index of random number
        $index = mt_rand(0,count($alphabets)-1);
        // add that to the token string 
          $token .= $alphabets[$index];
         } 
         /* 
         * Generating token ends here
         */
        $subject = "Password reset link";
        $message = "A password request has been initiated from your account, if you did not intiate this request, please ignore this message. otherwise, visit: http://localhost:8888/phpTutorial/reset.php?token=".
        $token;
            $headers = "From: no-reply@ziri.com" . "\r\n" .
        "CC: ziri@gmail.com";
        
           // token
           file_put_contents("db/token/" . $email. ".json", json_encode (['token' => $token]));

        $try = mail($email,$subject,$message,$headers);
       
        if($try){
            // display a success message
            $_SESSION["message"] = "Password reset has been sent to your email " . $email;
            header("Location: login.php");
        }else{
            // display error
            $_SESSION["error"] = "something went wrong, we could  not send a password request to " . $email;
            header("Location: forgot.php");
        }
            die();

       }

        

    }
        $_SESSION["error"] = "Email not registered with us ERR " . $email;
         header("Location: forgot.php");
}

?>