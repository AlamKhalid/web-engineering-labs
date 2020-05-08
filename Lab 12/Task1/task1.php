<!DOCTYPE html>
<html>

<head>
    <title>Task-1</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
    table {
        border: 1px solid blue;
    }

    th {
        background-color: silver;
    }

    th,
    td {
        padding-right: 30px;
        padding-bottom: 10px;
    }
    </style>
</head>

<body>
    <h2>The data of employees is as follows</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Job Title</th>
            <th>Emp Office Address</th>
            <th>Reports To</th>
            <th>Update</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "classicmodels";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT concat(e1.firstName, ' ' ,e1.lastName) AS name, 
        e1.email, e1.jobTitle as job,
        concat(e2.firstName, ' ', e2.lastName, ', ', e2.jobTitle) as report, 
        concat(addressLine1, '<br>',IFNULL(addressLine2, ''), '<br>',city, ', ',IFNULL(state, ''), ', ',country) as address
        FROM employees e1 JOIN employees e2 ON (e1.reportsTo = e2.employeeNumber) JOIN offices o ON (e1.officeCode = o.officeCode)";

        $result = $conn->query($sql);
        $fields = ["name", "email", "job", "address", "report"];

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($fields as $field) {
                    echo "<td>$row[$field]</td>";
                }
                echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                echo "</tr>";
            }
        }
        $conn->close();
        ?>
    </table>
</body>

</html>