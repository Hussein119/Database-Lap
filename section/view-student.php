<?php
include "dbconfig.php";
?>


<!DOCTYPE html>
<html>

<head>
    <title>Student Database</title>
    <style>
        table {
            border: 1px solid;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid;
        }


        button {
            width: 100px;
            height: 40px;
            padding: 10px;
            margin: 10px;
            text-align: center;
            border-radius: 5px;
            background: white;
            color: #4E9CAF;
        }

        button:hover {
            color: white;
            background: #4E9CAF;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div>
        <h2>Student Details</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM students";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><a href="update-student.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a>
                                &nbsp;
                                <a href="delete-student.php?id=<?php echo $row['id']; ?>"><button>Delete</button></a>
                            </td>
                        </tr>
                <?php       }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>