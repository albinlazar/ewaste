<?php
require('../../includes/db.php');
require('../../includes/auth_session.php');
check_admin_login();

// Report 1: Waste by Type
$type_query = "SELECT waste_type, COUNT(*) as count, SUM(weight_kg) as total_weight FROM requests GROUP BY waste_type";
$type_result = mysqli_query($conn, $type_query);

// Report 2: Monthly Collection
$month_query = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count, SUM(weight_kg) as total_weight FROM requests WHERE status='Completed' GROUP BY month";
$month_result = mysqli_query($conn, $month_query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>System Reports - EcoCycle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body { background-color: var(--bg-light); color: var(--text-color); }
        .sidebar { width: 250px; background: #2c3e50; color: white; height: 100vh; position: fixed; padding-top: 2rem; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; color: #f1c40f; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; }
        .main-content { margin-left: 250px; padding: 2rem; }
        .report-section { background: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem; box-shadow: var(--shadow); }
        h3 { border-bottom: 2px solid #eee; padding-bottom: 10px; margin-bottom: 20px; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #ecf0f1; color: #2c3e50; }
        .print-btn { background: #e74c3c; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; float: right; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_requests.php">Manage Requests</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="reports.php" class="active">Reports</a>
        <a href="../../logout.php">Logout</a>
    </div>

    <div class="main-content">
        <button onclick="window.print()" class="print-btn">Print Report</button>
        <h1>System Reports</h1>
        <br>

        <div class="report-section">
            <h3>♻️ Collection by Waste Type</h3>
            <table>
                <thead>
                    <tr>
                        <th>Waste Type</th>
                        <th>Total Requests</th>
                        <th>Total Weight (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($type_result)) { ?>
                    <tr>
                        <td><?php echo $row['waste_type']; ?></td>
                        <td><?php echo $row['count']; ?></td>
                        <td><?php echo $row['total_weight']; ?> kg</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="report-section">
            <h3>📅 Monthly Completed Collections</h3>
            <table>
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Collections Completed</th>
                        <th>Weight Recycled (kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($month_result) > 0) {
                        while($row = mysqli_fetch_assoc($month_result)) { 
                            echo "<tr>";
                            echo "<td>".$row['month']."</td>";
                            echo "<td>".$row['count']."</td>";
                            echo "<td>".$row['total_weight']." kg</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No completed collections yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
