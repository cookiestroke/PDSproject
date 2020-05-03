<?php require_once("adminbar.php"); ?>

<br /><br />
<div class="row">
    <p class="h3 text-dark">Automobiles Insured</p>
    <?php
    $conn = new mysqli("localhost:3308", "root", "", "wds");

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    function changeFormat($row)
    {
        if ($row['vstat'] == "L") {
            $row['vstat'] = "Leased";
        } else if ($row['vstat'] == "F") {
            $row['vstat'] = "Financed";
        } else {
            $row['vstat'] = "Owned";
        }

        return $row;
    }
    $g = 1;
    $sql1 = "SELECT* from ains order by hinsid";
    if ($stmt = mysqli_prepare($conn, $sql1)) {
        $stmt->execute();
        echo "
            <table class='table table-striped'>
            <thead class='bg-dark text-white'>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>Insurance ID</th>
                <th scope='col'>Vehicle Identification Number</th>
                <th scope='col'>Vehicle</th>
                <th scope='col'>Status</th>
                <th scope='col'>Term</th>
              </tr>
            </thead>
            <tbody>";
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row = changeFormat($row);
                echo "
            <tr>
            <th scope='row'>" . $g . "</th>
            <td>" . $row["hinsid"] . "</th>
            <td>" . $row["vid"] . "</th>
            <td>" . $row["vmake"] . " " . $row["vmodel"] . " " . $row["vyear"] . "</td>
            <td>" . $row["vstat"] . "</th>
            <td>" . $row["vterm"] . " Months</td>

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

    // Close connection
    //mysqli_close($conn);

    ?>
</div>

</div>
</div>
</body>

</html>