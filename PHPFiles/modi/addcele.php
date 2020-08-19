<?php
// Connection parameters
require('db.php');
print ('<head><link rel="import" href="../index.html"></head>');
print ('<br><a href="modification.php">Back to Homepage</a><br>');
// Getting the input:
$ac = $_POST['acn'];
$name = $_POST['n1'];
$age = (int)$_POST['n2'];
$gender = $_POST['g'];
$occu = $_POST['n3'];

if($ac==''){
    print 'Please enter a valid account number!';
}
elseif (substr( $ac, 0, 2 ) === "c"){
    print 'Please enter a valid account number, start with c !';
}
elseif($age == '') {
    print 'Please enter age!';
}
elseif($name==''){
    print 'Please enter name!';
}
elseif($occu==''){
    print 'Please enter occupation!';
}
else{
    $query = "INSERT INTO Celebrities(c_account,c_name,c_gender,c_occupation,c_age) 
VALUES ('$ac', '$name', '$gender', '$occu',$age);";
    $result = mysqli_query($conn, $query)
    or die('Query failed: ' . mysqli_error($conn));
    printf("%d Rows affected\n", mysqli_affected_rows($conn));
}
?>