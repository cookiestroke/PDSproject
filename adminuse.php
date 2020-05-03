<?php require_once("adminbar.php"); ?>

<br /><br />

<div class="row">
    <p class="h3 text-dark">Users</p>
    <?php

    $conn = new mysqli("localhost:3308", "root", "", "wds");

    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    function changeFormat($row)
    {
        if ($row['cmar'] == "W") {
            $row['cmar'] = "Widow";
        } else if ($row['cmar'] == "M") {
            $row['cmar'] = "Married";
        } else {
            $row['cmar'] = "Single";
        }

        if ($row['cgen'] == "M") {
            $row['cgen'] = "Male";
        } else {
            $row['cgen'] = "Female";
        }

        return $row;
    }
    $g = 1;
    $sql1 = "SELECT * from customer order by cmail";
    if ($stmt = mysqli_prepare($conn, $sql1)) {
        $stmt->execute();
        echo "
            <table class='table table-striped'>
            <thead class='bg-dark text-white'>
              <tr>
                <th scope='col'>#</th>
                <th scope='col'>Email</th>
                <th scope='col'>Name</th>
                <th scope='col'>Zipcode</th>
                <th scope='col'>Marriage</th>
                <th scope='col'>Gender</th>
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
            <td>" . $row["cmail"] . "</th>
            <td>" . $row["cfirst"] . " " . $row["clast"] . "</td>
            <td>" . $row["czip"] . "</th>
            <td>" . $row["cmar"] . "</th>
            <td>" . $row["cgen"] . "</td>
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