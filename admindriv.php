<?php require_once("adminbar.php"); ?>

<br /><br />
<form method="POST">
    <div class="row">
        <div class="form-group col">
            <label for="dfname">First Name</label>
            <input type="text" class="form-control" name="dfname" id="dfname" placeholder="Enter First Name" required>
        </div>
        <div class="form-group col"><label for="dlname">Last Name</label>
            <input type="text" class="form-control" name="dlname" id="dlname" placeholder="Enter Last Name" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="dlicen">License</label>
            <input type="text" minlength="10" maxlength="10" class="form-control" name="dlicen" id="dlicen" placeholder="Enter License" required>
        </div>
        <div class="form-group col"><label for="dbdate">Date of Birth</label>
            <input type="date" class="form-control" name="dbdate" id="dbdate" required>
        </div>
    </div>
    <button type="submit" name="drivadd" class="btn btn-dark">Add Driver</button>
</form>
<br />
<p class="h3 text-dark">Drivers</p>
<?php
$conn = new mysqli("localhost:3308", "root", "", "wds");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$g = 1;
$sql1 = "SELECT * from driver order by dlicen";
if ($stmt = mysqli_prepare($conn, $sql1)) {
    $stmt->execute();
    echo "
            <table class='table table-striped'>
            <thead class='bg-dark text-white'>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>License</th>
                <th scope='col'>Name</th>
                <th scope='col'>DOB</th>
              </tr>
            </thead>
            <tbody>";
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
            <th scope='row'>" . $g . "</th>
            <td>" . $row["dlicen"] . "</th>
            <td>" . $row["dfname"] . " " . $row["dlname"] . "</td>
            <td>" . $row["dbdate"] . "</th>
            </tr>";
            $g = $g + 1;
        }
        $result->close();
    } else {
        echo "<h3>0 results $conn->error</h3>";
    }
} else {
    echo "Database error $conn->error";
}
echo "</tbody></table>";
// Close statement
mysqli_stmt_close($stmt);

if (isset($_POST['drivadd'])) {

    $sql = "INSERT into driver values(?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        $stmt->bind_param("ssss", $dlicen, $dfname, $dlname, $dbdate);
        $dlicen = $_POST['dlicen'];
        $dfname = $_POST['dfname'];
        $dlname = $_POST['dlname'];
        $dbdate = $_POST['dbdate'];
        if (mysqli_stmt_execute($stmt)) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Driver Added')
            window.location.href='admindriv.php';
            </SCRIPT>");
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
              window.alert('Process Failed')
              window.location.href='admindriv.php';
              </SCRIPT>");
        }
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                      window.alert('Database Error')
                      window.location.href='admindriv.php';
                      </SCRIPT>");
    }
    mysqli_stmt_close($stmt);
    $conn->close();
}
?>


</div>
</div>
</body>

</html>