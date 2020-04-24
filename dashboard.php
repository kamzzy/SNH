<?php include_once('lib/header.php'); 

if(!isset($_SESSION['loggedIn'])){
    // redirect to login
    header("Location: login.php");
  }
  
?> 
<body>
    <h3>Dashboard</h3>
    
 Welcome, <?php echo $_SESSION['fullname'] ?>, You are logged in as (<?php echo 
 $_SESSION['role'] ?>), and your ID is <?php echo $_SESSION['loggedIn'] ?>
    <?php include_once('lib/footer.php'); ?>
</body>
</html>