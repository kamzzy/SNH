<?php 
include_once('lib/header.php');
// collecting  the data

$fnameErr = $lnameErr = $emailErr = $passwordErr = $genderErr = $designationErr = $departmentErr  = "";
$first_name = $last_name = $email = $password = $gender = $designation = $department  = "";
// verifying the data, validation

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["first_name"])) {
       $fnameErr = "First Name is required";
    
    } else {
       $first_name = test_input($_POST["first_name"]);
       if (!preg_match('/^[a-zA-Z0-9\s]+$/', $first_name)) {
       $fnameErr = 'First Name can only contain letters, numbers and white spaces';
    }
    }
    
    if (empty($_POST["last_name"])) {
        $lnameErr = "last Name is required";
     } else {
       $last_name = test_input($_POST["last_name"]);
       if (!preg_match('/^[a-zA-Z0-9\s]+$/', $last_name)) {
        $lnameErr = 'last Name can only contain letters, numbers and white spaces';
     }
     }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);

        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
       $password = test_input($_POST["password"]);
    }

    if (empty($_POST["designation"])) {
        $designationErr = "designation is required";
    } else {
        $designation = test_input($_POST["designation"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["department"])) {
        $departmentErr = "department is required";
    } else {
        $department = $_POST["department"];
    }

    header("Location: register.php ");
} else {
    // count all users
    $allUsers = scandir("db/users/");
    $countAllUsers = count($allUsers);
    $newUserId = ($countAllUsers - 2) + 1;


    // assign ID to the new user
    $userObject = [
        'id' => $newUserId,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),  // password hashing
        'gender' => $gender,
        'designation' => $designation,
        'department' => $department

    ];
    // check if user already exists

    // assign the next ID to the new user
    // count($users =>2, next should then be ID 3

    // loop

    for ($counter = 0; $counter < $countAllUsers; $counter++) {
        $currentUser = $allUsers[$counter];

        if ($currentUser == $email . ".json") {
            $_SESSION["error"] = "User already exists " . $first_name;
            header("Location: register.php");
            die();
        }
    }
    file_put_contents("db/users/" . $email . ".json", json_encode($userObject));
    $_SESSION["message"] = "Registration Successful, you can now login " . $first_name;

    // inform client of a successful registration

    $department = "Signup successful";
    $message = " You have successfully signed up at SNH ";

    $headers = "From: customercare@snh.org" . "\r\n" .
        "CC: ziri@snh.org";

    $signup = mail($email, $department, $message, $headers);
    header("Location: login.php");



    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
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
