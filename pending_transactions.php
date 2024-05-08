<?php

$pdo = new PDO("mysql:host=localhost;dbname=laundrys", "root", "");

$stmt = $pdo->query("SELECT * FROM transactions WHERE status = 'pending'");
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($transactions);
?>
