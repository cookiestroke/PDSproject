<?php require_once("adminbar.php"); ?>

<br /><br />
<p class="h3 text-dark">Insurances</p>
<?php

$conn = new mysqli("localhost:3308", "root", "", "wds");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

function changeFormat($row)
{
    if ($row['itype'] == "A") {
        $row['itype'] = "Auto Insurance";
    } else {
        $row['itype'] = "Home Insurance";
    }

    return $row;
}

if (isset($_POST["deli"])) {

    $h = $_POST["iid"];
    $sql = "DELETE from ins where hinsid=?";
    $sql2 = "DELETE from ains where hinsid=?";

    if (($stmt = mysqli_prepare($conn, $sql)) and ($stmnt1 = mysqli_prepare($conn, $sql2))) {

        mysqli_stmt_bind_param($stmt, "s", $h);
        mysqli_stmt_bind_param($stmnt1, "s", $h);

        if (mysqli_stmt_execute($stmt) and mysqli_stmt_execute($stmnt1)) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Insurance Removed')
            window.location.href='adminins.php';
            </SCRIPT>");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Process Failed')
        window.location.href='adminins.php';
        </SCRIPT>");
        }
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Process Error')
              window.location.href='adminins.php';
              </SCRIPT>");
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmnt1);
    mysqli_close($conn);
}

if (isset($_POST["delish"])) {

    $h = $_POST["iid"];
    $sql = "DELETE from ins where hinsid=?";
    $sql2 = "DELETE from hins where hinsid=?";

    if (($stmt = mysqli_prepare($conn, $sql)) and ($stmnt1 = mysqli_prepare($conn, $sql2))) {

        mysqli_stmt_bind_param($stmt, "s", $h);
        mysqli_stmt_bind_param($stmnt1, "s", $h);

        if (mysqli_stmt_execute($stmt) and mysqli_stmt_execute($stmnt1)) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Insurance Removed')
            window.location.href='adminins.php';
            </SCRIPT>");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Process Failed')
        window.location.href='adminins.php';
        </SCRIPT>");
        }
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Process Error')
              window.location.href='adminins.php';
              </SCRIPT>");
    }

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmnt1);
    mysqli_close($conn);
}

$sqll = "SELECT * FROM ins order by hinsid";
if ($stmt1 = mysqli_prepare($conn, $sqll)) {
    $stmt1->execute();
    $result = $stmt1->get_result();
    if ($result->num_rows > 0) {

        $i = 1;
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $row = changeFormat($row);

            if ($row['itype'] == "Auto Insurance") {
                echo ("
                    <div class='row m-1 bg-light' id='extra" . $i . "'>
                        <div class='col-md-1 p-1 bg-dark text-white rounded-left'>
                        <h5 class='card-title'>" . $row["hinsid"] . "</h5>
                        </div>
                        <div class='col-md-2 p-1 bg-dark text-white'>
                        <h6>Email: " . $row["cmail"] . "</h6>
                        </div>
                        <div class='col-md-2 p-1 bg-dark text-white'>
                        <h6>Start: " . $row["istart"] . "</h6>
                        </div>
                        <div class='col-md-2 p-1 bg-dark text-white'>
                        <h6>End: " . $row["iend"] . "</h6>
                        </div>
                        <div class='col-md-2 p-1 bg-dark text-white'>
                        <h6>Premium: $" . $row["iprem"] . "</h6>
                        </div>
                        <div class='col-md-2 p-1 bg-dark text-white'>
                        <h6>Type: " . $row["itype"] . "</h6>
                        </div>                      
                        <div class='col-md-1 p-1 bg-dark text-white rounded-right'>
                        <form method='POST'>
                        <input type='hidden' value='" . $row['hinsid'] . "' name='iid' />
                        <button type='submit' class=' btn btn-block mybtn btn-primary tx-tfm text-white btn-dark' name='deli'>Delete</a>
                        </form>
                        </div>              
                    </div>");
            } else {
                echo ("
                <div class='row m-1 bg-light' id='extra" . $i . "'>
                    <div class='col-md-1 p-1 bg-dark text-white rounded-left'>
                    <h5 class='card-title'>" . $row["hinsid"] . "</h5>
                    </div>
                    <div class='col-md-2 p-1 bg-dark text-white'>
                    <h6>Email: " . $row["cmail"] . "</h6>
                    </div>
                    <div class='col-md-2 p-1 bg-dark text-white'>
                    <h6>Start: " . $row["istart"] . "</h6>
                    </div>
                    <div class='col-md-2 p-1 bg-dark text-white'>
                    <h6>End: " . $row["iend"] . "</h6>
                    </div>
                    <div class='col-md-2 p-1 bg-dark text-white'>
                    <h6>Premium: $" . $row["iprem"] . "</h6>
                    </div>
                    <div class='col-md-2 p-1 bg-dark text-white'>
                    <h6>Type: " . $row["itype"] . "</h6>
                    </div>                      
                    <div class='col-md-1 p-1 bg-dark text-white rounded-right'>
                    <form method='POST'>
                    <input type='hidden' value='" . $row['hinsid'] . "' name='iid' />
                    <button type='submit' class=' btn btn-block mybtn btn-primary tx-tfm text-white btn-dark' name='delish'>Delete</a>
                    </form>
                    </div>              
                </div>");
            }
            $i++;
        }
        $result->close();
    } else {
        echo "<h1 class='m-3 p-3'>No Insurance Available</h1>";
    }
} else {
    echo "Database error $conn->error";
}
mysqli_stmt_close($stmt1);

?>

</div>
</div>
</body>

</html>