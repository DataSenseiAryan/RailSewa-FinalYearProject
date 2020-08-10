    <?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $database = "twitter";

    $conn = new mysqli($servername, $username, $password,$database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    						$sql = "select * from tweets where prediction=1 order by id desc;";
    						$result = $conn->query($sql);
                            $i=1;
                            if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td style='color:black' width='180%'>";
                                echo $row["tweet"];
                                echo "</td><td width='20%'><button type='button' class='btn btn-info add'><b>Reply</b></button></td>";
                                echo "<td class='value'><input type='hidden' id='tweet_value' class='myval' name='tweet_value' value=".$row["tweet_id"]."></td></tr>";
                                $i++;
                                }



    							} ?>

