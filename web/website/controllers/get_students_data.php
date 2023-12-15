<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Collage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all students with their associated courses
    $stmt = $conn->query("SELECT Student.student_id, student_name, department_id, GROUP_CONCAT(course_name SEPARATOR ', ') as courses
                          FROM Student
                          LEFT JOIN Enrollment ON Student.student_id = Enrollment.student_id
                          LEFT JOIN Course ON Enrollment.course_id = Course.course_id
                          GROUP BY Student.student_id");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1'>";
    echo "<tr><th>Student ID</th><th>Student Name</th><th>Department ID</th><th>Courses</th></tr>";
    foreach ($students as $student) {
        echo "<tr><td>{$student['student_id']}</td><td>{$student['student_name']}</td><td>{$student['department_id']}</td><td>{$student['courses']}</td></tr>";
    }
    echo "</table>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
