<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$customer_name = $customer_address = $customer_mobileno = $customer_mailid = $customer_id = "";
$customer_name_err = $customer_address_err = $customer_mobileno_err = $customer_mailid_err = $customer_id_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate customer_name
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
    $input_customer_mobileno = trim($_POST["customer_mobileno"]);
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
    if(empty($customer_name_err) && empty($customer_address_err)  && empty($customer_mobileno_err) && empty($customer_mailid_err) && empty($customer_id)){
        // Prepare an insert statement
        $sql = "UPDATE customer SET customer_name=?, customer_address=?, customer_mobileno=?, customer_mailid=?, customer_id=?  WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_customer_name, $param_customer_address, $param_customer_mobileno, $param_customer_mailid, $param_customer_id  $param_id);
            
            // Set parameters
            $param_customer_name = $customer_name;
            $param_customer_address = $customer_address;
			$param_customer_mobileno = $customer_mobileno;
            $param_customer_mailid = $customer_mailid;
            $param_customer_id = $customer_id;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
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
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM customer WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $customer_name = $row["customer_name"];
                    $customer_address = $row["customer_address"];
					$customer_mobileno = $row["customer_mobileno"];
                    $customer_mailid = $row["customer_mailid"];
                    $customer_mailid = $row["customer_mailid"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($customer_name_err)) ? 'has-error' : ''; ?>">
                            <label>Item Name</label>
                            <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>">
                            <span class="help-block"><?php echo $customer_name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($customer_address_err)) ? 'has-error' : ''; ?>">
                            <label>Item Code</label>
                            <input type="text" name="customer_address" class="form-control" value="<?php echo $customer_address; ?>">
                            <span class="help-block"><?php echo $customer_address_err;?></span>
                        </div>
						<div class="form-group <?php echo (!empty($customer_mobileno_err)) ? 'has-error' : ''; ?>">
                            <label>customer_mobileno</label>
                            <input type="text" name="customer_mobileno" class="form-control" value="<?php echo $customer_mobileno; ?>">
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>