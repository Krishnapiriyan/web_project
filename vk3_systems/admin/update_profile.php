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

   $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $confirm_pass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
         $message[] = 'password updated successfully!';
      }else{
         $message[] = 'please enter a new password!';
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
   <title>update profile</title>

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
                  <h1>Update Profile</h1>
                  <!-- <p>default username = <span>admin</span><br> & password = <span>111</span></p> -->

                  <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">

                  <div class="input-box">
                     <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="enter your username" oninput="this.value = this.value.replace(/\s/g, '')">
                  </div>

                  <div class="input-box">
                        <input type="password" name="old_pass" placeholder="enter old password" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-lock-alt' ></i>
                  </div>

                  <div class="input-box">
                        <input type="password" name="new_pass" placeholder="enter new password" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-lock-alt' ></i>
                  </div>

                  <div class="input-box">
                        <input type="password" name="confirm_pass" placeholder="confirm new password" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-lock-alt' ></i>
                  </div>

                  <button type="submit" class="btn" name="submit">Update Now</button>

            </form>
         </div>

      </section>
   </div>
</div>   











<script src="../js/admin_script.js"></script>
   
</body>
</html>