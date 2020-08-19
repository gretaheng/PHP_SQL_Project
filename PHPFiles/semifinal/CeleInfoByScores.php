<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');

print ('<br><a href="front.html">Back to Homepage</a><br>');
// Getting the input:

$pf = $_POST['pstfre'];
$wf = $_POST['weifo'];
$is = $_POST['infscore'];

$query = "SELECT  c_name, c_age, c_gender, c_occupation, wu_followers, wu_post_frequncy FROM Weibo_Users
Join Celebrities 
ON wu_account = c_account
WHERE wu_post_frequncy > $pf 
AND wu_score > $is
AND wu_followers > $wf;";

if($pf==''){
    print 'Please enter a valid number!';
}
elseif($pf<0 || $pf>1) {
    print 'Please enter a valid number!';
}
elseif($wf==''){
    print 'Please enter a valid number!';
}
elseif ($wf<0){
    print 'Please enter a valid number!';
}
elseif($is==''){
    print 'Please enter a valid number!';
}
elseif ($is<0||$is>100){
    print 'Please enter a valid number!';
}
else{
$result = $conn->query($query)
    or die('Query failed: ' . mysqli_error($conn));

if (mysqli_num_rows($result)==0){
    print 'No entry is found!';
}

else {
    print ("<h2>The result of your search is:</h2><br>");
    print('<table style="width:30%">');
    print('<tr>
                <th>Name</th>
                <th>age</th> 
                <th>gender</th>
                <th>occupation</th>
                <th>weibo_followers</th>
                <th>post frequency</th>
            </tr>');
 }
 while ($tuple = mysqli_fetch_row($result)) {
    print '<tr>';
    print '<td>'.$tuple[0].'</td>';
    print '<td>'.$tuple[1].'</td>';
    print '<td>'.$tuple[2].'</td>';
    print '<td>'.$tuple[3].'</td>';
    print '<td>'.$tuple[4].'</td>';
    print '<td>'.$tuple[5].'</td>';
    print '</tr>';
}}
?>