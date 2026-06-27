<?php
// 1. Tell PHP to stop printing raw system warnings to the screen
error_reporting(0);
ini_set('display_errors', 0);

$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = ""; // Replace with your actual database name

// 2. The "@" symbol suppresses any immediate connection warning popup
$conn = @new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    // 3. Print your own clean, user-friendly message
    echo "Our database is temporarily resting. Please try again in a few minutes.";
    exit(); // Stop any further code from executing
}
?>
