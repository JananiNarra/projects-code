<?php
	include "connection.php";
	if(isset($_POST['submit']));
	{
		$count=0;
		$sql=mysqli_query($conn,"select * from student_details where username='$_POST[name]'");
		$count=mysqli_num_rows($sql);
		if($count==1)
		{
		echo "<script> alert('username or password already exits')<script/>";
		}
		else
		{
			$add=mysqli_query($conn,"insert into student_details values('$_POST[name]','$_POST[email]','$_POST[password]')");
			echo "<script>
			alert('Registration successful!!');
			window.location.href='student_login.php';
			</script>";
		}
	}
?>