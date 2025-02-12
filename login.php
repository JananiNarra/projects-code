<?php
	include "connection.php";
?>
<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="a.css">
</head>
<body>
<div class="form">
	<form action="check_login.php" method="POST">
	<h3>If you are already a user then login else <a href="signup.php">SignUP</a></h3>
	<table>
	<tr> 
		<td><font size="6" color="white">User Name: </td></font> <td><input type="text" name="name" required></td>
	</tr>
	<tr>
		<td><font size="6" color="white">Email: </td></font> <td><input type="text" name="email" required></td>
	</tr>
	<tr>
		<td><font size="6" color="white">Password</font></td> <td><input type="Password" name="password" required></td>
		<h3><td><a href="forget.php" >Forget Password</a></td></h3>
	</tr>
	</table>
		<input type="submit" id="btn" value="Register" name="submit">
	</form>
</div>
<div class="b">
</div>
</body>
</html>