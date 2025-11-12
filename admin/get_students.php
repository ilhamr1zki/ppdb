<?php
include "db.php";

$limit = 10; // rows per page
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM students LIMIT $start, $limit";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

$totalResult = $conn->query("SELECT COUNT(*) AS total FROM students");
$total = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);

echo json_encode([
  "students" => $data,
  "totalPages" => $totalPages
]);
?>
  