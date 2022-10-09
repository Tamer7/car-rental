<?php
  session_start();
  include('inc/config.php');
  include('inc/checklogin.php');
  check_login();
  //hold logged in user session.
  $a_id = $_SESSION['a_id'];
  //register car
  
		if(isset($_POST['update_booking']))
		{
            $car_id = $_GET['car_id'];
            $car_fine = $_POST['fine'];

            
            //sql to insert captured values
            $query="UPDATE crms_bookings SET fines = ? WHERE car_id = $car_id";
            $stmt = $mysqli->prepare($query);
            $rc=$stmt->bind_param('s', $car_fine);
            $stmt->execute();

            if($stmt)
            {
                      $success = "Fee has been added";
                      
                      //echo "<script>toastr.success('Have Fun')</script>";
            }
            else {
              $err = "Please Try Again Or Try Later";
            }
			
			
		}
?>

<!DOCTYPE html>
<html lang="en">

<?php include("inc/head.php");?>

<body class="">
 <!--Sidebar-->
 <?php include("inc/sidebar.php");?>
  
  <div class="main-content">
    <!-- Navbar -->
   <?php include("inc/nav.php");?>
    <!-- End Navbar -->
    <!-- Header -->
    <div class="header  pb-8 pt-5 pt-md-8" style="min-height: 300px;  background-color:black; background-size: cover; background-position: center top;">
        <span class="mask bg-gradient-default opacity-5"></span>
    </div>
        <?php
                            
            $car_id = $_GET['car_id'];
            $ret="SELECT  * FROM  crms_bookings  WHERE car_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$car_id);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
            {
        ?>

        <div class="container-fluid mt--7">
            <!--Pie chart to show number of car categories-->
            <div class="row">
                <div class="card col-md-12">
                    <h2 class="card-header">Update <?php echo $row->car_name;?></h2>
                    <div class="card-body">
                        <!--Form-->
                        <form method="post" enctype="multipart/form-data" >
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Add Fine</label>
                                    <input type="text" required name="fine" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            <button type="submit" name="update_booking" class="btn btn-outline-success">Add FIne</button>
                        </form>
                        <!-- ./ Form -->
                    </div>    
                </div>
            </div>
        <!-- Footer -->
               
        </div>
    <?php }?>
  </div>
 
  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    <script type="text/javascript">
    CKEDITOR.replace('car_features')
  </script>
  <script src="assets/js/canvasjs.min.js"></script>
  <script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="assets/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>