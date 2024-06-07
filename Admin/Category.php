<?php

session_start();

if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit();
} else {
  include("Connecte.php");
  $categoryCounts = array(); // Initialize an empty array to store category names and product counts
  $query = "SELECT c.CategoryID, c.CategoryName, COUNT(p.ProductID) AS ProductCount
          FROM categories c
          LEFT JOIN products p ON c.CategoryID = p.CategoryID
          GROUP BY c.CategoryID";
  $result = mysqli_query($conn, $query);

  // Store category names and product counts in the array
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $categoryCounts[$row["CategoryID"]] = $row["ProductCount"];
    }
  }
  $query = "SELECT * FROM categories ";

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Valider'])) {
    $name = $_POST['name'];
    $date = date('Y-m-d H:i:s');

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
      $fileTmpPath = $_FILES['picture']['tmp_name'];
      $pic = file_get_contents($fileTmpPath);

      $stmt = $conn->prepare("INSERT INTO categories (CategoryName, DateAdded , Picture) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $date, $pic);

      if ($stmt->execute()) {
        header("Location: Category.php");
        exit();
      } else {
        echo 'Error: ' . $stmt->error;
      }

      $stmt->close();
    }

    // $insert = mysqli_query($conn, "INSERT INTO `categories` (CategoryName, DateAdded) VALUES ('$name','$date')");
    // if ($insert) {
    //   header("Location: Category.php");
    // } else {
    //   echo 'Error: ' . mysqli_error($conn); // 
    // }
  }
}
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
      <div class="just" style="display: block" id="active">
        <div class="" style="display: flex">
          <i class="fa-solid fa-cart-shopping"></i>
          <p id="link">Product</p>
          <i class="fa-solid fa-chevron-down"></i>
        </div>
        <div class="list show" style="display: inline">
          <ul>
            <a href="Category.php">
              <li style="background-color: #1a0d0d16">
                <i class="fa-solid fa-list"></i><span id="link">Category</span>
              </li>
            </a>
            <a href="Product.php">
              <li><i class="fa-regular fa-eye"></i> <span id="link">View</span></li>
            </a>
          </ul>
        </div>
      </div>
      <!-- <a href="">
          <div class="list"></div>
        </a> -->

      <a href="logout.php">
        <div class="">
          <i class="fa-solid fa-right-from-bracket"></i>
          <p class="logout">Logout</p>
        </div>
      </a>
    </div>
  </div>
  <div class="right">
    <div class="navbar">
      <div class="new">
      </div>
      <div class=""><i class="fa-solid fa-bell"></i></div>
    </div>
    <div class="contain">
      <div class="gridx">
        <div class="grid-leftx">
          <div class="flex">
            <h3>Category</h3>
            <h3>Add New</h3>
          </div>
          <table>
            <thead>
              <th>Name</th>
              <th>Product</th>
              <th>Logo</th>
              <th>Option</th>
            </thead>
            <tbody>
              <?php
              $result = mysqli_query($conn, $query);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row["CategoryName"]) . "</td>";
                  echo "<td>" . (isset($categoryCounts[$row["CategoryID"]]) ? htmlspecialchars($categoryCounts[$row["CategoryID"]]) : 0) . "</td>";
                  echo '<td><div class="Product" style="background-image: url(data:image/jpeg;base64,' . base64_encode($row["Picture"]) . ');"></div></td>';
                  echo '<td>
                            <a href="Modifie_CT.php?id=' . htmlspecialchars($row['CategoryID']) . '"><i class="fa-solid fa-pen"></i></a>
                            <a href="delete_category.php?id=' . htmlspecialchars($row['CategoryID']) . '" onclick="return confirmDelete(' . htmlspecialchars($row['CategoryID']) . ')"><i class="fa-solid fa-trash"></i></a>
                          </td>';
                  echo '</tr>';
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
        <h3>Ajouter Catogory</h3>
        <p>x</p>
      </div>
      <div class="">
        <div class="">
          <label for="">Nom</label>
          <input type="text" placeholder="Enter Name of Category" name="name" required />
        </div>
        <div class="">
          <label for="">Logo</label>
          <input type="file" placeholder="Upload The Logo" name="picture" />
        </div>
      </div>
      <div class=""> <button type="submit" name="Valider" id="Valider">Valider</button>
      </div>
    </div>
  </form>
  <!-- <div class="confirmation" style="width: 300px">
    <div class="">
      <h3>Confirmation</h3>
    </div>

    <div class="btns" style="display: flex; margin: 20px;">
      <div class="" id="Cancel">Cancel</div>
      <div class="" id="Delete">Delete</div>
    </div>
  </div> -->
</body>

<script>
  function confirmDelete(id) {
    return confirm('Are you sure you want to delete the category with ID ' + id + '?');
  }
</script>
<script src="admin.js"></script>

</html>