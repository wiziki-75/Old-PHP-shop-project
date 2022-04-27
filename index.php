<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/function-pdo.php');

function getProducts($pdo){
    $sql = "SELECT product_name,product_price,seller,id_product FROM products";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    return $result;
}

$products = getProducts($pdo);

?>

<B><div id="title">eShop</div></B>

<ul class="list-group" style="padding-top: 60px;">

    <?php
        for($i = 0; $i < count($products);$i++){
    ?>
        <li class="list-group-item">
            <a href="detail.php?id_product=<?= $products[$i]['id_product'] ?>"><?= $products[$i]['product_name'] ?></a>
            <div class="price"><?= $products[$i]['product_price'] ?>€</div>
            <div>By <?= $products[$i]['seller'] ?></div>
        </li>
        
    <?php } ?>

</ul>