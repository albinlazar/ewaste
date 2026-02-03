<?php
require('../../includes/db.php');
require('../../includes/auth_session.php');
check_login();

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM requests WHERE user_id='$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Requests - EcoCycle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: var(--bg-light); color: var(--text-color); }
        .sidebar { width: 250px; background: var(--secondary-color); color: white; height: 100vh; position: fixed; padding-top: 2rem; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover { background: var(--primary-color); }
        .sidebar a.active { background: var(--primary-color); }
        .main-content { margin-left: 250px; padding: 2rem; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: var(--shadow); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: var(--secondary-color); color: white; }
        tr:hover { background: #f9f9f9; }
        .badge { padding: 5px 10px; border-radius: 15px; font-size: 0.8rem; color: white; font-weight: 500; }
        .badge.Pending { background: #f1c40f; color: #333; }
        .badge.Approved { background: #3498db; }
        .badge.Picked { background: #e67e22; } /* 'Picked Up' matches partial or I check full string */
        .badge.Completed { background: #2ecc71; }
        .badge.Rejected { background: #e74c3c; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>EcoCycle</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="request_pickup.php">Request Pickup</a>
        <a href="view_requests.php" class="active">My Requests</a>
        <a href="../../logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>My Pickup Requests</h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Waste Type</th>
                    <th>Weight (kg)</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $status_class = explode(" ", $row['status'])[0]; // Quick hack for 'Picked Up' -> 'Picked'
                        echo "<tr>";
                        echo "<td>#".$row['id']."</td>";
                        echo "<td>".$row['waste_type']."</td>";
                        echo "<td>".$row['weight_kg']."</td>";
                        echo "<td>".$row['pickup_address']."</td>";
                        echo "<td>".date('d M Y', strtotime($row['scheduled_date']))."</td>";
                        echo "<td><span class='badge $status_class'>".$row['status']."</span></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No requests found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
