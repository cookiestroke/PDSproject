<?php

session_start();

if (!isset($_SESSION['email'])) {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.location.href='index.php';
    			</SCRIPT>");
}

$conn = new mysqli("localhost:3308", "root", "", "wds");

if ($conn === false) {
  die("ERROR: Could not connect. " . mysqli_connect_error());
}

$email = $_SESSION['email'];
$data = mysqli_query($conn, "SELECT sum(iprem) as Total, itype as Insurance_Type FROM ins WHERE cmail='$email' group by itype order by itype;");
$data1 = mysqli_query($conn, "SELECT iprem, hinsid FROM ins WHERE cmail='$email' order by hinsid;");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>WDS Customer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>

  <style>
    a:hover {
      cursor: pointer;
    }

    .nav-tabs .nav-link {
      color: white;

    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
      /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
      -moz-appearance: textfield;
      /* Firefox */
    }

    form label:not(.form-check-label) {
      font-weight: bold
    }

    #page-container {
      position: relative;
      min-height: 84vh;
    }

    #content-wrap {
      padding-bottom: 2.5rem;
      /* Footer height */
    }

    #footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 2.5rem;
      /* Footer height */
    }
  </style>
</head>

<body>

  <ul class="nav nav-tabs bg-dark justify-content-end sticky-top">
    <li class="nav-item">
      <img src="logo.png" alt="logo" style="width:70px;">
    </li>
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#menu2">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#home">Add Insurance</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Current Insurance</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu3">Insured Assets</a>
    </li>
    <li class="nav-item">
      <form method="POST">
        <button class="nav-link bg-dark " type="submit" name="byeo"><span><i class="fas fa-sign-out-alt"></i></span>&nbsp;&nbsp;Logout</button>
      </form>
    </li>
  </ul>

  <!-- Tab panes -->
  <div id="page-container">
    <div id="content-wrap">
      <div class="tab-content">
        <div class="tab-pane container fade" id="menu3">
          <div class="row">
            <div class="m-3 p-3 col-md-5">
              <p class="h3">Houses Insured</p>
              <?php
              $email = $_SESSION['email'];
              $g = 1;
              $sql1 = "select a.hinsid,a.istart,a.iprem,b.hid from ins a join hins b on a.hinsid=b.hinsid where a.cmail=?";
              if ($stmt = mysqli_prepare($conn, $sql1)) {

                mysqli_stmt_bind_param($stmt, "s", $email);
                $stmt->execute();
                echo ("
            <table class='table table-striped'>
            <thead class='bg-secondary text-white'>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>Insurance ID</th>
                <th scope='col'>Home ID</th>
                <th scope='col'>Insurance Start</th>
                <th scope='col'>Insurance Premium</th>
              </tr>
            </thead>
            <tbody>");
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    echo ("
            <tr>
            <th scope='row'>" . $g . "</th>
            <td>" . $row["hinsid"] . "</th>
            <td>" . $row["hid"] . "</th>
            <td>" . $row["istart"] . "</th>
            <td>" . $row["iprem"] . "</td>
            </tr>");
                    $g = $g + 1;
                  }
                  //$result->free();
                  $result->close();
                } else {
                  echo "<h1>0 results $conn->error</h1>";
                }
              } else {
                echo "Database error $conn->error";
              }
              echo ("</tbody></table>");
              // Close statement
              mysqli_stmt_close($stmt);

              // Close connection
              //mysqli_close($conn);

              ?>
            </div>

            <div class="m-3 p-3 col-md-5">
              <p class="h3">Automobiles Insured</p>
              <?php
              $email = $_SESSION['email'];
              $g = 1;
              $sql1 = "select a.hinsid,a.istart,a.iprem,b.vid from ins a join ains b on a.hinsid=b.hinsid where a.cmail=?";
              if ($stmt = mysqli_prepare($conn, $sql1)) {

                mysqli_stmt_bind_param($stmt, "s", $email);
                $stmt->execute();
                echo "
            <table class='table table-striped'>
            <thead class='bg-secondary text-white'>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>Insurance ID</th>
                <th scope='col'>Vehicle Identification Number</th>
                <th scope='col'>Insurance Start</th>
                <th scope='col'>Insurance Premium</th>
              </tr>
            </thead>
            <tbody>";
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "
            <tr>
            <th scope='row'>" . $g . "</th>
            <td>" . $row["hinsid"] . "</th>
            <td>" . $row["vid"] . "</th>
            <td>" . $row["istart"] . "</th>
            <td>" . $row["iprem"] . "</td>
            </tr>";
                    $g = $g + 1;
                  }
