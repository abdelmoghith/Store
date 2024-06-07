<?php
include("Connecte.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Valider'])) {
  $name = $_POST['name'];
  $Category = isset($_POST['Category']) ? $_POST['Category'] : null;
  $Price = $_POST['Prix'];
  $Description = $_POST['Description'];
  $date = date('Y-m-d H:i:s');

  if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['picture']['tmp_name'];
    $pic = file_get_contents($fileTmpPath);
  }
  if (isset($_FILES['howto']) && $_FILES['howto']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath2 = $_FILES['howto']['tmp_name'];
    $pic2 = file_get_contents($fileTmpPath2);
  }
  $stmt = $conn->prepare("INSERT INTO products (ProductName, Description, Price, CategoryID, DateAdded, Picture, `Explain`) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssdisss", $name, $Description, $Price, $Category, $date, $pic, $pic2);
  
  

  if ($stmt->execute()) {
    $productId = $stmt->insert_id;
    $stmt->close();


    if (isset($_FILES['additional_pictures'])) {

      $stmt = $conn->prepare("INSERT INTO product_pictures (ProductID, Picture) VALUES (?, ?)");


      $stmt->bind_param("is", $productId, $picture);

      // Loop through each file
      foreach ($_FILES['additional_pictures']['tmp_name'] as $key => $tmp_name) {

        // Check if file is uploaded successfully
        if ($_FILES['additional_pictures']['error'][$key] === UPLOAD_ERR_OK) {

          $picture = file_get_contents($_FILES['additional_pictures']['tmp_name'][$key]);

          $stmt->execute();
        }
      }

      $stmt->close();
    }



    header("Location: Product.php");
    exit();
  } else {
    echo 'Error: ' . $stmt->error;
  }
}

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

$query_2 = "SELECT * FROM categories";
$result_2 = mysqli_query($conn, $query_2);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="all.min.css" />
  <link rel="stylesheet" href="hide.css" />
  <title>Product Management</title>
</head>

<body>

  <div class="left">
    <div class="logo"></div>
    <div class="icons">
      <!-- <a href="Admin.php">
        <div class="">
          <i class="fa-solid fa-house"></i>
          <p>dashboard</p>
        </div>
      </a> -->
      <!-- <a href="Client.php">
        <div class="">
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
      <div class="just" style="display: block" id="active">
        <div class="" style="display: flex">
          <i class="fa-solid fa-cart-shopping"></i>
          <p>Product</p>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="list show" style="display: inline">
          <ul>
            <a href="Category.php">
              <li><i class="fa-solid fa-list"></i><span>Category</span></li>
            </a>
            <a href="Product.php">
              <li style="background-color: #1a0d0d16">
                <i class="fa-regular fa-eye"></i> <span>View</span>
              </li>
            </a>
          </ul>
        </div>
      </div>
      <a href="logout.php">
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
            <h3>List of Product</h3>
            <h3>Add New</h3>
          </div>
          <table>
            <thead>
              <th>Name</th>
              <th>Price</th>
              <th>Category</th>
              <th>Picture</th>
              <th>Option</th>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $ctgQuery = "SELECT CategoryName FROM categories WHERE CategoryID = " . $row['CategoryID'];
                  $ctgResult = mysqli_query($conn, $ctgQuery);
                  $category = mysqli_fetch_assoc($ctgResult);

                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row["ProductName"]) . "</td>";
                  echo "<td>" . htmlspecialchars($row["Price"]) . "</td>";
                  echo "<td>" . htmlspecialchars($category['CategoryName']) . "</td>";
                  echo '<td><div class="Product_pic" style="background-image: url(data:image/jpeg;base64,' . base64_encode($row["Picture"]) . ');"></div></td>';
                  echo '<td>
                          <a href="Modifie_PD.php?id=' . htmlspecialchars($row['ProductID']) . '"><i class="fa-solid fa-pen"></i></a>
                          <a href="delete_product.php?id=' . htmlspecialchars($row['ProductID']) . '" onclick="return confirmDelete(' . htmlspecialchars($row['ProductID']) . ')"><i class="fa-solid fa-trash"></i></a>
                        </td>';
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

  <form action="" method="post" enctype="multipart/form-data">
    <div class="About-product">
      <div class="">
        <h3>Add Product</h3>
        <p>x</p>
      </div>
      <div class="">
        <div class="">
          <label for="name">Name</label>
          <input type="text" name="name" placeholder="Enter Name of Product" required />
        </div>
        <div class="">
          <label for="Category">Category</label>
          <select name="Category" required>
            <option value="" hidden>Choose</option>
            <?php
            if (mysqli_num_rows($result_2) > 0) {
              while ($roc = mysqli_fetch_assoc($result_2)) {
                echo "<option value='" . $roc["CategoryID"] . "'>" . $roc["CategoryName"] . "</option>";
              }
            }
            ?>
          </select>
        </div>
      </div>
      <div class="">
        <div class="">
          <label for="Prix">Price</label>
          <input type="number" name="Prix" placeholder="Enter the Price" required />
        </div>
        <div class="">
          <label for="picture">Picture</label>
          <input type="file" name="picture" required />
        </div>

      </div>
      <div class="">
        <div class="">
          <label for="picture">Other Picture</label>
          <input type="file" name="additional_pictures[]" accept="image/*" multiple>
          </div>
        <div class="">
        <label for="howto">طريقة الاسخدام</label>
        <input type="file" name="howto" required />
        </div>
          </div>
          <div class="">
            <div class="howto">
         <div class="">
           <label for="">Description</label>
           <input type="text" name="Description" placeholder="Enter Your Description" id="Description" required />
         </div>
        
        </div>
       </div>
      <div class="">
        <a href=""></a>
        <button type="submit" name="Valider" id="Delete">Submit</button>
      </div>
    </div>
  </form>



  <script>
    function confirmDelete(id) {
      return confirm('Are you sure you want to delete the product with ID ' + id + '?');
    }
  </script>
  <script src="admin.js"></script>

</body>

</html>