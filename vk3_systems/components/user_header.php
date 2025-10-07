<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
         <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
   }
}
?>

<header class="header">

   <section class="flex">


      <a href="home.php" class="logo"> <video class="gif-video" autoplay loop muted playsinline>
            <source src="new_image\icon.mp4" type="video/mp4">
            Your browser does not support the video tag.
         </video></a>
       <!-- <a href="home.php" class="logo">
               <img src=" ../new_image/logo.png" alt="Logo" style="height:35px; vertical-align:middle; margin-right:8px;"><span>Systems</span>
            </a> -->
      <!-- <a href="home.php" class="logo">Shopie<span>.</span></a> -->

      <?php
         // Get current page filename
         $current_page = basename($_SERVER['PHP_SELF']);
      ?>

      <nav class="newnavbar">
         <a href="home.php" class="<?= ($current_page == 'home.php') ? 'active' : '' ?>">Home<span></span></a>
         <a href="about.php" class="<?= ($current_page == 'about.php') ? 'active' : '' ?>">About<span></span></a>
         <a href="orders.php" class="<?= ($current_page == 'orders.php') ? 'active' : '' ?>">Orders<span></span></a>
         <a href="shop.php" class="<?= ($current_page == 'shop.php') ? 'active' : '' ?>">Shop<span></span></a>
         <a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact us<span></span></a>
         <a href="repair_ser.php" class="<?= ($current_page == 'repair_ser.php') ? 'active' : '' ?>">Repairs<span></span></a>
      </nav>


      <div class="icons">
         <?php
         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         $total_wishlist_counts = $count_wishlist_items->rowCount();

         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php" class="icon-circle"><i class="fas fa-search"></i></a>
         <a href="wishlist.php" class="icon-circle"><i class="fa-regular fa-heart"></i><span>(<?= $total_wishlist_counts; ?>)</span></a>
         <a href="cart.php" class="icon-circle"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

            <p><?= $fetch_profile["name"]; ?></p>

            <a href="update_user.php" class="btn">update profile</a>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">register</a>
               <a href="user_login.php" class="option-btn">login</a>
            </div>
            <a href="components/user_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>
         <?php
         } else {
         ?>
            <p>please login or register first!</p>
            <div class="flex-btn">
               <a href="user_register.php" class="option-btn">register</a>
               <a href="user_login.php" class="option-btn">login</a>
            </div>
         <?php
         }
         ?>


      </div>

   </section>

</header>