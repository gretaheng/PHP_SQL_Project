<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="front.html">Back to Homepage</a><br>');
// Getting the input:
$tp = $_POST['typeoption4'];
$query = "SELECT c_name, wu_post_frequncy,w_content FROM
(SELECT c_account,w_content FROM Weibo
WHERE w_datetime = (SELECT MAX(w_datetime)
FROM Weibo WHERE w_type = '$tp')) c
JOIN Celebrities
USING(c_account)
JOIN Weibo_Users
ON c.c_account = Weibo_Users.wu_account;";
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
         <th>Celebrity name</th>
         <th>Post frequency</th>
         <th>Weibo</th>
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
