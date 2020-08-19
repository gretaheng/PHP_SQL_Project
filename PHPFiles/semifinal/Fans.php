<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="front.html">Back to Homepage</a><br>');
// Getting the input:
$num = $_POST['mynum'];
//echo $pf;
$query = "select p_account, p_name, p_edu_level, followingstars FROM myfans
NATURAL JOIN Public
WHERE followingstars >= $num
ORDER BY followingstars;";

if(num ==''){
    print 'Please enter a valid number!';
}
elseif (num < 1 || num >100){
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
                 <th>User Account</th>
                 <th>User Name</th>
                 <th>User Education Level</th>
                 <th>Counts</th>
               </tr>');
    }
    while ($tuple = mysqli_fetch_row($result)) {
        print '<tr>';
        print '<td>'.$tuple[0].'</td>';
        print '<td>'.$tuple[1].'</td>';
        print '<td>'.$tuple[2].'</td>';
        print '<td>'.$tuple[3].'</td>';
        print '</tr>';
    }
}
?>
