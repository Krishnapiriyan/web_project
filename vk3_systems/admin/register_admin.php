<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $tp_num = $_POST['tp_num'];
   $tp_num = filter_var($tp_num, FILTER_SANITIZE_STRING);

   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'username already exist!';
   }else{

      if($tp_num < 0){
         $message[] = 'invalid telephone number!';
      }elseif(strlen($tp_num) != 10){
         $message[] = 'telephone number should be 10 digits!';
      }elseif(!is_numeric($tp_num)){
         $message[] = 'telephone number should contain only numbers!';  

      }elseif($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name,tp_num, password) VALUES(?,?,?)");
         $insert_admin->execute([$name,$tp_num,$cpass]);
         $message[] = 'new admin registered successfully!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
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
                  <h1>Register Now</h1>
                  <p>Create New account</p>

                  <div class="input-box">
                        <input type="text" name="name" required placeholder="enter your username" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-user' ></i>
                  </div>
                  
                  <div class="input-box">
                        <input type="text" name="tp_num" required placeholder="enter your telephone number" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-phone' ></i>
                  </div>

                  <div class="input-box">
                        <input type="password" name="pass" required placeholder="enter your password" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-lock-alt' ></i>
                  </div>

                  <div class="input-box">
                        <input type="password" name="cpass" required placeholder="confirm your password" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-lock-alt' ></i>
                  </div>

                  <!-- <div class="remember-forgot">
                        <lable><input type="checkbox">Remember Me</lable>
                        <a href="#">Forgot Password</a>
                  </div> -->

                  <button type="submit" class="btn" name="submit">Register Now</button>

                  <div class="register-link">
                        <p>Already have an account?<a href="../admin/admin_login.php">Login</a></p>  
                  </div> 

            </form>
         </div>

      </section>

   </div>
</div>










<script src="../js/admin_script.js"></script>
   
</body>
</html>