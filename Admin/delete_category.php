<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    include('Connecte.php');

    // Enable MySQLi exceptions
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        // Escape the ID to prevent SQL injection
        $id = $conn->real_escape_string($id);

        // Prepare the DELETE query
        $query = "DELETE FROM categories WHERE CategoryID='$id'";

        // Execute the query
        $conn->query($query);

        header('Location: Category.php');
        exit();
        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            echo "<script>alert(' لا تستطيع حذف نوع منتج لانه يحتوي علي منتجات');</script>";
            echo "<script>window.history.back();</script>";

            }
}
