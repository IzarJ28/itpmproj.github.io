<?php
include 'connection.php';

$Name = $_POST["name"];
$Address = $_POST["address"];
$Number = $_POST["number"];

$stmt = $conn->prepare("INSERT INTO customers (Name, Address, Number) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $Name, $Address, $Number);
$stmt->execute();

$stmt->close();
$conn->close();

header("Location: adminpage.php?success=true");
exit();
?>
