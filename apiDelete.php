<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data= json_decode(file_get_contents("php://input"), true);
$enroll=$data['enroll'];
 $con=   mysqli_connect('localhost', 'root', '', 'ggsipu') or  die("Connection failed: " . mysqli_connect_error());
 $sql= "DELETE FROM student_details WHERE enroll={$enroll}";
 if(mysqli_query($con, $sql)){
    echo json_encode(array('message'=>'Data deleted.','status'=>true));
  }else{
  echo json_encode(array('message'=>'Data not deleted.','status'=>false));
  }   
?>