<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="modification.php">Back to Homepage</a><br>');
print ('<br><h2>Update Media</h2>');
// Getting the input:
$mname = $_POST['f1'];
$col = $_POST['f2'];
$val = $_POST['f3'];

if($mname ==''){
    print 'Please enter media name!';
}
elseif($col == 'm_level'&& ($val != "national" && $val != "local" &&  $val != "worldwide")){
    print 'Please enter a valid media level!(national, local or worldwide)';
}
else{
    $query1 = "SELECT * FROM Media WHERE m_name = '$mname';";
    $result1 = $conn->query($query1)
    or die('Query failed: ' . mysqli_error($conn));
    if (mysqli_num_rows($result1)==0){
        print 'The media name is not found in the Media table. Cannot update it.
        Please try another media name.';
    }
    else{
        $query2 = "SELECT * FROM Media WHERE m_name = '$mname' AND $col = '$val';";
        $result2 = $conn->query($query2)
        or die('Query failed: ' . mysqli_error($conn));
        if (mysqli_num_rows($result2)!=0){
            die('The value you entered is the same with the old value. Please try another one');
        };

        $query3 = "UPDATE Media set $col = '$val' where m_name = '$mname';";
        $result3 = mysqli_query($conn, $query3);
        mysqli_stmt_bind_param($result3, 'sss', $col,$val,$mname);
        mysqli_stmt_execute($result3);

        $query5 = "SELECT * FROM MChangeLog where m_name='$mname' AND new_value = '$val' AND column_changed='$col';";
        $result5 = mysqli_query($conn, $query5);
        $num_row = mysqli_stmt_affected_rows($result5);
        print('<p>Congratulations! The change has been made. See the following table for update details.</p>');
        printf("%d Row(s) affected\n", mysqli_affected_rows($conn));
        print('<table style="width:30%">');
        print('<tr>
            <th>Media_name</th>
            <th>Column changed</th>
            <th>Old value</th>
            <th>New value</th>
            <th>Timestamp</th>
            </tr>');
        while ($tuple = mysqli_fetch_row($result5)) {
            print '<tr>';
            print '<td>'.$tuple[0].'</td>';
            print '<td>'.$tuple[1].'</td>';
            print '<td>'.$tuple[2].'</td>';
            print '<td>'.$tuple[3].'</td>';
            print '<td>'.$tuple[4].'</td>';
            print '</tr>';
        }
    }
}
?>

