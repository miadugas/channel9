<?php
    if(isset($_POST["submitButton"])) {
               
        $firstName = sanitizeFormString($_POST["firstName"]);
        echo "Form was submitted";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to Channel 9</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css?v=<?php echo time(); ?>"/>
    </head>
    <body>
        
<div class="signInContainer">

    <div class="column">

    <div class="header">
    
    <img src="assets/images/logo1.png" title="Logo" alt="Site logo" />
        <h3>Sign In</h3>
        <span>to continue to Channel 9</span>
</div>

    <form method="POST">

        <input type="text" name="username" placeholder="Username" required>

        <input type="password" name="password" placeholder="Password" required>

        <input type="submit" name="submitButton" value="SUBMIT">

    </form>

    <a href="register.php" class="signInMessage">Need an account? Sign up here!</a>

</div>

</div>

</body>
</html>
