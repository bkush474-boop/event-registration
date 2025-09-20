<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Kush230908."; // replace with your MySQL root password
$dbname = "event_registration";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo " Connected successfully to database <br><br>";
}

// Run SQL Query
$sql = "SELECT * FROM students ORDER BY enrollment_no ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>Name</th><th>Enrollment</th><th>Branch</th><th>Year</th><th>Semester</th><th>Date</th></tr>"; 
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['name']."</td>
                <td>".$row['enrollment_no']."</td>
                <td>".$row['branch']."</td>
                <td>".$row['year']."</td>
                <td>".$row['semester']."</td>
                <td>".$row['registration_date']."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo " No records found in database.";
}

$conn->close();
?>
