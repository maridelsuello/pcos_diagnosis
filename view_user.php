<?php
include 'session.php';
include 'connection.php';


$sql = "SELECT id, lastname, firstname, middlename, gender, birthday, cno, username FROM users";
$result = $dbhandle->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="view_user.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
</head>
<body>
    <table>
        <tr>
            
            <th>Name</th>
            <th>Birthday</th>
            <th>Contact Number</th>
            <th>Gender</th>
            <th colspan="2">Action</th> 
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
               
                echo "<td>" . $row["lastname"] . " " . $row["firstname"] . "</td>";
                echo "<td>" . $row["birthday"] . "</td>";
                echo "<td>" . $row["cno"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td> 
                    <a href='edit_user.php?id=" .$row['id']. "'> <button class='edit-btn'> Edit </button></a>
                    </td>";
                echo "<td> 
                    <a href='delete_user.php?id=" .$row['id']. "' onclick=\"return confirm('Are you sure you want to delete this user?');\"> <button class='delete-btn'> Delete </button></a>
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
