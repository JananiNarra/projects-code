<?php
session_start();
include "../connection.php";

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$total_que = 0;
$rel = mysqli_query($conn, "SELECT * FROM exam_questions WHERE category='{$_SESSION['exam_category']}'");
$total_que = mysqli_num_rows($rel);
echo $total_que;
?>
