<?php
$id = $_GET['id'];

$conn = mysqli_connect('localhost:8889','root','root') or die('No connection');
mysqli_select_db($conn,'Nassiba') or die ('db will not open');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = 'delete FROM users WHERE id = '.$id;
if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    echo "Successfully deleted!";
    exit;
} else {
    echo "Error deleting ";
}
?>