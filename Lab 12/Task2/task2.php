<!DOCTYPE html>
<html>

<head>
    <title>Task-2</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <style>
    div,
    h2 {
        text-align: center;
    }

    table {
        border: 1px solid blue;
        margin: 0 auto;
    }

    th {
        background-color: silver;
    }

    th,
    td {
        padding-right: 30px;
        padding-bottom: 10px;
        padding-left: 5px;
    }
    </style>
</head>

<body>
    <?php require_once 'process.php' ?>
    <?php
    if (isset($_SESSION['msg'])) {
        $msg = $_SESSION['msg'];
        $type = $_SESSION['type'];
        echo "<div class='w-50 mx-auto alert alert-$type alert-dismissible fade show'>$msg<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
      </button></div>";
        unset($_SESSION['msg']);
    }
    ?>
    <h2 class="text-uppercase mb-3 mt-5">Form to add employees</h2>
    <div class="container w-50">
        <form method="post" action="process.php">
            <input type="hidden" name="id" value=<?php echo $id ?> />
            <div class="row mb-2">
                <div class="col"> <input type="text" class="form-control" name="firstName" placeholder="First Name"
                        value="<?php echo $first ?>" required />
                </div>
                <div class="col"> <input type="text" class="form-control" name="lastName" placeholder="Last Name"
                        value="<?php echo $last ?>" required />
                </div>
            </div>
            <div class="row mb-2">
                <div class="col"> <input type="text" value="<?php echo $ext ?>" class="form-control" name="extension"
                        placeholder="Extension" required />

                </div>
                <div class="col"> <input type="email" class="form-control" name="email" value="<?php echo $email ?>"
                        placeholder="Email" required />

                </div>
            </div>
            <div class="row mb-2">
                <div class="col"> <select name="title" class="form-control" required>
                        <option value="">Select Title</option>
                        <option value="VP Sales" <?php if ($title == "VP Sales") echo "selected" ?>>VP Sales
                        </option>
                        <option vlaue="VP Marketing" <?php if ($title == "VP Marketing") echo "selected" ?>>VP Marketing
                        </option>
                        <option value="Sales Manager (APAC)"
                            <?php if ($title == "Sales Manager (APAC)") echo "selected" ?>>Sales Manager (APAC)</option>
                        <option value="Sale Manager (EMEA)"
                            <?php if ($title == "Sale Manager (EMEA)") echo "selected" ?>>Sale Manager (EMEA)</option>
                        <option value="Sales Manager (NA)" <?php if ($title == "Sales Manager (NA)") echo "selected" ?>>
                            Sales Manager (NA)</option>
                        <option value="Sales Rep" <?php if ($title == "Sales Rep") echo "selected" ?>>Sales Rep</option>
                    </select>
                </div>
                <div class="col"> <select name="office" class="form-control" value="<?php echo $officeCode ?>" required>
                        <option value="">Select Office</option>
                        <?php
                        include 'connect.php';
                        $sql = "SELECT officeCode as code, concat(addressLine1, ' ',IFNULL(addressLine2, ''), ' ',city, ', ',IFNULL(state, ''), ', ',country) as address FROM offices";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $selected = $office == $row["code"] ? "selected" : '';
                                echo "<option value=" . $row["code"] . " $selected>" . $row["address"] . "</option>";
                            }
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>
            </div>
            <?php if ($update) : ?><button type="submit" name="update"
                class="form-control btn btn-warning mt-2 w-25">Update
                Employee</button><?php else : ?><button type="submit" name="add"
                class="form-control btn btn-primary mt-2 w-25">Add
                Employee</button> <?php endif; ?>
        </form>
    </div>

    <br>
    <hr>
    <h2 class="text-uppercase mb-4">The data of employees is as follows</h2>
    <table class="mb-5">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Job Title</th>
            <th>Emp Office Address</th>
            <th>Reports To</th>
            <th>Update</th>
        </tr>
        <?php
        include 'connect.php';
        $sql = "SELECT e1.employeeNumber as id, concat(e1.firstName, ' ' ,e1.lastName) AS name, 
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
                $id = $row["id"];
                echo "<td><a href='task2.php?edit=$id'>Edit</a> | <a href='process.php?delete=$id' name='delete'>Delete</a>";
                echo "</tr>";
            }
        }
        $conn->close();
        ?>
    </table>
</body>

</html>