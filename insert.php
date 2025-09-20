<?php
$servername = "localhost";
$username = "root"; 
$password = "Kush230908."; 
$dbname = "event_registration";
// Set the header to indicate a JSON response
header('Content-Type: application/json');

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 // Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
 }

 // Check if form is submitted
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $_POST['name'];
     $enrollment = $_POST['enrollment'];
     $branch = $_POST['branch'];
     $year = $_POST['year'];
     $semester = $_POST['semester'];

     $sql = "INSERT INTO students (name, enrollment_no, branch, year, semester) 
             VALUES ('$name', '$enrollment', '$branch', '$year', '$semester')";

     if ($conn->query($sql) === TRUE) {
        header("Location: event.html");
        echo "✅ New student inserted successfully! <a href='checkdb.php'>View Students</a>";
        // Return a success JSON response
        echo json_encode(['status' => 'success', 'message' => 'New student inserted successfully!']);
     } else {
        echo "❌ Error: " . $sql . "<br>" . $conn->error;
        // Return a failure JSON response with the MySQL error message
       echo json_encode(['status' => 'error', 'message' => $conn->error]);
     }
 }
 $conn->close();
 ?>