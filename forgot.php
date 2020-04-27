<?php include_once('lib/header.php'); require_once('functions/alert.php') ?>
<h3>Forgot Password</h3>
<p>Provide the email address associated with your account</p>

<form action="processForgot.php" method="POST">
<p>
<?php error();?> 
</p>

<p> <label>Email</label><br/>
   <input 
    <?php
       if(isset($_SESSION['email'])) {
    echo "value=" . $_SESSION['email'];
        }
   ?> 
   type="text"name="email" placeholder="Email"  /> 
</p>
<p> 
   <button type="submit">Send Reset Code</button> 
 </p>
</form>

<?php include_once('lib/footer.php'); ?>