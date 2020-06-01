  <?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['trmsaid']==0)) {
  header('location:logout.php');
  } else{
    
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
   
    <title>TRMS||Allot Faculty</title>
  
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
                        <h1>Allot Faculty</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard1.php">Dashboard</a></li>
                            <li><a href="viewsubjects.php">Allot Faculty</a></li>
                            <li class="active">Allot</li>
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
                            <div class="card-header"><strong>Faculty</strong><small> Detail</small></div>
                            <form name="" method="post" action="">
                                
                            <div class="card-body card-block">
                            	<div class="card-body">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <tr>
                  <th>S.NO</th>
                  
                  <th>Faculty Name</th>

                 <th>Priority Number</th>

                  <th>Action</th>
                </tr>
                                        </tr>
                                        </thead>


<?php
$subject_id=$_GET['sub_id'];
$sql="SELECT tblteacher.Name,tblteacher.ID,tblpriority.Alloted,tblpriority.Priority from tblteacher,tblpriority where tblteacher.ID=tblpriority.FacultyId and tblpriority.SubId=$subject_id";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
$faculty_ids = "0";
if($query->rowCount() > 0)
{
foreach($results as $row)
{         
                  $faculty_ids = $faculty_ids.",".$row->ID
                  ?>

                  <tr >
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php echo htmlentities($row->Name);?></td>
                  <td><?php echo htmlentities($row->Priority);?></td>
                   <?php
                    if($row->Alloted >0){  $i=0; ?>
                  
                  <td><input type="checkbox" name="alloted[]" id="alloted" value="<?php echo $row->ID?>" checked="checked"></td>
                  <?php } else { ?>
                  <td><input type="checkbox" name="alloted[]" id="alloted" value="<?php echo $row->ID?>"></td>
               </tr><?php }?>
               <?php $cnt=$cnt+1;$i=$i+1; }} ?>  
                               </table>
                   
                            </div>
                        </div>
                        <div class="card-footer">
                  <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="update" id="update">
                                                            <i class="fa fa-dot-circle-o"></i> Update
                                                        </button></p> </div>
                    </form>
 
<?php
if(isset($_POST['update'])){
  $subject_id = $_GET['sub_id'];
  $sql="";
 $flag=0;

  $allot = "0";
  if(!empty($_POST['alloted'])){
    foreach($_POST['alloted'] as $alloted){
      $allot = $allot.",".$alloted;
    };
  }
  
  $sql = $sql."UPDATE tblpriority SET Alloted=0 where FacultyId in ($faculty_ids) and SubId=$subject_id;";
  $sql = $sql."UPDATE tblpriority SET Alloted=1 where FacultyId in ($allot) and SubId=$subject_id;";
  $flag=1;
    
    if($sql != ""){
    $query = $dbh->prepare($sql);
    $query->execute();
    if($query->rowCount() > 0 or $flag==1){
      echo '<script>alert("Your profile has been updated")</script>';
    }else{
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
  }
 $sql="";
  $flag=0;
} ?>

                                             </div>
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

