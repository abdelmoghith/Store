<?php
session_start();
$_SESSION['confirmation_completed'] = true;
?>

<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $OrderID = $_GET['OrderID'];

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

  $queryz = "SELECT * FROM orderdetails WHERE OrderID=$OrderID";
  $resultz = mysqli_query($conn, $queryz);
  if ($rowz = mysqli_fetch_assoc($resultz)) {
    $quantite = $rowz["Quantity"];
    $Price = $rowz["Price"];
  }

  $queryx = "SELECT * FROM product_pictures WHERE ProductID=$id";
  $resultx = mysqli_query($conn, $queryx);

  $Pictures = array();

  if (mysqli_num_rows($resultx) > 0) {
    while ($rowx = mysqli_fetch_assoc($resultx)) {
      $Pictures[] = $rowx['Picture'];
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

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }

  .container {
    max-width: 600px;
    min-height: 600px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: center;
  }

  h1,
  h4 {
    color: #333;
  }

  p {
    color: #666;
    line-height: 1.6;
  }

  .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #0056b3;
  }

  .image {
  background-image: url(balloon.webp);
  background-size: contain;
  background-position: center;
  width: 100%;
  height: 400px;
  background-repeat: no-repeat;
  margin: 10px auto;
}

a {
  text-decoration: none; 
  color: white; 
  font-weight: bold; 
  background-color: #007bff;
  padding: 20px;
  margin: 20px auto;
  border-radius: 10px;

}


.vide{
  padding: 20px;
}


</style>

<body>
  <div class="container">
    <h1>! تهانينا </h1>
    <h4>لقد قمت بطلب المنتج بنجاج </h4>
    <p> سوف نتصل بك قريبا </p>
    <p> ابقى على اتصال </p>
    <div class="image"></div>
    <a href="Landing.php">العودة الى الرئيسية</a>
    <div class="vide"></div>
    <br>
  </div>
</body>
<script src="page.js"></script>

</html>