<?php
include('includes/header.php');
include('includes/function-pdo.php');

$id_product = $_GET['id_product'];

function foundProduct($id_product, $pdo){
    $sql = "SELECT product_price FROM products WHERE id_product = $id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    return $result;
}

$res = foundProduct($id_product, $pdo);
$price = $res[0]['product_price'];


function updateAmount($email, $price, $pdo){
    $sql = "UPDATE users SET amount = :new_amount WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $params = ['new_amount' => ($_SESSION['amount'] - $price), 'email' => $email];
    $result = $stmt->execute($params);
    $_SESSION['amount'] -= $price;
    return $result;
}

$res2 = updateAmount($email, $price, $pdo);

function addOrder($user_id, $product_id, $pdo){
    $sql = "INSERT INTO orders (user_id, product_id) VALUES (:user_id,:product_id)";
    $stmt = $pdo->prepare($sql);
    $params = ['user_id' => $user_id, 'product_id' => $product_id];
    $result = $stmt->execute($params);
    return $result;
}

$res3 = addOrder($_SESSION['id'], $id_product, $pdo);

if($res2 && $res3){
    header('Location: index.php');
} else {
    echo 'Something go wrong..';
}


?>