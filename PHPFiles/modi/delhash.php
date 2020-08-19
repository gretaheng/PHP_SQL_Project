<?php

require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');

print ('<br><a href="modification.php">Back to Home</a>');
print ('<br><h2>Delete hashtags</h2>');

$h = $_POST['typeoption5'];

$query0 = "SELECT * FROM hashDeleteLog WHERE h_name = '$h'";
$result0 = mysqli_query($conn, $query0);
if (mysqli_num_rows($result0)!=0){
    print ('<br>Already deleted<br>');
    print('<table style="width:30%">');
    print('<tr>
            <th>h_name </th>
            <th>h_length</th>
            <th>h_used_times</th>
            <th>delete_time</th>
            </tr>');
    while ($tuple = mysqli_fetch_row($result0)) {
        print '<tr>';
        print '<td>'.$tuple[0].'</td>';
        print '<td>'.$tuple[1].'</td>';
        print '<td>'.$tuple[2].'</td>';
        print '<td>'.$tuple[3].'</td>';
        print '</tr>';
    }
}
else{
    $query = "DELETE FROM Weibo_hashtags WHERE h_name = '$h';";
    $call = mysqli_prepare($conn,$query);
    mysqli_stmt_bind_param($call, 's', $h);
    mysqli_stmt_execute($call);
    $num_row = mysqli_stmt_affected_rows($call);


    $query1 = "SELECT * FROM hashDeleteLog WHERE h_name = '{$h}'";
    $result = mysqli_query($conn, $query1);
    print('<table style="width:30%">');
    print('<tr>
            <th>h_name </th>
            <th>h_length</th>
            <th>h_used_times</th>
            <th>delete_time</th>
            </tr>');
    while ($tuple = mysqli_fetch_row($result)) {
        print '<tr>';
        print '<td>'.$tuple[0].'</td>';
        print '<td>'.$tuple[1].'</td>';
        print '<td>'.$tuple[2].'</td>';
        print '<td>'.$tuple[3].'</td>';
        print '</tr>';
    }

    $query2 = "SELECT * FROM Weibo_hashtags WHERE h_name = '$h'";
    $result2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($result2)==0){
        print ('<br>Delete successfully<br>');
    }
    else{
        print ('<br>Not delete successfully<br>');
    }
}
?>