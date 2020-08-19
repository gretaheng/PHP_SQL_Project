<!DOCTYPE html>
<html>
    <head>
        <title>CrazyWeiboUsers</title>
        <link rel="import" href="../index.html">
    </head>
    <body>
    <h1>Crazy Weibo Users</h1>
    <br><a href="front.html">Back to Homepage</a><br>
    <table>
        <tr>
            <th>Users' name</th>
            <th>Reposted times</th>
        </tr>
        <?php
            require('db.php');
            $tp = $_POST['type'];
            $query = "
                    SELECT p_name, r_times
                    FROM Reposts
                    NATURAL JOIN
                        (SELECT p_name, p_account 
                        FROM Public
                        LEFT OUTER JOIN
                        Weibo_Users
                        ON Public.p_account = Weibo_Users.wu_account
                        WHERE Weibo_Users.wu_score >= (SELECT AVG(wu_score)
                                                        FROM Weibo_Users)) A
                    ORDER BY r_times DESC;";



            // === checks for equality and same type
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['p_name']."</td>";
                    echo "<td>".$row['r_times']."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No Results</td></tr>";
            }
            $conn->close();
        ?>
    </table>
    </body>
</html>

