<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

if(isset($_POST['reset'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? ");
   $select_admin->execute([$name]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:reset_password.php');
   }else{
      $message[] = 'invalid username!';
   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>
    <div class="round"></div>

<div class="banner">

   <div class="content">
         
      <section class="newform-container">

         <div class="wrapper">
               <form action="" method="post">
                  <h1>Admin Login</h1>
                  <p>default username = <span>admin</span><br> & password = <span>111</span></p>

                  <div class="input-box">
                        <input type="text" name="name" required placeholder="Enter your username" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-user' ></i>
                  </div>

                  <div class="input-box">
                        <input type="password" name="pass" required placeholder="Enter your password" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-lock-alt' ></i>
                  </div>

            <div class="remember-forgot">
               <lable><input type="checkbox">Remember Me</lable>
               <a href="#" id="forgot-link">Forgot Password</a>
            </div>

                  <button type="submit" class="btn" name="submit">Login</button>

                  <div class="register-link">
                        <p>Don't have an account? <a href="../admin/newregister_admin.php">Register</a></p> 
                  </div> 

            </form>
         </div>

      </section>
   </div>
</div>

<script>
document.getElementById('forgot-link').addEventListener('click', function(e){
   e.preventDefault();
   const nameInput = document.querySelector('input[name="name"]');
   const name = nameInput ? nameInput.value.trim() : '';
   if(!name){
      alert('Please enter your username first');
      nameInput && nameInput.focus();
      return;
   }
   // redirect to reset page with username in querystring
   window.location.href = 'reset_password.php?name=' + encodeURIComponent(name);
});
</script>

</body>
</html>