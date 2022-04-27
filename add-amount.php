<?php
include('includes/function-pdo.php');
include('includes/header.php');

$old_amount = $_POST['oldamount'];
$new_amount = $_POST['newamount'];
$email = $_SESSION['email'];

function addAmount($new_amount, $old_amount, $email, $pdo){
    $sql = "UPDATE users SET amount = :new_amount WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $params = ['new_amount' => ($new_amount + $old_amount), 'email' => $email];
    $result = $stmt->execute($params);
    return $result;
}

$res = addAmount($new_amount, $old_amount, $email, $pdo);
if($res){
    $_SESSION['amount'] = $new_amount + $old_amount;
    header('Location: account.php');
} else {
    echo 'Something go wrong...';
}

?>