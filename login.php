<?php
 
   include_once('lib/header.php'); 
   require_once('functions/alert.php');

if(isset($_SESSION['loggedIn']) && !empty ($_SESSION['loggedIn'])){
  // redirect to dashboard
  header("Location: dashboard.php");
}
?>
<body>
<p>
      <?php message();?>
    <h3><strong>Login</strong></h3>
    
    <form method="POST" action="processLogin.php">
      <p>
      <?php error();?>
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
