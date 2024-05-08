<?php
include 'connection.php';

try {
    $stmt = $conn->prepare("SELECT * FROM employees");
    $stmt->execute();

    $stmt->bind_result($id, $name, $address, $number, $salary, $join_date, $end_date);
    
    $employeeData = [];
    while ($stmt->fetch()) {
        $employeeData[] = [
            'id' => $id,
            'name' => $name,
            'address' => $address,
            'number' => $number,
            'salary' => $salary,
            'join_date' => $join_date,
            'end_date' => $end_date
        ];
    }
    
    echo json_encode($employeeData);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $stmt->close();
    $conn->close();
}
?>
