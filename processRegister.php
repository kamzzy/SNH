<?php 
include_once('lib/header.php');
// collecting  the data
 
$errorCount = 0;
// verifying the data, validation

$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] : $errorCount++; 
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] : $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++; 
$gender = $_POST['gender'] != "" ? $_POST['gender'] : $errorCount++; 
$designation= $_POST['designation'] != "" ? $_POST['designation'] : $errorCount++; 
$department = $_POST['department'] != "" ? $_POST['department'] : $errorCount++; 

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;

if($errorCount > 0) {
    // redirect back and display error
    $session_error = "You Have " . $errorCount . " error";
   if ($errorCount > 1) { 
       $session_error .="s";
}
$session_error .= " in your form submission";
$_SESSION["error"] = $session_error;

    header("Location: register.php ");
}else{
    // count all users
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);
    $newUserId = ($countAllUsers -2) +1;


// assign ID to the new user
 $userObject =[
'id' => $newUserId,
'first_name' => $first_name, 
'last_name' => $last_name,
'email' => $email,
'password' => password_hash($password, PASSWORD_DEFAULT ),  // password hashing
'gender' => $gender,
'designation' => $designation,
'department'=> $department

    ];
    // check if user already exists
    
    // assign the next ID to the new user
    // count($users =>2, next should then be ID 3

    // loop
     
    for($counter = 0; $counter < $countAllUsers; $counter++) {
        $currentUser = $allUsers[$counter];

        if($currentUser == $email . ".json"){
            $_SESSION["error"] = "User already exists " . $first_name;
            header("Location: register.php");
            die();
        }

    }
    file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
    $_SESSION["message"] = "Registration Successful, you can now login " . $first_name;
    
    // inform client of a successful registration

    $subject = "Signup successful";
                        $message = " You have successfully signed up at SNH ";
                          
                        $headers = "From: customercare@snh.org" . "\r\n" .
                            "CC: ziri@snh.org";

                        $signup = mail($email, $subject, $message, $headers);
    header("Location: login.php");
}

// this is a long way of performing data validation


// $errorArray = [];
// // verifying the data, validation

// if($first_name == "") {
//     $errorArray = "first name cant be blank";
// }
// if($last_name == "") {
//     $errorArray = "last name cant be blank";
// }
// if($email == "") {
//     $errorArray = "email cant be blank";
// }
// if($password == "") {
//     $errorArray = "password cant be blank";
// }
// if($gender == "") {
//     $errorArray = "gender cant be blank";
// }
// if($designation == "") {
//     $errorArray = "designation cant be blank";
// }
// if($department == "") {
//     $errorArray = "department cant be blank";
// }

// print_r($errorArray);
// saving the data into the database(folder)

// return back to the page with a string status
?>