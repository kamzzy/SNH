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
} 



?>