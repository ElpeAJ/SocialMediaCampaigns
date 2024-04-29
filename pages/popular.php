<?php

// Check if the "popular" key is set in the array
if (isset($_POST['popular'])) {
    // Access the "popular" key
    $searchQuery = $_POST['popular'];
    // Further processing here
} else {
    // Handle the case when the key is not set
    echo "The 'popular' key is not set in the array.";
}

// Retrieve search query from POST data
// $searchQuery = $_POST['popular'];

// Simulate database search based on search query (replace this with actual database query)
$searchResults = [
    "Facebook" => "Use strong and unique passwords for your accounts.",
    "Instagram" => "Enable two-factor authentication for added security.",
    "Snapchat" => "Be cautious about who you add as friends and what you share.",
    "Twitter" => "Review your privacy settings regularly to control who can see your tweets.",
    "YouTube" => "Watch and share videos, but avoid sharing personal information publicly.",
    "WeChat" => "Communicate with friends and family, but be cautious of scams and phishing attempts.",
    "LinkedIn" => "Build professional connections and showcase your skills, while maintaining a professional online presence.",
    "Telegram" => "Chat with friends and join groups, but be aware of privacy settings and potential scams.",
    "TikTok" => "Create and share short videos, but use privacy settings to control who can view your content."
];

// Display search results
foreach ($searchResults as $app => $technique) {
    if (stripos($app, $searchQuery) !== false || stripos($technique, $searchQuery) !== false) {
      echo '<link rel="stylesheet" href="../src/style.css">';
      echo "<div class='ppphp'>";
      echo "<p class='ppsearch'><strong>$app:</strong> $technique</p>";
      echo "<div class='ppDiv'>
      <div class='ppsearchDiv'><button><a href='popular.html'>Search more</a></button></div> 
      <div class='ppsearchDiv'><button>Back to <a href='../index.html'>Home page</a></button></div>
      </div>";
      echo "</div>";
    }
}
?>
