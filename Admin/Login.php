<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $valid_email = 'store@.net';
    $valid_password = 'pass123';

    if ($email === $valid_email && $password === $valid_password) {
        $_SESSION['user'] = $email;
        header('Location: Product.php');
        exit();
    } else {
        echo "Invalid email or password.";
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
  <link rel="shortcut icon" type="x-icon" href="icons8-user-96.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Other.css">
  <link rel="stylesheet" href="all.min.css" />
  <title>Login</title>
</head>

<body>
  <div class="container">
    <div class="right">
      <div class="top">
        <h1>Welcome</h1>
        <p>E-Commerce</p>
      </div>
      <div class="inp">
        <form action="" method="post">
          <label for="email">Email</label><br />
          <input type="text" name="email" placeholder="ENTER EMAIL" required /><br />
          <label for="password">Password</label><br />
          <div class="password-container">
            <input type="password" name="password" placeholder="ENTER PASSWORD" required />
            <div class="eye"></div>
          </div>
        </form>
      </div>

      <div class="cvr">
       <input type="submit" value="Login" name="submit" />
      </div>

      </form>
    </div>
    <div class="left"></div>

  </div>
</body>
<script src="login.js"></script>

</html>