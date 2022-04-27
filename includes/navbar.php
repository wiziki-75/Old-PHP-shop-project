<nav class="navbar navbar-expand-lg navbar-light bg-light navbar navbar-dark bg-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php if(isset($_SESSION['email'])){ echo 'add-product.php'; } else { echo 'stop.php'; } ?>">Add a product <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a <?php if(isset($_SESSION['email'])){ echo 'hidden'; } ?> class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a <?php if(isset($_SESSION['email'])){ echo 'hidden'; } ?> class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a <?php if(!isset($_SESSION['email'])){ echo 'hidden'; } ?> class="nav-link" href="account.php">Account</a>
      </li>
      <li class="nav-item">
        <a <?php if(!isset($_SESSION['email'])){ echo 'hidden'; } ?> class="nav-link" href="logout.php">Logout</a>
      </li>
      </ul>
      <ul class="nav justify-content-end">
        <li class="nav-item" style="color: #fff;">

          <?php
            if(isset($_SESSION['email'])){
              echo 'You are connected as <B>',  $_SESSION['email'], '</B>';
            } else {
              echo 'You are not connected';
            }
          ?>

        </li>
      </ul>
  </div>
</nav>