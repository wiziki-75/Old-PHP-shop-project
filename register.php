<?php
include('includes/header.php');
include('includes/function-pdo.php');
?>

<body>
  <?php

    function addUser($username, $email ,$password ,$pdo){
        $sql = "INSERT INTO users (username,email,password) VALUES (:username,:email,:password)";
        $stmt = $pdo->prepare($sql);
        $params = ['username' => $username, 'email' => $email,'password' => $password];
        $result = $stmt->execute($params);
        return $result;
    }

    function userTest($email,$pdo){
        $sql ="SELECT email FROM users WHERE email = '$email'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    if (isset($_POST['password'])) {
        $crypted_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $username = $_POST['username'];
        $email = $_POST['email'];
        $res2 = userTest($email, $pdo);
        if(count($res2) <= 0){
          $res = addUser($username, $email, $crypted_password, $pdo);
          if($res){
            header('Location: index.php');
          } else {
            echo 'Something go wrong..';
          }
        } else {
          echo 'This email is already used by another user';
        }
    }
  ?>

  <div class="container">
  <br>
    <h1>Register</h1>
    <form action="register.php" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input class="form-control" name="username" id="username" aria-describedby="emailHelp">
    </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input required type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input required type="password" name="password" class="form-control" id="password">
      </div>
      <button type="submit" class="btn btn-primary" id="btn">Confirm</button>
    </form>
  </div>


<script>
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

$('#btn').on('click', function(event){
  let mail = $('#email').val()
  console.log(mail)
  console.log(validateEmail(mail))
  if(validateEmail(mail) == false){
    event.preventDefault()
    alert("Cette email n'est pas bien formulé !")
  }
})
</script>

</body>
</html>