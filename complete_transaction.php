<?php
if(isset($_POST['id'])) {

    $transaction_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    include 'connection.php';

    $sql = "UPDATE transactions SET finished_date = NOW() WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transaction_id);

    if ($stmt->execute()) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Failed to execute SQL statement: " . $stmt->error));
}


    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Transaction ID not provided"));
}
?>
