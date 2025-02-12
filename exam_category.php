<?php
include "connection.php";
?>
<html>
<head>
<link rel="stylesheet" href="partitions.css">
<link rel="stylesheet" href="a.css">
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
		<h4>Add Exam</h4><br><br>
		New Exam Category<br><br>
		<input type="text" name="exam_name" placeholder="Enter exam name" id="s"><br><br>
		Exam Time in Minutes<br><br>
		<input type="text" name="exam_time" placeholder="Enter exam time" id="s"><br><br>
		<input type="submit" name="submit" value="Add Exam" >
		<br>
		<br>
		</div>
		<div id="b2">
		<table border='1' width='50%'>
		<tr>
		<th>S.No</th>
		<th>Exam Name</th>
		<th>Exam Time</th>
		<th>Edit</th>
		<th>Delete</th>
		</tr>
		<?php
		$count=0;
		$res=mysqli_query($conn,"SELECT * FROM exam_category");
		while($row=mysqli_fetch_array($res))
		{
			$count=$count+1;
			?>
			<tr>
			<th scope='row'><?php echo $count; ?></th>
			<td><?php echo $row['exam_name'];?></td>
			<td><?php echo $row['exam_time'];?></td>
			<td><a href="edit.php?id=<?php echo $row['id'];?>">Edit</a></td>
			<td><a href="delete.php?id=<?php echo $row['id'];?>">Delete</td>
			</tr>
			<?php
		}
		?>
		</table>
		</div>
	</form>
	</div>
<?php
if(isset($_POST['submit']))
{
	$exam_name = isset($_POST['exam_name']) ? mysqli_real_escape_string($conn, $_POST['exam_name']) : '';
	$exam_time = isset($_POST['exam_time']) ? mysqli_real_escape_string($conn, $_POST['exam_time']) : '';
	
	$res=mysqli_query($conn,"INSERT INTO exam_category (exam_name, exam_time) VALUES ('$exam_name', '$exam_time')");
	if($res)
	{
		echo "<script>alert('Exam added'); window.location.href=window.location.href;</script>";
	}
	else
	{
		echo "error" . mysqli_error($conn);
	}
}
?>
</body>
</html>
