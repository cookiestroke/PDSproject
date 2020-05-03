<?php
session_start();

if (isset($_SESSION['admin'])) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='admin.php';
    			</SCRIPT>");
}
?>
<html>

<head>
  <?php require_once("cursed.php"); ?>
</head>

<body class="bg-dark">

  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body bg-light">
            <h5 class="card-title text-center">Admin Sign In</h5>
            <form method="POST" class="form-signin">

              <div class="form-group">
                <label for="email1">Email address</label>
                <input type="email" name="email1" class="form-control" id="email1" placeholder="Enter email" required>
              </div>

              <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" name="password1" id="password1" class="form-control" placeholder="Enter Password" required>
              </div>

              <button class="btn btn-dark btn-lg btn-primary btn-block text-uppercase" type="submit" name="log">Sign in</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php

  $conn = mysqli_connect("localhost:3308", "root", "", "wds");

  if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  if (isset($_POST["log"])) {
    $sql = "SELECT * FROM admin1 where amail=? and apass=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $email, $password);
      $email = $_POST['email1'];
      $password = md5($_POST['password1']);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        $_SESSION['admin'] = $email;

        echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='admin.php';
    					</SCRIPT>");
      } else {
        session_destroy();

        echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Login Failed')
              window.location.href='adminlog.php';
    					</SCRIPT>");
      }
    } else {

      session_destroy();

      echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error connecting to database')
    window.location.href='adminlog.php';
    </SCRIPT>");
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
  }
  ?>
</body>

</html>