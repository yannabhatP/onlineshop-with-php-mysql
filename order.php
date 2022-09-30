<?php
session_start();
$fname= $_POST["fname"];
$lname= $_POST["lname"];
$address= $_POST["address"];
$mobile= $_POST["mobile"];
$servername="localhost";
$username="root";
$password="12345678";
$dbname="shop";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());


$sql="INSERT INTO order_product (fname, lname, address, phone)";

$sql.="VALUES ('$fname', '$lname', '$address','$mobile');";

if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);
    
    $sql1="INSERT INTO order_details (order_id,product_id) VALUES ";
    for($i=0;$i<count($_SESSION["cart"]);$i++){
        $item_id=$_SESSION["cart"][$i]['id'];
        $sql1.="('$last_id','$item_id')";
        if($i<count($_SESSION["cart"])-1)
         $sql1.=",";
        else
         $sql.=";";
    }
    
    if(mysqli_query($con,$sql1)) echo "บันทึกข้อมูลการสั่งซื้อเรียบร้อยแล้ว";
    else "เกิดข้อผิดพลาดในการสั่งซื้อ";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  mysqli_close($conn);

?>