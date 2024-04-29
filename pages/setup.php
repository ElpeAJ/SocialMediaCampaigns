<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Creation of Database for SMC</title>
   <link rel="stylesheet" href="../src/style.css">
    </head>
  <body>
        
   <?php
    $conn = new mysqli("localhost","root","123456");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

// SQL statement to create database
    $smc = "CREATE DATABASE IF NOT EXISTS smcampaigns";
    // Check if database is created successfully
    if($conn->query($smc) === TRUE){
         echo "<div class='open'><p class='setup'>Database created successfully</p></div>";
    }else{
        die("<p class='setup'>Error creating database: </p>" . $conn->error);
    }

// Select the database
    $conn = new mysqli("localhost","root","123456","smcampaigns");
    // Check if database is selected
    if($conn->connect_error){
        die ("<p class='setup'>Could not select database: </p>" . $conn->connect_error);
    }else{
         echo "<div class='middle'><p class='setup'>Database 'smcampaigns' successfully selected</p></div>";
    }

// Create register table
$signUpTable =
  " CREATE TABLE IF NOT EXISTS `signup` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `town` varchar(30) NOT NULL,
  `county` varchar(30) NOT NULL,
  `postcode` varchar(30) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `dateofbirth` date NOT NULL,
  `gender` text NOT NULL,  
  `term` text NOT NULL,  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1";


    // Check if table is created
    if($conn->query($signUpTable) === TRUE){
     echo "<div class='middle'><p class='setup'>Register table successfully created</div>";
    }else{
        die("<p class='setup'>Could not create table register: </p>" . $conn->error);
    }

          
// sql to create contact table
  $contactUsTAble ='CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1'; 

    if ($conn->query($contactUsTAble) === TRUE) {
       echo '<div class="middle"><p class="setup">Contact Table created successfully</p></div>';
    } else {
      echo '<p class="error">Error creating table: ' . $conn->error . '</p>';
    }

          
  $newsletterTable = 'CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1';
  
          if ($conn->query($newsletterTable) === TRUE) {
               echo '<div class="close"><p class="setup">Newsletter created successfully</p></div>';
          } else {
              echo '<p class="error">Error creating table: ' . $conn->error . '</p>';
          }

$changePasswordTable = 'CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(8) NOT NULL AUTO_INCREMENT,
  `userName` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `displayName` varchar(55) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2' ;

echo "<div";
//echo "<p class='setup'><a class='login' href='login.html'>Login</a></p><br/>";
//echo "<p class='setup'><a class='login' href='signup.html'>Register</a></p>";
echo "<div class='ppDiv'>";
echo "<div class='ppsearchDiv'><button><a href='signup.html'>Sign Up</a></button></div> 
      <div class='ppsearchDiv'><button><a href='login.html'>Login</a></button></div> 
      <div class='ppsearchDiv'><button>Back to <a href='../index.html'>Home page</a></button></div>
      </div>";
 "</div";

//Close connection
$conn->close();
?>
</body>
</html>