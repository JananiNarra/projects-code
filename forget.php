<?php
	include "connection.php";
?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form">
	<form action="" method="POST">
	<table>
	<tr> 
		<td><font size="5">User Name: </td></font> <td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td><font size="5">Email: </td></font> <td><input type="text" name="email"></td>
	</tr>
	<tr>
		<td><font size="5">New Password</font></td> <td><input type="Password" name="password"></td>
	</tr>
	</table>
		<input type="submit" id="btn" value="Register" name="submit">
	</form>
</div>
<?php
	if(isset($_POST['submit']));
	{
		$count=0;
		$sql=mysqli_query($conn,"select * from details where username='$_POST[name]' && email='$_POST[email]'");
		$count=mysqli_num_rows($sql);
		if($count==0)
		{
		echo "<script> alert('username or password already exits');<script/>";
		}
		else
		{
			$add="update details set password='$_POST[password]' where username='$_POST[name]' && email='$_POST[email]'";
			$res=mysqli_query($conn,$add);
			echo"<script>alert('done');</script>";
		}
	}
?>
</body>
</html>