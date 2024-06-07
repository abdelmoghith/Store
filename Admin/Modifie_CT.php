<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  include('Connecte.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Valider'])) {
  $name = $_POST['name'];
  $date = date('Y-m-d H:i:s');

  if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['picture']['tmp_name'];
    $pic = file_get_contents($fileTmpPath);

    $stmt = $conn->prepare("UPDATE categories SET CategoryName = ?, Picture = ?  , DateAdded =? WHERE CategoryID = ?");
    $stmt->bind_param("ssss", $name ,$pic, $date , $id );

    if ($stmt->execute()) {
      header("Location: Category.php");
      exit();
    } else {
      echo 'Error: ' . $stmt->error;
    }

    $stmt->close();
  }
}

// $query_2 = "SELECT * FROM categories";
// $result_2 = mysqli_query($conn, $query_2);

$query = "SELECT * FROM categories WHERE CategoryID = $id";
$result = mysqli_query($conn, $query);
if ($row = mysqli_fetch_assoc($result)) {
  $n=$row["CategoryName"];
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
            <h3>Modifie Category</h3>
        </div>

        <div class="last">
      <div class="">
        <div class="">
          <label for="name">Name</label> <br>
          <input type="text" name="name" placeholder="" required  value="<?php echo$n?> "/>
        </div> 
      </div>
      <div class="">
        <div class="">
          <label for="picture">Picture</label><br>
          <input type="file" name="picture" required />
        </div>
      </div>
      
      <div class="">     <button type="submit" name="Valider" id="Valider">Valider</button>
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
      <div class="" id="Cancel" >Cancel</div>
      <div class="" id="Delete">Delete</div>
    </div>
  </div>

  <script src="admin.js"></script>

</body>

</html>