<?php

$server = 'localhost';
$usrname = 'root';
$password = '';
$database = 'student';

$conn = mysqli_connect($server,$usrname,$password,$database);

if($conn){
    echo mysqli_connect_errno();
}


?>