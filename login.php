<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/function-pdo.php');

if (count($_POST) > 0) {
  if (isValid($_POST['email'], $_POST['password'], $pdo)) {
    $_SESSION['email'] = $_POST['email'];

    function getAmount($email, $pdo){
      $sql = "SELECT amount FROM users WHERE email = '$email'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    $res = getAmount($_SESSION['email'], $pdo);
    $_SESSION['amount'] = $res[0]['amount'];

    function getId($email, $pdo){
      $sql = "SELECT user_id FROM users WHERE email = '$email'";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    $res2 = getId($_SESSION['email'], $pdo);
    $_SESSION['id'] = $res2[0]['user_id'];

    header('Location: index.php');
  } else {
    echo '<script>alert("Login failed")</script>';
  }
} 


?>

<body>
    <h1>Login</h1>

    <div class="container">

      <form action="login.php" method="post">
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input required type="email" class="form-control" name="email" value="anthony.pilot75@gmail.com" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input required type="password" name="password" value="anthony" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </form><br>
      <div>Not registed ?</div>
      <a class="nav-link" href="register.php"><button type="submit" class="btn btn-primary">Register</button></a>
    </div>
  </body>