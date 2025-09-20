<?php
$servername = "localhost";
$username = "root";
$password = "Kush230908.";
$dbname = "event_registration";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM student_events ORDER BY enrollment_no";
$result = $conn->query($sql);

echo "<h1>Registered Events</h1>";
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>Enrollment No</th><th>Event Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".htmlspecialchars($row['enrollment_no'])."</td><td>".htmlspecialchars($row['event_name'])."</td></tr>";
    }
    echo "</table>";
} else {
    echo "No events registered yet.";
}

$conn->close();
?>
