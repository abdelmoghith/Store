<?php

session_start();
session_destroy();
?>
<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  include('Connecte.php');



  $query = "SELECT * FROM products WHERE ProductID=$id";
  $result = mysqli_query($conn, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $n = $row["ProductName"];
    $p = $row["Price"];
    $d = $row["Description"];
    $Picture = $row['Picture'];
    $Explain = $row['Explain'];
  }

  $queryx = "SELECT * FROM product_pictures WHERE ProductID=$id";
  $resultx = mysqli_query($conn, $queryx);

  $Pictures = array();

  if (mysqli_num_rows($resultx) > 0) {
    while ($rowx = mysqli_fetch_assoc($resultx)) {
      $Pictures[] = $rowx['Picture'];
    }
  }


  if (isset($_POST['valider'])) {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    if (strpos($user_agent, 'android') !== false) {
      echo "";
      exit();
    } else {



      $name = $_POST['name'];
      $phone = $_POST['number'];
      if ($wilayas = $_POST['wilayas']) {
        $wilayas = $_POST['wilayas'];
      }
      if ($Qnt = $_POST['Qnt']) {
        $Qnt = $_POST['Qnt'];
      }
      $adresse = $_POST['adresse'];
      $stmt = $conn->prepare("INSERT INTO counter (vide) VALUES (?)");
      $vide = '0';

      $stmt->bind_param("i", $vide);

      $stmt->execute();

      $OrderID = $stmt->insert_id;
      $stmt->close();

      header("Location: Confirmation.php?id=$id&OrderID=$OrderID&price=$p&name=$name&phone=$phone&wilayas=$wilayas&Qnt=$Qnt&adresse=$adresse");
      exit();
    }
  }
}



?>

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

    <div class="pic" style="background-image: url('data:image/jpeg;base64,<?php echo base64_encode($Picture); ?>');"></div>
    <div class="pic_product">
      <h2>طلب المنتج</h2>
    </div>

    <div class="form">
      <form action="" method="post">
        <input type="text" id="name" placeholder="الاسم الكامل" name="name" required oninput="validateInput()" />
        <input type="number" id="phoneNumber" placeholder="رقم الهاتف" name="number" maxlength="10" required />
        <select name="wilayas" id="wilayas" required>
          <option value="" hidden>الولاية</option>
          <option value="أدرار">أدرار</option>
          <option value="الشلف">الشلف</option>
          <option value="الأغواط">الأغواط</option>
          <option value="أم البواقي">أم البواقي</option>
          <option value="باتنة">باتنة</option>
          <option value="بجاية">بجاية</option>
          <option value="بسكرة">بسكرة</option>
          <option value="بشار">بشار</option>
          <option value="البليدة">البليدة</option>
          <option value="البويرة">البويرة</option>
          <option value="تمنراست">تمنراست</option>
          <option value="تبسة">تبسة</option>
          <option value="تلمسان">تلمسان</option>
          <option value="تيارت">تيارت</option>
          <option value="تيزي وزو">تيزي وزو</option>
          <option value="الجزائر">الجزائر</option>
          <option value="الجلفة">الجلفة</option>
          <option value="جيجل">جيجل</option>
          <option value="سطيف">سطيف</option>
          <option value="سعيدة">سعيدة</option>
          <option value="سكيكدة">سكيكدة</option>
          <option value="سيدي بلعباس">سيدي بلعباس</option>
          <option value="عنابة">عنابة</option>
          <option value="قالمة">قالمة</option>
          <option value="قسنطينة">قسنطينة</option>
          <option value="المدية">المدية</option>
          <option value="مستغانم">مستغانم</option>
          <option value="المسيلة">المسيلة</option>
          <option value="معسكر">معسكر</option>
          <option value="ورقلة">ورقلة</option>
          <option value="وهران">وهران</option>
          <option value="البيض">البيض</option>
          <option value="إليزي">إليزي</option>
          <option value="برج بوعريريج">برج بوعريريج</option>
          <option value="بومرداس">بومرداس</option>
          <option value="الطارف">الطارف</option>
          <option value="تندوف">تندوف</option>
          <option value="تيسمسيلت">تيسمسيلت</option>
          <option value="الوادي">الوادي</option>
          <option value="خنشلة">خنشلة</option>
          <option value="سوق أهراس">سوق أهراس</option>
          <option value="تيبازة">تيبازة</option>
          <option value="ميلة">ميلة</option>
          <option value="عين الدفلى">عين الدفلى</option>
          <option value="النعامة">النعامة</option>
          <option value="عين تيموشنت">عين تيموشنت</option>
          <option value="غرداية">غرداية</option>
          <option value="غليزان">غليزان</option>
          <option value="تيميمون">تيميمون</option>
          <option value="برج باجي مختار">برج باجي مختار</option>
          <option value="أولاد جلال">أولاد جلال</option>
          <option value="بني عباس">بني عباس</option>
          <option value="عين صالح">عين صالح</option>
          <option value="عين قزام">عين قزام</option>
          <option value="تقرت">تقرت</option>
          <option value="جانت">جانت</option>
          <option value="المغير">المغير</option>
          <option value="المنيعة">المنيعة</option>

        </select>

        <input type="text" placeholder="العنوان الكامل" name="adresse" required />
        <select name="Qnt" id="Qnt" required onchange="updatePrice()">
          <option value="" hidden>اختر الكمية</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
        </select>



    </div>

    <div class="pic_product">
      <h2>ملخص الطلبية</h2>
      <br>
      <div class="details">
        <p><?php echo $n ?></p>
        <p><?php echo $d ?></p>
        <p>x<span id="selectedQuantity">1</span> : الكمية</p>
        <p> ثمن المنتج : <span id="totalPrice"><?php echo $p ?></span> د.ج</p>
      </div>
    </div>


    <script>
      function updatePrice() {
        var quantity = document.getElementById("Qnt").value;
        document.getElementById("selectedQuantity").textContent = quantity;
      }
    </script>

    <div class="valider">
      <button type="submit" id="valider" name="valider">شراء</button>
    </div>
    </form>
    <div class="pic_product">
      <h2>صور المنتج</h2>
      <br><br>
      <?php
      if (!empty($Pictures)) {
        foreach ($Pictures as $picture) {
          echo '<div class="pic" style="background-image: url(data:image/jpeg;base64,' . base64_encode($picture) . ')"></div>';
        }
      }
      ?>
    </div>

    <div class="pic_product">
      <h2>طريقة الاستخدام</h2>
      <div class="picx" style="background-image: url('data:image/jpeg;base64,<?php echo base64_encode($Explain); ?>');"></div>
    </div>
  </div>

  <div class="valider">
    <button type="submit" id="valider" name="valider" onclick="scrollToTop()">إضغط هنا للطلب </button>
  </div>
</body>
<script>
  function validateInput() {
    var inputText = document.getElementById("name").value;
    var regex = /\d/;
    if (regex.test(inputText)) {
      alert("الرجاء إدخال نص بدون أرقام.");
      document.getElementById("name").value = ""; // Clear the input field
    }
  }
</script>

<script src="page.js"></script>

</html>