<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="front.html">Back to Homepage</a><br>');

// Getting the input:
$num = $_POST['finally!'];
//echo $pf;
$query = "SELECT p_name, SUM(r_times)
FROM Public
JOIN Reposts
ON Public.p_account = Reposts.p_account
GROUP BY Reposts.p_account
HAVING SUM(r_times) > $num";
if(num==''){
    print 'Please enter a valid number!';
}
elseif (num<0||num>5){
    print 'Please enter a valid number!';
}
else {
    $result = $conn->query($query)
    or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($result) == 0) {
        print 'No entry is found!';
    } else {
        print ("<h2>The result of your search is:</h2><br>");
        print('<table style="width:30%">');
        print('<tr>
             <th>User Name</th>
             <th>Repost Times</th>
           </tr>');
    }
    while ($tuple = mysqli_fetch_row($result)) {
        print '<tr>';
        print '<td>' . $tuple[0] . '</td>';
        print '<td>' . $tuple[1] . '</td>';
        print '</tr>';
    }
}
?>
