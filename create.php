<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$customer_name = $customer_address = $customer_mobileno = $customer_mailid = $customer_id = "";
$customer_name_err = $customer_address_err = $customer_mobileno_err = $customer_mailid_err = $customer_id_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_customer_name = trim($_POST["customer_name"]);
    if(empty($input_customer_name)){
        $customer_name_err = "Please enter a name.";
    } elseif(!filter_var(trim($_POST["customer_name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $customer_name_err = 'Please enter a valid name.';
    } else{
        $customer_name = $input_customer_name;
    }
    
    // Validate customer_address
    $input_customer_address = trim($_POST["customer_address"]);
    if(empty($input_customer_address)){
        $customer_address_err = 'Please enter an customer_address.';     
    } else{
        $customer_address = $input_customer_address;
    }
    
    // Validate customer_mobileno
    $input_customer_mobileno = trim($_POST['customer_mobileno']);
    if(empty($input_customer_mobileno)){
        $customer_mobileno_err = "Please enter the customer_mobileno.";     
    } else{
        $customer_mobileno = $input_customer_mobileno;
    }
	
	 // Validate customer_mailid
    $input_customer_mailid = trim($_POST["customer_mailid"]);
    if(empty($input_customer_mailid)){
        $customer_mailid_err = "Please enter the customer_mailid.";     
    } else{
        $customer_mailid = $input_customer_mailid;
    }
    
   // Validate customer_id
    $input_customer_id = trim($_POST["customer_id"]);
    if(empty($input_customer_id)){
        $customer_id_err = "Please enter the customer_id.";     
    } else{
        $customer_id = $input_customer_id;
    }

    // Check input errors before inserting in database
    if(empty($customer_name_err) && empty($customer_address_err) &&  empty($customer_mobileno_err) && empty($customer_mailid_err) && empty($customer_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO customer (customer_name, customer_address, customer_mobileno, customer_mailid, customer_id) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_customer_name, $param_customer_address, $param_customer_mobileno, $param_customer_mailid, $param_customer_id);
            
            // Set parameters
            $param_customer_name = $customer_name;
            $param_customer_address = $customer_address;
            $param_customer_mobileno = $customer_mobileno;
            $param_customer_mailid = $customer_mailid;
            $param_customer_id = $customer_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add subjects record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($customer_name_err)) ? 'has-error' : ''; ?>">
                            <label>customer_name</label>
                            <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>">
                            <span class="help-block"><?php echo $customer_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($customer_address_err)) ? 'has-error' : ''; ?>">
                            <label>customer_code</label>
                            <input type="text" name="customer_address" class="form-control" value="<?php echo $customer_address; ?>">
                            <span class="help-block"><?php echo $customer_address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($customer_mobileno_err)) ? 'has-error' : ''; ?>">
                            <label>customer_mobileno</label>
                            <input tyoe="text"  name="customer_mobileno" class="form-control" value="<?php echo $customer_mobileno; ?>">
                            <span class="help-block"><?php echo $customer_mobileno_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($customer_mailid_err)) ? 'has-error' : ''; ?>">
                            <label>customer_mailid</label>
                            <input type="text" name="customer_mailid" class="form-control" value="<?php echo $customer_mailid; ?>">
                            <span class="help-block"><?php echo $customer_mailid_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($customer_id_err)) ? 'has-error' : ''; ?>">
                            <label>customer_id</label>
                            <input type="text" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>">
                            <span class="help-block"><?php echo $customer_id_err;?></span>
                        </div>  
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>