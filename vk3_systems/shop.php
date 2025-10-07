<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
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
   <title>shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- 🔹 Price Filter Section -->
<section class="filter-section">
   <h2>Filter by Price</h2>
   <form method="get" action="">
      <div class="price-slider">
         <div class="slider-track"></div>

         <input type="range" name="min_price" id="min_price"
            min="0" max="500000" step="100"
            value="<?= isset($_GET['min_price']) ? $_GET['min_price'] : 0; ?>"
            oninput="updateSlider()">

         <input type="range" name="max_price" id="max_price"
            min="0" max="500000" step="100"
            value="<?= isset($_GET['max_price']) ? $_GET['max_price'] : 500000; ?>"
            oninput="updateSlider()">
      </div>

      <div class="price-values">
         <span>Min: LKR <span id="min_val"><?= isset($_GET['min_price']) ? $_GET['min_price'] : 0; ?></span></span>
         <span>Max: LKR <span id="max_val"><?= isset($_GET['max_price']) ? $_GET['max_price'] : 500000; ?></span></span>
      </div>

      <button type="submit" class="btn">Apply Filter</button>
   </form>
</section>


<section class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

   <?php
     // 🔹 Get filter values (default = show all)
     $min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
     $max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 500000;

     $select_products = $conn->prepare("SELECT * FROM `products` WHERE price BETWEEN :min AND :max ORDER BY price ASC"); 
     $select_products->bindParam(':min', $min_price, PDO::PARAM_INT);
     $select_products->bindParam(':max', $max_price, PDO::PARAM_INT);
     $select_products->execute();

     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
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
   }else{
      echo '<p class="empty">No products found in this price range!</p>';
   }
   ?>

   </div>

</section>


<?php include 'components/footer.php'; ?>


<script>
const minSlider = document.getElementById("min_price");
const maxSlider = document.getElementById("max_price");
const minValSpan = document.getElementById("min_val");
const maxValSpan = document.getElementById("max_val");
const sliderTrack = document.querySelector(".slider-track");

// Initialize min/max values
if(!minSlider.value) minSlider.value = 0;
if(!maxSlider.value) maxSlider.value = 500000;

// Update slider function
function updateSlider() {
    let minVal = parseInt(minSlider.value);
    let maxVal = parseInt(maxSlider.value);

    // Prevent overlap (500 gap)
    if(minVal > maxVal - 500) {
        minVal = maxVal - 500;
        minSlider.value = minVal;
    }
    if(maxVal < minVal + 500) {
        maxVal = minVal + 500;
        maxSlider.value = maxVal;
    }

    // Update text
    minValSpan.textContent = minVal.toLocaleString();
    maxValSpan.textContent = maxVal.toLocaleString();

    // Update highlighted range
    const percent1 = ((minVal - minSlider.min) / (minSlider.max - minSlider.min)) * 100;
    const percent2 = ((maxVal - maxSlider.min) / (maxSlider.max - maxSlider.min)) * 100;

    sliderTrack.style.background = `linear-gradient(to right, #ddd ${percent1}% , #007BFF ${percent1}% , #007BFF ${percent2}%, #ddd ${percent2}%)`;
}

// Initialize slider
updateSlider();

// Trigger update on input
minSlider.addEventListener("input", updateSlider);
maxSlider.addEventListener("input", updateSlider);
</script>


</body>
</html>