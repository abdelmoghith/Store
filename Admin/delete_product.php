<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];


    include('Connecte.php');
    $id = $conn->real_escape_string($id);

    $query = "DELETE FROM products WHERE ProductID='$id'";
    $conn->query($query);


    header('Location: Product.php');
    exit();
}
