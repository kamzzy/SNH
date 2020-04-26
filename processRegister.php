<?php 
include_once('lib/header.php');
// collecting  the data
 
// $session_error();
// verifying the data, validation

$first_name = $_POST['first_name'];
// != "" ? $_POST['first_name'] : $session_error; 
$last_name = $_POST['last_name'];
// != "" ? $_POST['last_name'] : $session_error;
$email = $_POST['email']; 
// != "" ? $_POST['email'] : $session_error;
$password = $_POST['password']; 
// != "" ? $_POST['password'] : $session_error; 
$gender = $_POST['gender']; 
// != "" ? $_POST['gender'] : $session_error; 
$designation= $_POST['designation'] ;
// != "" ? $_POST['designation'] : $session_error; 
$department = $_POST['department'] ;
// != "" ? $_POST['department'] : $session_error; 

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // redirect back and display error
    if (empty($_POST['email'])) {
		$session_error= 'Please enter your email';
	} elseif ($_POST['email']){
	
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$session_error= 'Invalid Email Format';
		}
	}else{
        $email = validator($_POST['email']);
    }
    if (empty($_POST['last_name'])) {
		$session_error = 'Last Name should be filled';
	} elseif ($_POST['last_name']) {
		if (!preg_match('/^[a-zA-Z\s]+$/', $last_name)) {
			$session_error = 'last Name can only contain letters,and white spaces';
		}
	} else {
        $last_name = validator($_POST['last_name']);
    }

    if (empty($_POST['first_name'])) {
		$session_error = 'First Name should be filled';
	} elseif ($_POST['first_name']) {
		if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
			$session_error = 'First Name can only contain letters,and white spaces';
		}
	} else {
        $first_name = validator($_POST['first_name']);
    }
    
    
   
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

function validator($formData) {
    $formData = trim($formData);
    $formData = stripslashes($formData);
    $formData = htmlspecialchars($formData);
    return $formData;
 }


?>