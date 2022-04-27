<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/function-pdo.php');

$id_product = $_GET['id_product'];

function getProductById($id_product, $pdo){
    $sql = "SELECT product_name,product_price,seller FROM products WHERE id_product = $id_product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    return $result;
}

$product = getProductById($id_product, $pdo);

?>

<div id="product">
    <B><div class="product"><?= $product[0]['product_name'] ?></div></B>
    <B><div class="product"><?= $product[0]['product_price'] ?>€</div></B>
    <div class="product">Sell by <B><?= $product[0]['seller'] ?></B></div>
    <div style="padding-top: 20px;"><a type="button" class="btn btn-primary" href="<?php if(isset($_SESSION['email'])){ echo 'buy.php?id_product=' . $id_product; } else { echo 'stop.php'; } ?>">Buy</a></div>
    <div style="padding-top: 20px;"><a type="button" class="btn btn-primary" href="<?php if(isset($_SESSION['email'])){ echo 'deleteProduct.php?id_product=' . $id_product; } else { echo 'stop.php'; } ?>">Delete</a></div>
</div>
