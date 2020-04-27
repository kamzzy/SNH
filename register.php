
<body>

<?php include_once('lib/header.php'); require_once('functions/alert.php');

if(isset($_SESSION['loggedIn']) && !empty ($_SESSION['loggedIn'])){
  // redirect to dashboard
  header("Location: dashboard.php");
}


?>
<h3><strong>Register</strong></h3>

<form method="POST" action="processRegister.php">
  <div>
  <?php error(); message();?>
  </div>
<div>
<label>First Name</label><br/>
<input 
<?php
   if(isset($_SESSION['first_name'])) {
echo "value=" . $_SESSION['first_name'];
    }
?>
type="text"name="first_name" placeholder="First Name"  /></div>
<div> <label>Last Name</label><br/>
<input
<?php
   if(isset($_SESSION['last_name'])) {
echo "value=" . $_SESSION['last_name'];
    }
?>
type="text"name="last_name" placeholder="Last Name"  /></div>
<div> <label>Email</label><br/>
<input  <?php
   if(isset($_SESSION['email'])) {
echo "value=" . $_SESSION['email'];
    }
?> type="text"name="email" placeholder="Email"  /> </div>
<div> <label>Password</label><br/>
<input type="password" name="password" placeholder="Password"  /> </div>


<div>
 <label>Gender</label><br/>
 <select name="gender" >
     <option value="">Select One</option>
     <option <?php
   if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') {
echo "selected"; }
?> >Male</option>
     <option 
      <?php
   if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') {
echo "selected"; }
?> 
>Female</option>
 </select>
</div> 

<div>
 <label>Designation</label><br/>
 <select name="designation" >
 <option value="">Select One</option>
     <option  <?php
   if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team(MT)') {
echo "selected"; }
?> >Medical Team(MT)</option>
     <option  <?php
   if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient') {
echo "selected"; }
?> >Patient</option>
 </select>
</div> 

<div>
 <label>Department</label><br/>
 <input <?php
   if(isset($_SESSION['department'])) {
echo "value=" . $_SESSION['department'];
    }
?> type="text" name="department" placeholder="Department" />
</div>
<div> <button type="submit" name="submit">Register</button>  </div>

</form>

<?php  include('lib/footer.php'); ?>
</body>
</html>