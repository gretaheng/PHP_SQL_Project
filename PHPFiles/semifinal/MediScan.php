<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="front.html">Back to Homepage</a><br>');
// Getting the input:
$tp = $_POST['typeoption3'];
//echo $pf;
$query = "SELECT m_name, m_level,m_type,num
FROM (SELECT m_name, count(*) as num FROM Reports
JOIN Scandals
ON Scandals.s_id = Reports.s_id
WHERE s_type = '$tp'
GROUP BY m_name, s_type) a
NATURAL JOIN Media";

$result = $conn->query($query)
or die('Query failed: ' . mysqli_error($conn));

if (mysqli_num_rows($result)==0){
    print 'No entry is found!';
}
else {
    print ("<h2>The result of your search is:</h2><br>");
    print('<table style="width:30%">');
    print('<tr>
         <th>Media name</th>
         <th>Media level</th>        
         <th>Media type</th>
         <th>Count</th>
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
?>

