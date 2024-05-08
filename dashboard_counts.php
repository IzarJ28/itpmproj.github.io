<?php

$connection = mysqli_connect('localhost', 'root', '', 'laundrys');

if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Query to get counts
$totalEmployeesQuery = "SELECT COUNT(*) AS totalEmployees FROM employees";
$totalCustomersQuery = "SELECT COUNT(*) AS totalCustomers FROM customers";
$totalTransactionsQuery = "SELECT COUNT(*) AS totalTransactions FROM transactions";

$totalEmployeesResult = mysqli_query($connection, $totalEmployeesQuery);
$totalCustomersResult = mysqli_query($connection, $totalCustomersQuery);
$totalTransactionsResult = mysqli_query($connection, $totalTransactionsQuery);

$totalEmployees = mysqli_fetch_assoc($totalEmployeesResult)['totalEmployees'];
$totalCustomers = mysqli_fetch_assoc($totalCustomersResult)['totalCustomers'];
$totalTransactions = mysqli_fetch_assoc($totalTransactionsResult)['totalTransactions'];

mysqli_close($connection);
$counts = array(
    "totalEmployees" => $totalEmployees,
    "totalCustomers" => $totalCustomers,
    "totalTransactions" => $totalTransactions
);

$jsonData = json_encode($counts);

header('Content-Type: application/json');

echo $jsonData;
?>
