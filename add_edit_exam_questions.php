<?php
include "connection.php";

// Fetch categories
$category_query = "SELECT * FROM exam_category";
$category_result = mysqli_query($conn, $category_query);
$categories = [];
while ($row = mysqli_fetch_assoc($category_result)) {
    $categories[] = $row;
}

// Fetch options
$options = ["Option 1", "Option 2", "Option 3", "Option 4"];

// Add Question
if(isset($_POST['add_question'])) {
    // Retrieve form inputs
    $question_no = isset($_POST['question_no']) ? mysqli_real_escape_string($conn, $_POST['question_no']) : '';
    $question = isset($_POST['question']) ? mysqli_real_escape_string($conn, $_POST['question']) : '';
    $option1 = isset($_POST['option1']) ? mysqli_real_escape_string($conn, $_POST['option1']) : '';
    $option2 = isset($_POST['option2']) ? mysqli_real_escape_string($conn, $_POST['option2']) : '';
    $option3 = isset($_POST['option3']) ? mysqli_real_escape_string($conn, $_POST['option3']) : '';
    $option4 = isset($_POST['option4']) ? mysqli_real_escape_string($conn, $_POST['option4']) : '';
    $answer = isset($_POST['answer']) ? mysqli_real_escape_string($conn, $_POST['answer']) : '';
    $category_id = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';

    // Insert question into database
    $query = "INSERT INTO exam_questions (question_no, question, opt1, opt2, opt3, opt4, answer, category) VALUES ('$question_no', '$question', '$option1', '$option2', '$option3', '$option4', '$answer', '$category_id')";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "<script>alert('Question added'); window.location.href=window.location.href;</script>";
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
    <form name="add_question_form" action="" method="POST">
        <div id="b1">
        <h3>Add Question</h3><br><br>
		<table>
		<tr>
        <td>Question Number</td>
        <td><input type="text" name="question_no" placeholder="Enter question number"></td></tr>
        <tr><td>Question</td>
        <td><input type="text" name="question" placeholder="Enter question" required></td></tr>
        <tr><td>Option </td>
        <td><input type="text" name="option1" placeholder="Enter option 1" required></td></tr>
        <tr><td>Option 2</td>
        <td><input type="text" name="option2" placeholder="Enter option 2" required></td></tr>
        <tr><td>Option 3</td>
        <td><input type="text" name="option3" placeholder="Enter option 3" required></td></tr>
        <tr><td>Option 4</td>
        <td><input type="text" name="option4" placeholder="Enter option 4" required></td></tr>
        <tr><td>Correct Answer</td>
        <td><input type="text" name="answer" placeholder="Enter correct option" required></td></tr>
		</table>
        Category
        <select name="category">
            <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['exam_name']; ?>"><?php echo $category['exam_name']; ?></option>
            <?php endforeach; ?>
        </select>
		<br><br>
        <input type="submit" name="add_question" value="Add Question" ><br>
		<br>
        To edit question <a href="edit_question_form.php">Click Here</a>
        </div>
    </form>
    </div>
</body>
</html>
