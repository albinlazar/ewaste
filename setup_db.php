<?php
// setup_db.php - Run this (e.g. your-app.vercel.app/setup_db.php) once to setup the DB
require 'includes/db.php';

echo "<h1>Database Setup...</h1>";

if (getenv('DB_HOST')) {
    echo "<p>Connected to database host: " . getenv('DB_HOST') . "</p>";
} else {
    echo "<p>Using local database config.</p>";
}

// Read the SQL file
$sql = file_get_contents('database.sql');

// Remove comments to check logic (basic) or just rely on multi_query
// Split by semicolon
$queries = explode(';', $sql);

foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if ($conn->query($query) === TRUE) {
            echo "<p style='color:green'>Success: " . substr($query, 0, 50) . "...</p>";
        } else {
            echo "<p style='color:red'>Error: " . $conn->error . " <br>Query: " . substr($query, 0, 50) . "...</p>";
        }
    }
}

echo "<h2>Setup Completed.</h2>";
echo "<a href='index.php'>Go to Home</a>";
?>
