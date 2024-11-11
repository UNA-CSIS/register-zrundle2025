<?php
// start session
session_start();

// login to the softball database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
}

// select password from users where username = <what the user typed in>
$sql = "SELECT password FROM users WHERE username = '" . $_POST["user"] . "'";
    $result = $conn->query($sql);

// if no rows, then username is not valid (but don't tell Mallory) just send
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $password_hash = $row["password"];
    $user_pwd = $_POST["pwd"];

    if (password_verify($user_pwd, $password_hash)) {
        $_SESSION['username'] = $_POST["user"];
        header('Location: games.php');
    }
} else{
    header("location: index.php");
}
// her back to the login

// otherwise, password_verify(password from form, password from db)

// if good, put username in session, otherwise send back to login
?>
