<?php
include "connection.php";
	if(isset($_POST['submit']));
	{
		$count=0;
		$sql=mysqli_query($conn,"select * from details where username='$_POST[name]'&&password='$_POST[password]'&&email='$_POST[email]'");
		$count=mysqli_num_rows($sql);
		if($count==0)
		{
			echo "<script>alert('Username or Password incorrect');
			window.location='login.php';</script>";
		}
		else
		{
			echo "<script>
			alert('Login successful');
			window.location='exam_category.php';
			</script>";
		}
	}
?>