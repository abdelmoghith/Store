<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
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
    $fileTmpPath2 = $_FILES['howto']['tmp_name'];
    $pic2 = file_get_contents($fileTmpPath2);

    $stmt = $conn->prepare("UPDATE products SET ProductName = ?, Description = ?, Price = ?, CategoryID = ?, DateAdded = ?, Picture = ?, `Explain` = ? WHERE ProductID = ?");
    $stmt->bind_param("ssdisssi", $name, $Description, $Price, $Category, $date, $pic, $pic2, $id);
    

    if ($stmt->execute()) {
      $stmt->close();

      $deleteStmt = $conn->prepare("DELETE FROM product_pictures WHERE ProductID = ?");
    $deleteStmt->bind_param("i", $id);
    $deleteStmt->execute();
    $deleteStmt->close();

    if (isset($_FILES['additional_pictures'])) {

      $stmt = $conn->prepare("INSERT INTO product_pictures (ProductID, Picture) VALUES (?, ?)");


      $stmt->bind_param("is", $id, $picture);

      foreach ($_FILES['additional_pictures']['tmp_name'] as $key => $tmp_name) {

        if ($_FILES['additional_pictures']['error'][$key] === UPLOAD_ERR_OK) {

          $picture = file_get_contents($_FILES['additional_pictures']['tmp_name'][$key]);

          $stmt->execute();
        }
      }

      $stmt->close();
    }

      

        header("Location: Product.php");
        exit();
    }  else {
      echo 'Error: ' . $stmt->error;
      exit();
    }
  }
}

$query_2 = "SELECT * FROM categories";
$result_2 = mysqli_query($conn, $query_2);

$query = "SELECT * FROM products WHERE ProductID=$id";
$result = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($result)) {
  $n = $row["ProductName"];
  $p = $row["Price"];
  $d = $row["Description"];
}
}
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
    <form action="" method="post" enctype="multipart/form-data">
      <div class="contain">
        <div class="grid-leftx">
          <h3>Modifie Product</h3>
        </div>

        <div class="last">
          <div class="">
            <div class="">
              <label for="name">Name</label> <br>
              <input type="text" name="name" placeholder="Enter Name of Product" required value="<?php echo $n ?>" />
            </div>
            <div class="">
              <label for="Category">Category</label> <br>
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
              <label for="Prix">Price</label><br>
              <input type="number" name="Prix" placeholder="Enter the Price" required value="<?php echo $p ?>" />
            </div>
            <div class="">
              <label for="picture">Picture</label><br>
              <input type="file" name="picture" required />
            </div>
            <div class="">
              <label for="picture">Other Picture</label>
              <input type="file" name="additional_pictures[]" accept="image/*" multiple>
            </div>
            <div class="">
              <label for="howto">How to</label><br>
              <input type="file" name="howto" required />
            </div>
          </div>
          <div class="">
            <label for="Description">Description</label>
            <input type="text" name="Description" placeholder="Enter Your Description" id="Description" value="<?php echo $d ?>" required />
          </div>
          <div class="center"><button type="submit" name="Valider" id="Valider">Valider</button>
          </div>
        </div>

      </div>


    </form>

    <div class="About">
      <div class="">
        <h3>Description</h3>
      </div>
      <div class="Description">
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque
          excepturi vel omnis ipsam sunt maiores voluptates ratione veritatis
          placeat aliquid amet minima pariatur eos nesciunt, libero unde quam
          odio deleniti?
        </p>
      </div>

      <div class="" id="Okey">Okey</div>
    </div>
    <div class="confirmation" style="width: 300px">
      <div class="">
        <h3>Confirmation</h3>
      </div>

      <div class="btns" style="display: flex; margin: 20px;">
        <div class="" id="Cancel">Cancel</div>
        <div class="" id="Delete">Delete</div>
      </div>
    </div>

    <script src="admin.js"></script>

</body>

</html>