<?php
$servername = "localhost";
$username = "root";
$password = "Kush230908."; // replace with your password
$dbname = "event_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['enrollment']) && isset($_POST['events'])) {
    $enrollment = $conn->real_escape_string($_POST['enrollment']);
    $events = $_POST['events'];

    // Check if this enrollment already exists
    $check = $conn->prepare("SELECT * FROM student_events WHERE enrollment_no = ?");
    $check->bind_param("s", $enrollment);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0) {
        echo "This enrollment number has already registered for events.<br><a href='event.html'>Go Back</a>";
    } else {
        // Prepare single insert for multiple events
        $values = [];
        foreach($events as $event) {
            $event_safe = $conn->real_escape_string($event);
            $values[] = "('$enrollment', '$event_safe')";
        }
        $values_string = implode(", ", $values);

        $sql = "INSERT INTO student_events (enrollment_no, event_name) VALUES $values_string";

        if($conn->query($sql) === TRUE) {
            header("Location: tx.html");
            echo "Events saved successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $check->close();
} else {
    echo "Please enter enrollment and select at least one event.<br><a href='event.html'>Go Back</a>";
}

$conn->close();
?>
