<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: user_page.php");
    exit;
}

include 'connection.php';

$stmt = $conn->prepare("SELECT * FROM transactions");
$stmt->execute();
$result = $stmt->get_result();

// Close the statement
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <h3>Transaction Data</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Customer ID</th>
                <th>Employee ID</th>
                <th>Weight</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Finished Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['customer_id']; ?></td>
                    <td><?php echo $row['employee_id']; ?></td>
                    <td><?php echo $row['weight']; ?></td>
                    <td><?php echo $row['total']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['finished_date']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
