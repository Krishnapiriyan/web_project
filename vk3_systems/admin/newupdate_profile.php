<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
// load current profile for display and baseline checks
$select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
$select_profile->execute([$admin_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){

    // fetch posted values and sanitize
    $name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : '';
    $new_name = isset($_POST['new_name']) ? filter_var($_POST['new_name'], FILTER_SANITIZE_STRING) : '';
    $new_tp_num = isset($_POST['new_tp_num']) ? filter_var($_POST['new_tp_num'], FILTER_SANITIZE_STRING) : '';

    // password handling (raw values from form)
    $old_pass_raw = isset($_POST['old_pass']) ? $_POST['old_pass'] : '';
    $new_pass_raw = isset($_POST['new_pass']) ? $_POST['new_pass'] : '';
    $confirm_pass_raw = isset($_POST['confirm_pass']) ? $_POST['confirm_pass'] : '';

    $errors = [];

    if(!$fetch_profile){
        $errors[] = 'profile not found';
    }

    // Prepare an array to hold fields to update
    $fields = [];
    $params = [];

    // Validate and prepare username change
    if($new_name !== '' && $new_name !== $fetch_profile['name']){
        $select_name = $conn->prepare("SELECT id FROM `admins` WHERE name = ? AND id != ?");
        $select_name->execute([$new_name, $admin_id]);
        if($select_name->rowCount() > 0){
            $errors[] = 'username already taken!';
        }else{
            $fields[] = 'name = ?';
            $params[] = $new_name;
        }
    }

    // Validate telephone number
    // Accept either the old (current) telephone number or a new one.
    if($new_tp_num !== ''){
        if($new_tp_num !== $fetch_profile['tp_num']){
            // basic numeric and length checks for a new number
            if(!is_numeric($new_tp_num) || strlen($new_tp_num) != 10 || (int)$new_tp_num < 0){
                $errors[] = 'telephone number should be 10 digits and numeric';
            }else{
                $select_tp = $conn->prepare("SELECT id FROM `admins` WHERE tp_num = ? AND id != ?");
                $select_tp->execute([$new_tp_num, $admin_id]);
                if($select_tp->rowCount() > 0){
                    $errors[] = 'telephone number already taken!';
                }else{
                    $fields[] = 'tp_num = ?';
                    $params[] = $new_tp_num;
                }
            }
        }else{
            // if the user entered the same (old) number, no change required
        }
    }

    // Validate password change if requested
    if($old_pass_raw !== '' || $new_pass_raw !== '' || $confirm_pass_raw !== ''){
        // require all three fields
        if($old_pass_raw === '' ){
            $errors[] = 'please enter old password!';
        }else{
            $old_pass = sha1($old_pass_raw);
            if($old_pass !== $fetch_profile['password']){
                $errors[] = 'old password not matched!';
            }
        }

        if($new_pass_raw === '' || $confirm_pass_raw === ''){
            $errors[] = 'please enter new password and confirm it!';
        }else{
            if($new_pass_raw !== $confirm_pass_raw){
                $errors[] = 'confirm password not matched!';
            }else{
                // all good: set new password (store hashed)
                $fields[] = 'password = ?';
                $params[] = sha1($new_pass_raw);
            }
        }
    }

    // If there are no validation errors and we have fields to update, run the update
    if(empty($errors)){
        if(!empty($fields)){
            $params[] = $admin_id; // for WHERE
            $sql = 'UPDATE `admins` SET ' . implode(', ', $fields) . ' WHERE id = ?';
            $update = $conn->prepare($sql);
            $update->execute($params);
            $message[] = 'updated successfully!';
        }else{
            $message[] = 'no changes to update';
        }
    }else{
        foreach($errors as $e) $message[] = $e;
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
                <h1>Update Profile</h1>
                <!-- <p>default username = <span>admin</span><br> & password = <span>111</span></p> -->

                <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">

                <div class="input-box">
                        <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="enter your username" oninput="this.value = this.value.replace(/\s/g, '')">
                </div>
            
                <div class="input-box">
                        <input type="text" name="new_name" required placeholder="enter your username" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-user' ></i>
                </div>
                
                <div class="input-box">
                        <input type="text" name="new_tp_num" required placeholder="enter your telephone number" oninput="this.value = this.value.replace(/\s/g, '')">
                        <i class='bx bxs-phone' ></i>
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