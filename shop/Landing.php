<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="hide.css" />
  <link rel="stylesheet" href="all.min.css" />
  <title>Document</title>
</head>

<body>
  <div class="sidebar">
    <div class="" id="exit">X</div>
    <input type="text" placeholder="عن مذا تبحث ؟" />
    <div class="links">
      <ul>
        <a href="Landing.php">
          <li>الرئيسية</li>
        </a>
        <a href="store.php">
          <li>المتجر</li>
        </a>
        <a href="livraison.php">
          <li>الشحن والتسليم</li>
        </a>
        <a href="paiment.php">
          <li>طرق الدفع</li>
        </a>
      </ul>
    </div>
  </div>
  <div class="Bar">أطلب الآن 87733824617</div>
  <div class="navbar">
    <div class="left"><i class="fa-solid fa-magnifying-glass"></i></div>
    <div class="meduim"><a href="Landing.php">LOGO</a></div>
    <div class="right"><i class="fa-solid fa-bars"></i></div>
  </div>

  <div class="container">
    <div class="title">
      <div class="first">منتجاتنا أصلية و ذات جودة عالية</div>
      <div class="last">تصفح قائمة المنتجات الأكثر رواجا</div>
    </div>

    <div class="products">
      <?php
      include("Connecte.php");
      $query = "SELECT * FROM products ORDER BY sales DESC LIMIT 4";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        $productName = htmlspecialchars($row['ProductName']);
        $productPrice = htmlspecialchars($row['Price']);
        $productPicture = $row['Picture'];
        $productName = htmlspecialchars($productName);
        $productPrice = htmlspecialchars($productPrice);
      ?>
        <div class="product">
          <div class="Picture" id="prod_1" style="background-image: url('data:image/jpeg;base64,<?php echo base64_encode($productPicture); ?>');"></div>
          <div class="description">
            <h6>الاكثر مبيعا</h6>
            <h5><?php echo $productName; ?></h5>
            <p id="price"><?php echo $productPrice; ?> د.ج</p>
            <a href="Product.php?id=<?php echo htmlspecialchars($row['ProductID']); ?>">اشتري الان</a>
          </div>
        </div>
      <?php
      }
      ?>
    </div>




  </div>
  <div class="title">
    <div class="first"><a href="store.php"> اقسام المتجر</a> </div>
    <div class="firt"> <a href="store.php">اضغط هنا لتصفح المتجر</a></div>
  </div>
  <div class="Categoryes">
    <?php
    include("Connecte.php");
    $queryz = "SELECT * FROM categories";
    $resultz = mysqli_query($conn, $queryz);

    while ($rowz = mysqli_fetch_assoc($resultz)) {
      $idcat = htmlspecialchars($rowz['CategoryID']);
      $CatName = htmlspecialchars($rowz['CategoryName']);
      $CatPicture = $rowz['Picture'];

    ?>
      <div class="" id="" style="background-image: url('data:image/jpeg;base64,<?php echo base64_encode($CatPicture); ?>');">
        <p><?php echo $CatName; ?></p>
        <a href="store.php?id=<?php echo $idcat ?>">تسوق الان</a>
        </div>
    <?php
    }
    ?>
  </div>
</body>
<script src="page.js"></script>

</html>