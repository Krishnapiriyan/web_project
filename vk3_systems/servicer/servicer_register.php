<?php
include("../components/connect.php");
session_start();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $skills = $_POST['skills'];

    $stmt = $conn->prepare("SELECT * FROM servicers WHERE username=?");
    $stmt->execute([$username]);
    if($stmt->rowCount() > 0){
        $error = "Username already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO servicers (name, username, password, skills) VALUES (?, ?, ?, ?)");
        if($stmt->execute([$name, $username, $password, $skills])){
            $_SESSION['servicer_id'] = $conn->lastInsertId();
            header("Location: servicer_dashboard.php");
            exit;
        } else {
            $error = "Registration failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Servicer Registration</title>
    <link rel="stylesheet" href="../css/servicer.css">
</head>
<body>
<div class="container">
    <form method="POST" action="">
        <h2>Register</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <label>Repair Type:</label>
            <select name="skills" class="box">
                <option>Laptop</option>
                <option>Desktop</option>
                <option>Monitor</option>
                <option>Other</option>               
                <option>All repairs</option>

            </select>
        <!-- <input type="text" name="skills" placeholder="Your Skills" required> -->
        <button type="submit" name="submit">Register</button>
        <p>Already have an account? <a href="servicer_login.php">Login here</a></p>
    </form>
</div>
</body>
</html>
