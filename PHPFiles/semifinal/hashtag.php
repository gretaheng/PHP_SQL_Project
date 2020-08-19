<?php
// Connection parameters
require('db.php');

print ('<br><a href="front.html">Back to Homepage</a><br>');
// Getting the input:
$tp = $_POST['typeoption5'];
$query = "SELECT * FROM Weibo_hashtags WHERE h_name = '$tp';";
//
$result = $conn->query($query)
or die('Query failed: ' . mysqli_error($conn));

if (mysqli_num_rows($result)==0){
    print 'No entry is found!';
}
else {
    print ("<h2>The result of your search is:</h2><br>");
    print('<table style="width:30%">');
    print('<tr>
         <th>Hashtag</th>
         <th>Length</th>
         <th>Used times</th>
         </tr>');
}
while ($tuple = mysqli_fetch_row($result)) {
    print '<tr>';
    print '<td>'.$tuple[0].'</td>';
    print '<td>'.$tuple[1].'</td>';
    print '<td>'.$tuple[2].'</td>';
    print '</tr>';
}
?>
