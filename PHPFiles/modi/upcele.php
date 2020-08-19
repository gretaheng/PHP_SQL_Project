<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="modification.php">Back to Homepage</a><br>');
print ('<br><h2>Update Celebrity</h2>');
// Getting the input:
$ac = $_POST['p1'];
$col = $_POST['p2'];
$val = $_POST['p3'];
$test = preg_replace("/[^0-9]/", "", $val);

if($ac ==''){
    print 'Please enter a valid celebrity account number!';
}
elseif (substr( $ac, 0, 2 ) === "c"){
    print 'Please enter a valid celebrity account number, start with c !';
}
elseif($col == 'c_age' && $test != $val){
    print 'Please enter a valid age!(a non-negative integer)';
}
elseif($col == 'c_gender'&& ($val != "Male" && $val != "Female")){
    print 'Please enter a valid gender!(Male or Female)';
}
else{
    $query1 = "SELECT * FROM Celebrities WHERE c_account = '$ac';";
    $result1 = $conn->query($query1)
    or die('Query failed: ' . mysqli_error($conn));
    if (mysqli_num_rows($result1)==0){
        print 'The celebrity account is not found in the Celebrities table. Cannot update it.
        Please try another account number.';
    }
    else{
        $query2 = "SELECT * FROM Celebrities WHERE c_account = '$ac'AND $col = '$val';";
        $result2 = $conn->query($query2)
        or die('Query failed: ' . mysqli_error($conn));
        if (mysqli_num_rows($result2)!=0){
            die('The value you entered is the same with the old value. Please try another one');
        };

        $query3 = "UPDATE Celebrities set $col = '$val' where c_account = '$ac';";
        $result3 = mysqli_query($conn, $query3);
        mysqli_stmt_bind_param($result3, 'sss', $col,$val,$ac);
        mysqli_stmt_execute($result3);

        $query5 = "SELECT * FROM CeleChangeLog where c_account='$ac' AND new_value = '$val' AND column_changed='$col';";
        $result5 = mysqli_query($conn, $query5);
        $num_row = mysqli_stmt_affected_rows($result5);
        print('<p>Congratulations! The change has been made. See the following table for update details.</p>');
        printf("%d Row(s) affected\n", mysqli_affected_rows($conn));
        print('<table style="width:30%">');
        print('<tr>
            <th>Celebrity_account</th>
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

