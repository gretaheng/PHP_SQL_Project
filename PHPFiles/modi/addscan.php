<?php

require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print('<br><br><br>');
print ('<P><a href="modification.php">Back to Home</a></P>');

$id = $_POST['a0'];
$date = $_POST['txtDate'];
$type = $_POST['a2'];
$truth = $_POST['a3'];
$intro = $_POST['a4'];
$cele = $_POST['a5'];


if($id==''){
    print 'Please enter a valid scandal_id!';
}
elseif($date==''){
    print 'Please enter a valid date!';
}
elseif($id<0){
    print 'Please enter a valid scandal_id!';
}
elseif($intro == '') {
    print 'Please enter Intro!';
}
else{
    $query1 = "SELECT * FROM Scandals WHERE s_id = $id;";
    $query2 = "SELECT * FROM Get_involved_in WHERE c_account = '$cele' and s_id = $id;";
    $result2 = $conn->query($query2)
    or die('Query failed: ' . mysqli_error($conn));
    $result1 = $conn->query($query1)
    or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($result1)!=0){
        print 'The scandal id has already existed. Try another one';
    }
    elseif (mysqli_num_rows($result2)!=0){
        print 'The relation(Celebrity gets involved in a scandal) has already existed. Try another one(change
        celebrity account or change a scandal id)<br>.';
    }
    else{
        $query3 = "INSERT INTO Scandals VALUES ($id, '$date', '$type', $truth, '$intro');";
        $result3 = mysqli_query($conn, $query3);
        mysqli_stmt_bind_param($result3, 'issis', $id,$date,$type,$truth, $intro);
        mysqli_stmt_execute($result3);
        $query5 = "SELECT * FROM Scandals WHERE s_id = $id;";
        $result5 = $conn->query($query5)
        or die('Query failed: ' . mysqli_error($conn));



        print ("<h2>The record in the Scandal and Get_involved_in tables you just added are:</h2>");
        print("<br>Scandal table is on the top of the Get_invloved_in table</br>");
        print('<table style="width:30%">');
        print('<tr>
         <th>Scandal id</th>
         <th>Date</th>
         <th>Type</th>
         <th>Truth</th>
         <th>Intro</th>     
         </tr>');

        while ($tuple = mysqli_fetch_row($result5)) {
            print '<tr>';
            print '<td>' . $tuple[0] . '</td>';
            print '<td>' . $tuple[1] . '</td>';
            print '<td>' . $tuple[2] . '</td>';
            print '<td>' . $tuple[3] . '</td>';
            print '<td>' . $tuple[4] . '</td>';
            print '</tr>';
        }

        $query4 = "INSERT INTO Get_involved_in VALUES ('$cele',$id);";
        $result4 = mysqli_query($conn, $query4);
        mysqli_stmt_bind_param($result4, 'si', $cele,$id);
        mysqli_stmt_execute($result4);

        $query6 = "SELECT * FROM Get_involved_in where c_account = '$cele' AND s_id=$id;";
        $result6 = $conn->query($query6)
        or die('Query failed: ' . mysqli_error($conn));

        print('<table style="width:30%">');
        print('<tr>
         <th>Celebrity_account</th>   
         <th>Scandal id</th> 
         </tr>');
        }
        while ($tuple = mysqli_fetch_row($result6)) {
            print '<tr>';
            print '<td>' . $tuple[0] . '</td>';
            print '<td>' . $tuple[1] . '</td>';
            print '</tr>';
        }
}
?>