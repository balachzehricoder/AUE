<?php 
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'e-comercedb';
$conn = mysqli_connect($server,$username,$password,$database);
if(!$conn){
    echo die("sorry your database is refueds or under contraction  (");
}
?>