<?php
session_start();

// Check if questionno and value1 are set in the $_GET array
if(isset($_GET["questionno"]) && isset($_GET["value1"])) {
    // Sanitize input
    $questionno = htmlspecialchars($_GET["questionno"]);
    $value1 = htmlspecialchars($_GET["value1"]);

    // Save answer in session
    $_SESSION["answer"][$questionno] = $value1;

    // Output success message (for debugging)
    echo "Answer for question $questionno saved as: $value1";
} else {
    // Output error message if questionno or value1 are not set
    echo "Error: Missing parameters";
}
?>
