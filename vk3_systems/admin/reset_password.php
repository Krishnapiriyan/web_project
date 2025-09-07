<?php

include '../components/connect.php';


session_start();

// allow optional ?name=... to prefill username when coming from login "forgot password"
$prefill_name = '';
if(isset($_GET['name'])){
   $prefill_name = trim(filter_var($_GET['name'], FILTER_SANITIZE_STRING));
}

if(isset($_POST['submit'])){

   // identify user by username then verify telephone number before allowing password change
   $name = isset($_POST['name']) ? trim($_POST['name']) : '';
   $tp_num = isset($_POST['tp_num']) ? trim($_POST['tp_num']) : '';
   $new_pass_raw = isset($_POST['new_pass']) ? $_POST['new_pass'] : '';
   $confirm_pass_raw = isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : '';

   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $tp_num = filter_var($tp_num, FILTER_SANITIZE_STRING);

   if($name === '' || $tp_num === ''){
      $message[] = 'please provide username and telephone number to identify account';
   }else{
      // find user by name
      $select_user = $conn->prepare("SELECT * FROM `admins` WHERE name = ? LIMIT 1");
      $select_user->execute([$name]);
      if($select_user->rowCount() <= 0){
         $message[] = 'user not found';
      }else{
         $user = $select_user->fetch(PDO::FETCH_ASSOC);
         // verify telephone number (normalize formats and compare trailing digits)
         if(!isset($user['tp_num'])){
            $message[] = 'telephone number does not match our records';
         }else{
            $stored_tp = preg_replace('/\D+/', '', $user['tp_num']);
            $input_tp = preg_replace('/\D+/', '', $tp_num);

            if($stored_tp === '' || $input_tp === ''){
               $message[] = 'telephone number does not match our records';
            } else {
               // compare last N digits (allow different country code/prefix formatting)
               $compare_len = 9; // use 9 as a conservative match length
               $stored_tail = (strlen($stored_tp) > $compare_len) ? substr($stored_tp, -$compare_len) : $stored_tp;
               $input_tail = (strlen($input_tp) > $compare_len) ? substr($input_tp, -$compare_len) : $input_tp;

               if($stored_tail !== $input_tail){
                  $message[] = 'telephone number does not match our records';
               }else{
                    // now allow password change
                    if($new_pass_raw === '' || $confirm_pass_raw === ''){
                    $message[] = 'please enter new password and confirm it';
                    }elseif($new_pass_raw !== $confirm_pass_raw){
                    $message[] = 'confirm password not matched!';
                    }else{
                    // update password (keep using sha1 for compatibility)
                    $hashed = sha1($new_pass_raw);
                    $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
                    $update_admin_pass->execute([$hashed, $user['id']]);
                    $message[] = 'password updated successfully!';
                }
            }
        }

    }
    }

}}

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

<!-- ?php include '../components/admin_header.php'; ?> -->
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


<!-- <section class="form-container">

   <form action="" method="post">
      <h3>update profile</h3>
      <input type="hidden" name="prev_pass" value="?= $fetch_profile['password']; ?>">
      <input type="text" name="name" value="?= $fetch_profile['name']; ?>" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="enter old password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="enter new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirm new password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="update now" class="btn" name="submit">
   </form>

</section> -->
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
                    <h1>Update profile</h1>
                    <!-- <p>default username = <span>admin</span><br> & password = <span>111</span></p> -->

                <div class="input-box">
                <input type="text" name="name" value="<?= htmlspecialchars($prefill_name ?? '', ENT_QUOTES); ?>" required placeholder="enter your username" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>

                <?php if(!empty($prefill_name)): ?>
                    <p class="info">Enter the telephone number associated with "<?= htmlspecialchars($prefill_name, ENT_QUOTES); ?>" to verify your account.</p>
                <?php endif; ?>

            <div class="input-box">
                <input type="text" name="tp_num" required placeholder="enter your telephone number" oninput="this.value = this.value.replace(/\s/g, '')" autofocus>
                <i class='bx bxs-phone' ></i>
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

                    <div class="register-link">
                        <p>Go To Back <a href="../admin/admin_login.php">  Login</a></p> 
                    </div> 

            </form>
        </div>

        </section>
    </div>
</div>












<script src="../js/admin_script.js"></script>
   
</body>
</html>