//                  echo "</tbody></table>";
                  //$result->free();
                  $result->close();
                } else {
                  echo "<h1>0 results $conn->error</h1>";
                }
              } else {
                echo "Database error $conn->error";
              }
              echo "</tbody></table>";
              // Close statement
              mysqli_stmt_close($stmt);

              // Close connection
              //mysqli_close($conn);

              ?>
            </div>
          </div>
        </div>
        <div class="tab-pane container fade" id="home">

          <ul class="nav nav-pills ">
            <li class="nav-item p-1 m-3 ">
              <a class="nav-link active bg-dark text-white" data-toggle="pill" href="#hins">Home Insurance</a>
            </li>
            <li class="nav-item p-1 m-3 ">
              <a class="nav-link bg-dark text-white" data-toggle="pill" href="#ains">Auto Insurance</a>
            </li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane container active " id="hins">
              <form method="POST">

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="hid">House Number</label>
                    <input type="text" name="hid" class="form-control" id="hid" placeholder="Enter House Number" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="purval">House Value</label>
                    <input type="number" name="purval" class="form-control" id="purval" min="0" step="any" placeholder="$(Enter House Value in USD)" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="harea">House Area</label>
                    <input type="number" name="harea" class="form-control" id="harea" min="0" step="any" placeholder="Enter House Area in Square Feet" required>
                  </div>
                </div>

                <b>House Type</b> &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="htype1" name="htype" value="C" required>Condominium
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="htype2" name="htype" value="T">Townhouse
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="htype3" name="htype" value="M">Multi Family
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="htype4" name="htype" value="S">Single Family
                  </label>
                </div>

                <br /><br />
                <b>Swimming Pool Type</b> &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="swim1" name="swim" value="NULL" required>None
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="swim2" name="swim" value="M">Mutiple
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="swim3" name="swim" value="O">Overground
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="swim4" name="swim" value="U">Underground
                  </label>
                </div>

                <br /> <br />

                <div class="form-check-inline">
                  <b>Basement</b>&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="basement1" name="basement" value="0" required>No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="basement2" name="basement" value="1">Yes
                    </label>
                  </div>
                </div>

                <div class="form-check-inline">
                  <b>Home Security System</b>&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="hsec1" name="hsec" value="0" required>No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="hsec2" name="hsec" value="1">Yes
                    </label>
                  </div>
                </div>

                <div class="form-check-inline">
                  <b>Auto Fire Notification</b>&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="afire1" name="afire" value="0" required>No
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="afire2" name="afire" value="1">Yes
                    </label>
                  </div>
                </div>

                <br /> <br />

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="purdate">Purchase Date</label>
                    <input type="date" name="purdate" class="form-control" id="purdate" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="hterm">Term</label>
                    <input type="number" name="hterm" class="form-control" id="hterm" min="0" placeholder="Enter Term in Months" required>
                  </div>
                </div>

                <div class="col-md-12 text-center mb-3">
                  <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm bg-dark" name="hadd">Add Insurance</button>
                </div>


              </form>
            </div>

            <div class="tab-pane container fade" id="ains">

              <form method="POST">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="vin">Vehicle Identification Number</label>
                    <input type="text" name="vin" class="form-control" id="vin" placeholder="Enter VIN" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="vmake">Vehicle Make</label>
                    <input type="text" name="vmake" class="form-control" id="vmake" placeholder="Enter Make of Automobile" required>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="vmodel">Vehicle Model</label>
                    <input type="text" name="vmodel" class="form-control" id="vmodel" placeholder="Enter Model of Automobile" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="vyear">Vehicle Year</label>
                    <input type="number" name="vyear" class="form-control" id="vyear" min="1900" max="2020" placeholder="Enter Year of Automobile" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="aterm">Term</label>
                    <input type="number" name="aterm" class="form-control" id="aterm" min="0" placeholder="Enter Term in Months" required>
                  </div>
                </div>
                <div class="form-check-inline">
                  <b>Vehicle Status</b>&nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="vstatus1" name="vstatus" value="L" required>Leased
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="vstatus2" name="vstatus" value="F">Financed
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="vstatus3" name="vstatus" value="O">Owned
                    </label>
                  </div>
                </div>
                <br /><br />
                <div class="col-md-12 text-center mb-3">
                  <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm bg-dark " name="aadd">Add Insurance</button>
                </div>

              </form>

            </div>
          </div>
        </div>
        <div class="tab-pane container fade" id="menu1">
          <div class='row'>
            <?php

            function changeFormat($row)
            {
              if ($row['itype'] == "A") {
                $row['itype'] = "Auto Insurance";
              } else {
                $row['itype'] = "Home Insurance";
              }

              return $row;
            }

            // if(isset($_POST['logg'])){
            //     echo "<script>alert('".$_POST["premi"]."<------Premium     Insurance ID--->".$_POST["hinsid"]."');</script>";
            // }

            if (isset($_POST["logg"])) {

              $h = $_POST["hinsid"];
              $prem = $_POST["premi"];
              $c = 0;
              $sql = "INSERT INTO ains (hinsid,vid,vmake,vmodel,vyear,vterm,vstat) VALUES (?, ?, ?, ?, ?, ?, ?);";
              $sql2 = "SELECT vid from ains where vid=?";
              $sql1 = "UPDATE ins SET iprem = ? where hinsid=?;";

              if (($stmt = mysqli_prepare($conn, $sql)) and ($stmnt1 = mysqli_prepare($conn, $sql2))) {

                mysqli_stmt_bind_param($stmt, "sssssss", $hinsid, $vid, $vmake, $vmodel, $vyear, $vterm, $vstat);
                mysqli_stmt_bind_param($stmnt1, "s", $vid);
                $hinsid = $h;
                $vid = $_POST['vin'];
                $vmake = $_POST['vmake'];
                $vmodel = $_POST['vmodel'];
                $vterm = $_POST['aterm'];
                $vyear = $_POST['vyear'];
                $vstat = $_POST['vstatus'];
                $stmnt1->execute();
                $result = $stmnt1->get_result();
                if ($result->num_rows <= 0) {
                  if (mysqli_stmt_execute($stmt)) {
                    $c = 1;
                  } else {
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                  window.alert('Insurance Failed')
                  window.location.href='cust.php';
                  </SCRIPT>");
                  }
                } else {
                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Automobile Already Insured')
                        window.location.href='cust.php';
                        </SCRIPT>");
                }
              } else {

                session_destroy();

                echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Error connecting to database')
              window.location.href='index.php';
              </SCRIPT>");
              }
              if ($c == 1) {
                if ($stmnt = mysqli_prepare($conn, $sql1)) {

                  mysqli_stmt_bind_param($stmnt, "ss", $iprem, $hinsid);

                  $hinsid = $h;
                  $iprem = $prem + (2050 - $vyear) * (60 / $vterm);

                  if (mysqli_stmt_execute($stmnt)) {
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.alert('Insurance Added Old Premium was $$prem, New Premium is$$iprem, numrows is $result->num_rows')
                        window.location.href='cust.php';
                        </SCRIPT>");
                  } else {
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Insurance Failed')
                window.location.href='cust.php';
                </SCRIPT>");
                  }
                } else {

                  session_destroy();

                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Error connecting to database')
                window.location.href='index.php';
                </SCRIPT>");
                }
              }

              mysqli_stmt_close($stmt);
              mysqli_stmt_close($stmnt);
              mysqli_stmt_close($stmnt1);

              mysqli_close($conn);
            }


            $email = $_SESSION['email'];
            $sql1 = "SELECT * FROM ins where cmail=? order by hinsid";
            if ($stmt = mysqli_prepare($conn, $sql1)) {

              mysqli_stmt_bind_param($stmt, "s", $email);
              $stmt->execute();
              $result = $stmt->get_result();
              if ($result->num_rows > 0) {

                $i=1;
                // output data of each row
                while ($row = $result->fetch_assoc()) {

                  $row = changeFormat($row);

                  if ($row['itype'] == "Auto Insurance") {
                    echo ("
                    <div class='card col-sd-4 m-3 p-3 bg-light'>
                      <div class='card-body bg-secondary text-white'>
                        <h5 class='card-title'>" . $row["hinsid"] . "</h5>
                      </div>
              
                      <ul class='list-group list-group-flush'>
                        <li class='list-group-item'><h6>Insurance Start</h6><p>" . $row["istart"] . "</p></li>
                        <li class='list-group-item'><h6>Insurance End</h6><p>" . $row["iend"] . "</p></li>
                        <li class='list-group-item'><h6>Insurance Premium</h6><p>$" . $row["iprem"] . "</p></li>
                        <li class='list-group-item'><h6>Insurance Type</h6><p>" . $row["itype"] . "</p></li>
                      </ul>
                      <div class='card-body'>
                        <a data-toggle='modal' data-target='#extra".$i."'>Add Automobile</a>
                      </div>
              
                      <div class='modal fade' id='extra".$i."'>
                        <div class='modal-dialog modal-lg'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h4 class='modal-title'>Add Automobile</h4>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            </div>
                            <div class='modal-body'>
                              <form method='POST'>
                                 <input type='hidden' value='" . $row['hinsid'] . "' name='hinsid' />
                                 <input type='hidden' value='" . $row['iprem'] . "' name='premi' />
                              <div class='form-row'>
                              <div class='form-group col-md-6'>
                                <label for='vin'>Vehicle Identification Number</label>
                                <input type='text' name='vin' class='form-control' id='vin' placeholder='Enter VIN' required>
                              </div>
                              <div class='form-group col-md-6'>
                                <label for='vmake'>Vehicle Make</label>
                                <input type='text' name='vmake' class='form-control' id='vmake' placeholder='Enter Make of Automobile' required>
                              </div>
                            </div>
                            <div class='form-row'>
                              <div class='form-group col-md-4'>
                                <label for='vmodel'>Vehicle Model</label>
                                <input type='text' name='vmodel' class='form-control' id='vmodel' placeholder='Enter Model of Automobile' required>
                              </div>
                              <div class='form-group col-md-4'>
                                <label for='vyear'>Vehicle Year</label>
                                <input type='number' name='vyear' class='form-control' id='vyear' min='1900' max='2020' placeholder='Enter Year of Automobile' required>
                              </div>
                              <div class='form-group col-md-4'>
                                <label for='aterm'>Term</label>
                                <input type='number' name='aterm' class='form-control' id='aterm' min='0' placeholder='Enter Term in Months' required>
                              </div>
                            </div>
                            <div class='form-check-inline'>
                              <b>Vehicle Status</b>&nbsp;&nbsp;&nbsp;&nbsp;
                              <div class='form-check-inline'>
                                <label class='form-check-label'>
                                  <input type='radio' class='form-check-input' id='vstatus1' name='vstatus' value='L' required>Leased
                                </label>
                              </div>
                              <div class='form-check-inline'>
                                <label class='form-check-label'>
                                  <input type='radio' class='form-check-input' id='vstatus2' name='vstatus' value='F'>Financed
                                </label>
                              </div>
                              <div class='form-check-inline'>
                                <label class='form-check-label'>
                                  <input type='radio' class='form-check-input' id='vstatus3' name='vstatus' value='O'>Owned
                                </label>
                              </div>
                            </div>
                            <br /><br />
              
                                  <div class='col-md-12 text-center '>
                                    <button type='submit' class=' btn btn-block mybtn btn-primary tx-tfm text-white bg-dark' name='logg'>Add Automobile</button>
                                  </div>
                                
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
              
                    </div>");
                  } else {
                    echo ("
                      <div class='card col-sd-4 m-3 p-3 bg-light'>
                          <div class='card-body bg-secondary text-white'>
                              <h5 class='card-title'>" . $row["hinsid"] . "</h5>
                          </div>
                      
                          <ul class='list-group list-group-flush'>
                              <li class='list-group-item'>
                                  <h6>Insurance Start</h6>
                                  <p>" . $row["istart"] . "</p>
                              </li>
                              <li class='list-group-item'>
                                  <h6>Insurance End</h6>
                                  <p>" . $row["iend"] . "</p>
                              </li>
                              <li class='list-group-item'>
                                  <h6>Insurance Premium</h6>
                                  <p>$" . $row["iprem"] . "</p>
                              </li>
                              <li class='list-group-item'>
                                  <h6>Insurance Type</h6>
                                  <p>" . $row["itype"] . "</p>
                              </li>
                          </ul>
                          <div class='card-body'>
                              <a data-toggle='modal' data-target='#extra1'>Add House</a>
                          </div>
                      
                          <div class='modal fade' id='extra1'>
                              <div class='modal-dialog modal-lg'>
                                  <div class='modal-content'>
                                      <div class='modal-header'>
                                          <h4 class='modal-title'>Add House</h4>
                                          <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                      </div>
                                      <div class='modal-body'>
                      
                                          <form method='POST'>
                                          
                                            <input type='hidden' value='" . $row['hinsid'] . "' name='hinsid' />
                                            <input type='hidden' value='" . $row['iprem'] . "' name='premi' />
                      
                                              <div class='form-row'>
                                                  <div class='form-group col-md-4'>
                                                      <label for='hid'>House Number</label>
                                                      <input type='text' name='hid' class='form-control' id='hid' placeholder='Enter House Number' required>
                                                  </div>
                                                  <div class='form-group col-md-4'>
                                                      <label for='purval'>House Value</label>
                                                      <input type='number' name='purval' class='form-control' id='purval' min='0' step='any' placeholder='$(Enter House Value in USD)' required>
                                                  </div>
                                                  <div class='form-group col-md-4'>
                                                      <label for='harea'>House Area</label>
                                                      <input type='number' name='harea' class='form-control' id='harea' min='0' step='any' placeholder='Enter House Area in Square Feet' required>
                                                  </div>
                                              </div>
                      
                                              <b>House Type</b> &nbsp;&nbsp;&nbsp;&nbsp;
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='htype1' name='htype' value='C' required>Condominium
                                                  </label>
                                              </div>
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='htype2' name='htype' value='T'>Townhouse
                                                  </label>
                                              </div>
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='htype3' name='htype' value='M'>Multi Family
                                                  </label>
                                              </div>
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='htype4' name='htype' value='S'>Single Family
                                                  </label>
                                              </div>
                      
                                              <br /><br />
                                              <b>Swimming Pool Type</b> &nbsp;&nbsp;&nbsp;&nbsp;
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='swim1' name='swim' value='NULL' required>None
                                                  </label>
                                              </div>
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='swim2' name='swim' value='M'>Mutiple
                                                  </label>
                                              </div>
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='swim3' name='swim' value='O'>Overground
                                                  </label>
                                              </div>
                                              <div class='form-check-inline'>
                                                  <label class='form-check-label'>
                                                      <input type='radio' class='form-check-input' id='swim4' name='swim' value='U'>Underground
                                                  </label>
                                              </div>
                      
                                              <br /> <br />
                      
                                              <div class='form-check-inline'>
                                                  <b>Basement</b>&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <div class='form-check-inline'>
                                                      <label class='form-check-label'>
                                                          <input type='radio' class='form-check-input' id='basement1' name='basement' value='0' required>No
                                                      </label>
                                                  </div>
                                                  <div class='form-check-inline'>
                                                      <label class='form-check-label'>
                                                          <input type='radio' class='form-check-input' id='basement2' name='basement' value='1'>Yes
                                                      </label>
                                                  </div>
                                              </div>
                      
                                              <div class='form-check-inline'>
                                                  <b>Home Security System</b>&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <div class='form-check-inline'>
                                                      <label class='form-check-label'>
                                                          <input type='radio' class='form-check-input' id='hsec1' name='hsec' value='0' required>No
                                                      </label>
                                                  </div>
                                                  <div class='form-check-inline'>
                                                      <label class='form-check-label'>
                                                          <input type='radio' class='form-check-input' id='hsec2' name='hsec' value='1'>Yes
                                                      </label>
                                                  </div>
                                              </div>
                      
                                              <div class='form-check-inline'>
                                                  <b>Auto Fire Notification</b>&nbsp;&nbsp;&nbsp;&nbsp;
                                                  <div class='form-check-inline'>
                                                      <label class='form-check-label'>
                                                          <input type='radio' class='form-check-input' id='afire1' name='afire' value='0' required>No
                                                      </label>
                                                  </div>
                                                  <div class='form-check-inline'>
                                                      <label class='form-check-label'>
                                                          <input type='radio' class='form-check-input' id='afire2' name='afire' value='1'>Yes
                                                      </label>
                                                  </div>
                                              </div>
                      
                                              <br /> <br />
                      
                                              <div class='form-row'>
                                                  <div class='form-group col-md-6'>
                                                      <label for='purdate'>Purchase Date</label>
                                                      <input type='date' name='purdate' class='form-control' id='purdate' required>
                                                  </div>
                                                  <div class='form-group col-md-6'>
                                                      <label for='hterm'>Term</label>
                                                      <input type='number' name='hterm' class='form-control' id='hterm' min='0' placeholder='Enter Term in Months' required>
                                                  </div>
                                              </div>
                      
                                              <div class='col-md-12 text-center mb-3'>
                                                  <button type='submit' class=' btn btn-block mybtn btn-primary tx-tfm bg-dark' name='hadda'>Add House</button>
                                              </div>
                      
                      
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      
                      </div>");
                  }
                  $i++;
                }
                $result->close();
              } else {
                echo "<h1 class='m-3 p-3'>No Insurance Available $conn->error</h1>";
              }
            } else {
              echo "Database error $conn->error";
            }
            mysqli_stmt_close($stmt);

            ?>
          </div>

        </div>
        <div class="tab-pane container active" id="menu2">


          <br /><br />

          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="card">

                  <div class="card-body">
                    <div class="card-title mb-4">
                      <div class="d-flex justify-content-start">
                        <div class="userData ml-3">
                          <?php
                          $email = $_SESSION['email'];
                          $sql1 = "SELECT * FROM customer where cmail=?";
                          if ($stmt = mysqli_prepare($conn, $sql1)) {

                            mysqli_stmt_bind_param($stmt, "s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                echo ("<h2 class='d-block' style='font-size: 1.5rem; font-weight: bold'>" . $row["cfirst"] . " " . $row["clast"] . "</h2>");
                              }
                              $result->close();
                            } else {
                              echo "0 results $conn->error";
                            }
                          } else {
                            echo "Database error $conn->error";
                          }
                          mysqli_stmt_close($stmt);
                          ?>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12">
                        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active bg-dark text-white" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link bg-dark text-white" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Expenditures</a>
                          </li>
                        </ul>
                        <div class="tab-content ml-1" id="myTabContent">
                          <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">


                            <?php

                            function changeFormat1($row)
                            {

                              if ($row['cgen'] == "F") {
                                $row['cgen'] = "Female";
                              } else {
                                $row['cgen'] = "Male";
                              }

                              return $row;
                            }

                            function changeFormat2($row)
                            {

                              if ($row['cmar'] == "S") {
                                $row['cmar'] = "Single";
                              } else if ($row['cmar'] == "M") {
                                $row['cmar'] = "Married";
                              } else {
                                $row['cmar'] = "Widow";
                              }

                              return $row;
                            }

                            $email = $_SESSION['email'];
                            $sql1 = "SELECT * FROM customer where cmail=?";
                            if ($stmt = mysqli_prepare($conn, $sql1)) {

                              mysqli_stmt_bind_param($stmt, "s", $email);
                              $stmt->execute();
                              $result = $stmt->get_result();
                              if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                  $row = changeFormat1($row);
                                  $row = changeFormat2($row);
                                  echo ("<div class='row'>
                              <div class='col-sm-3 col-md-2 col-5'>
                                <label style='font-weight:bold;'>Full Name</label>
                              </div>
                              <div class='col-md-8 col-6'>" . $row["cfirst"] . " " . $row["clast"] .
                                    "</div>
                            </div>
                            <hr />
    
                            <div class='row'>
                              <div class='col-sm-3 col-md-2 col-5'>
                                <label style='font-weight:bold;'>Email</label>
                              </div>
                              <div class='col-md-8 col-6'>" . $email . "
                              
                              </div>
                            </div>
                            <hr />

                            <div class='row'>
                              <div class='col-sm-3 col-md-2 col-5'>
                                <label style='font-weight:bold;'>Gender</label>
                              </div>
                              <div class='col-md-8 col-6'>" .
                                    $row["cgen"] . "
                              </div>
                            </div>
                            <hr />
                            <div class='row'>
                              <div class='col-sm-3 col-md-2 col-5'>
                                <label style='font-weight:bold;'>Marriage Status</label>
                              </div>
                              <div class='col-md-8 col-6'>" .
                                    $row["cmar"] . "
                              </div>
                            </div>
                            <hr />
                            <div class='row'>
                              <div class='col-sm-3 col-md-2 col-5'>
                                <label style='font-weight:bold;'>Zipcode</label>
                              </div>
                              <div class='col-md-8 col-6'>" .
                                    $row["czip"] . "
                              </div>
                            </div>
                            <hr />");
                                }
                                $result->close();
                              } else {
                                echo "0 results $conn->error";
                              }
                            } else {
                              echo "Database error $conn->error";
                            }
                            mysqli_stmt_close($stmt);
                            ?>

                          </div>
                          <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                            <div class="row">
                              <div id="myChart" class="chart--container col-md-5 column"></div>
                              <div id="myChart1" class="chart--container col-md-5 column"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer id="footer">

      <div class="footer-copyright text-center py-3 bg-light">
        <img src="logo.png" alt="logo" style="width:80px;">
        <p>© 2020 Copyright: WDSSolutions.com partnered with Mandar Mhaske
        </p>
      </div>

    </footer>
  </div>

  <?php

  if (isset($_POST["byeo"])) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.location.href='index.php';
      </SCRIPT>");
    session_unset();
    session_destroy();
  }

  if (isset($_POST["aadd"])) {
    $sql = "INSERT INTO ains (vid,vmake,vmodel,vyear,vterm,vstat) VALUES (?, ?, ?, ?, ?, ?)";
    $sql1 = "SELECT vid from ains where vid=?";
    $sql2 = "INSERT INTO ins (hinsid,cmail,istart,iend,iprem,itype,istatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $sql3 = "SELECT hinsid from ains where vid=?";

    if (($stmt = mysqli_prepare($conn, $sql)) and ($stmnt = mysqli_prepare($conn, $sql1))) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ssssss", $vid, $vmake, $vmodel, $vyear, $vterm, $vstat);
      mysqli_stmt_bind_param($stmnt, "s", $vid);

      $vid = $_POST['vin'];
      $vmake = $_POST['vmake'];
      $vmodel = $_POST['vmodel'];
      $vterm = $_POST['aterm'];
      $vyear = $_POST['vyear'];
      $vstat = $_POST['vstatus'];

      $stmnt->execute();
      $result = $stmnt->get_result();
      if ($result->num_rows <= 0) {
        if (mysqli_stmt_execute($stmt)) {
          //
        } else {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Insurance Failed')
        window.location.href='cust.php';
        </SCRIPT>");
        }
      } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Automobile Already Insured')
                window.location.href='cust.php';
                </SCRIPT>");
      }
    } else {

      session_destroy();

      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error connecting to database')
      window.location.href='index.php';
      </SCRIPT>");
    }

    if (($stmt1 = mysqli_prepare($conn, $sql2)) and ($stmnt1 = mysqli_prepare($conn, $sql3))) {

      mysqli_stmt_bind_param($stmt1, "sssssss", $hinsid, $cmail, $istart, $iend, $iprem, $itype, $istatus);
      mysqli_stmt_bind_param($stmnt1, "s", $vid);

      $stmnt1->execute();
      $result = $stmnt1->get_result();
      $res = $result->fetch_assoc();
      $hinsid = $res['hinsid'];
      $cmail = $_SESSION['email'];
      $d = strtotime("today");
      $istart = date("Y-m-d", $d);
      $iend = date("Y-m-d", strtotime("+$vterm months", $d));
      $iprem = (2050 - $vyear) * (60 / $vterm);
      $itype = 'A';
      $istatus = 'P';

      if (mysqli_stmt_execute($stmt1)) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Insurance Added Premium is $$iprem')
              window.location.href='cust.php';
              </SCRIPT>");
      } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Insurance Failed')
      window.location.href='cust.php';
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
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmnt);
    mysqli_stmt_close($stmnt1);

    // Close connection
    mysqli_close($conn);
  }

  if (isset($_POST["hadd"])) {
    $sql = "INSERT INTO hins (hid,purval,harea,htype,swim,basement,hsec,afire,purdate,iterm) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $sql1 = "SELECT hid from hins where hid=?";
    $sql2 = "INSERT INTO ins (hinsid,cmail,istart,iend,iprem,itype,istatus) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $sql3 = "SELECT hinsid from hins where hid=?";

    if (($stmt = mysqli_prepare($conn, $sql)) and ($stmnt = mysqli_prepare($conn, $sql1))) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ssssssssss", $hid, $purval, $harea, $htype, $swim, $basement, $hsec, $afire, $purdate, $hterm);
      mysqli_stmt_bind_param($stmnt, "s", $hid);

      $hid = $_POST['hid'];
      $purval = $_POST['purval'];
      $harea = $_POST['harea'];
      $htype = $_POST['htype'];
      $swim = $_POST['swim'];
      $basement = $_POST['basement'];
      $hsec = $_POST['hsec'];
      $afire = $_POST['afire'];
      $purdate = $_POST['purdate'];
      $hterm = $_POST['hterm'];

      $stmnt->execute();
      $result = $stmnt->get_result();
      if ($result->num_rows <= 0) {
        if (mysqli_stmt_execute($stmt)) {
          //
        } else {
          echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Insurance Failed')
        window.location.href='cust.php';
        </SCRIPT>");
        }
      } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('House Already Insured')
                window.location.href='cust.php';
                </SCRIPT>");
      }
    } else {

      session_destroy();

      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Error connecting to database')
      window.location.href='index.php';
      </SCRIPT>");
    }

    if (($stmt1 = mysqli_prepare($conn, $sql2)) and ($stmnt1 = mysqli_prepare($conn, $sql3))) {

      mysqli_stmt_bind_param($stmt1, "sssssss", $hinsid, $cmail, $istart, $iend, $iprem, $itype, $istatus);
      mysqli_stmt_bind_param($stmnt1, "s", $hid);

      $stmnt1->execute();
      $result = $stmnt1->get_result();
      $res = $result->fetch_assoc();
      $hinsid = $res['hinsid'];
      $cmail = $_SESSION['email'];
      $d = strtotime("today");
      $istart = date("Y-m-d", $d);
      $iend = date("Y-m-d", strtotime("+$hterm months", $d));
      $baser = $purval / $harea;
      if ($swim = 'O') {
        $pool = 1;
      } else if ($swim = 'U') {
        $pool = 2;
      } else if ($swim = 'M') {
        $pool = 3;
      } else {
        $pool = 0;
      }
      $iprem = $baser * (1 + ($pool + $basement + $hsec + $afire) / 10) * (60 / $hterm);
      $itype = 'H';
      $istatus = 'P';

      if (mysqli_stmt_execute($stmt1)) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Insurance Added Premium is $$iprem')
              window.location.href='cust.php';
              </SCRIPT>");
      } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Insurance Failed')
      window.location.href='cust.php';
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
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmnt);
    mysqli_stmt_close($stmnt1);

    // Close connection
    mysqli_close($conn);
  }

  ?>

  <script>
    var myData = [<?php
                  while ($info = mysqli_fetch_array($data))
                    echo $info['Total'] . ',';
                  ?>];
    var myData1 = [<?php
                    while ($info = mysqli_fetch_array($data1))
                      echo $info['iprem'] . ',';
                    ?>];
    <?php
    $data1 = mysqli_query($conn, "SELECT iprem, hinsid FROM ins WHERE cmail='$email' order by hinsid;");
    ?>
    var myLabels1 = [<?php
                      while ($info = mysqli_fetch_array($data1))
                        echo '"' . $info['hinsid'] . '",';
                      ?>];

    window.onload = function() {
      zingchart.render({
        id: "myChart",
        width: "100%",
        height: 300,
        data: {
          type: 'bar',
          title: {
            text: "Expenditure per Type"
          },
          'scale-x': {
            label: {
              text: 'Insurance Type'
            },
            labels: ['Auto Insurance', 'Home Insurance']
          },
          'scale-y': {
            label: {
              text: 'USD'
            },
          },
          plotarea: {
            marginLeft: 100,
            marginRight: 100
          },
          series: [{
            values: myData
          }]
        }
      });

      zingchart.render({
        id: "myChart1",
        width: "100%",
        height: 300,
        data: {
          type: 'scatter',
          title: {
            text: "Expenditure per Insurance"
          },
          'scale-x': {
            label: {
              text: 'Insurance ID'
            },
            labels: myLabels1
          },
          'scale-y': {
            label: {
              text: 'USD'
            },
          },
          plotarea: {
            marginLeft: 100,
            marginRight: 100
          },
          series: [{
            values: myData1
          }]
        }
      });
    };
  </script>

</body>

</html>