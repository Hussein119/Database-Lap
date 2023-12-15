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

// Function to insert a new course
function insertDepartment($department_name)
{
    global $conn;
    $sql = "INSERT INTO Department (department_name) VALUES (:department_name)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':department_name', $department_name);
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

        $department_name = $_POST['department_name'];

        // Insert the Course
        insertDepartment($department_name);

        // Commit transaction only if it was started in this block
        if ($conn->inTransaction()) {
            $conn->commit();
            echo '<script>alert("Department inserted successfully!"); window.location.href = "../department.php";</script>';
        }
    } catch (PDOException $e) {
        // Rollback transaction on error
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        echo "Error: " . $e->getMessage();
    }
}
