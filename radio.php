<?php
      if(isset($_POST['submit'])){
        if(!empty($_POST['001']) && !empty($_POST['002']) && !empty($_POST['003']) && !empty($_POST['004']) && !empty($_POST['005']) && !empty($_POST['tDate'])) {
          $oo1= $_POST['001'];
          $oo2= $_POST['002'];
          $oo3= $_POST['003'];
          $oo4= $_POST['004'];
          $oo5= $_POST['005'];
          $arr= array($oo1,$oo2,$oo3,$oo4,$oo5);
          $arr2= array(001,002,003,004,005);
          $date= $_POST['tDate'];
          $db =   mysqli_connect('localhost', 'root', '', 'ggsipuattendancedb');
          if($db){
              for($i=0;$i<5;$i++){
                  $sql = "INSERT INTO radiodata(enrollNo,AbsentPresent,date) VALUES('$arr2[$i]','$arr[$i]','$date')"; 
                  mysqli_query($db, $sql);
              }
              echo "<h3>data stored in a database successfully </h3>"; 
              echo "<br><br><br>"."<a href='AttPanel.html'> Back to previous Page</a>";
              echo "<br><br><br>"."<a href='select.html'> Back to select Page</a>";
       mysqli_close($db);
  }
  else{
      die("Connection failed: " . mysqli_connect_error());
  }
        } 
        else {
            echo"Please check all the radio buttons and enter date";
            echo "<br><br><br>"."<a href='AttPanel.html'> Back to previous Page</a>";
        }
      
  }
    ?>