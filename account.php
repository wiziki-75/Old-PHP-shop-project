<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/function-pdo.php');

?>

<div id="amountcontent">
    <div id="amount">Your actual amount is <B><?= $_SESSION['amount'] ?>€</B></div>
    <div id="amount2">Add</div>
    <form action="add-amount.php" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2" name ="newamount">
            <input hidden name="oldamount" value="<?= $_SESSION['amount'] ?>">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Add</button>
        </div>
    </form>
</div>

<?php

function getOrder($user_id, $pdo){
    $sql = "SELECT product_id,date FROM orders WHERE user_id = $user_id ORDER BY date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

$res = getOrder($_SESSION['id'], $pdo);
$product_id = $res[0]['product_id'];

function getProduct($product_id, $pdo){
    $sql = "SELECT product_name,product_price FROM products WHERE id_product = $product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

$total = 0;

?>

<div id="total">Total dépensé : <B><?= $_SESSION['total'] ?>€</B></div>

<div id="titleAccount">Last orders</div>

<ul class="list-group" style="padding-top: 60px;">

    <?php
        for($i = 0; $i < count($res);$i++){
            $res2 = getProduct($res[$i]['product_id'], $pdo);
            $total += $res2[0]['product_price'];
            $_SESSION['total'] = $total;
    ?>
        <li class="list-group-item">
        <B><div><?= $res2[0]['product_name'] ?></div>
        <div><?= $res2[0]['product_price'] ?>€</div></B>
        <div><?= $res[$i]['date'] ?></div>
        </li>
        
    <?php } ?>

</ul>
