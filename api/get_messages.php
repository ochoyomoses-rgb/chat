<?php
require_once '../config/db.php';
$s_id = $_GET['sender_id'];
$r_id = $_GET['receiver_id'];

$query = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) 
          OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";
$stmt = $conn->prepare($query);
$stmt->execute([$s_id, $r_id, $r_id, $s_id]);
echo json_encode($stmt->fetchAll());
?>