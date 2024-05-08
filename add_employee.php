<?php
include 'connection.php';

$name = $_POST['name'];
$address = $_POST['address'];
$number = $_POST['number'];
$salary = $_POST['salary'];
$join_date = $_POST['join_date'];
$end_date = $_POST['end_date'];

$stmt = $conn->prepare("INSERT INTO employees (name, address, number, salary, join_date, end_date) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $address, $number, $salary, $join_date, $end_date);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: adminpage.php?success=true");
exit();
?>
