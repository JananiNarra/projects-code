<?php
session_start();
include "header.php";
include "connection.php";
?>

<div class="row" style="...">
    <div class="col-lg-6 col-lg-push-3" style="...">
        <center>
            <h1>Old Exams Results</h1>
        </center>
        <?php
        $count = 0;
        $res = mysqli_query($conn, "SELECT * FROM exam_results WHERE username='$_SESSION[username]' ORDER BY id DESC");
        $count = mysqli_num_rows($res);
        if ($count == 0) {
            ?>
            <center>
                <h1>No Results Found</h1>
            </center>
            <?php
        } else {
            echo "<table class='table table-bordered'>";
            echo "<tr style='background-color: #006df0; color:white'>";
            echo "<th>Username</th>";
            echo "<th>Exam Type</th>";
            echo "<th>Total Questions</th>";
            echo "<th>Correct Answers</th>";
            echo "<th>Wrong Answers</th>";
            echo "<th>Exam Time</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["exam_type"] . "</td>";
                echo "<td>" . $row["total_question"] . "</td>";
                echo "<td>" . $row["correct_answer"] . "</td>";
                echo "<td>" . $row["wrong_answer"] . "</td>";
                echo "<td>" . $row["exam_time"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</div>
