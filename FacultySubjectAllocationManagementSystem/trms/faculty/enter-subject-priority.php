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
   
    <title>TRMS|| Enter Subject Priority</title>
  
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
                        <h1>Enter Subject Priority</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard1.php">Dashboard</a></li>
                            <li><a href="enter-priority.php">Enter Priority</a></li>
                            <li class="active">Priority</li>
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
                            <div class="card-header"><strong>Subject</strong><small> Detail</small></div>
                            <form name="" method="post" action="">
                                
                            <div class="card-body card-block">
                            	<div class="card-body">
                                <table class="table" >
                                    <thead>
                                        <tr>
                                            <tr>
                  <th>S.NO</th>
                  
                  <th>Subject ID</th>

                  <th>Subjects</th>
                          
                   <th>Priority Number</th>
                </tr>
                                        </tr>
                                        </thead>


<?php
$eid=$_GET['editid'];
$id=$_GET['Id'];
$session_id = $_SESSION['trmsaid'];
$sql="SELECT Id,Subject from tblsubjects where SemId=$eid and DeptId=(SELECT DeptId from tblteacher where Id=$session_id)";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$subjects = array_fill(0, 200, 0);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>   
                                 <tr >
                  <td><?php echo htmlentities($cnt);?></td>
                  <td><?php echo htmlentities($row->Id);?></td>
                  <td><?php  echo htmlentities($row->Subject);?></td>
                  <?php 
                    $sql="SELECT Priority from tblsubjects, tblpriority where tblsubjects.ID=tblpriority.SubId and tblpriority.FacultyId=$session_id and tblpriority.SubId=$row->Id";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $prioritys=$query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0)
                    {
                      $priority = $prioritys[0]->Priority;
                    }else{
                      $priority = 0;
                    }
                    $subjects[$row->Id] = $priority;
                  ?>
                  <td><div class="form-group"><input style="width:20%" type="text" name="priority<?php echo $cnt?>" value="<?php echo $priority?>" id="priority" /></div></td>
                

               </tr>
               <?php $cnt=$cnt+1;}} ?>  
               

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
  $priority=$_POST['priority'];
  $cnt = 1;
  $sql = "";
  foreach($results as $row)
  {
    $subject_id = $row->Id;
    $old_priority = $subjects[$row->Id];
    $new_priority = $_POST['priority'.$cnt];
    $cnt=$cnt+1;
    if ($old_priority == $new_priority){
      // nothing
    }elseif($old_priority == 0 and $new_priority > 0){
      $sql = $sql."INSERT INTO tblpriority (FacultyId, Priority, SubId) VALUES ($session_id,$new_priority,$subject_id);";
    }elseif($old_priority != 0 and $new_priority != $old_priority){
      $sql = $sql."UPDATE tblpriority SET Priority=$new_priority where FacultyId=$session_id and SubId=$subject_id;";
    }
  };
  if($sql != ""){
    $query = $dbh->prepare($sql);
    $query->execute();
    if($query->rowCount() > 0){
      echo '<script>alert("Your profile has been updated")</script>';
    }else{
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
  }
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

