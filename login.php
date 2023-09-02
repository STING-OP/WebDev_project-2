<?php
$mail = $_POST['email'];
$password = $_POST['pswd'];
$count = 0;
$pMailErr =  $pwdErr = "";

// Required field and Data validation
if (isset($_POST['Login'])) {
    if (empty($mail)) {
        $pMailErr = " or Email required";
        echo $pMailErr . "<br>";
    } else {
        $mail = test_input($mail);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $pMailErr = "Invalid Email format";
            echo $pMailErr . "<br><br>";
            $count = $count + 1;
        }
    }
    if (empty($password)) {
        $pwdErr = "Password required";
        echo $pwdErr . "<br><br><br>";
        echo "<a href='index.html'> Back to Login Page</a>";
    } else {
        $password = test_input($password);
        if (!preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
            $pwdErr = "Password Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters";
            echo $pwdErr . "<br><br><br>";
            echo "<a href='index.html'> Back to Login Page</a>";
            $count = $count + 1;
        }
    }
}
//Function for data sanitization
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// Login Data validation with respect to database
if ($count == 0) {
    $db =   mysqli_connect('localhost', 'root', '', 'ggsipuatt');
    if ($db) {

        $sql = "select mail, password from logindetails WHERE mail='" . $mail . "' and  password='" . $password . "'";
        $res = mysqli_query($db, $sql);
        if ($res->num_rows == 1) {
            echo "<script>window.location.href='select.html';</script>";
        } else {
            echo "<script>alert('You have entered Wrong Cridentials')</script>";
            echo "<script>window.location.href='index.html';</script>";
        }
    } else {
        die("Connection failed: " . mysqli_connect_error());
    }
}

?>