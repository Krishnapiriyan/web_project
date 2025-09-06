<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- Font Awesome for icons (kept) -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <div class="home-bg">

      <section class="home">

         <div class="swiper home-slider">

            <div class="swiper-wrapper">

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="new_image\home_slider\1.png" alt="">
                  </div>
                  <div class="content">
                     <h3>Fast Delivery Service</h3>
                     <span>Perfect for students, professionals, and gamers who want their laptops without the wait.</span>
                     <a href="orders.php" class="btn">order now</a>
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="new_image\home_slider\2.png" alt="">
                  </div>
                  <div class="content">
                     <h3>New Gaming Laptop Series Available!</h3>
                     <span>Discover powerful gaming laptops – cutting-edge technology, fast processors, advanced graphics, and unbeatable gaming experience.</span>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="new_image\home_slider\3.png" alt="">
                  </div>
                  <div class="content">
                     <h3>Wide selection of NVIDIA RTX</h3>
                     <span>Experience ultimate gaming with our RTX laptop range – powerful graphics, smooth performance, immersive displays included.</span>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="new_image\home_slider\4.png" alt="">
                  </div>
                  <div class="content">
                     <h3>ROG laptops deliver maximum processor power</h3>
                     <span>ROG laptops with maximum processors – ultimate speed, exceptional performance, and immersive gaming experiences.</span>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

               <div class="swiper-slide slide">
                  <div class="image">
                     <img src="new_image\home_slider\5.png" alt="">
                  </div>
                  <div class="content">
                     <h3>Exclusive university student offers</h3>
                     <span>University student discounts – grab high-performance laptops and accessories at unbeatable prices today.</span>
                     <a href="shop.php" class="btn">shop now</a>
                  </div>
               </div>

            </div>
            <div class="flex-direction-nav">
               <li class="flex-nav-prev"><a class="flex-prev" href="#" aria-label="Previous">&#10094;</a></li>
               <li class="flex-nav-next"><a class="flex-next" href="#" aria-label="Next">&#10095;</a></li>
            </div>
            <div class="swiper-pagination"></div>

         </div>

      </section>

   </div>

    <div class="home-bg">

        <section class="home">

            <div class="swiper home-slider">

                <div class="swiper-wrapper">

                <?php
                $select_products = $conn->prepare("SELECT * FROM `advertise` LIMIT 6");
                $select_products->execute();
                if ($select_products->rowCount() > 0) {
                    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>

                <div class="swiper-slide slide">
                        <div class="image">
                            <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                        </div>

                        <div class="content">
                            <div class="description"><?= $fetch_product['description']; ?></div>
                            <br>
                            <div class="details"><?= $fetch_product['details']; ?></div>
                        </div>


                </div>  

                    <?php
                    }
                    } else {
                    echo '<p class="empty">no products added yet!</p>';
                    }
                    ?>
                </div>   

            </div>
            </div>
            <div class="flex-direction-nav">
                <li class="flex-nav-prev"><a class="flex-prev" href="#" aria-label="Previous">&#10094;</a></li>
                <li class="flex-nav-next"><a class="flex-next" href="#" aria-label="Next">&#10095;</a></li>     
            </div>
        
        </section>
    </div>
    <div class="swiper-pagination"></div>



   <?php include 'components/footer.php'; ?>

   <!-- removed Swiper JS include to avoid external framework setup -->

   <script src="js/script.js"></script>

   <!-- Lightweight native slider to replace Swiper functionality -->
   <script>
      // Simple slider for elements with class 'swiper'
      document.querySelectorAll('.swiper').forEach(function(swiperEl) {
         const wrapper = swiperEl.querySelector('.swiper-wrapper');
         if (!wrapper) return;
         const slides = Array.from(wrapper.querySelectorAll('.swiper-slide'));
         if (slides.length === 0) return;
         let index = 0;

         // create pagination
         const pagination = document.createElement('div');
         pagination.className = 'slider-pagination';
         slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.className = 'slider-dot';
            dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
            dot.addEventListener('click', () => {
               goTo(i);
            });
            pagination.appendChild(dot);
         });
         swiperEl.appendChild(pagination);

         // style wrapper & slides for horizontal sliding
         wrapper.style.display = 'flex';
         wrapper.style.transition = 'transform 0.5s ease';
         slides.forEach(s => {
            s.style.flex = '0 0 100%';
         });

         function update() {
            wrapper.style.transform = 'translateX(' + (-index * 100) + '%)';
            Array.from(pagination.children).forEach((d, i) => d.classList.toggle('active', i === index));
         }

         function goTo(i) {
            index = (i + slides.length) % slides.length;
            update();
         }

         function next() {
            goTo(index + 1);
         }

         function prev() {
            goTo(index - 1);
         }

         // wire prev/next nav if present
         const prevBtn = swiperEl.querySelector('.flex-prev');
         const nextBtn = swiperEl.querySelector('.flex-next');
         if (prevBtn) prevBtn.addEventListener('click', function(e) {
            e.preventDefault();
            prev();
         });
         if (nextBtn) nextBtn.addEventListener('click', function(e) {
            e.preventDefault();
            next();
         });

         update();
         let auto = setInterval(next, 4000);
         swiperEl.addEventListener('mouseenter', () => clearInterval(auto));
         swiperEl.addEventListener('mouseleave', () => {
            clearInterval(auto);
            auto = setInterval(next, 4000);
         });
      });




      // basic styles for pagination and dots
      (function() {
         const style = document.createElement('style');
         style.textContent = `
   .swiper { position:relative; overflow:hidden; }
   .swiper-wrapper{ will-change:transform; }
   .slider-pagination{ position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px; z-index:5; }
   .slider-dot{ width:8px; height:8px; border-radius:50%; background:#ddd; border:none; padding:0; cursor:pointer; }
      .slider-dot.active{ background:#333; }
   .flex-direction-nav{ position:absolute; top:50%; left:0; right:0; display:flex; justify-content:space-between; transform:translateY(-50%); padding:0 10px; z-index:60; opacity:0; transition:opacity 180ms ease; pointer-events:none; }
   /* arrows hidden by default, shown on hover over the slider container */
   .swiper:hover .flex-direction-nav{ opacity:1; pointer-events:auto; }
   .flex-direction-nav a{ background:rgba(0,0,0,0.4); color:#fff; padding:8px 10px; border-radius:4px; text-decoration:none; font-size:18px; display:inline-block; }
   .flex-direction-nav a:hover{ background:rgba(0,0,0,0.6); }
   /* also show when a child receives focus (keyboard/touch) */
   .flex-direction-nav a:focus{ outline:2px solid rgba(255,255,255,0.5); }
   `;
         document.head.appendChild(style);
      })();
   


      // mixedSlider controller: scroll MS-content by item width
      (function() {
         const slider = document.getElementById('mixedSlider');
         if (!slider) return;
         const content = slider.querySelector('.MS-content');
         const left = slider.querySelector('.MS-left');
         const right = slider.querySelector('.MS-right');

         function scrollBy(dir) {
            const item = content.querySelector('.item');
            if (!item) return;
            const itemW = item.getBoundingClientRect().width + parseFloat(getComputedStyle(content).gap || 8);
            content.scrollBy({
               left: dir * itemW,
               behavior: 'smooth'
            });
         }
         left && left.addEventListener('click', () => scrollBy(-1));
         right && right.addEventListener('click', () => scrollBy(1));

         // touch drag support
         let isDown = false,
            startX, scrollLeft;
         content.addEventListener('pointerdown', (e) => {
            isDown = true;
            content.setPointerCapture(e.pointerId);
            startX = e.clientX;
            scrollLeft = content.scrollLeft;
         });
         content.addEventListener('pointerup', (e) => {
            isDown = false;
            content.releasePointerCapture(e.pointerId);
         });
         content.addEventListener('pointermove', (e) => {
            if (!isDown) return;
            const x = e.clientX;
            const walk = (startX - x);
            content.scrollLeft = scrollLeft + walk;
         });
      })();
   </script>

</body>

</html>
