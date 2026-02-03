<?php
require('includes/db.php');

// 1. Rename 'password' to 'password_hash'
$sql1 = "ALTER TABLE users CHANGE COLUMN password password_hash VARCHAR(255) NOT NULL";
if ($conn->query($sql1) === TRUE) {
    echo "Renamed 'password' to 'password_hash' successfully.\n";
} else {
    echo "Error renaming column (might already be fixed): " . $conn->error . "\n";
}

// 2. Add 'credits' column if not exists
$sql2 = "ALTER TABLE users ADD COLUMN credits DECIMAL(10, 2) DEFAULT 0.00 AFTER address";
if ($conn->query($sql2) === TRUE) {
    echo "Added 'credits' column successfully.\n";
} else {
    echo "Error adding column (might already exist): " . $conn->error . "\n";
}

echo "Schema update attempt finished.\n";
?>
