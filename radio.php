<?php
      header('Content-Type:application/json');
      header('Access-Control-Allow-Origin: *');
      header('Access-Control-Allow-Methods: POST');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
      $data= json_decode(file_get_contents("php://input"), true);
      $val_count= 0;
      $din= $data['tDate'];
          $db =   mysqli_connect('localhost', 'root', '', 'ggsipu') or die("Connection failed: " . mysqli_connect_error());    
            foreach($data as $x => $x_value) {
                if($x== "tDate"){
                    continue;
                }
                $sql = "INSERT INTO radiodata(enrollNo,AbsentPresent,entryDate) VALUES('$x','$x_value','$din')"; 
                if(mysqli_query($db, $sql)){
                    $val_count= $val_count+1;
                }
              }
              if($val_count){
                $val_count= 0;
                echo json_encode(array('message'=>'Data Submitted Successfully.','status'=>true));
              }else{
              echo json_encode(array('message'=>'Data Not Submitted.','status'=>false));
              }
?>