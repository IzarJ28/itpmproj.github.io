<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST["transaction_id"]) && isset($_POST["customer"]) && isset($_POST["employee"]) && isset($_POST["weight"]) && isset($_POST["order_date"])) {
        // Get form data
        $transactionId = $_POST["transaction_id"];
        $customerId = $_POST["customer"];
        $employeeId = $_POST["employee"];
        $weight = $_POST["weight"];
        $orderDate = $_POST["order_date"];

        $servername = "localhost";
        $username = "root";
        $password = "=";
        $dbname = "laundrys";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE transactions SET customer_id=?, employee_id=?, weight=?, order_date=? WHERE transaction_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisi", $customerId, $employeeId, $weight, $orderDate, $transactionId);

        if ($stmt->execute()) {
            echo "Transaction updated successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "All required fields are not set.";
    }
} else {
    echo "Form was not submitted.";
}
?>
