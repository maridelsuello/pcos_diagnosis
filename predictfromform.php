<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $age = escapeshellarg($_POST['age']);
    $bmi = escapeshellarg($_POST['bmi']);
    $menstrual = escapeshellarg($_POST['menstrual']);
    $testosterone = escapeshellarg($_POST['testosterone']);
    $follicle = escapeshellarg($_POST['folliclecount']);

    // Python command
    $command = "python load_model.py $age $bmi $menstrual $testosterone $follicle";

    // Execute the command
    $output = shell_exec($command);

    // Decode the result
    $result = json_decode($output, true);

    // Display the result
   /* if (isset($result['error'])) {
        echo "<h3>Error: " . htmlspecialchars($result['error']) . "</h3>";
    } else {
        $diagnosis = $result['prediction'] ? "Positive for PCOS" : "Negative for PCOS";
        echo "<h2>Diagnosis Result: $diagnosis</h2>";
        echo "<p>Probability of PCOS: " . ($result['probability'] * 100) . "%</p>";
    }*/
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PCOS Diagnosis Result</title>
</head>
<body>
    <h1>Diagnosis Result</h1>

    <?php
    if (isset($result)) {
        if (isset($result['error'])) {
            echo "<h3>Error: " . htmlspecialchars($result['error']) . "</h3>";
        } else {
            $diagnosis = $result['prediction'] ? "Positive for PCOS" : "Negative for PCOS";
            echo "<h2>Diagnosis: $diagnosis</h2>";
            echo "<p>Probability: " . ($result['probability'] * 100) . "%</p>";
        }
    } else {
        echo "<p>No result received.</p>";
    }
    ?>

    <br>
    <a href="add_info.php">← Back to Form</a>
</body>
</html>
