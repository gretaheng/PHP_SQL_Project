<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="front.html">Back to Homepage</a><br>');
// Getting the input:
$tp = $_POST['typeoption6'];
$query = "select p_account, p_name, p_edu_level, c_attitude, count(*)
from Comments
NATURAL JOIN Public
Where c_attitude = '$tp'
GROUP BY p_account;";
//

if(tp==''){
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
         <th>User Account</th>
         <th>User Name</th>
         <th>User Education Level</th>
         <th>Comment Attitude</th>
         <th>Count</th>       
         </tr>');
    }
    while ($tuple = mysqli_fetch_row($result)) {
        print '<tr>';
        print '<td>' . $tuple[0] . '</td>';
        print '<td>' . $tuple[1] . '</td>';
        print '<td>' . $tuple[2] . '</td>';
        print '<td>' . $tuple[3] . '</td>';
        print '<td>' . $tuple[4] . '</td>';
        print '</tr>';
    }
}
?>
