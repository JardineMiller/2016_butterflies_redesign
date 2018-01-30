<?php

include("includes/header.php");
include("includes/connection.php");

// Queries the SQL database
$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);

?>

 

 <html>
  <body>

    <div class="container">
    
    <h1>Butterflies </h1>

    <?php

        // Checks that there are rows being returned
        if (mysqli_num_rows($result) > 0) {

            // Outputs data
            echo "<table class='table table-bordered' style='margin-top: 75px;'><tr><th>ID</th><th>Name</th><th>Email</th><th>Added</th>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>". $row["id"]. "</td><td> ". $row["name"]. "</td><td> ". $row["email"]. "</td><td>". $row["added"]. "</td></tr>";
            }

            echo "</table>";

        } else {
            echo "No results found";
        }

        // Close connection
        mysqli_close($connection);

    ?>

    </div>

    </body>
</html>