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
   <title>Home</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

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


   <section class="category">

      <h1 class="heading">shop by category</h1>

      <div class="categories">
         <div class="container">
            <div id="mixedSlider" class="ms-animating">
               <div class="MS-content">
                  <!-- category items: keep same links/images as before -->
                  <div class="item">
                     <a href="category.php?category=laptop">
                        <img src="images/laptop.png" alt="laptop">
                        <h3>Laptop</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=monitor">
                        <img src="images/monitor.png" alt="monitor">
                        <h3>Monitor</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=keyboard">
                        <img src="images/keyboard.png" alt="keyboard">
                        <h3>Keyboard</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=mouse">
                        <img src="images/mouse.png" alt="mouse">
                        <h3>Mouse</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=printer">
                        <img src="images/printer.png" alt="printer">
                        <h3>Printer</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=processor">
                        <img src="images/processor.png" alt="processor">
                        <h3>Processor</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=graphic_card">
                        <img src="images/graphic-card.png" alt="graphic_card">
                        <h3>Graphic-card</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=flash_drive">
                        <img src="images/pendrive.png" alt="flash_drive">
                        <h3>Flash-Drive</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=ram">
                        <img src="images/ram.png" alt="ram">
                        <h3>Ram</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=hard_disk">
                        <img src="images/hard-disk-drive.png" alt="hard_disk">
                        <h3>HardDisk</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=speaker">
                        <img src="images/speaker.png" alt="speaker">
                        <h3>Speaker</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=webcam">
                        <img src="images/webcam.png" alt="webcam">
                        <h3>WebCam</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=headphone">
                        <img src="images/headphones.png" alt="headphone">
                        <h3>Headphones</h3>
                     </a>
                  </div>
                  <div class="item">
                     <a href="category.php?category=others">
                        <img src="images/other.png" alt="others">
                        <h3>Other</h3>
                     </a>
                  </div>
               </div>

               <div class="MS-controls">
                  <button class="MS-left" aria-label="previous">&#10094;</button>
                  <button class="MS-right" aria-label="next">&#10095;</button>
               </div>

            </div>
         </div>
      </div>

   </section>



   <section class="home-products">

      <h1 class="heading">latest products</h1>

      <div class="swiper products-slider">

         <div class="swiper-wrapper">

            <?php
            $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
               while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
                  <form action="" method="post" class="swiper-slide slide">
                     <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                     <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                     <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                     <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                     <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                     <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
                     <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
                     <div class="name"><?= $fetch_product['name']; ?></div>
                     <div class="flex">
                        <div class="price"><span>LKR </span><?= $fetch_product['price']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                  </form>
            <?php
               }
            } else {
               echo '<p class="empty">no products added yet!</p>';
            }
            ?>

         </div>

         <div class="swiper-pagination"></div>

      </div>

   </section>


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
   //    (function() {
   //       const style = document.createElement('style');
   //       style.textContent = `
   // .swiper { position:relative; overflow:hidden; }
   // .swiper-wrapper{ will-change:transform; }
   // .slider-pagination{ position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px; z-index:5; }
   // .slider-dot{ width:8px; height:8px; border-radius:50%; background:#ddd; border:none; padding:0; cursor:pointer; }
   //    .slider-dot.active{ background:#333; }
   // .flex-direction-nav{ position:absolute; top:50%; left:0; right:0; display:flex; justify-content:space-between; transform:translateY(-50%); padding:0 10px; z-index:60; opacity:0; transition:opacity 180ms ease; pointer-events:none; }
   // /* arrows hidden by default, shown on hover over the slider container */
   // .swiper:hover .flex-direction-nav{ opacity:1; pointer-events:auto; }
   // .flex-direction-nav a{ background:rgba(0,0,0,0.4); color:#fff; padding:8px 10px; border-radius:4px; text-decoration:none; font-size:18px; display:inline-block; }
   // .flex-direction-nav a:hover{ background:rgba(0,0,0,0.6); }
   // /* also show when a child receives focus (keyboard/touch) */
   // .flex-direction-nav a:focus{ outline:2px solid rgba(255,255,255,0.5); }
   // `;
   //       document.head.appendChild(style);
   //    })();
   </script>

   <script>
      (function() {
  const slider = document.getElementById('mixedSlider');
  if (!slider) return;

  const content = slider.querySelector('.MS-content');
  const items = Array.from(content.querySelectorAll('.item'));
  const leftBtn = slider.querySelector('.MS-left');
  const rightBtn = slider.querySelector('.MS-right');

  if (!content || items.length === 0) return;

  let index = 0;

  function update() {
    const itemWidth = items[0].getBoundingClientRect().width + 16; // 16 = gap
    content.style.transform = `translateX(${-index * itemWidth}px)`;
  }

  leftBtn && leftBtn.addEventListener('click', () => {
    index = Math.max(index - 1, 0);
    update();
  });

  rightBtn && rightBtn.addEventListener('click', () => {
    index = Math.min(index + 1, items.length - 1);
    update();
  });

  // Clickable items (default <a> works naturally)
})();

   </script>
   


</body>

</html>

<!-- *********advertise********* -->
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