<?php
include "connection.php";

// Fetch question details based on ID
if(isset($_POST['get_question'])) {
    $question_id = isset($_POST['question_id']) ? mysqli_real_escape_string($conn, $_POST['question_id']) : '';
    $query = "SELECT * FROM exam_questions WHERE id = '$question_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

// Edit Question
if(isset($_POST['edit_question'])) {
    $question_id = isset($_POST['question_id']) ? mysqli_real_escape_string($conn, $_POST['question_id']) : '';
    $question_no = isset($_POST['question_no']) ? mysqli_real_escape_string($conn, $_POST['question_no']) : '';
    $question = isset($_POST['question']) ? mysqli_real_escape_string($conn, $_POST['question']) : '';
    $option1 = isset($_POST['opt1']) ? mysqli_real_escape_string($conn, $_POST['opt1']) : '';
    $option2 = isset($_POST['opt2']) ? mysqli_real_escape_string($conn, $_POST['opt2']) : '';
    $option3 = isset($_POST['opt3']) ? mysqli_real_escape_string($conn, $_POST['opt3']) : '';
    $option4 = isset($_POST['opt4']) ? mysqli_real_escape_string($conn, $_POST['opt4']) : '';
    $answer = isset($_POST['answer']) ? mysqli_real_escape_string($conn, $_POST['answer']) : '';
    $category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';

    $query = "UPDATE exam_questions SET question_no='$question_no', question='$question', opt1='$option1', opt2='$option2', opt3='$option3', opt4='$option4', answer='$answer', category='$category' WHERE id='$question_id'";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "<script>alert('Question updated'); window.location.href=window.location.href;</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<html>
<head>
<link rel="stylesheet" href="partitions.css">
</head>
<body>
    <div id="a">
	<h2><u>ADMIN LOGIN</u></h2>
		<h3><a href="exam_category.php">Add & Edit exam</a></h3>
		<h3><a href="add_edit_exam_questions.php">Add & Edit Questions</a></h3>
		<h3><a href="old-exam-results.php">All Exam Results</a></h3>
		<h3><a href="logout_admin.php">Logout</a></h3>
	</div>
    <div id="b">
    <form name="edit_question_form" action="" method="POST">
        <div id="b2">
        <h4>Edit Question</h4><br><br>
        Enter Question ID to Edit<br><br>
        <input type="text" name="question_id" placeholder="Enter question ID" required><br><br>
        <input type="submit" name="get_question" value="Get Question" ><br><br>
        <?php if(isset($row)): ?>
            <input type="hidden" name="question_id" value="<?php echo $row['id']; ?>">
            Question Number<br><br>
            <input type="text" name="question_no" value="<?php echo $row['question_no']; ?>"><br><br>
            Question<br><br>
            <textarea name="question" placeholder="Enter question" rows="4" cols="50"><?php echo $row['question']; ?></textarea><br><br>
            Option 1<br><br>
            <input type="text" name="opt1" value="<?php echo $row['opt1']; ?>"><br><br>
            Option 2<br><br>
            <input type="text" name="opt2" value="<?php echo $row['opt2']; ?>"><br><br>
            Option 3<br><br>
            <input type="text" name="opt3" value="<?php echo $row['opt3']; ?>"><br><br>
            Option 4<br><br>
            <input type="text" name="opt4" value="<?php echo $row['opt4']; ?>"><br><br>
            Correct Answer<br><br>
            <input type="text" name="opt4" value="<?php echo $row['opt4']; ?>"><br><br>
            
           
            Category<br><br>
            <input type="text" name="category" value="<?php echo $row['category']; ?>"><br><br>
            <input type="submit" name="edit_question" value="Edit Question" >
        <?php endif; ?>
        </div>
    </form>
    </div>
</body>
</html>
