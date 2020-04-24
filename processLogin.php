<?php include_once('lib/header.php');
// collecting  the data

$errorCount = 0;
// verifying the data, validation


$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;
$timestamp = date_create();

$_SESSION['email'] = $email;
// $_SESSION['password'] = $password;

/*
*
*/
if ($errorCount > 0) {
  // redirect back and display error
  $session_error = "You Have " . $errorCount . " error";
  if ($errorCount > 1) {
    $session_error .= "s";
  }
  $session_error .= " in your form submission";
  $_SESSION["error"] = $session_error;

  header("Location: login.php ");
} else {
  $allUsers = scandir("db/users/");
  $countAllUsers = count($allUsers);

  for ($counter = 0; $counter < $countAllUsers; $counter++) {

    $currentUser = $allUsers[$counter];

    if ($currentUser == $email . ".json") {

      /// check password
      $userString = file_get_contents("db/users/" . $currentUser);
      $userObject = json_decode($userString);

      $passwordFromDb = $userObject->password;
      $passwordFromUser = password_verify($password, $passwordFromDb);


      if ($passwordFromDb == $passwordFromUser) {
        //    redirect to dashboard
        $_SESSION['loggedIn'] = $userObject->id;
        $_SESSION['email'] = $userObject->email;
        $_SESSION['fullname'] = $userObject->first_name . " " . $userObject->last_name;
        $_SESSION['role'] = $userObject->designation;
        $_SESSION[] = $timestamp;
      //  timestamp
      file_put_contents("db/timestamp/" . $email . ".json", json_encode($timestamp));
        header('Location: dashboard.php');
        die();
      }
    }
  }

  $_SESSION['error'] = "Invalid Email or Password";
  header("Location: login.php");
  die();
}
