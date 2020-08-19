<?php

require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');

print ('<br><a href="modification.php">Back to Home</a>');
print ('<br><h2>Delete hashtags</h2>');

$h = $_POST['typeoption4'];

$query = "DELETE FROM Scandals WHERE s_id = $h;";
$call = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($call, 'i', $h);
mysqli_stmt_execute($call);
$num_row = mysqli_stmt_affected_rows($call);


$query1 = "SELECT * FROM ScandalsDeleteLog where s_id=$h;";
$result = mysqli_query($conn, $query1);
print('<table style="width:30%">');
print('<tr>
            <th>s_id </th>
            <th>Date</th>
            <th>Type</th>
            <th>Intro</th>
            <th>delete_time</th>
            </tr>');
while ($tuple = mysqli_fetch_row($result)) {
    print '<tr>';
    print '<td>'.$tuple[0].'</td>';
    print '<td>'.$tuple[1].'</td>';
    print '<td>'.$tuple[2].'</td>';
    print '<td>'.$tuple[3].'</td>';
    print '<td>'.$tuple[4].'</td>';
    print '</tr>';
}

$query2 = "SELECT * FROM Scandals WHERE s_id = $h";
$result2 = mysqli_query($conn, $query2);
if (mysqli_num_rows($result2)==0){
    print ('<br>Delete successfully<br>');
}
else{
    print ('<br>Not delete successfully<br>');
}
?>