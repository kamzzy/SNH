<?php include_once('lib/header.php');
  require_once('functions/alert.php');
  require_once('functions/user.php');
// if token is set
 
if (!$_SESSION['loggedin'] && !isset($_GET['token']) && !isset($_SESSION['token'])) {
    $_SESSION["error"] = "You are not authorized to view that page";
    header("Location: login.php");
}
?>
<h3>Reset Password</h3>
<p>Reset Password associated with your account : [email]</p>

<form action="processreset.php" method="POST">
    <p>
        <?php error(); message();?>
    </p>
    <p>
    <?php if(!$_SESSION['loggedin']) { ?>
        <input 
            <?php
                if (isset($_SESSION['token'])) {
                    echo "value=' " . $_SESSION['token'] . "'";
                } else {
                    echo "value= '" . $_GET['token'] . "'";
                }
                ?> type="hidden" name="token" />
    <?php } ?>

    </p>
    <p>
        <label>Email</label><br />
        <input <?php
                if (isset($_SESSION['email'])) {
                    echo "value=" . $_SESSION['email'];
                }
                ?> type="text" name="email" placeholder="Email" />
    </p>
    <p>
        <label>Enter New Password</label><br />
        <input type="password" name="password" placeholder="Password" /> </p>
    <p>
        <button type="submit">Reset Password</button>
    </p>
</form>

<?php include_once('lib/footer.php'); ?>