<?php

// Include configuration file (assuming `config.php` is in the same directory)
require_once('config.php');
require_once('setup.php');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get form data (replace with actual field names)
$first_name = mysqli_real_escape_string($conn, $_POST['first-name']);
$last_name = mysqli_real_escape_string($conn, $_POST['last-name']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$town = mysqli_real_escape_string($conn, $_POST['town']);
$county = mysqli_real_escape_string($conn, $_POST['county']);
$postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
$tel = mysqli_real_escape_string($conn, $_POST['tel']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$dateofbirth = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$term = mysqli_real_escape_string($conn, $_POST['term']);


// Create prepared statement
$insertIntoSignup = "INSERT INTO signup (first_name, last_name, address, town, county, postcode, tel, email, username, password, dateofbirth, gender, term)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $insertIntoSignup);

if (!$stmt) {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit;
}

// Bind parameters to prepared statement
mysqli_stmt_bind_param($stmt, "sssssssssssss", $first_name, $last_name, $address, $town, $county, $postcode, $tel, $email, $username, $password, $dateofbirth, $gender, $term);

// Execute prepared statement
if (mysqli_stmt_execute($stmt)) {
	header("Location: login.html");
  echo "Registration successful!";
} else {
  echo "Error: " . $insertIntoSignup . "<br>" . mysqli_error($conn);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>