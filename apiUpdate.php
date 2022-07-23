<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data= json_decode(file_get_contents("php://input"), true);
$enroll=$data['enroll'];
$name=$data['name'];
$con= mysqli_connect('localhost', 'root', '', 'ggsipuattendancedb') or  die("Connection failed: " . mysqli_connect_error());
$sql= "UPDATE student_details set name= '{$name}' where enroll= {$enroll}";
 if(mysqli_query($con,$sql)){
    echo json_encode(array('message'=>'Student Record Updated.','status'=>true));
  }else{
  echo json_encode(array('message'=>'Student Record Not Updated.','status'=>false));
  }
?>