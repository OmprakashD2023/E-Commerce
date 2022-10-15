<?php
session_start();
include('Admin/connection.inc.php');
unset($_SESSION['cart']);
if(isset($_POST['amt']) && isset($_POST['name'])){
    $payment_status="pending";
    $res=mysqli_query($con,'select * from orders ORDER BY id DESC LIMIT 1');
    $row=mysqli_fetch_assoc($res);
    $id=$row['id'];
    mysqli_query($con,"insert into orders(payment_status) values('$payment_status') where id='$id'");
    $_SESSION['OID']=mysqli_insert_id($con);
}


if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id=$_POST['payment_id'];
    $res=mysqli_query($con,'select * from orders ORDER BY id DESC LIMIT 1');
    $row=mysqli_fetch_assoc($res);
    $id=$row['id'];
    mysqli_query($con,"update orders set payment_status='complete',pay_id='$payment_id' where id='$id'");
}
?>