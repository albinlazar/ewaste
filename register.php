<?php
require('includes/db.php');
if (isset($_REQUEST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $phone = stripslashes($_REQUEST['phone']);
    $address = stripslashes($_REQUEST['address']);

    $query    = "INSERT into `users` (name, email, password_hash, phone, address)
                     VALUES ('$username', '$email', '" . password_hash($password, PASSWORD_BCRYPT) . "', '$phone', '$address')";
    $result   = mysqli_query($conn, $query);
    if ($result) {
        header("Location: login.php");
    } else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='register.php'>registration</a> again.</p>
                  </div>";
    }
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration | EcoCycle</title>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>
        body { background: var(--bg-light); display: flex; justify-content: center; align-items: center; height: 100vh; }
        .form-container { background: white; padding: 2rem; border-radius: 10px; box-shadow: var(--shadow); width: 400px; }
        .form-container h2 { text-align: center; color: var(--primary-dark); margin-bottom: 1.5rem; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        .submit-btn { width: 100%; cursor: pointer; background: var(--primary-color); color: white; border: none; font-size: 1rem; }
        .link { text-align: center; margin-top: 10px; display: block; }
    </style>
</head>
<body>
    <div class="form-container">
        <form class="form" action="" method="post">
            <h2>Sign Up</h2>
            <input type="text" class="login-input" name="username" placeholder="Full Name" required />
            <input type="email" class="login-input" name="email" placeholder="Email Address" required />
            <input type="password" class="login-input" name="password" placeholder="Password" required />
            <input type="text" class="login-input" name="phone" placeholder="Phone Number" required />
            <textarea name="address" placeholder="Address" rows="3" required></textarea>
            <input type="submit" name="submit" value="Register" class="submit-btn">
            <a href="login.php" class="link">Already have an account? Login</a>
            <a href="index.php" class="link" style="font-size: 0.9rem;">Back to Home</a>
        </form>
    </div>
</body>
</html>
<?php
}
?>
