<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Include database connection file
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
    // Check if all required fields are set
    if (isset($_POST['name'], $_POST['number'], $_POST['adresse'], $_POST['Qnt'])) {

      // Prepare the data to be sent to Google Apps Script
      $data = array(
        'name' => $_POST['name'],
        'number' => $_POST['number'],
        'wilayas' => isset($_POST['wilayas']) ? $_POST['wilayas'] : null,
        'adresse' => $_POST['adresse'],
        'Qnt' => isset($_POST['Qnt']) ? $_POST['Qnt'] : null,
        'id' => $id // Include product ID in the data
      );

      // Send the data to Google Apps Script using cURL
      $url = 'https://script.google.com/macros/s/AKfycbwUdXUKgOJYP9TDtuXwh1MjVVz7aEZ8B8hoOAIDYgku6c_i_6yDRl028bLx1V8Je4oi/exec';
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      $response = curl_exec($ch);
      curl_close($ch);

      // Redirect to Congratulation.php if successful
      if ($response == 'success') {
        header("Location: Congratulation.php?id=$id");
        exit();
      } else {
        echo "Failed to submit the form.";
      }
    } else {
      echo "All required fields are not set.";
    }
  }
}
?>
