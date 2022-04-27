<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/function-pdo.php');

function getUsername($email, $pdo){
    $sql = "SELECT username FROM users WHERE email = '$email'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

$username = getUsername($_SESSION['email'], $pdo);

function addProduct($name, $price, $seller, $pdo){
    $sql = "INSERT INTO products (product_name,product_price,seller) VALUES (:name,:price,:seller)";
    $stmt = $pdo->prepare($sql);
    $params = ['name' => $name, 'price' => $price, 'seller' => $seller];
    $result = $stmt->execute($params);
    return $result;
}

if(isset($_POST['name'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $seller = $username[0]['username'];
    $res = addProduct($name, $price, $seller, $pdo);
    if($res){
      header('Location: index.php');
    } else {
      echo 'Something go wrong...';
    }
}

?>

<div class="container">
    <br>
        <h1>Add a product</h1>
    <form action="add-product.php" method="post">
    <div class="form-group">
      <label for="exampleInputEmail1">Product name</label>
      <input required type="text" class="form-control" name="name" id="exampleInputEmail1" value="" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Price</label>
      <input required type="text" name="price" class="form-control" id="exampleInputPassword1">
    </div>
  <button type="submit" class="btn btn-primary">Confirm</button>
</form>
</div>