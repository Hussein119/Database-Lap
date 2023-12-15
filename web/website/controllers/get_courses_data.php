<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Collage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all courses
    $stmt = $conn->query("SELECT * FROM Course");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>Course ID</th><th>Course Name</th></tr>";
    foreach ($courses as $course) {
        echo "<tr><td>{$course['course_id']}</td><td>{$course['course_name']}</td></tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
