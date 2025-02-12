<?php
	include "connection.php";
	if(isset($_POST['submit']));
	{
		$count=0;
		$sql=mysqli_query($conn,"select * from details where username='$_POST[name]' && email='$_POST[email]'");
		$count=mysqli_num_rows($sql);
		if($count>0)
		{
		echo "<script> alert('username or password already exits')<script/>";
		}
		else
		{
			$add=mysqli_query($conn,"insert into details values('$_POST[name]','$_POST[password]','$_POST[email]')");
			echo "<script>
			alert('Registration successful!!');
			window.location='login.php';
			</script>";
		}
	}
?>