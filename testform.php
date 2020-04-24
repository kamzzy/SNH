
<body>

<?php include_once('lib/header.php'); ?>


<h3><strong>Register</strong></h3>

<form method="POST" action="test.php">
  
<p>
<label>First Name</label><br/>
<input type="text"name="first_name" placeholder="First Name"  />
<span class="error">* <?php echo $lnameErr;?></span>
</p>
<p> 
    <label>Last Name</label><br/>
<input type="text"name="last_name" placeholder="Last Name" required />
</p>
<p>
     <label>Email</label><br/>
<input type="text"name="email" placeholder="Email" required  /> 
</p>
<p> <label>Password</label><br/>
<input type="password" name="password" placeholder="Password" required  /> 
</p>


<p>
 <label>Gender</label><br/>
 <select name="gender" >
     <option value="">Select One</option>
     <option>Male</option>
     <option> Female</option>
 </select>
</p> 

<p>
 <label>Designation</label><br/>
 <select name="designation" >
 <option value="">Select One</option>
     <option>Medical Team(MT)</option>
     <option>Patient</option>
 </select>
</p> 

<p>
 <label>Department</label><br/>
 <input type="text" name="department" placeholder="Department" />
</p>
<p> <button type="submit">Register</button>  </p>

</form>

<?php  include('lib/footer.php'); ?>
</body>
</html>