<?php

require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');

print ('<br><a href="modification.php">Back to Home</a>');
print ('<br><h2>Delete celebrity</h2>');

$h = $_POST['typeoption3'];

$query = "DELETE FROM Celebrities WHERE c_occupation = '$h';";
$call = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($call, 's', $h);
mysqli_stmt_execute($call);
printf("%d Row(s) affected\n", mysqli_affected_rows($conn));

$query1 = "SELECT * FROM CeleDelLog where c_occupation='$h';";
$result = mysqli_query($conn, $query1);
print('<table style="width:30%">');
print('<tr>
            <th>Account</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Occupation</th>
            <th>Insert_time</th>
            </tr>');
while ($tuple = mysqli_fetch_row($result)) {
    print '<tr>';
    print '<td>'.$tuple[0].'</td>';
    print '<td>'.$tuple[1].'</td>';
    print '<td>'.$tuple[2].'</td>';
    print '<td>'.$tuple[3].'</td>';
    print '<td>'.$tuple[4].'</td>';
    print '<td>'.$tuple[5].'</td>';
    print '</tr>';
}
?>