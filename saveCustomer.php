<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['customerName'];
    $address = $_POST['customerAddress'];
    $number = $_POST['customerNumber'];

    try {
        $stmt = $conn->prepare("INSERT INTO customers (name, address, number) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $address, $number);
        $stmt->execute();
    
        echo "Customer added successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    Header("Location: adminpage.php");
}
?>
