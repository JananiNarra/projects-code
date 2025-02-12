<?php
session_start();

// Include the connection file
include "../connection.php";

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$question_no = "";
$question = "";
$opt1 = "";
$opt2 = "";
$opt3 = "";
$opt4 = "";
$answer = "";
$ans = "";

$quesno = $_GET["questionno"];
if (isset($_SESSION["answer"][$quesno])) {
    $ans = $_SESSION["answer"][$quesno];
}

$res = mysqli_query($conn, "SELECT * FROM exam_questions WHERE category=' $_SESSION[exam_category]'  AND question_no=$quesno");

// Check if the query executed successfully
if (!$res) {
    die("Error: " . mysqli_error($conn));
}

$count = mysqli_num_rows($res);

if ($count == 0) {
    echo "No questions found for this category and question number.";
} else {
    while ($row = mysqli_fetch_array($res)) {
        $question_no = $row["question_no"];
        $question = $row["question"];
        $opt1 = $row["opt1"];
        $opt2 = $row["opt2"];
        $opt3 = $row["opt3"];
        $opt4 = $row["opt4"];
    }
?>

<br>
<table>
    <tr>
        <td style="font-weight: bold; font-size: 10px; padding-left:5px" colspan="2">
            <?php echo "(" . $question_no . ")" . $question; ?>
        </td>
    </tr>
</table>

<table style="margin-left: 20px">
    <tr>
        <!-- Radio buttons and options here -->
    </tr>
</table>

<?php
}
?>
