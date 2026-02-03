<?php
require('../../includes/db.php');
require('../../includes/auth_session.php');
check_login();

$msg = "";
if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $waste_type = mysqli_real_escape_string($conn, $_POST['waste_type']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    $query = "INSERT INTO requests (user_id, waste_type, weight_kg, pickup_address, scheduled_date, status) 
              VALUES ('$user_id', '$waste_type', '$weight', '$address', '$date', 'Pending')";
    
    if (mysqli_query($conn, $query)) {
        $msg = "<div style='background:#d4edda; color:#155724; padding:10px; border-radius:5px; margin-bottom:15px;'>Request submitted successfully!</div>";
    } else {
        $msg = "<div style='color:red;'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Request Pickup - EcoCycle</title>
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
        .form-box { background: white; padding: 2rem; border-radius: 10px; max-width: 600px; box-shadow: var(--shadow); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: 500; }
        select, input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>EcoCycle</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="request_pickup.php" class="active">Request Pickup</a>
        <a href="view_requests.php">My Requests</a>
        <a href="../../logout.php">Logout</a>
    </div>

    <div class="main-content">
        <h1>Schedule a Pickup</h1>
        <p>Fill in the details below to dispose of your e-waste.</p>
        <br>
        <?php echo $msg; ?>
        <div class="form-box">
            <form method="post">
                <div class="form-group">
                    <label>Type of E-Waste</label>
                    <select name="waste_type" required>
                        <option value="">Select Type</option>
                        <option value="Laptop/Computer">Laptop / Computer</option>
                        <option value="Mobile/Tablet">Mobile / Tablet</option>
                        <option value="Batteries">Batteries</option>
                        <option value="Appliances">Household Appliances</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Estimated Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" placeholder="e.g. 2.5" required>
                </div>
                <div class="form-group">
                    <label>Pickup Address</label>
                    <textarea name="address" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label>Preferred Date</label>
                    <input type="date" name="date" required>
                </div>
                <button type="submit" name="submit" class="btn primary" style="border:none; cursor:pointer;">Submit Request</button>
            </form>
        </div>
    </div>
</body>
</html>
