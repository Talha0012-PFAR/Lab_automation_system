<?php
$servername="localhost";
$username="root";
$password="";
$dbname="lab_automation_system";

$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
  die("connection failed");
}
?>