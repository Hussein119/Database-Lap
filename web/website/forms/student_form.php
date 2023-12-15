<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Collage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo '<script>alert("Connected successfully!");</script>';
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Function to insert a new student
function insertStudent($student_name, $department_id)
{
    global $conn;
    $sql = "INSERT INTO Student (student_name, department_id) VALUES (:student_name, :department_id)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_name', $student_name);
    $stmt->bindParam(':department_id', $department_id);
    return $stmt->execute();
}

// Function to insert courses for a student
function insertCourses($student_id, $course_id)
{
    global $conn;
    $sql = "INSERT INTO Enrollment (student_id, course_id) VALUES (:student_id, :course_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->bindParam(':course_id', $course_id);
    return $stmt->execute();
}

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Check if a transaction is already active
        if (!$conn->inTransaction()) {
            // Start transaction
            $conn->beginTransaction();
        }

        $student_name = $_POST['student_name'];
        $department_id = $_POST['department'];
        $course_id = $_POST['course_id'];

        // Insert the student
        insertStudent($student_name, $department_id);

        // Retrieve the student_id of the last inserted student
        $student_id = $conn->lastInsertId();

        // Insert the courses for the student
        insertCourses($student_id, $course_id);

        // Commit transaction only if it was started in this block
        if ($conn->inTransaction()) {
            $conn->commit();
            echo '<script>alert("Student inserted successfully!"); window.location.href = "../student.php";</script>';
        }
    } catch (PDOException $e) {
        // Rollback transaction on error
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }
}
