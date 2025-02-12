<?php
include "connection.php";
include "header.php"; // Include your header file

// Check if the user is logged in
if(isset($_SESSION["username"])) {
    // Redirect to login.php if the user is already logged in
    header("Location: student_login.php");
    exit(); // Terminate script execution after redirecting
}

// Perform database query to fetch exam categories
$res = mysqli_query($conn, "SELECT * FROM exam_category");

// Check if there are any errors in the query execution
if (!$res) {
    echo "Error: " . mysqli_error($conn);
    exit(); // Terminate script execution if there is an error
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Categories</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
        }
        .exam-category {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            margin-bottom: 10px;
        }
        .exam-category input[type="button"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .header-links {
            margin-bottom: 20px; /* Add margin after the header links */
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="header-links">
            <!-- Links to Select Exam, Last Results, and Logout -->
           
        </div>
        <div class="exam-categories">
            <?php
            if(mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_array($res)) {
                    if(isset($row["exam_name"])) {
                        ?>
                        <div class="exam-category">
                            <input type="button" value="<?php echo $row["exam_name"]; ?>" onclick="set_exam_type_session(this.value);">
                        </div>
                        <?php
                    } else {
                        echo "Category key not found in the row.";
                    }
                }
            } else {
                echo "No exam categories found.";
            }
            ?>
        </div>
    </div>
    <script type="text/javascript">
		
        function set_exam_type_session(exam_category) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
                    alert(xmlhttp.responseText);
                    window.location = "dashboard.php"
                }
            };
            xmlhttp.open("GET", "forajax/set_exam_type_session.php?exam_category="+ exam_category,true);
            xmlhttp.send(null);
        }
    </script>
</body>
</html>