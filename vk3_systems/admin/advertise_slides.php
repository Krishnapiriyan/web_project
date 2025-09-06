<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_advertise'])){
    $advertise_id = $_POST['advertise_id'];

    // enforce a maximum number of adverts (change MAX_ADVERTISE as needed)
   $MAX_ADVERTISE = 6;
   $countStmt = $conn->prepare("SELECT COUNT(*) FROM `advertise`");
   $countStmt->execute();
   $currentCount = (int) $countStmt->fetchColumn();
   if($currentCount >= $MAX_ADVERTISE){
      $message[] = "maximum of {$MAX_ADVERTISE} adverts reached";
   } else {
      if(!isset($_FILES['image_01']) || $_FILES['image_01']['error'] !== UPLOAD_ERR_OK){
         $message[] = 'please choose an image file';
        } else {
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
            // generate unique filename
            $uniqueName = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
            $dest = '../uploaded_img/' . $uniqueName;

            if(move_uploaded_file($image_tmp_name_01, $dest)){
               $insert = $conn->prepare("INSERT INTO `advertise` (image_01, description, details) VALUES (?, ?, ?)");

               $description = isset($_POST['description']) ? trim($_POST['description']) : '';
               $description = filter_var($description, FILTER_SANITIZE_STRING);
               
               $details = isset($_POST['details']) ? trim($_POST['details']) : '';
               $details = filter_var($details, FILTER_SANITIZE_STRING);
               $insert->execute([$uniqueName, $description, $details]);
               if($insert->rowCount()){
                  $message[] = 'advertise added successfully';
               } else {
                  // rollback file if DB insert failed
                  @unlink($dest);
                  $message[] = 'database insert failed';
               }
            } else {
               $message[] = 'failed to move uploaded file';
            }
         }
    }
}
}
if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `advertise` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);

   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   
   $delete_product = $conn->prepare("DELETE FROM `advertise` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   
   header('location:advertise_slides.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Advertise</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

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

      <section class="add-products">

         <h1 class="heading">Add Advertise</h1>
         <div class="newflex">
         <form action="" method="post" enctype="multipart/form-data">
            
            <div class="newinputBox">
                  <span>image (required)</span>
                  <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>

            <div class="newinputBox">
                  <span>Description title (required)</span>
                  <textarea name="description" placeholder="enter small description" class="newbox" required maxlength="100" cols="10" rows="10"></textarea>
               </div>

               <div class="newinputBox">
                  <span>Full details (required)</span>
                  <textarea name="details" placeholder="enter full description" class="newbox" required maxlength="500" cols="30" rows="10"></textarea>
               </div>
            
            <input type="submit" value="Add advertise" class="btn" name="add_advertise">

         </form>
         </div>

      </section>

      <section class="show-products">

         <h1 class="heading">Advertise</h1>

         <div class="box-container">

         <?php
            $select_advertise = $conn->prepare("SELECT * FROM `advertise`");
            $select_advertise->execute();        
            if($select_advertise->rowCount() > 0){
               while($fetch_products = $select_advertise->fetch(PDO::FETCH_ASSOC)){ 
         ?>
         <div class="newbox">
            <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" alt="">
            <div class="description"><span><?= $fetch_products['description']; ?></span></div>
            <div class="details"><span><?= $fetch_products['details']; ?></span></div>

            <div class="flex-btn">
               
               <a href="update_advertise_slides.php?update=<?= $fetch_products['id']; ?>" class="option-btn"><i class='bx bx-reset' ></i></a>
                        
               <a href="advertise_slides.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');"><i class='bx bx-trash' ></i></a>
            </div>
         </div>
         <?php
               }
            }else{
               echo '<p class="empty">no products added yet!</p>';
            }
         ?>
         
         </div>

      </section>







<script src="../js/admin_script.js"></script>
   
</body>
</html>