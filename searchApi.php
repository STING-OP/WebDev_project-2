<?php
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
$data= json_decode(file_get_contents("php://input"), true);
$searchVal=$data['search'];
 $con=   mysqli_connect('localhost', 'root', '', 'ggsipuattendancedb') or  die("Connection failed: " . mysqli_connect_error());
 $sql= "SELECT * FROM radiodata WHERE enrollNo= '{$searchVal}' or AbsentPresent LIKE '%{$searchVal}%'";
 $res = mysqli_query($con, $sql) or die("Sql query failed");
 if(mysqli_num_rows($res)>0){
    $output= mysqli_fetch_all($res,MYSQLI_ASSOC);
    echo json_encode($output);
  }else{
  echo json_encode(array('message'=>'No Record Found.','status'=>false));
  }
  ?>
