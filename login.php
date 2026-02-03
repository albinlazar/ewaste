<?php
require('includes/db.php');
session_start();

if (isset($_POST['email'])) {
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    // Check User
    $query = "SELECT * FROM `users` WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    
    if ($rows == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: pages/user/dashboard.php");
            exit();
        }
    }

    // Check Admin
    $query_admin = "SELECT * FROM `admins` WHERE email='$email'";
    $result_admin = mysqli_query($conn, $query_admin);
    
    if (mysqli_num_rows($result_admin) == 1) {
        $admin = mysqli_fetch_assoc($result_admin);
         // For setup simplicity, assuming admin password might not be hashed initially or we use verify.
         // Let's assume standard hash verify for consistency.
         // If you manually inserted 'admin123' without hash, this will fail. 
         // But for a robust app, we should use hash. 
         // NOTE: Admin needs to be inserted with password_hash() in database setup or manually.
         // Fallback for plain text admin (NOT RECOMMENDED for production but helpful for instant setup if data was seeded manually)
        if (password_verify($password, $admin['password_hash']) || $password === $admin['password_hash']) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            header("Location: pages/admin/dashboard.php");
            exit();
        }
    }

    $error_msg = "Incorrect Email or Password.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login | EcoCycle</title>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <style>
        body { background: var(--bg-light); display: flex; justify-content: center; align-items: center; height: 100vh; }
        .form-container { background: white; padding: 2rem; border-radius: 10px; box-shadow: var(--shadow); width: 350px; }
        .form-container h2 { text-align: center; color: var(--primary-dark); margin-bottom: 1.5rem; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        .submit-btn { width: 100%; cursor: pointer; background: var(--primary-color); color: white; border: none; font-size: 1rem; }
        .link { text-align: center; margin-top: 10px; display: block; }
        .error { color: red; text-align: center; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="form-container">
        <form class="form" method="post" name="login">
            <h2>Login</h2>
            <?php if(isset($error_msg)) echo "<p class='error'>$error_msg</p>"; ?>
            <input type="email" class="login-input" name="email" placeholder="Email" autofocus="true" required/>
            <input type="password" class="login-input" name="password" placeholder="Password" required/>
            <input type="submit" value="Login" name="submit" class="submit-btn"/>
            <a href="register.php" class="link">New User? Register</a>
            <a href="index.php" class="link" style="font-size: 0.9rem;">Back to Home</a>
        </form>
    </div>
</body>
</html>
