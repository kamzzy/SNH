<?php include_once(session_start());

$first_name = 
$last_name = 
$email = 
$password = 
$gender = 
$designation=
$department = "" ;


$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;

if (isset($_POST['submit'])) {

    // redirect back and display error
    if (empty($_POST['department'])) {
		$session_error = 'department should be selected';
	} else {
        $department = test_input($_POST['department']);
    }
    if (empty($_POST['designation'])) {
		$session_error = 'designation should be selected';
	} else {
        $designation = test_input($_POST['designation']);
    }
    if (empty($_POST['gender'])) {
		$session_error = 'gender should be selected';
	} else {
        $gender = test_input($_POST['gender']);
    }
    if (empty($_POST['password'])) {
		$session_error = 'password should be filled';
	} else {
        $password= test_input($_POST['password']);
    }
    if (empty($_POST["email"])) {
        $session_error = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $session_error = "Invalid email format";
        }
      } 
    if (empty($_POST['last_name'])) {
		$session_error = 'Last Name should be filled';
	} else{
        $last_name = test_input($_POST['last_name']);
		if (!preg_match('/^[a-zA-Z ]+$/', $last_name)) {
			$session_error = 'last Name can only contain letters and white spaces';
		}
	} 

    if (empty($_POST['first_name'])) {
		$session_error = 'First Name should be filled';
	} else {
        $first_name = test_input($_POST['first_name']);
		if (!preg_match('/^[a-zA-Z ]+$/', $first_name)) {
			$session_error = 'First Name can only contain letters and white spaces';
		}
	} 


    $_SESSION["error"] = $session_error;

    header("Location: register.php ");
}
else{
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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    // $data = htmlspecialchars($data);
    return $data;
  }
