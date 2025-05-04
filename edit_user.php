<?php
include 'session.php';
include 'connection.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
      $id = intval($_GET['id']);
    }

$sql = "SELECT id, lastname, firstname, middlename, gender, birthday, cno, username FROM users WHERE id = '$id'";
$result = $dbhandle->query($sql);
if($result->num_rows == 1){
        $row = $result->fetch_assoc();
      }

if($_SERVER["REQUEST_METHOD"] == "POST"){
      $lastname = $_POST['lastname'];
      $firstname = $_POST['firstname'];
      $middlename = $_POST['middlename'];
      $gender = $_POST['gender'];
      $birthday = $_POST['birthday'];
      $cno = $_POST['cno'];
      $username = $_POST['username'];

      $update_sql = "UPDATE users SET
        lastname = '$lastname',
        firstname = '$firstname',
        middlename = '$middlename',
        gender = '$gender',
        birthday = '$birthday',
        cno = '$cno'
        
        WHERE id = $id";
        
        if ($dbhandle->query($update_sql) === TRUE) {
          echo "<script>alert('User updated successfully!'); window.location='view_user.php';</script>";
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
    <title>Modify Users</title>
    <link rel="stylesheet" href="reg.css"> 
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <form action="" method="POST">

        <label for="lastname">Lastname:</label>
        <input type="text" name="lastname" placeholder="Last Name" value="<?= $row['lastname']?>" required> <br> <br>

        <label for="firstname">Firstname:</label>
        <input type="text" name="firstname" placeholder="First Name" value="<?= $row['firstname']?>" required> <br><br>

        <label for="middlename">Middlename:</label>
        <input type="text" name="middlename" placeholder="Middle Name" value="<?= $row['middlename']?>" required><br><br>

        <label for="gender" >Gender:</label>
        <select id="gender" name="gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="1" value="<?= $row['gender']?>" >Male</option>
        <option value="0" value="<?= $row['gender']?>" >Female</option>
        <option value="X" value="<?= $row['gender']?>" >Other</option>
        </select> <br><br>
        
        <label for="birthday">Date of Birth</label>
        <input type="date" name="birthday" value="<?= $row['birthday']?>" required><br> <br>

        <label for ="cno">Contact Number:</label>
        <input type="text" name="cno" placeholder="Contact Number" value="<?= $row['cno']?>" required> <br> <br>
            
        <a href="view_users.php"><button type="submit">Edit</button></a>
        </form>
    </div>
</body>
</html>
