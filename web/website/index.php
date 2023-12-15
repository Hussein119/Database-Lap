<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        #header {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            color: #333;
        }

        .category {
            width: 100%;
            text-align: center;
            margin: 20px 0;
        }

        .category h3 {
            margin-bottom: 10px;
        }

        .nav-buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            width: 80%;
            margin: 20px auto;
        }

        .nav-button {
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 45%;
            text-align: center;
            text-decoration: none;
            margin: 10px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .add-button {
            background-color: #4CAF50;
            color: #fff;
        }

        .edit-button {
            background-color: #f8b400;
            color: #fff;
        }

        .delete-button {
            background-color: #d9534f;
            color: #fff;
        }

        .nav-button:hover {
            filter: brightness(85%);
        }

        /* Additional styling for smaller screens */
        @media (max-width: 600px) {
            .nav-button {
                width: 90%;
            }
        }
    </style>
</head>

<body>

    <div class="category">
        <h3>Student Actions</h3>
        <div class="nav-buttons">
            <a href="student.php" class="nav-button">View Students</a>
            <a href="addStudent.php" class="nav-button add-button">Add Student</a>
            <a href="editStudent.php" class="nav-button edit-button">Edit Student</a>
            <a href="deleteStudent.php" class="nav-button delete-button">Delete Student</a>
        </div>
    </div>

    <div class="category">
        <h3>Course Actions</h3>
        <div class="nav-buttons">
            <a href="course.php" class="nav-button">View Courses</a>
            <a href="addCourse.php" class="nav-button add-button">Add Course</a>
            <a href="editCourse.php" class="nav-button edit-button">Edit Course</a>
            <a href="deleteCourse.php" class="nav-button delete-button">Delete Course</a>
        </div>
    </div>

    <div class="category">
        <h3>Department Actions</h3>
        <div class="nav-buttons">
            <a href="department.php" class="nav-button">View Departments</a>
            <a href="addDepartment.php" class="nav-button add-button">Add Department</a>
            <a href="editDepartment.php" class="nav-button edit-button">Edit Department</a>
            <a href="deleteDepartment.php" class="nav-button delete-button">Delete Department</a>
        </div>
    </div>

</body>

</html>