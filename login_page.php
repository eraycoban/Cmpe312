<?php include "config.php" ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      
    <!-- External CSS file-->
    <link rel="stylesheet" href="css/login.css">
      
    <title>Login Page</title>
      
  </head>
  <body>
      
      <div class="wrapper">
          <form class="form-signin" method="post" action="index.php">
              <div class="text-center">
                  <img src="img/logo.png" width="100px" height="100px">
                  <h2 class="form-signin-heading h3 font-weight-normal">EMU</h2>
              </div>
              <input type="number" class="form-control" name="user_id" placeholder="ID" required="" autofocus="">
              <input type="password" class="form-control" name="password" placeholder="Password" required="">
              <input type="submit" class="btn btn-lg btn-primary btn-block" name="login_button" value="Login">
              <div class="text-center mt-3">
              <?php if(isset($_GET['error'])){ echo "<p class='text-danger mb-0'>".$_GET['error']."</p>";} ?>
              </div>
          </form>
          
          <!-- Copyright -->
          <div class="footer-copyright text-center py-3">© 2020 Copyright
          </div>
          <!-- Copyright -->
          
      </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>