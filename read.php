<?php

include('dbconnect.php');



$customer_name = $_POST['customer_name'];

$customer_address = $_POST['customer_address'];

$customer_mobileno = $_POST['customer_mobileno'];

$customer_mailid = $_POST['customer_mailid'];

$customer_id = $_POST['customer_id'];

//create query


$query = "INSERT INTO customer (customer_name , customer_address , customer_mobileno , customer_mailid , customer_id) VALUES('$customer_name' , '$customer_address' , '$customer_mobileno' , '$customer_mailid' , '$customer_id')";

if(mysqli_query($conn ,$query)){
	
header("Location:form.php");
}
