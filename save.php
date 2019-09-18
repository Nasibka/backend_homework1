<?php
$info = $_GET['info'];
$info=explode(",",$info);
$conn = mysqli_connect('localhost:8889','root','root') or die('No connection');
mysqli_select_db($conn,'Nassiba') or die ('db will not open');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql1='select * from users where id='.$info[0];
$sql2='update users set id="'.$info[0].'",name="'.$info[1].'",surname="'.$info[2].'",email="'.$info[3].'" where id="'.$info[0].'"';
$sql3='insert into users(id,name,surname,email) values("'.$info[0].'","'.$info[1].'","'.$info[2].'","'.$info[3].'")';

$qry=mysqli_query($conn,$sql1);
$rowCheck=mysqli_num_rows($qry);
echo $sql2;
    if ($rowCheck>0) { 
        mysqli_query($conn,$sql2); 
        echo "Updated!" ;
    }
    else{ 
        mysqli_query($conn,$sql3);
        echo "Inserted!";
    }
mysqli_close($conn);

// if (mysqli_query($conn, $sql)) {
//     mysqli_close($conn);
//     echo "Successfully !";
//     exit;
// } else {
//     echo "Error";
// }
?>