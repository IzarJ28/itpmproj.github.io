<?php
include 'connection.php';

try {
    $stmt = $conn->prepare("SELECT * FROM customers");
    $stmt->execute();
    $stmt->bind_result($id, $name, $address, $number);
    
    $customerData = [];
    while ($stmt->fetch()) {
        $customerData[] = [
            'id' => $id,
            'name' => $name,
            'address' => $address,
            'number' => $number
        ];
    }

    echo json_encode($customerData);
} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
} finally {
    $stmt->close();
    $conn->close();
}
?>
