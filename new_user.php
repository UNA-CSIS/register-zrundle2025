<?php
session_start();

include 'validate.php'; 

// get all 3 strings from the form
$user = $_POST['user'];
$pass1 = $_POST['pwd'];
$pass2 = $_POST['repeat'];

// make sure that the two password values match!
if ($pass1 !== $pass2) {
    die("Passwords do not match.");
}

// create the password_hash using the PASSWORD_DEFAULT argument
$password_hash = password_hash($pass1, PASSWORD_DEFAULT);

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "softball"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// make sure that the new user is not already in the database
$sql_check = "SELECT * FROM users WHERE username = '$user'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    die("Username already exists. Please choose another.");
}

// insert username and password hash into db (put the username in the session or make them login)
$sql_insert = "INSERT INTO users (username, password) VALUES ('$user', '$password_hash')";

if ($conn->query($sql_insert) === TRUE) {
    $_SESSION['username'] = $user;
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
