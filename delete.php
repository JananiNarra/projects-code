<?php
	include ("connection.php");
	$id=$_GET['id'];
	mysqli_query($conn,"delete from exam_category where id=$id");
?>
<script>
window.location="exam_category.php";
</script>