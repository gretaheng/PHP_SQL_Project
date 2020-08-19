<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="modification.php">Back to Homepage</a><br>');
print ('<br><h2>Add Follows Relation</h2>');
// Getting the input:
$c1 = $_POST['l1'];
$c2 = $_POST['l2'];

if($c2==''){
    print 'Please enter a valid celebrity account number!';
}
elseif (substr( $c2, 0, 2 ) === "c"){
    print 'Please enter a valid celebrity account number, start with c !';
}
elseif($c1 == '') {
    print 'Please enter a valid public user account number!';
}
elseif($c1 < 0) {
    print 'Please enter a valid public user account number!';
}
else{
    $query1 = "SELECT * FROM Celebrities WHERE c_account = '$c2';";
    $query2 = "SELECT * FROM Public WHERE p_account = $c1;";
    $query3 = "SELECT * FROM Follows_ WHERE p_account = $c1 and c_account ='$c2' ;";
    $result2 = $conn->query($query2)
    or die('Query failed: ' . mysqli_error($conn));
    $result3 = $conn->query($query3)
    or die('Query failed: ' . mysqli_error($conn));
    $result1 = $conn->query($query1)
    or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($result1)==0){
        print 'The celebrity account is not found in Celebrities table. Try another one';
    }
    elseif (mysqli_num_rows($result2)==0){
        print 'The public user account is not found in Public table. Try another one';
    }
    elseif (mysqli_num_rows($result3)!=0){
        print 'The relation has already existed in the table';
    }
    else{
        $query4 = "INSERT INTO Follows_(p_account,c_account) VALUES ($c1,'$c2');";
        $result4 = mysqli_query($conn, $query4);
        mysqli_stmt_bind_param($result4, 'is', $c1,$c2);
        mysqli_stmt_execute($result4);
        printf("%d Row(s) affected\n", mysqli_affected_rows($conn));

        $query5 = "SELECT * FROM InsertfLog where c_account='$c2' AND p_account = $c1;";
        $result5 = mysqli_query($conn, $query5);
        print('<table style="width:30%">');
        print('<tr>
            <th>Public_account</th>
            <th>Celebrity_account</th>
            <th>Add_time</th>
            </tr>');
        while ($tuple = mysqli_fetch_row($result5)) {
            print '<tr>';
            print '<td>'.$tuple[0].'</td>';
            print '<td>'.$tuple[1].'</td>';
            print '<td>'.$tuple[2].'</td>';
            print '</tr>';
        }
    }
}
?>