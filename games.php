<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "softball";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, opponent, site, result FROM games";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Opponent</th><th>Site</th><th>Result</th></tr>";

            // Loop through each row and display the data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['opponent'] . "</td>";
                echo "<td>" . $row['site'] . "</td>";
                echo "<td>" . $row['result'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No games found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </body>
</html>
