<?php
include("../components/connect.php");
session_start();

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM servicers WHERE username=?");
    $stmt->execute([$username]);
    $servicer = $stmt->fetch(PDO::FETCH_ASSOC);

    if($servicer && password_verify($password, $servicer['password'])){
        $_SESSION['servicer_id'] = $servicer['id'];
        header("Location: servicer_dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Servicer Login</title>
    <link rel="stylesheet" href="../css/servicer.css">
</head>
<body>
<div class="container">
    <form method="POST" action="">
        <h2>Login</h2>
        <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
        <p>Don't have an account? <a href="servicer_register.php">Register here</a></p>
    </form>
</div>
</body>
</html>
