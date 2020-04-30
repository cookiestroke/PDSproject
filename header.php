<?php
session_start();

if (isset($_SESSION['email'])) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='cust.php';
    			</SCRIPT>");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>WDS Insurance</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <style>
    a:hover {
      cursor: pointer;
    }

    form label:not(.form-check-label) {
      font-weight: bold
    }

  </style>
</head>

<body>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="index.php">
      <img src="logo.png" alt="logo" style="width:80px;">
    </a>
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" style="color:white; border-right:0.5px solid grey" data-toggle="modal" data-target="#logu"><span><i class=" fas fa-sign-in-alt"></i></span> &nbsp;Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:white; border-right:0.5px solid grey" data-toggle="modal" data-target="#singu"><span><i class="  fas fa-user-plus"></i></span> &nbsp;Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:white; border-right:0.5px solid grey" href="contact.php"><span><i class=" fas fa-phone"></i></span> &nbsp;Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" style="color:white" href="index.php"><span><i class=" fas fa-info-circle"></i></span> &nbsp;About</a>
      </li>
    </ul>
  </nav>

  <div class="modal fade" id="logu">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST">
            <div class="form-group">
              <label for="email1">Email address</label>
              <input type="email" name="email1" class="form-control" id="email1" placeholder="Enter email" required>
            </div>
            <div class="form-group">
              <label for="password1">Password</label>
              <input type="password" name="password1" id="password1" class="form-control" placeholder="Enter Password" required>
            </div>
            <div class="col-md-12 text-center ">
              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm text-white bg-dark" name="logga">Login</button>
            </div>
          </form>
        </div>

        <!-- Modal footer
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div> -->

      </div>
    </div>
  </div>

  <div class="modal fade" id="singu">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Sign Up</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter Firstname" required>
              </div>
              <div class="form-group col-md-6">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter Lastname" required>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
              </div>
              <div class="form-group col-md-6">
                <label for="czipcode">Zipcode</label>
                <input type="text" name="czipcode" class="form-control" id="czipcode" placeholder="Enter Zipcode" required>
              </div>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
            </div>

            <b>Maritial Status</b> &nbsp;&nbsp;&nbsp;&nbsp;
            <div class="form-check-inline">
              <label class="form-check-label" for="radio1">
                <input type="radio" class="form-check-input" id="radio1" name="optradio" value="Single" required>Single
              </label>
            </div>

            <div class="form-check-inline">
              <label class="form-check-label" for="radio2">
                <input type="radio" class="form-check-input" id="radio2" name="optradio" value="Married">Married
              </label>
            </div>

            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" id="radio3" name="optradio" value="Widow">Widow
              </label>
            </div>

            <br /><br />
            <b>Gender </b>&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="form-check-inline">
              <label class="form-check-label" for="radio11">
                <input type="radio" class="form-check-input" id="radio11" name="optradio1" value="M" required>Male
              </label>
            </div>

            <div class="form-check-inline">
              <label class="form-check-label" for="radio12">
                <input type="radio" class="form-check-input" id="radio12" name="optradio1" value="F">Female
              </label>
            </div>

            <br /> <br />

            <div class="col-md-12 text-center mb-3">
              <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm text-white bg-dark" name="regsub">Register</button>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>
  
  <?php

  $conn = mysqli_connect("localhost:3308", "root", "", "wds");

  if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
  }

  if (isset($_POST["logga"])) {
    $sql = "SELECT cmail, cpass FROM customer where cmail=? and cpass=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $email, $password);
      $email = $_POST['email1'];
      $password = $_POST['password1'];
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;

        echo ("<SCRIPT LANGUAGE='JavaScript'>
							window.location.href='cust.php';
    					</SCRIPT>");
      } else {
        session_destroy();

        echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Login Failed')
              window.location.href='index.php';
    					</SCRIPT>");
      }
    } else {

      session_destroy();

      echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error connecting to database')
    window.location.href='index.php';
    </SCRIPT>");
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($conn);
  }


  if (isset($_POST["regsub"])) {
    $sql = "INSERT INTO customer (cmail,cfirst,clast,czip,cpass,cmar,cgen) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "sssssss", $email, $first_name, $last_name, $zipcode, $password, $marry, $gender);

      $first_name = $_POST['firstname'];
      $last_name = $_POST['lastname'];
      $email = $_POST['email'];
      $zipcode = $_POST['czipcode'];
      $password = $_POST['password'];
      $marry = $_POST['optradio'];
      $gender = $_POST['optradio1'];

      if (mysqli_stmt_execute($stmt)) {
        $_SESSION['email'] = $email;

        echo ("<SCRIPT LANGUAGE='JavaScript'>
    					window.alert('Registration successful $first_name $last_name')
							window.location.href='cust.php';
    					</SCRIPT>");
      } else {
        session_destroy();

        echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Registration failed')
      window.location.href='index.php';
      </SCRIPT>");
      }
    } else {

      session_destroy();

      echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Error connecting to database')
    window.location.href='index.php';
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