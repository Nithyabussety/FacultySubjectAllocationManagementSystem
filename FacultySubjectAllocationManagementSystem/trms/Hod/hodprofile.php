<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['trmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $hodid=$_SESSION['trmsaid'];
    $HName=$_POST['hodname'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  $qualification=$_POST['qualifications'];
  $add=$_POST['address'];

  $sql="UPDATE tblhod set Name=:hodname,MobileNumber=:mobilenumber,Email=:email, Qualifications=:qualifications, Address=:address where Id=:hid";
     $query = $dbh->prepare($sql);
     $query->bindParam(':hodname',$HName,PDO::PARAM_STR);
     $query->bindParam(':email',$email,PDO::PARAM_STR);
     $query->bindParam(':mobilenumber',$mobno,PDO::PARAM_STR);
     $query->bindParam(':hid',$hodid,PDO::PARAM_STR);
     $query->bindParam(':address',$add,PDO::PARAM_STR);
     $query->bindParam(':qualifications',$qualification,PDO::PARAM_STR);
$query->execute();
if($query -> rowCount() > 0)
   {
    echo '<script>alert("Your profile has been updated")</script>';
  }
  else
    {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
     
    }
  }
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>TRMS HOD Profile</title>
   

    <link rel="apple-touch-icon" href="apple-icon.png">
   


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body>
    <!-- Left Panel -->

    <?php include_once('includes/sidebar.php');?>

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>HOD Profile</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard1.php">Dashboard</a></li>
                            <li><a href="hodprofile.php">HOD Profile</a></li>
                            <li class="active">Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-6">
                       <!-- .card -->

                    </div>
                    <!--/.col-->

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>HOD</strong><small> Profile</small></div>
                            <form name="profile" method="post" action="">
                                
                            <div class="card-body card-block">
 <?php
$hodid=$_SESSION['trmsaid'];
$sql="SELECT Name,UserName,MobileNumber,Email,Qualifications,Address,TeacherSub,JoiningDate,RegDate from tblhod where ID=$hodid";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <div class="form-group"><label for="company" class=" form-control-label">HOD Name</label><input type="text" name="hodname" value="<?php  echo $row->Name;?>" class="form-control" required='true'></div>
                                    <div class="form-group"><label for="vat" class=" form-control-label">User Name</label><input type="text" name="username" value="<?php  echo $row->UserName;?>" class="form-control" readonly=""></div>
                                        <div class="form-group"><label for="street" class=" form-control-label">Contact Number</label><input type="text" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>"  class="form-control" maxlength='10' required='true'></div>
                                            <div class="row form-group">
                                                <div class="col-12">
                                                    <div class="form-group"><label for="city" class=" form-control-label">Email</label><input type="email" name="email" value="<?php  echo $row->Email;?>" class="form-control" required='true'></div>
                                                    </div>
                                                    <div class="form-group"><label for="company" class=" form-control-label">Qualifications</label><input type="text" name="qualifications" value="<?php  echo $row->Qualifications;?>" class="form-control" required='true'></div>
                                                    <div class="form-group"><label for="company" class=" form-control-label">Address</label><input type="text" name="address" value="<?php  echo $row->Address;?>" class="form-control" required='true'></div>
                                                     
                                                     <div class="col-12">
                                                        <div class="form-group"><label for="postal-code" class=" form-control-label">Subjects Taught</label><input type="text" name="subjects" value="<?php  echo $row->TeacherSub;?>" readonly="" class="form-control"></div>
                                                        </div>
                                                        <div class="col-12">
                                                        <div class="form-group"><label for="postal-code" class=" form-control-label">HOD Joining Date</label><input type="text" name="" value="<?php  echo $row->JoiningDate;?>" readonly="" class="form-control"></div>
                                                        </div>


                                                        <div class="col-12">
                                                        <div class="form-group"><label for="postal-code" class=" form-control-label">HOD Registration Date</label><input type="text" name="" value="<?php  echo $row->RegDate;?>" readonly="" class="form-control"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    </div>
                                                     <?php $cnt=$cnt+1;}} ?>  
                                                     <div class="card-footer">
                                                       <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">
                                                            <i class="fa fa-dot-circle-o"></i> Update
                                                        </button></p>
                                                        
                                                    </div>
                                                </div>
                                                </form>
                                            </div>



                                           
                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                </div><!-- /#right-panel -->
                                <!-- Right Panel -->


                           <script src="vendors/jquery/dist/jquery.min.js"></script>
                           <script src="vendors/popper.js/dist/umd/popper.min.js"></script>

                            <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                            <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

                            <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                            <script src="assets/js/main.js"></script>
</body>
</html>
<?php }  ?>