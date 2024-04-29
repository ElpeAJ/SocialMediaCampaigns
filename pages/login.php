<?php
// Start session
session_start();

// Include database connection
include('db.php');

// Database connection details
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "smcampaigns";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables
$maxAttempts = 3;
$lockoutDuration = 300; // 10 minutes in seconds

// Check if login attempts session variable is set
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Get form data
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Basic validation
if (empty($username) || empty($password)) {
    echo '<link href="../src/style.css" rel="stylesheet" />';
    echo "<div class='max-attempts'>";
    echo "Please enter both Username and password.";
    echo "</div>";
    exit;
}

// Check if user is locked out
if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) {
    echo '<link href="../src/style.css" rel="stylesheet" />';
    echo "<div class='max-attempts'>";
    echo "You have been locked out. <br>";
    echo "You have exceeded the maximum number of login attempts of 3 tries."; 
    echo "<br> Please try again in 10 minutes.<br>";
    echo "</div>";
    exit;
}

// Prepare and execute SQL statement
$stmt = mysqli_prepare($conn, "SELECT * FROM signup WHERE username = ?");
if (!$stmt) {
    echo "Error preparing statement: " . mysqli_error($conn);
    exit;
}

// Bind parameters to prepared statement
mysqli_stmt_bind_param($stmt, "s", $username);

// Execute prepared statement
$result = mysqli_stmt_execute($stmt);
if (!$result) {
    echo "Error executing statement: " . mysqli_error($conn);
    exit;
}

// Store result
$result = mysqli_stmt_get_result($stmt);

// Check if user exists
if (mysqli_num_rows($result) > 0) {
    // User found, verify password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        // Password is correct, log in user
        $_SESSION['username'] = $row['username'];
        $_SESSION['login_attempts'] = 0; // Reset login attempts
        header("Location: ../index.html");
        exit;
    } else {
        // Password is incorrect
        echo "Invalid password.";
        $_SESSION['login_attempts']++;
    }
} else {
    // User not found
    echo "Invalid username.";
    $_SESSION['login_attempts']++;
}

// Check if max login attempts reached
if ($_SESSION['login_attempts'] >= $maxAttempts) {
    $_SESSION['lockout_time'] = time() + $lockoutDuration;
    echo '<link href="../src/style.css" rel="stylesheet" />';
    echo "<div class='max-attempts'>";
    echo "You have exceeded the maximum number of login attempts of 3 tries."; 
    echo "Please try again in 10 minutes.";
    echo "</div>";
    exit; // Exit script if max attempts reached
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
