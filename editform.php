<?php
	require_once("functions/functions.php");
  //add dbconnect

include('dbconnect.php');


//create query

$query="SELECT * FROM customer";

$result = mysqli_query($conn ,$query);
?>
<?php
	get_header();
?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
<?php
	get_sidebar();
?>
<?php
	get_navbar();



?>




 

<div class="right_col" role="main">
          <!--Paste Content Below-->
      
      <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>customer Manager</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit customer Form <small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>  
                    <?php

                      $id=$_GET['id'];


                      include('dbconnect.php');

                      $query="SELECT * FROM customer WHERE id='$id'";

                      $result= mysqli_query($conn,$query);



                      ?>





                      <div class="container bg-info" style="padding-top:20px; padding-bottom:20px">

                	

                      <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="edit.php" method = "post">
                      <?php

                      while($row=mysqli_fetch_assoc($result)){
                        
                      ?>
                        


                      <input type="hidden" name="id" value="<?php echo $row['id'];?>">




                      <div class="form-group">
                        <label class="control-label col-md-63 col-sm-3 col-xs-12" for="first-name">customer_name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" name="customer_name" value="<?php echo $row['customer_name'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">customer_address<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last-name" name="customer_address" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row['customer_address'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">customer_mobileno<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" rows="3" placeholder="customer_mobileno..." name="customer_mobileno"><?php echo $row['customer_mobileno'];?></textarea>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">customer_mailid <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="customer_mailid" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $row['customer_mailid'];?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">customer_id <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="customer_id" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo $row['customer_id'];?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-primary" type="button">Cancel</button>
						              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Edit customer</button>
                        </div>
                      </div>

                      <?php
                      }

                      mysqli_close($conn);

                      ?>


                      </form>






                      </div>







                  </div>
                </div>
              </div>
            </div> 




<?php
	get_footer();
?>



</body>
</html>