// Get credentials from Environment Variables (Vercel) or fallback to Localhost (XAMPP)
$servername = getenv('DB_HOST') ? getenv('DB_HOST') : "localhost";
$username = getenv('DB_USER') ? getenv('DB_USER') : "root";
$password = getenv('DB_PASS') ? getenv('DB_PASS') : "";
$dbname = getenv('DB_NAME') ? getenv('DB_NAME') : "ewaste_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Hide actual error in production, show simple message
    if (getenv('DB_HOST')) {
       die("Database Connection Failed. Check Vercel Environment Variables.");
    } else {
       die("Connection failed: " . $conn->connect_error);
    }
}
?>
