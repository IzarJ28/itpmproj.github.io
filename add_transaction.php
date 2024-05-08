<?php
include 'connection.php';

try {
    if (!isset($conn)) {
        throw new Exception("Database connection not found.");
    }

    $required_params = ['customer', 'employee', 'weight', 'total', 'order_date'];
    foreach ($required_params as $param) {
        if (!isset($_POST[$param]) || empty($_POST[$param])) {
            throw new Exception("Required POST parameter '$param' is missing.");
        }
    }

    if (!is_numeric($_POST['total'])) {
        throw new Exception("Invalid value for 'total'.");
    }

    $sql = "INSERT INTO transactions (customer_id, employee_id, weight, total, order_date, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error preparing SQL statement: " . $connection->error);
    }

    $stmt->bind_param("iiddss", $customer_id, $employee_id, $weight, $total, $order_date, $status);

    $customer_id = $_POST['customer'];
    $employee_id = $_POST['employee'];
    $weight = $_POST['weight'];
    $total = $weight * 40;
    $order_date = $_POST['order_date'];
    $status = 'pending';

    if (!$stmt->execute()) {
        throw new Exception("Error executing SQL statement: " . $stmt->error);
    }

    $stmt->close();

    header("Location: adminpage.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
