<?php
    session_start();

	include "connection.php";
?>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form">
	<form action="check_details.php" method="POST">
	if you are already a user then login else <a href="student_signup.php">SignUP</a>
	<table>
	<tr> 
		<td><font size="5">User Name: </td></font> <td><input type="text" name="name"></td>
	</tr>
	<tr>
		<td><font size="5">Email: </td></font> <td><input type="text" name="email"></td>
	</tr>
	<tr>
		<td><font size="5">Password</font></td> <td><input type="Password" name="password"></td>
		<td><a href="forget.php">Forget Password</a></td>
	</tr>
	</table>
		<input type="submit" id="btn" value="Register" name="submit">
	</form>
</div>
</body>
</html>