<head>
<style>
        body{
            display:flex;
            position: relative;
            flex-direction:column;
            background:rgb(70,0,70);
            justify-content:center;
            align-items:center;
        }
        td,tr,th{
            border: 2px solid #ddd;
            border-radius:2%;
            position:relative;
            max-width:auto;
        }
        table {
            border: 1px solid #ddd;
            border-radius:0.02%;
            max-width: auto;
        }
        div{
            margin: 1.4rem;
        }
        td,tr{
            margin: 7px 10px;
            padding: 0.7rem 0.5rem;
            
        }
        th{
            background:rgb(50,100,60);
            color:#fff;
            padding: 0.7rem 0.5rem;
            font:small-caps 800 22px Arial,sans-serif;
        }
        td{
            background:rgb(6,233,6);
            color:#fff;
            padding: 0.7rem 0.5rem;
            font: 600 18px serif;
            
        }
        h1{
            margin:2.8% 4.5%;
            color:#fff;
            font: 800 32px serif;
        }
        form{
            margin: 2px 2px
        }
        form > label {
            color:#fff;
            font: 500 22px serif;
        }
        form > input {
            border-radius:20px;
            margin:4px 0px ;
            padding: 10px 20px;
            font: 600 18px serif;
        }
        form > textarea {
            border-radius:20px;
            margin:4px 0px ;
            padding: 10px 20px;
            font: 600 18px serif;
        }
    </style>
</head>
<?php
session_start();
// $fname= $_POST["fname"];
// $lname= $_POST["lname"];
$servername="localhost";
$username="root";
$password="12345678";
$dbname="shop";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());

$sql = "SELECT * FROM order_product op JOIN order_details od ON op.id = od.order_id JOIN product p ON p.id = od.product_id ORDER BY od.order_id DESC";
$result = mysqli_query($con,$sql);
$total = 0;
$id = 0;
if(mysqli_num_rows($result)>0){
    echo "<table border=1><tr><th>firstname</th><th>lastname</th><th>address</th><th>Phone</th><th>Product</th><th>Price</th><th>Date</th></tr>";
    while($row=mysqli_fetch_assoc($result)){
        if ($id <= $row["order_id"]) {
            $id = $row["order_id"];
            $total = $total + $row["price"];
            echo "<tr><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["address"]."</td>";
            echo "<td>".$row["phone"]."</td><td>".$row["name"]."</td><td>".$row["price"]."</td><td>".$row["date"]."</td></tr>";
        }
        
    }
    echo "</table>";
}

echo "<h1> Total : $total</h1>"
?>