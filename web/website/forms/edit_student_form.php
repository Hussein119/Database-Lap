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

function updateStudent($student_id, $student_name, $department_id)
{
    global $conn;
    $sql = "UPDATE Student SET student_name = :student_name ,
         department_id = :department_id WHERE  student_id = :student_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':student_id', $student_id);
    $stmt->bindParam(':student_name', $student_name);
    $stmt->bindParam(':department_id', $department_id);
    return $stmt->execute();
}

function updateCourses($student_id, $course_id)
{
    global $conn;
    $sql = "UPDATE Enrollment SET course_id = :course_id WHERE student_id = :student_id";
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

        $student_id = $_POST['student_id'];
        $student_name = $_POST['student_name'];
        $department_id = $_POST['department'];
        $course_id = $_POST['course_id'];

        // Update the student
        updateStudent($student_id, $student_name, $department_id);

        // Retrieve the student_id of the last inserted student
        $student_id = $conn->lastInsertId();

        // update the courses for the student
        updateCourses($student_id, $course_id);

        // Commit transaction only if it was started in this block
        if ($conn->inTransaction()) {
            $conn->commit();
            echo '<script>alert("Student updated successfully!"); window.location.href = "../student.php";</script>';
        }
    } catch (PDOException $e) {
        // Rollback transaction on error
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }
}
