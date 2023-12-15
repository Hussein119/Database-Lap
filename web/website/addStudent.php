<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data Form</title>
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

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            box-sizing: border-box;
            overflow: hidden;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button.blue-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button.blue-button:hover {
            background-color: #0056b3;
        }

        select {
            background-color: #fff;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>');
            background-repeat: no-repeat;
            background-position: right 8px center;
            cursor: pointer;
        }

        select::-ms-expand {
            display: none;
        }

        #coursesList {
            margin-top: 16px;
        }

        #coursesList div {
            margin-bottom: 8px;
            color: #333;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #header {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            color: #333;
        }

        h4 {
            margin-top: 20px;
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .edit-button,
        .delete-button {
            background-color: #f8b400;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-button:hover,
        .delete-button:hover {
            background-color: #c29000;
        }
    </style>
</head>

<body>

    <form action="./forms/student_form.php" method="post">
        <h2>Add a new student</h2>
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required>

        <label for="department">Department:</label>
        <select name="department" required>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "Collage";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT department_id, department_name FROM Department";
            $result = $conn->query($sql);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['department_id']}'>{$row['department_name']}</option>";
                }
            } else {
                echo "<option value='' disabled>No courses available</option>";
            }
            ?>
        </select>

        <label for="course_id">Courses:</label>
        <select name="course_id" required>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "Collage";
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT course_id, course_name FROM Course";
            $result = $conn->query($sql);

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['course_id']}'>{$row['course_name']}</option>";
                }
            } else {
                echo "<option value='' disabled>No courses available</option>";
            }
            ?>
        </select>
        <br />
        <input type="submit" value="ADD" class="submit-button">
    </form>

    <script>
        const courses = [];

        function addCourse() {
            const coursesSelect = document.getElementById('coursesSelect');
            const coursesText = coursesSelect.options[coursesSelect.selectedIndex].text;

            courses.push({
                text: coursesText
            });

            updateList('coursesList', courses);
        }

        function updateList(elementId, items) {
            const element = document.getElementById(elementId);
            element.innerHTML = '';

            items.forEach(item => {
                const listItem = document.createElement('div');
                listItem.textContent = item.text;
                element.appendChild(listItem);
            });
        }
    </script>
</body>

</html>