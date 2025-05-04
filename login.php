<?php
session_start();
include 'connection.php';

if (!$dbhandle) {
    die("Database connection failed: " . mysqli_connect_error());
}


$error = "";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM users WHERE username = ?";

    if ($dbhandle instanceof mysqli) {
        $stmt = mysqli_prepare($dbhandle, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_assoc($result);

                if ($row) {
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['id'] = $row['id']; 
                        $_SESSION['username'] = $row['username']; 
                        header("Location: home.php");
                        exit();
                    } else {
                        $error = "Invalid password";
                    }
                } else {
                    $error = "Invalid username";
                }
            } else {
                $error = "Data retrieval failed: " . mysqli_error($dbhandle);
            }
            mysqli_stmt_close($stmt);
        } else {
            $error = "SQL statement preparation failed: " . mysqli_error($dbhandle);
        }
    } else {
        $error = "Invalid database connection object.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PCOS Diagnosis: Log In</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="">
</head>

<body>
    <div class="container">
        <div class="logo-container">
            <div class="logo">
                <img src="img/PCOS_IMG.png" alt="Logo">
            </div>
            <h1>Log In To Your Account</h1>
        </div>
        <?php if (!empty($error)): ?>
            <div class="error-message" style="color: red; margin-bottom: 10px;">
                 <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <form action="#" method="post">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <br>
            <br>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <br>
            <br>
            <button type="submit" name="submit">Log In</button>
                    
            <p style="margin-top: 15px; color: white;"> Don't have an account? <a href="registration.php" style="color: #00f; text-decoration: underline;">Register here</a>
            </p>
                    
        </form>
    </div>
</body>
</html>