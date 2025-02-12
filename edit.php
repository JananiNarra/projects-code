<?php
include "connection.php";
$id=$_GET['id'];
$res=mysqli_query($conn,"select*from exam_category where id='$id'");
while($row=mysqli_fetch_array($res))
{
	$exam_category=$row['exam_name'];
	$exam_time=$row['exam_time'];
}
?>
<head>
<link rel="stylesheet" href="partitions.css">
</head>
<body>
	<div id="a">
	<h2><u>ADMIN LOGIN</u></h2>
		<h3><a href="exam_category.php">Add & Edit exam</a></h3>
		<h3><a href="add_edit_exam_questions.php">Add & Edit Questions</a></h3>
		<h3><a href="old-exam-results.php">All Exam Results</a></h3>
		<h3><a href="logout_admin.php">Logout</a></h3>
	</div>
	<div id="b">
	<form name="form1" action="" method="POST">
		<div id="b1">
		<h4>Edit Exam</h4><br><br>
		Exam Category<br><br>
		<input type="text" name="exam_name" placeholder="Enter exam name" value="<?php echo $exam_category?>"><br><br>
		Exam Time in Minutes<br><br>
		<input type="text" name="exam_time" placeholder="Enter exam time" value="<?php echo $exam_time?>"><br><br>
		<input type="submit" name="submit" value="Update Exam" >
		</div>
</form>
</head>
<?php
if(isset($_POST['submit']))
{
	$res=mysqli_query($conn,"update exam_category set exam_name='$_POST[exam_name]',exam_time='$_POST[exam_time]' where id='$id'");
	if($res)
	{
		echo "<script>
		window.location.href='exam_category.php';
		</script>";
	}
	else
	{
		echo "error".$res->error;
	}
}
?>
<script>
window.location='exam_category.php";
</script>