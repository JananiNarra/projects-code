<?php
session_start();
include "connection.php";
	if(isset($_POST['submit']));
	{
		$count=0;
		$sql=mysqli_query($conn,"select * from student_details where username='$_POST[name]'&&password='$_POST[password]'&&email='$_POST[email]'");
		$count=mysqli_num_rows($sql);
		if($count==0)
		{
			echo "<script>alert('Username or Password incorrect');</script>";
		}
		else
		{
            $_SESSION["username"]=$_POST["name"];
			echo "<script>
			alert('Login successful');
			</script>";
            ?>
            <script type="text/javascript">
                window.location.href="select_exam.php";
                </script>
            <?php
		}
	}
?>