<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laundrys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $sql = "SELECT * FROM transactions WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $transaction_id);


    $transaction_id = intval($_GET['id']); // Ensure it's an integer
    if ($stmt->execute()) {

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $transactions = [];
            while ($row = $result->fetch_assoc()) {
                $transaction = array(
                    "customer_id" => $row["customer_id"],
                    "employee_id" => $row["employee_id"],
                    "weight" => $row["weight"],
                    "total" => $row["total"],
                    "order_date" => $row["order_date"],
                    "finished_date" => $row["finished_date"]
                );
                $transactions[] = $transaction;
            }
            header('Content-Type: application/json');
            echo json_encode($transactions);
        } else {
            echo json_encode(['error' => 'No transactions found with ID: ' . $transaction_id]);
        }
    } else {
        echo json_encode(['error' => 'Failed to execute query']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Transaction ID is not provided']);
}

$conn->close();
?>
