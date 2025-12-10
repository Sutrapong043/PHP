<?php
include 'connect.php';
header('Content-Type: application/json');

// Count all required stats
$result_total = mysqli_query($con, "SELECT COUNT(*) as count FROM customer");
$total_users = mysqli_fetch_assoc($result_total)['count'];

$result_admin = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'Admin'");
$total_admin = mysqli_fetch_assoc($result_admin)['count'];

$result_dev = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'Dev'");
$total_dev = mysqli_fetch_assoc($result_dev)['count'];

$result_member = mysqli_query($con, "SELECT COUNT(*) as count FROM customer WHERE role = 'User'");
$total_member = mysqli_fetch_assoc($result_member)['count'];

echo json_encode([
    'total_users' => $total_users,
    'total_admin' => $total_admin,
    'total_dev' => $total_dev,
    'total_member' => $total_member
]);
?>