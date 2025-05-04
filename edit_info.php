<?php
include 'session.php';
include 'connection.php';

if(isset($_GET['id'])&& !empty($_GET['id'])){
    $id = intval ($_GET['id']);
    }

$sql = "SELECT id,age, bmi, menstrual, testosterone, folliclecount, diagnosis FROM dataset_features WHERE id = '$id'";
$result = $dbhandle->query($sql);
if ($result->num_rows == 1 ) {
    $row = $result->fetch_assoc();
    }

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $age = $_POST['age'];
    $bmi = $_POST['bmi'];
    $menstrual = $_POST['menstrual'];
    $testosterone = $_POST['testosterone'];
    $folliclecount = $_POST['folliclecount'];
    
    if ($bmi > 25 && $testosterone > 70 && $folliclecount > 12 && $menstrual != 'regular') {
        $diagnosis = 'Positive';
    } else {
        $diagnosis = 'Negative';
    }


    $update_sql = "UPDATE dataset_features SET
        age = '$age',
        bmi = '$bmi',
        menstrual = '$menstrual',
        testosterone = '$testosterone',
        folliclecount = '$folliclecount',
        diagnosis = '$diagnosis'
        WHERE id = $id";

        if ($dbhandle->query($update_sql) === TRUE){
         echo "<script>alert('User updated successfully!'); window.location='features.php'</script>";
        } else {
         echo "Error updating record: " . $dbhandle->error;
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User's Information</title>
    <link rel ="stylesheet" href="reg.css">
</head>
<body>
    <div class="container">
        <h2>Edit User's Information</h2>
        <form action="" method="POST">

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" value="<?=$row['age']?>" required> <br><br>
        <label for="bmi">BMI:</label>
        <input type="text" id="bmi" name="bmi" value="<?= $row['bmi'] ?>"required> <br><br>
        <label for="menstrual">Menstrual Cycle:</label>
        <select id="menstrual" name="menstrual" required>
            <option value="0" <?= $row['menstrual'] == 0 ? 'selected' : '' ?>>Regular</option>
            <option value="1" <?= $row['menstrual'] == 1 ? 'selected' : '' ?>>Irregular</option>
        </select><br><br>
        <label for="testosterone">Testosterone Level: </label>
        <input type="text" id="testosterone" name="testosterone" value="<?= $row['testosterone']?>"required> <br><br>
        <label for="folliclecount">Follicle Count:</label>
        <input type="text" id="folliclecount" name="folliclecount" value="<?=$row['folliclecount']?>"required><br><br>
        <label for="diagnosis">Diagnosis:</label>
        <input type="text" id="diagnosis" name="diagnosis" value="<?= $row['diagnosis'] ?>" readonly> <br><br>


        <button type="submit">Edit</button></a>
        <a href="dfeatures.php"><button type="button">Cancel</button></a>
        
        </form>
    </div>
</body>


</html>






    