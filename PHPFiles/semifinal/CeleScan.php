<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="front.html">Back to Homepage</a><br>');
// Getting the input:
$tp = $_POST['typeoption2'];

$query = "SELECT c_name, c_age, c_gender,c_occupation, s_date,s_type,s_truth_or_not,s_intro 
FROM (SELECT * FROM Scandals WHERE s_type = '$tp') A
NATURAL JOIN Get_involved_in
NATURAL JOIN Celebrities;";

if(tp==''){
    print 'Please enter a valid number!';
}
else {
    $result = $conn->query($query)
    or die('Query failed: ' . mysqli_error($conn));

    if (mysqli_num_rows($result) == 0) {
        print 'No entry is found!';
    } else {
        print ("<h2>The result of your search is:</h2><br>");
        print('<table style="width:80%">');
        print('<tr>
         <th>name</th>
         <th>age</th>        
         <th>gender</th>
         <th>occupation</th>
         <th>The date of scandal</th>
         <th>The type of scandal</th>
         <th>If scandal is truth</th>
         <th>Scandal brief description</th>
         </tr>');
    }
    while ($tuple = mysqli_fetch_row($result)) {
        print '<tr>';
        print '<td>' . $tuple[0] . '</td>';
        print '<td>' . $tuple[1] . '</td>';
        print '<td>' . $tuple[2] . '</td>';
        print '<td>' . $tuple[3] . '</td>';
        print '<td>' . $tuple[4] . '</td>';
        print '<td>' . $tuple[5] . '</td>';
        print '<td>' . $tuple[6] . '</td>';
        print '<td>' . $tuple[7] . '</td>';
        print '</tr>';
    }
}
?>