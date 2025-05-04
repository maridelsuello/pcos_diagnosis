<?php
include 'session.php';
include 'connection.php';


$sql = "SELECT id, age, bmi, menstrual, testosterone, folliclecount, diagnosis FROM dataset_features";
$result = $dbhandle->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="features.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>
    <header>
        <h1>PCOS Health Tracker</h1>
    </header>

    <div id="full-screen">
        
    <table>
        <tr>
            
            <th>Age</th>
            <th>BMI</th>
            <th>Menstrual Cycle</th>
            <th>Testosterone Count</th>
            <th>Follicle Count</th>
            <th>Response Category</th>
            <th colspan="2">Action</th> 
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td>" . $row["bmi"] . "</td>";
                $menstrual = ($row["menstrual"] == 1) ? "Irregular" : "Regular";
                echo "<td>" . $menstrual . "</td>";
                echo "<td>" . $row["testosterone"] . "</td>";
                echo "<td>" . $row["folliclecount"] . "</td>";
                echo "<td>" . $row["diagnosis"] . "</td>";
                echo "<td> 
                    <a href='edit_info.php?id=" .$row['id']. "'> <button class='edit-btn'> Edit </button></a>
                    </td>";
                echo "<td>     
                <a href='delete_info.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this user?');\"><button class='delete-btn'>Delete</button></a>
                    </td>"; 
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No users found</td></tr>";
        }
        ?>
    </table>
</body>
</html>