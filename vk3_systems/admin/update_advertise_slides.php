<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = isset($_POST['pid']) ? (int)$_POST['pid'] : 0;

   $description = isset($_POST['description']) ? trim($_POST['description']) : '';
   $description = filter_var($description, FILTER_SANITIZE_STRING);

   $details = isset($_POST['details']) ? trim($_POST['details']) : '';
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $old_image_01 = isset($_POST['old_image_01']) ? $_POST['old_image_01'] : '';

   // Update text fields first
   $update_product = $conn->prepare("UPDATE `advertise` SET description = ?, details = ? WHERE id = ?");
   $update_product->execute([$description, $details, $pid]);

   if($update_product->rowCount()){
      $message[] = 'advertise details updated successfully!';
   } else {
      // It's possible rowCount is 0 if no changes were made; still continue for image handling
      $message[] = 'advertise details saved.';
   }

   // Handle optional image upload
   if(isset($_FILES['image_01']) && $_FILES['image_01']['error'] === UPLOAD_ERR_OK){
      $img = $_FILES['image_01'];
      $image_tmp_name_01 = $img['tmp_name'];
      $image_size_01 = $img['size'];
      $image_name = basename($img['name']);
      $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
      $allowed = ['jpg','jpeg','png','webp'];

      if(!in_array($ext, $allowed)){
         $message[] = 'invalid image type';
      } elseif($image_size_01 > 2_000_000){
         $message[] = 'image size is too large (max 2MB)';
      } else {
         $uniqueName = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
         $dest = '../uploaded_img/' . $uniqueName;

         if(move_uploaded_file($image_tmp_name_01, $dest)){
            // update DB with new image name
            $update_image = $conn->prepare("UPDATE `advertise` SET image_01 = ? WHERE id = ?");
            $update_image->execute([$uniqueName, $pid]);
            if($update_image->rowCount()){
               // remove old image file if present and different
               if(!empty($old_image_01) && file_exists('../uploaded_img/'.$old_image_01)){
                  @unlink('../uploaded_img/'.$old_image_01);
               }
               $message[] = 'image updated successfully!';
            } else {
               // DB failed, remove uploaded file
               @unlink($dest);
               $message[] = 'database update failed for image';
            }
         } else {
            $message[] = 'failed to move uploaded file';
         }
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
   <title>update Advertise</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

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

<section class="update-product">

   <h1 class="heading">update Advertise details</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `advertise` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="newflex">
      <form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
         
         <div class="newimage-container">
         <div class="newmain-image">
               <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
         </div>
      
         <span>update image (optional)</span>
         <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
         <span>update title</span>
         <textarea name="description" class="box" required cols="30" rows="10"><?= $fetch_products['description']; ?></textarea>
         <span>update details</span>
         <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
      
         <div class="flex-btn">
               <a href="advertise_slides.php" class="option-btn">go back</a>
               <input type="submit" name="update" class="btn" value="update">
         </div>
      </form>
   </div>
   
   <?php
         }
      }else{
         echo '<p class="empty">no product found!</p>';
      }
   ?>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>