<?php
include('includes/function-pdo.php');
include('includes/header.php');

$id_product = $_GET['id_product'];

function deleteProduct($id_product, $pdo){
    $sql = "DELETE FROM products WHERE id_product = $id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    return $result;
}

deleteProduct($id_product, $pdo);
header('Location: index.php');


?>