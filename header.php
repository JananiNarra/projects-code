<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Page</title>
    <style>
        /* CSS Styling */
        .header {
            background-color: #007bff; /* Blue background color */
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-left {
            display: flex;
            align-items: center;
            margin-right: auto; /* Push the links to the left side */
        }
        .header-left a {
            color: #fff; /* White text color */
            text-decoration: none;
            margin-right: 50px;
        }
        .user-info {
            display: flex;
            align-items: center;
			width:30%;
        }
        .user-info span {
            font-weight: bold;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-left">
            <!-- Links to Select Exam, Last Results, and Logout -->
            <a href="select_exam.php">Select Exam</a>
            <a href="old_exam_results.php">Last Results</a>
            <a href="logout.php">Logout</a>
            
        </div>
        <div class="user-info">
            <!-- PHP to display user login name -->
            <?php
                
                if(isset($_SESSION["username"])) {
                    $username = $_SESSION["username"];
                    
                    echo "Welcome" . "$username .";
                }
            ?>
        </div>
        <!-- Countdown timer placeholder -->
        <div id="countdowntimer" style="display: block;"></div>
    </div>

    <!-- JavaScript to handle countdown timer -->
    <script>
        setInterval(function() {
            timer();
        }, 1000);

        function timer() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    if(xmlhttp.responseText == "00.00.01") {
                        window.location = "result.php";
                    }
                    document.getElementById("countdowntimer").innerHTML = xmlhttp.responseText;
                }
            };
            xmlhttp.open("GET", "forajax/load_timer.php", true);
            xmlhttp.send(null);
        }
    </script>
</body>
</html>