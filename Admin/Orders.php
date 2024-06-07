<?php
include('Connecte.php');

$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="all.min.css" />
  <link rel="stylesheet" href="hide.css" />
  <title>Document</title>
</head>

<body>
  <div class="left">
    <div class="logo"></div>
    <div class="icons">
      <!-- <a href="Admin.php">
          <div class="">
            <i class="fa-solid fa-house"></i>
            <p>dashbord</p>
          </div>
        </a> -->
      <!-- <a href="Client.php">
        <div class="">
          <i class="fa-solid fa-user-group"></i>
          <p>Client</p>
        </div>
      </a>
      <a href="Orders.php">
        <div class="" id="active">
          <i class="fa-solid fa-basket-shopping"></i>
          <p>Orders</p>
        </div>
      </a> -->
      <div class="just" style="display: block">
        <div class="" style="display: flex">
          <i class="fa-solid fa-cart-shopping"></i>
          <p>Product</p>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="list">
          <ul>
            <a href="Category.php" id="act">
              <li><i class="fa-solid fa-list"></i><span>Category</span></li>
            </a>
            <a href="Product.php">
              <li><i class="fa-regular fa-eye"></i> <span>View</span></li>
            </a>
          </ul>
        </div>
      </div>
      <!-- <a href="">
            <div class="list"></div>
          </a> -->

      <a href="">
        <div class="">
          <i class="fa-solid fa-right-from-bracket"></i>
          <p>Logout</p>
        </div>
      </a>
    </div>
  </div>
  <div class="right">
    <div class="navbar">
      <div class="new"></div>
      <div class=""><i class="fa-solid fa-bell"></i></div>
    </div>
    <div class="contain">
      <div class="gridx">
        <div class="grid-leftx">
          <div class="flex">
            <h4>List of Orders</h4>
            <a href="History.php">History</a>
          </div>
          <table>
            <thead>
              <th>Customer</th>
              <th>Date</th>
              <th>Produit</th>
              <th>Quantity</th>
              <th>Price (da)</th>
              <th>Wilaya</th>
              <th>Address</th>
              <th>Telephone</th>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $customersQuery = "SELECT * FROM customers WHERE CustomerID = " . $row['CustomerID'];
                  $customersResult = mysqli_query($conn, $customersQuery);

                  if ($customers = mysqli_fetch_assoc($customersResult)) {
                    $cmt = $customers['FullName'];
                    $phone = $customers['Phone'];
                    $adresse = $customers['Address'];
                    $wilaya = $customers['wilaya'];
                  }

                  $orderQuery = "SELECT * FROM orderdetails WHERE OrderID = " . $row['OrderID'];
                  $orderResult = mysqli_query($conn, $orderQuery);
                  $orderx = mysqli_fetch_assoc($orderResult);
                  $Quantity = $orderx['Quantity'];

                  $orderQueryz = "SELECT ProductID FROM orderdetails WHERE OrderID = " . $row['OrderID'];
                  $orderResultz = mysqli_query($conn, $orderQueryz);
                  $orderxz = mysqli_fetch_assoc($orderResultz);
                  $idproduct = $orderxz['ProductID'];

                  $orderQueryzz = "SELECT ProductName FROM products WHERE ProductID =  " . $idproduct ;
                  $orderResultzz = mysqli_query($conn, $orderQueryzz);
                  $orderxzz = mysqli_fetch_assoc($orderResultzz);
                  $product = $orderxzz['ProductName'];


                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($cmt) . "</td>";
                  echo "<td>" . htmlspecialchars($row["OrderDate"]) . "</td>";
                  echo "<td>" .$product . "</td>";
                  echo "<td>" . $Quantity . "</td>";
                  echo "<td>" . htmlspecialchars($row['TotalAmount']) . "</td>";
                  echo "<td>" . $wilaya . "</td>";
                  echo "<td>" . $adresse . "</td>";
                  echo "<td>" . $phone . "</td>";
                  echo "</tr>";
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="About-product" style="width: 300px">
    <div class="">
      <h3>Action produit</h3>
      <p>x</p>
    </div>

    <div class="btns" style="justify-content: block">
      <div class="" id="Valider">Valider</div>
      <div class="" id="Delete">Delete</div>
    </div>
  </div>
</body>
<script src="admin.js"></script>

</html>