
<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>
   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="about">

      <div class="row">

      <div class="image">
         <img src="images/about_img.gif" alt="">
      </div>

         <div class="content">
            <h3>Why choose VK3 Systems?</h3>
            <p>At VK3 Systems, we are dedicated to providing top-quality computers, accessories, and IT services for individuals and businesses. Our store offers the latest laptops, desktops, components, and expert repair services. With reliable products, affordable prices, and trusted after-sales support, we ensure that every customer in Sri Lanka receives the best technology solutions with a personal touch.</p>
            <a href="contact.php" class="btn">Contact us</a>
         </div>

      </div>

   </section>

   <section class="reviews">

      <h1 class="heading">Client's Reviews</h1>

      <div class="swiper reviews-slider">

         <div class="swiper-wrapper">

            <div class="swiper-slide slide">
               <img src="images/pic-2.1.jpeg" alt="">
               <h3>Kastu</h3>
               <p>Excellent service! I bought my laptop from VK3 Systems and it works perfectly. The staff were very friendly and supportive.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-3.jpeg" alt="">
               <h3>Jekki</h3>
               <p>I highly recommend VK3 Systems for computer accessories. They have a wide range and all are reasonably priced.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-4.jpeg" alt="">
               <h3>Vanu</h3>
               <p>Great customer support! My PC was repaired quickly, and they explained everything clearly. Truly reliable service in Sri Lanka.</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
               </div>
            </div>

            <div class="swiper-slide slide">
               <img src="images/pic-5.jpeg" alt="">
               <h3>Arush</h3>
               <p>I bought gaming accessories here and the quality is excellent. VK3 Systems is my go-to computer store now!</p>
               <div class="stars">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
               </div>
            </div>

      <div class="swiper-slide slide">
         <img src="images/pic-6.jpeg" alt="">
         <h3>Kuddy</h3>
         <p>The best store for affordable computer parts in Sri Lanka. I managed to build my PC with all components from here.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-7.jpeg" alt="">
         <h3>Krishna</h3>
         <p>Very satisfied with their after-sales support. My warranty claim was handled smoothly. Thank you, VK3 Systems!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-8.jpeg" alt="">
         <h3>Roni</h3>
         <p>Excellent computer shop with friendly staff, genuine spare parts, and fast service. Highly recommend to everyone.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>

      <div class="swiper-slide slide">
         <img src="images/pic-1.jpeg" alt="">
         <h3>Kavi</h3>
         <p>One of the most reliable computer shops I’ve visited. Great prices, quality products, and trustworthy service.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
      </div>
   </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>

<?php include 'components/footer.php'; ?>

   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

   <script src="js/script.js"></script>

   <script>
      var swiper = new Swiper(".reviews-slider", {
         loop: true,
         spaceBetween: 20,
         pagination: {
            el: ".swiper-pagination",
            clickable: true,
         },
         breakpoints: {
            0: {
               slidesPerView: 1,
            },
            768: {
               slidesPerView: 2,
            },
            991: {
               slidesPerView: 3,
            },
         },
      });
   </script>

</body>

</html>
