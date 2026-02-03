<?php
require('../../includes/db.php');
require('../../includes/auth_session.php');
check_admin_login();

// Stats
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM users"))['c'];
$request_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM requests"))['c'];
$pending_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as c FROM requests WHERE status='Pending'"))['c'];
$collected_weight = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(weight_kg) as w FROM requests WHERE status='Completed'"))['w'];
$collected_weight = $collected_weight ? $collected_weight : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - EcoCycle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: var(--bg-light); color: var(--text-color); }
        .sidebar { width: 250px; background: #2c3e50; color: white; height: 100vh; position: fixed; padding-top: 2rem; } /* Darker for admin */
        .sidebar h2 { text-align: center; margin-bottom: 2rem; color: #f1c40f; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; }
        .main-content { margin-left: 250px; padding: 2rem; }
        .stats-cards { display: flex; gap: 2rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 10px; flex: 1; box-shadow: var(--shadow); text-align: center; }
        .stat-number { font-size: 2.5rem; font-weight: 700; color: #2c3e50; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="manage_requests.php">Manage Requests</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="reports.php">Reports</a>
        <a href="../../logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Admin Overview</h1>
        <br>
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number"><?php echo $user_count; ?></div>
                <p>Total Users</p>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?php echo $request_count; ?></div>
                <p>Total Requests</p>
            </div>
            <div class="stat-card">
                <div class="stat-number" style="color:#e67e22;"><?php echo $pending_count; ?></div>
                <p>Pending Actions</p>
            </div>
            <div class="stat-card">
                <div class="stat-number" style="color:#27ae60;"><?php echo $collected_weight; ?> kg</div>
                <p>Waste Collected</p>
            </div>
        </div>
    </div>
</body>
</html>
