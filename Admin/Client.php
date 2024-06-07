<?php
include('Connecte.php');

$query = "SELECT * FROM customers";
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
  <title>Client</title>
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
        <div class="" id="active">
          <i class="fa-solid fa-user-group"></i>
          <p>Client</p>
        </div>
      </a>
      <a href="Orders.php">
        <div class="">
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
            <h3>List of Clients</h3>
            <h3>: )</h3>
          </div>
          <table>
            <thead>
              <th>Customer</th>
              <th>Telephone</th>
              <th>Wilaya</th>
              <th>Address</th>

            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['FullName'] . "</td>";
                  echo "<td>" . $row['Phone'] . "</td>";
                  echo "<td>" . $row['wilaya'] . "</td>";
                  echo "<td>" . $row['Address'] . "</td>";

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
</body>
<script src="admin.js"></script>

</html>