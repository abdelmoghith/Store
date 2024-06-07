<?php

session_start();
// Check if confirmation is completed, if so, redirect to home
if (isset($_SESSION['confirmation_completed']) && $_SESSION['confirmation_completed'] === true) {
    header("Location: store.php");
    exit;
} else {

    if (isset($_GET['id'])) {

        $id = $_GET['id'];
        $OrderID = $_GET['OrderID'];
        $name = $_GET['name'];
        $phone = $_GET['phone'];
        $wilayas = $_GET['wilayas'];
        $Qnt = $_GET['Qnt'];
        $adresse = $_GET['adresse'];
        $price = $_GET['price'];
        // $date = $_GET['price'];

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


        // if (isset($_POST['valider'])) {


        //     if (isset($_POST['name'], $_POST['number'], $_POST['adresse'], $_POST['Qnt'])) {



        //         $Fullname = $_POST['name'];
        //         $number = $_POST['number'];
        //         $wilayas = isset($_POST['wilayas']) ? $_POST['wilayas'] : null;
        //         $adresse = $_POST['adresse'];
        //         $Qnt = isset($_POST['Qnt']) ? $_POST['Qnt'] : null;
        //         $date = date('Y-m-d H:i:s');



        //         $stmt = $conn->prepare("INSERT INTO customers (FullName, Phone, wilaya, Address, DateRegistered) VALUES (?, ?, ?, ?, ?)");
        //         $stmt->bind_param("sssss", $Fullname, $number, $wilayas, $adresse, $date);
        //         $stmt->execute();

        //         $CustomerID = $stmt->insert_id;
        //         $stmt->close();

        //         // Calculate TotalAmount
        //         $TotalAmount = $p * $Qnt;

        //         // Insert order information
        //         $stmt = $conn->prepare("INSERT INTO orders (CustomerID, OrderDate, Status, TotalAmount) VALUES (?, ?, ?, ?)");
        //         $status = '0'; // Assign the value outside of bind_param
        //         $stmt->bind_param("isid", $CustomerID, $date, $status, $TotalAmount); // Use i for integer type, s for string, d for double
        //         $stmt->execute();

        //         $OrderID = $stmt->insert_id;
        //         $stmt->close();

        //         $stmt = $conn->prepare("INSERT INTO orderdetails (OrderID, ProductID, Quantity, Price) VALUES (?, ?, ?, ?)");
        //         $stmt->bind_param("iidd", $OrderID, $id, $Qnt, $p); // Use i for integer type, d for double
        //         $stmt->execute();

        //         exit();
        //     } else {
        //         echo "All required fields are not set.";
        //     }
        //     header("Location: Congratulation.php?id=$id&OrderID=$OrderID");
        // }
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
        </div>



        <div class="pic_product">
            <h2>ملخص الطلبية</h2>
            <br>
            <div class="details">
                <p><?php echo $n ?></p>
                <p>x <?php echo $Qnt ?> : المنتج</p>
                <p>Totale : <?php echo $Qnt * $price ?> د.ج</p>
            </div>
        </div>
    </div>
    <form id="myForm" action="https://script.google.com/macros/s/AKfycbwUdXUKgOJYP9TDtuXwh1MjVVz7aEZ8B8hoOAIDYgku6c_i_6yDRl028bLx1V8Je4oi/exec" method="post" onsubmit="handleSubmit(event)">

        <input type="hidden" name="Code" id="Code" value="<?php echo $OrderID; ?>" />
        <input type="hidden" name="product" id="product" value="<?php echo $n; ?>" />
        <input type="hidden" name="name" id="name" value="<?php echo $name; ?>" />
        <input type="hidden" name="number" id="number" value="<?php echo $phone; ?>" />
        <input type="hidden" name="wilayas" id="wilayas" value="<?php echo $wilayas; ?>" />
        <input type="hidden" name="adresse" id="adresse" value="<?php echo $adresse; ?>" />
        <input type="hidden" name="Date" id="Date" value="<?php echo $date; ?>" />
        <input type="hidden" name="Qnt" id="Qnt" value="<?php echo $Qnt; ?>" />
        <input type="hidden" name="prix" id="prix" value="<?php echo $price; ?>" />
        <input type="hidden" name="total" id="total" value="<?php echo $price * $Qnt; ?>" />


        <div class="valider">
            <button type="submit" id="valider" name="valider">تاكيد</button>
        </div>
    </form>
    </a>
</body>


<!-- <script>
  function handleSubmit(event) {
    event.preventDefault(); // Prevent the default form submission

    // Redirect to the desired link
    window.location.href = 'your_custom_link.php'; // Replace 'your_custom_link.php' with your desired link
  }
</script> -->

<script>
    function handleSubmit(event) {
        event.preventDefault();
        var form = document.getElementById('myForm');
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                window.location.href = 'Congratulation.php'; // Redirect after successful submission
            }
        };
        xhr.send(formData); // Send the form data after setting up the request
        // Disable the form submission button to prevent multiple submissions
        document.getElementById('valider').disabled = true;
        document.getElementById('valider').style.opacity = '0.2';
    }
</script>



<script src="page.js"></script>

</html>