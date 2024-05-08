<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

try {
    $stmt = $conn->prepare("SELECT * FROM transactions WHERE status = 'pending'");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement.");
    }
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement.");
    }

    $result = $stmt->get_result();
    if (!$result) {
        throw new Exception("Failed to get result.");
    }

    $pendingTransactionData = [];
    while ($row = $result->fetch_assoc()) {
        $pendingTransactionData[] = $row;
    }
    
    echo json_encode($pendingTransactionData);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
