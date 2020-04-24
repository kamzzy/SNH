 <?php include_once('lib/header.php'); 
 session_unset();
 session_destroy();

 header('Location: login.php');

 ?> 