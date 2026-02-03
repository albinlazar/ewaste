<?php
require('../../includes/db.php');
require('../../includes/auth_session.php');
check_admin_login();

// Handle Status Update
if (isset($_POST['update_status'])) {
    $req_id = $_POST['req_id'];
    $new_status = $_POST['status'];
    
    // Get current details to handle credit logic
    $q = mysqli_query($conn, "SELECT * FROM requests WHERE id='$req_id'");
    $req = mysqli_fetch_assoc($q);
    $current_status = $req['status'];
    $user_id = $req['user_id'];
    $weight = $req['weight_kg'];
    
    $update_query = "UPDATE requests SET status='$new_status' WHERE id='$req_id'";
    mysqli_query($conn, $update_query);

    // Business Logic: If moving to 'Completed' (and wasn't already), add credits
    // 1 kg = 50 Rs
    if ($new_status == 'Completed' && $current_status != 'Completed') {
        $reward = $weight * 50;
        mysqli_query($conn, "UPDATE users SET credits = credits + $reward WHERE id='$user_id'");
    }
}

$query = "SELECT requests.*, users.name as user_name FROM requests JOIN users ON requests.user_id = users.id ORDER BY requests.created_at DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Requests - EcoCycle</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body { background-color: var(--bg-light); color: var(--text-color); }
        .sidebar { width: 250px; background: #2c3e50; color: white; height: 100vh; position: fixed; padding-top: 2rem; }
        .sidebar h2 { text-align: center; margin-bottom: 2rem; color: #f1c40f; }
        .sidebar a { display: block; color: white; padding: 15px 20px; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; }
        .main-content { margin-left: 250px; padding: 2rem; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: var(--shadow); font-size: 0.9rem; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #34495e; color: white; }
        tr:hover { background: #f9f9f9; }
        select { padding: 5px; border-radius: 5px; }
        .btn-update { background: var(--primary-color); color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="manage_requests.php" class="active">Manage Requests</a>
        <a href="../../logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Manage Pickup Requests</h1>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Waste Type</th>
                    <th>Weight</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td>#<?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['waste_type']; ?></td>
                    <td><?php echo $row['weight_kg']; ?> kg</td>
                    <td><?php echo $row['pickup_address']; ?></td>
                    <td><?php echo $row['scheduled_date']; ?></td>
                    <form method="post">
                        <td>
                            <select name="status">
                                <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Approved" <?php if($row['status']=='Approved') echo 'selected'; ?>>Approved</option>
                                <option value="Picked Up" <?php if($row['status']=='Picked Up') echo 'selected'; ?>>Picked Up</option>
                                <option value="Completed" <?php if($row['status']=='Completed') echo 'selected'; ?>>Completed</option>
                                <option value="Rejected" <?php if($row['status']=='Rejected') echo 'selected'; ?>>Rejected</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="req_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="update_status" class="btn-update">Update</button>
                        </td>
                    </form>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
