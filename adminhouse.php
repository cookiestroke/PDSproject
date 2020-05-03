<?php require_once("adminbar.php"); ?>

<br /><br />

<div class="row">
    <p class="h3 text-dark">Houses Insured</p>
    <?php

    $conn = new mysqli("localhost:3308", "root", "", "wds");

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    function changeFormat($row)
    {
        if ($row['htype'] == "C") {
            $row['htype'] = "Condominium";
        } else if ($row['htype'] == "T") {
            $row['htype'] = "Townhouse";
        }else if ($row['htype'] == "S") {
            $row['htype'] = "Single Family";
        }else if ($row['htype'] == "M") {
            $row['htype'] = "Multi Family";
        }

        if ($row['swim'] == "M") {
            $row['swim'] = "Multiple";
        } else if ($row['swim'] == "O") {
            $row['swim'] = "Overground";
        }else if ($row['swim'] == "U") {
            $row['swim'] = "Underground";
        }else if ($row['swim'] == "I") {
            $row['swim'] = "Indoor";
        }else{
            $row['swim'] = "None";
        }

        if ($row['basement'] == "1") {
            $row['basement'] = "Yes";
        }else{
            $row['basement'] = "No";
        }

        if ($row['hsec'] == "1") {
            $row['hsec'] = "Yes";
        }else{
            $row['hsec'] = "No";
        }

        if ($row['afire'] == "1") {
            $row['afire'] = "Yes";
        }else{
            $row['afire'] = "No";
        }

        return $row;
    }

    $g = 1;
    $sql1 = "SELECT * from hins order by hinsid";
    if ($stmt = mysqli_prepare($conn, $sql1)) {
        $stmt->execute();
        echo ("
            <table class='table table-striped'>
            <thead class='bg-dark text-white'>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>Insurance ID</th>
                <th scope='col'>Home ID</th>
                <th scope='col'>Purchase Value</th>
                <th scope='col'>Purchase Date</th>
                <th scope='col'>Area</th>
                <th scope='col'>Home Type</th>
                <th scope='col'>Pools</th>
                <th scope='col'>Basement</th>
                <th scope='col'>Home Security</th>
                <th scope='col'>Auto Fire Notification</th>
                <th scope='col'>Term</th>
              </tr>
            </thead>
            <tbody>");
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $row = changeFormat($row);
                echo ("
            <tr>
            <th scope='row'>" . $g . "</th>
            <td>" . $row["hinsid"] . "</th>
            <td>" . $row["hid"] . "</th>
            <td>$" . $row["purval"] . "</th>
            <td>" . $row["purdate"] . "</th>
            <td>" . $row["harea"] . " sq ft</th>
            <td>" . $row["htype"] . "</th>
            <td>" . $row["swim"] . "</td>
            <td>" . $row["basement"] . "</th>
            <td>" . $row["hsec"] . "</th>
            <td>" . $row["afire"] . "</th>
            <td>" . $row["iterm"] . " Months</th>
            </tr>");
                $g = $g + 1;
            }
            //$result->free();
            $result->close();
        } else {
            echo "<h3>0 results $conn->error</h3>";
        }
    } else {
        echo "Database error $conn->error";
    }
    echo ("</tbody></table>");
    // Close statement
    mysqli_stmt_close($stmt);

    //mysqli_close($conn);

    ?>
</div>

</div>
</div>
</body>

</html>