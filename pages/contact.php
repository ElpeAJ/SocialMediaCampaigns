<?php

// Include configuration file (assuming `config.php` is in the same directory)
require_once('config.php');
require_once('setup.php');

if ($_SERVER["REQUEST_METHOD"] == "POST"){

// Get form data (replace with actual field names)
$full_name = mysqli_real_escape_string($conn, $_POST['full-name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['tel']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

// Create prepared statement
$insertIntoContactUs = "INSERT INTO contact (full_name, email, phone, message)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insertIntoContactUs);

if (!$stmt) {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}

// Bind parameters to prepared statement
mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $phone, $message);

// Bind parameters to prepared statement
    mysqli_stmt_bind_param($stmt, "ssss", $full_name, $email, $phone, $message);

    // Execute prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to contact page with success message
        header("Location: ../index.html?success=1");
        exit;
    } else {
        echo "Error: " . $insertIntoContactUs . "<br>" . mysqli_error($conn);
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }else {
    // Redirect if form is not submitted
    header("Location: ../index.html");
    exit;
}

// Close connection
mysqli_close($conn);

?>