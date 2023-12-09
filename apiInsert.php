<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data= json_decode(file_get_contents("php://input"), true);
$enroll=$data['enroll'];
$name=$data['name'];
$con= mysqli_connect('localhost', 'root', '', 'ggsipu') or  die("Connection failed: " . mysqli_connect_error());
$sql= "INSERT INTO student_details(enroll, name) VALUES ('{$enroll}','{$name}')";
 if(mysqli_query($con,$sql)){
    echo json_encode(array('message'=>'Student Record Inserted.','status'=>true));
  }else{
  echo json_encode(array('message'=>'Student Record Not Inserted.','status'=>false));
  }
?>