<?php

include('dbconnect.php');

$id=$_POST['id'];

$customer_name=$_POST['customer_name'];

$customer_address=$_POST['customer_address'];

$customer_mobileno=$_POST['customer_mobileno'];

$customer_mailid=$_POST['customer_mailid'];

$customer_id=$_POST['customer_id'];

$query="UPDATE  customer SET customer_name='$customer_name',customer_address='$customer_address',customer_mobileno='$customer_mobileno',customer_mailid='$customer_mailid',customer_id='$customer_id  WHERE id='$id'";


if(mysqli_query($conn,$query)){
	
	header("Location:form.php");
	
}

else{
	echo "Error in query";
}

mysqli_close($conn);
?>