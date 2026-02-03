<?php
require('../../includes/db.php');
require('../../includes/auth_session.php');
check_admin_login();

$query = "SELECT * FROM users ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users - EcoCycle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body { background-color: var(--bg-light); color: var(--text-color); }
        .sidebar { width: 250px; background: #2c3e50; color: white; height: 100vh; position: fixed; padding-top: 2rem; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; color: #f1c40f; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; }
        .main-content { margin-left: 250px; padding: 2rem; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: var(--shadow); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #34495e; color: white; }
        tr:hover { background: #f9f9f9; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_requests.php">Manage Requests</a>
        <a href="manage_users.php" class="active">Manage Users</a>
        <a href="../../logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Registered Users</h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Credits Earned</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>₹<?php echo $row['credits']; ?></td>
                    <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
