<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "Kush230908."; // change to your DB password
$dbname = "event_registration";   // change to your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query with branch added
$sql = "
    SELECT s.enrollment_no, s.name, s.branch,
           COALESCE(GROUP_CONCAT(se.event_name SEPARATOR ', '), 'No Event') AS events
    FROM students s
    LEFT JOIN student_events se ON s.enrollment_no = se.enrollment_no
    GROUP BY s.enrollment_no, s.name, s.branch
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Students and Events</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #121212;
      color: #fff;
      padding: 20px;
    }
    h2 {
      color: #4cafef;
    }
    table {
      width: 90%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    th, td {
      border: 1px solid #444;
      padding: 10px;
      text-align: left;
    }
    th {
      background: #333;
    }
    tr:nth-child(even) {
      background: #1e1e1e;
    }
  </style>
</head>
<body>

<h2>Students and Their Events</h2>
<table>
  <tr>
    <th>Enrollment No</th>
    <th>Name</th>
    <th>Branch</th>
    <th>Events Taken</th>
  </tr>
  <?php
  if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . $row["enrollment_no"] . "</td>
                  <td>" . $row["name"] . "</td>
                  <td>" . $row["branch"] . "</td>
                  <td>" . $row["events"] . "</td>
                </tr>";
      }
  } else {
      echo "<tr><td colspan='4'>No students found</td></tr>";
  }

  $conn->close();
  ?>
</table>

</body>
</html>
