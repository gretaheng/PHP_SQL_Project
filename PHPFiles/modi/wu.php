<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="modification.php">Back to Homepage</a><br>');
// Getting the input:
$ac = $_POST['acn'];
$wf = $_POST['m1'];
$pf = $_POST['m2'];
$is = $_POST['m3'];

if($ac==''){
    print 'Please enter a valid account number!';
}
elseif($wf == '') {
    print 'Please enter a followers!';
}
elseif ($wf<0){
    print 'Please enter a valid number for followers!';
}
elseif($pf=='') {
    print 'Please enter post frequency!';
}
elseif($pf<0 || $pf>1) {
    print 'Please enter a valid number for post frequency!';
}
elseif($is==''){
    print 'Please enter influence score!';
}
elseif ($is<0||$is>100){
    print 'Please enter a valid number for influence score!';
}
else{
    $query = "CALL addweibouser(?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Preparation failed: (" . $conn->errno . ") " . $conn->error);
    }
    if (!($stmt->bind_param("ssss", $ac, $wf ,$pf, $is))) {
        die("Bind failed: (" . $conn->errno . ") " . $conn->error);
    }
    if ($stmt->execute()) {
        print '<p>Insert successfully!</p>';
        printf("%d Row(s) affected\n", mysqli_affected_rows($conn));
        $query2 = "SELECT * FROM WUAddLog where wu_account = '$ac';";
        $result2 = mysqli_query($conn, $query2);
        print('<table style="width:30%">');
        print('<tr>
            <th>Account</th>
            <th>Followers</th>
            <th>Post Frequency</th>
            <th>Influence Score</th>
            <th>Insert_time</th>
            </tr>');
        while ($tuple = mysqli_fetch_row($result2)) {
            print '<tr>';
            print '<td>'.$tuple[0].'</td>';
            print '<td>'.$tuple[1].'</td>';
            print '<td>'.$tuple[2].'</td>';
            print '<td>'.$tuple[3].'</td>';
            print '<td>'.$tuple[4].'</td>';
            print '</tr>';
        }
    }
    else {
        print '<p>Please try another account number.</p><P>The number you entered is invalid or has been used</P>';
    }
}
?>