<?php

include 'connect.php';
session_start();
$first = "";
$last = "";
$email = "";
$ext = "";
$title = "";
$office = "";
$update = false;
$id = 0;
if (isset($_POST['add'])) {
    $first = $_POST['firstName'];
    $last = $_POST['lastName'];
    $email = $_POST['email'];
    $ext = $_POST['extension'];
    $title = $_POST['title'];
    $office = $_POST['office'];

    $sql_max = "SELECT max(employeeNumber) as num from employees";
    $result_max = $conn->query($sql_max);
    $num = ($result_max->fetch_assoc())["num"] + 1;

    $sql = "INSERT INTO employees VALUES($num, '$last', '$first', '$ext', '$email', $office, 1143, '$title')";
    $result = $conn->query($sql);
    $_SESSION['msg'] = "Employee has been added!";
    $_SESSION['type'] = 'success';
    header('Location: task2.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET["delete"];
    $sql = "DELETE FROM employees WHERE employeeNumber=$id";
    $conn->query($sql);
    $_SESSION['msg'] = "Employee has been deleted!";
    $_SESSION['type'] = 'danger';
    header('Location: task2.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET["edit"];
    $update = true;
    $sql = "SELECT * FROM employees WHERE employeeNumber=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    $first = $row['firstName'];
    $last = $row['lastName'];
    $email = $row['email'];
    $ext = $row['extension'];
    $title = $row['jobTitle'];
    $office = $row['officeCode'];
}

if (isset($_POST['update'])) {
    $id = $_POST["id"];
    $first = $_POST['firstName'];
    $last = $_POST['lastName'];
    $email = $_POST['email'];
    $ext = $_POST['extension'];
    $title = $_POST['title'];
    $office = $_POST['office'];
    $sql = "UPDATE employees SET firstName='$first', lastName='$last', email='$email', extension='$ext', jobTitle='$title', officeCode=$office WHERE employeeNumber=$id";
    $conn->query($sql);
    $_SESSION['msg'] = "Employee has been updated!";
    $_SESSION['type'] = 'warning';
    header('Location: task2.php');
}