<?php

$Name = $_POST['Name'];
$Password  = $_POST['Password'];
$E-mail = $_POST['E-mail'];
$Address = $_POST['Address'];
$Contact = $_POST['Contact'];
$Re-Password = $_POST['Password'];


if (!empty($Name) || !empty($Password) || !empty(E-mail) || !empty(Address) || !empty(Contact) || !empty($Password) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cp";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT E-mail From register Where E-mail = ? Limit 1";
  $INSERT = "INSERT Into register (Name , Password , E-mail , Address, Contact , Password )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $E-mail);
     $stmt->execute();
     $stmt->bind_result($E-mail);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking Username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssss", $Name1,$Password,$E-mail,$Address,$Contact,$Password);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this E-mail";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>