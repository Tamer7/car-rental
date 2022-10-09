<?php
  session_start();
  include('inc/config.php');
  include('inc/checklogin.php');
  check_login();
  //hold logged in user session.
  $c_id = $_SESSION['c_id'];
  //register staff
  
		if(isset($_POST['book_car']))
		{
            $c_id = $_SESSION['c_id'];
            $cc_id = $_GET['cc_id'];
            $car_id  = $_GET['car_id'];
            $car_name  = $_POST['car_name'];
            $car_type = $_POST['car_type'];
            $car_regno = $_GET['car_regno'];
            $b_duration = 'null';
            $c_name = $_POST['c_name'];
            $c_natidno =$_POST['c_natidno'];
            $c_phone = $_POST['c_phone'];
            $b_number = $_POST['b_number'];
            $car_price = $_POST['car_price'];
            $rent_start_day = $_POST['start_day'];
            $rent_end_day = $_POST['end_day'];



            $query1="SELECT * FROM crms_bookings WHERE c_id = $c_id AND car_id=$car_id AND b_car_return_status != 'Returned'";
            $stmt1 = $mysqli->prepare($query1);
            $stmt1->execute();
            $res=$stmt1->fetch();
 
            // var_dump($res);exit;

            if($res == true){

                echo "<script>
                alert('You have already requested to hire this car once');
                window.location.href='http://localhost/LaraCarRentalMS/public/core/BackEnd/client/client_hire_car.php';
                </script>";
            }

            else{

                
            $query="INSERT INTO crms_bookings (c_id, cc_id, car_id, car_name, car_type, car_regno, b_duration, c_name, c_natidno, c_phone, b_number, car_price, b_start_day, b_end_day) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query1="INSERT INTO booking_record_backup (c_id, cc_id, car_id, car_name, car_type, car_regno, b_duration, c_name, c_natidno, c_phone, b_number, car_price, b_start_day, b_end_day) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $mysqli->prepare($query);
            $stmt1 = $mysqli->prepare($query1);

            $rc=$stmt->bind_param('ssssssssssssss',$c_id, $cc_id, $car_id, $car_name, $car_type, $car_regno, $b_duration, $c_name, $c_natidno, $c_phone, $b_number, $car_price, $rent_start_day, $rent_end_day);
            $rc1=$stmt1->bind_param('ssssssssssssss',$c_id, $cc_id, $car_id, $car_name, $car_type, $car_regno, $b_duration, $c_name, $c_natidno, $c_phone, $b_number, $car_price, $rent_start_day, $rent_end_day);

            $stmt->execute();
            $stmt1->execute();
            
            if($stmt)
            {
                      $success = "Car Hiring Request Submitted";
                      
                      //echo "<script>toastr.success('Have Fun')</script>";
            }
            else {
              $err = "Please Try Again Or Try Later";
            }

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

    <div class="container-fluid mt--7">
        <?php
                            
            $car_id = $_GET['car_id'];
            $ret="SELECT  * FROM  crms_cars  WHERE car_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$car_id);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
            {
        ?>
        <div class="row">
            <div class="card col-md-12">
                <h2 class="card-header">Hire  <?php echo $row->car_name;?></h2>
                <div class="card-body">
                    <!--Form-->
                    <form method="post" enctype="multipart/form-data" >
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Car Name</label>
                                <input type="text" required readonly name="car_name" value="<?php echo $row->car_name;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Car Type</label>
                                <input type="text" required readonly name="car_type" value="<?php echo $row->car_type;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Car Registration Number</label>
                                <input type="text" required readonly name="car_regno" value="<?php echo $row->car_regno;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-md-6" style="display:none">
                                <label for="exampleInputEmail1">Booking Numbe</label>
                                    <?php 
                                        $length = 4;    
                                        $alph_num =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                        $num =  substr(str_shuffle('0123456789'),1,$length);

                                    ?>
                                <input type="text" required name="b_number" value="CRMS-B-<?php echo $alph_num;?>-<?php echo $num;?> " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Start Day</label>
                                <input type="date" id="s_day" name="start_day" class="form-control"  min="<?php echo date("Y-m-d"); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">End Day</label>
                                <input type="date" required name="end_day" class="form-control"  min="<?php echo date("Y-m-d"); ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Car Price Per Day</label>
                                <input type="text" required readonly name="car_price" value="<?php echo $row->car_price;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <?php }?>
                            <?php
                            
                                $c_id = $_SESSION['c_id'];
                                $ret="SELECT  * FROM  crms_clients  WHERE c_id=?";
                                $stmt= $mysqli->prepare($ret) ;
                                $stmt->bind_param('i',$c_id);
                                $stmt->execute() ;//ok
                                $res=$stmt->get_result();
                                //$cnt=1;
                                while($row=$res->fetch_object())
                                {
                            ?>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1">Client Name</label>
                                <input type="text" value="<?php echo $row->c_name;?>" readonly required name="c_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Client Phone Number</label>
                                <input type="text" required name="c_phone" value="<?php echo $row->c_phone;?>" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Client ID Number</label>
                                <input type="text"  required name="c_natidno" readonly value="<?php echo $row->c_natidno;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                        </div> 
                        <?php }?>
                        <button type="submit" name="book_car" class="btn btn-outline-success">Hire Car</button>
                    </form>
                    <!-- ./ Form -->
                </div>    
            </div>
        </div>
      <!-- Footer -->
           
    </div>
  </div>
 
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

      document.getElementById('s_day').valueAsDate = new Date();
  </script>
</body>

</html>