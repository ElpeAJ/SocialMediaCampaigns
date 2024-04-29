<?php


require_once('config.php');
require_once('setup.php');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


// Check if email field is set in the $_POST array
if(isset($_POST['email'])) {
 
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    echo "<p class='successful'>Email: $email</p>"; 
} else {
    echo "Email field is not set in the form data.";
    exit;
}

$insertIntoNewsletter = "INSERT INTO newsletter (email) VALUES (?)";

$stmt = mysqli_prepare($conn, $insertIntoNewsletter);

if (!$stmt) {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}

// Bind parameters to prepared statement
mysqli_stmt_bind_param($stmt, "s", $email);

// Execute prepared statement
if (mysqli_stmt_execute($stmt)) {
  echo "<p class='successful'>Registration successful!</p>";
  
} else {
  echo "Error: " . $insertIntoNewsletter . "<br>" . mysqli_error($conn);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>