<?php
 
   include_once('lib/header.php'); 

if(isset($_SESSION['loggedIn']) && !empty ($_SESSION['loggedIn'])){
  // redirect to dashboard
  header("Location: dashboard.php");
}
?>
<body>
<p>
      <?php 
   if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
     echo "<span style='color:green'> " . $_SESSION['message'] . "</span>";

     session_destroy();
   }
   ?>
    <h3><strong>Login</strong></h3>
    
    <form method="POST" action="processLogin.php">
      <p>
      <?php 
   if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
     echo "<span style='color:red'> " . $_SESSION['error'] . "</span>";

     session_destroy();
   }
   ?>
      </p>
      <p>
   <label>Email</label><br/>
   <input  <?php
       if(isset($_SESSION['email'])) {
    echo "value=" . $_SESSION['email'];
        }
   ?> type="text"name="email" placeholder="Email"  /> </p>
   <p> <label>Password</label><br/>
   <input type="password" name="password" placeholder="Password" /> </p>
    

 
   <p> <button type="submit">Login</button>  </p>

    </form>
<?php include('lib/footer.php'); ?>

</body>
</html>
