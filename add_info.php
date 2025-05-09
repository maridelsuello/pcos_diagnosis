<?php

include 'session.php';
include 'connection.php';

        /*if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $age = $_POST['age'];
            $bmi = $_POST['bmi'];
            $menstrual = $_POST['menstrual']; // 0 = Regular, 1 = Irregular
            $testosterone = $_POST['testosterone'];
            $folliclecount = $_POST['folliclecount'];

            // Basic diagnosis logic
            if ($bmi > 25 && $menstrual == 1 && $testosterone > 70 && $folliclecount > 12) {
                $diagnosis = "Likely PCOS";
            } else {
                $diagnosis = "Unlikely PCOS";
            }

            $sql = "INSERT INTO dataset_features (age, bmi, menstrual, testosterone, folliclecount, diagnosis) 
                    VALUES ('$age', '$bmi', '$menstrual', '$testosterone', '$folliclecount', '$diagnosis')";

            if ($dbhandle->query($sql) === TRUE) {
                echo "<script>alert('Information added successfully!'); window.location='features.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $dbhandle->error;
            }
        }*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $age = $_POST['age'];
    $bmi = $_POST['bmi'];
    $menstrual = $_POST['menstrual']; // 0 = Regular, 1 = Irregular
    $testosterone = $_POST['testosterone'];
    $folliclecount = $_POST['folliclecount'];

    // Call the Python model script via shell_exec
    $command = "python load_model.py " . escapeshellarg($age) . " " . escapeshellarg($bmi) . " " . escapeshellarg($menstrual) . " " . escapeshellarg($testosterone) . " " . escapeshellarg($folliclecount);
    $output = shell_exec($command);

    // Decode the result from Python
    $result = json_decode($output, true);

    // Check for errors
    if (isset($result['error'])) {
        echo "<h3>Error: " . htmlspecialchars($result['error']) . "</h3>";
    } else {
        $diagnosis = $result['prediction'] ? "Positive for PCOS" : "Negative for PCOS";
        $probability = $result['probability'] * 100;

        // Optionally, you can insert the results into the database
        // If you want to save the result, you can re-enable or modify the following SQL query
        // $sql = "INSERT INTO dataset_features (age, bmi, menstrual, testosterone, folliclecount, diagnosis, probability) 
        //         VALUES ('$age', '$bmi', '$menstrual', '$testosterone', '$folliclecount', '$diagnosis', '$probability')";
        
        // if ($dbhandle->query($sql) === TRUE) {
        //     echo "<script>alert('Information added and diagnosis made successfully!'); window.location='features.php';</script>";
        // } else {
        //     echo "Error: " . $sql . "<br>" . $dbhandle->error;
        // }

        // Show the diagnosis result
        echo "<h2>Diagnosis: $diagnosis</h2>";
        echo "<p>Probability of PCOS: $probability%</p>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Health Info</title>
    <link rel="stylesheet" href="addinfo.css">
</head>
<body>
    <h2>Enter Your Health Information</h2>
    <form action="predictfromform.php" method="POST">
        <label for="age">Age:</label><br>
        <input type="number" name="age" required><br><br>

        <label for="bmi">BMI:</label><br>
        <input type="number" step="0.1" name="bmi" required><br><br>

        <label for="menstrual">Menstrual Cycle:</label><br>
        <select name="menstrual" required>
            <option value=""></option>
            <option value="0">Regular</option>
            <option value="1">Irregular</option>
        </select><br><br>

        <label for="testosterone">Testosterone Level:</label><br>
        <input type="number" name="testosterone" required><br><br>

        <label for="folliclecount">Follicle Count:</label><br>
        <input type="number" name="folliclecount" required><br><br>

        <button type="submit">Submit</button>
        <a href="dfeatures.php"><button type="button">Cancel</button></a>
    </form>
</body>
</html>
