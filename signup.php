<html>
<head>
	<link rel="stylesheet" href="styles.css">
	<script src="check.js"></script>
</head>
<body>
<div class="form">
<br>
	<form action="check_signup.php" method="POST" onsubmit=" return check()">
	<table>
	<tr>
		<td><font size="6" color="white">User Name: </td></font> <td><input type="text" name="name" required></td>
	</tr>
	<tr>
		<td><font size="6" color="white">Email: </td></font> <td><input type="text" name="email" id="e" required></td>
	</tr>
	<tr>
		<td><font size="6" color="white">Password</font></td> <td><input type="Password" name="password" required></td>
	</tr>
	</table>
		<input type="submit" id="btn" value="SignUP" name="submit">
	</form>
</div>
</body>
</html>