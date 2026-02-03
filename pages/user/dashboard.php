<?php
require('../../includes/db.php'); // Adjusted path
require('../../includes/auth_session.php');
check_login();

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Stats
$req_query = "SELECT COUNT(*) as total, SUM(weight_kg) as total_weight FROM requests WHERE user_id='$user_id'";
$req_result = mysqli_query($conn, $req_query);
$stats = mysqli_fetch_assoc($req_result);
$total_requests = $stats['total'];
$total_weight = $stats['total_weight'] ? $stats['total_weight'] : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - EcoCycle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: var(--bg-light); color: var(--text-color); }
        .sidebar { width: 250px; background: var(--secondary-color); color: white; height: 100vh; position: fixed; padding-top: 2rem; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: var(--primary-color); }
        .main-content { margin-left: 250px; padding: 2rem; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .stats-cards { display: flex; gap: 2rem; margin-bottom: 2rem; }
        .stat-card { background: white; padding: 1.5rem; border-radius: 10px; flex: 1; box-shadow: var(--shadow); text-align: center; }
        .stat-circle { width: 60px; height: 60px; background: var(--bg-light); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; font-size: 1.5rem; }
        .stat-number { font-size: 2rem; font-weight: 700; color: var(--primary-dark); }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>EcoCycle</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="request_pickup.php">Request Pickup</a>
        <a href="view_requests.php">My Requests</a>
        <a href="../../logout.php">Logout</a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Welcome, <?php echo $user['name']; ?>!</h1>
            <div>Credits: <strong>₹<?php echo $user['credits']; ?></strong></div>
        </div>

        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-circle">📦</div>
                <div class="stat-number"><?php echo $total_requests; ?></div>
                <p>Total Requests</p>
            </div>
            <div class="stat-card">
                <div class="stat-circle">⚖️</div>
                <div class="stat-number"><?php echo $total_weight; ?> kg</div>
                <p>E-Waste Recycled</p>
            </div>
            <div class="stat-card">
                <div class="stat-circle">💰</div>
                <div class="stat-number">₹<?php echo $user['credits']; ?></div>
                <p>Total Earnings</p>
            </div>
        </div>

        <div class="recent-activity">
            <!-- Could add recent list here if needed -->
             <h3>Quick Action</h3>
             <a href="request_pickup.php" class="btn primary" style="display:inline-block; margin-top:1rem;">Schedule New Pickup</a>
        </div>
    </div>
</body>
</html>
