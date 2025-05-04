<?php

include ('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lastname = $_POST["lastname"]; 
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $gender = $_POST["gender"];
    $birthday = $_POST["birthday"];
    $contact_number = $_POST["cno"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check_sql = "SELECT * FROM users WHERE username = ?";
    $check_stmt = $dbhandle->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

     if ($check_result->num_rows > 0) {
        echo "<script>alert('Username already taken. Please choose another.'); window.history.back();</script>";
     }else{    
        $sql = "INSERT INTO users (lastname, firstname, middlename, gender, birthday, cno, username, password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $dbhandle->prepare($sql);
        $stmt->bind_param("ssssssss", $lastname, $firstname, $middlename, $gender, $birthday, $contact_number, $username, $password);

    

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='home.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }
    $check_stmt->close();
    $dbhandle->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="reg.css">
</head>
<body>
    <div class="container">
        <h2>User Registration</h2>
        <form action=" " method="POST">
            <label for="lastname">Lastname:</label>
            <input type="text" name="lastname" placeholder="Last Name" required> <br> <br>

            <label for="firstname">Firstname:</label>
            <input type="text" name="firstname" placeholder="First Name" required> <br><br>

            <label for="middlename">Middlename:</label>
            <input type="text" name="middlename" placeholder="Middle Name"><br><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="0">Male</option>
        <option value="1">Female</option>
        <option value="X">Other</option>
    </select> <br><br>

            <label for="date">Date of Birth:</label>
            <input type="date" name="birthday" required><br> <br>

            <label for="cno">Contact Number:</label>
            <input type="text" name="cno" placeholder="Contact Number" required> <br> <br>

            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Username" required><br> <br>

            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Password" required> <br><br>

            <label for="password">Confirm Password:</label>
            <input type="password" name="cf" placeholder = "Confirm Password" required> <br><br>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>