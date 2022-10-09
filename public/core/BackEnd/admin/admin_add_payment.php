<?php
  session_start();
  include('inc/config.php');
  include('inc/checklogin.php');
  check_login();
  //hold logged in user session.
  $a_id = $_SESSION['a_id'];
  //register staff
  
		if(isset($_POST['pay_hire']))
		{
            $a_id = $_SESSION['a_id'];
            $car_cat_id = $_GET['car_cat_id'];
            $car_id  = $_GET['car_id'];
            $car_name  = $_POST['car_name'];
            $car_type = $_POST['car_type'];
            $car_regno = $_POST['car_regno'];
            $b_duration = $_POST['b_duration'];
            $c_name = $_POST['c_name'];
            $c_natidno =$_POST['c_natidno'];
            $p_method = $_POST['p_method'];
            $p_code = $_POST['p_code'];
            // $p_amt = $_POST['p_amt'];
            $p_ref_number = $_POST['p_ref_number'];

            //Also Update Booking Table and show that this bookings has been paid


            
            $b_id = $_GET['b_id'];
            $ret="SELECT  * FROM  crms_bookings  WHERE b_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$b_id);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object()){

                $_POST['revenue'] = $row->revenue;
                $_POST['amount_due_pay'] = $row->amount_due_pay ;
            }


            if (!empty($p_ref_number)) {
                echo 'h';
                $total_due = $_POST['amount_due_pay'] - (int) $p_ref_number;
                $p_amt = $total_due;
            }

            else{
                $p_amt = $_POST['amount_due_pay'];
            }

            if($p_amt == 0){
                $b_payment = $_POST['b_payment'];
            }

            else{
                $b_payment = "Half";
            }



            // var_dump($_POST['revenue']);
            // var_dump($p_ref_number);exit;



            
            $b_id = $_GET['b_id'];

            // var_dump($a_id, $car_cat_id, $car_id, $car_name, $car_type, $car_regno, $b_duration, $c_name, $c_natidno, $p_method, $p_code, $p_amt, $p_ref_number);exit;
            
            //sql to insert captured values
            $query1="INSERT INTO crms_car_payments (a_id, car_cat_id, car_id, car_name, car_type, car_regno, b_duration, c_name, c_natidno, p_method, p_code, p_amt, p_ref_number) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query2="UPDATE crms_bookings SET b_payment = ? WHERE b_id =?";
            $query3="UPDATE crms_bookings SET amount_due_pay = ? WHERE b_id =?";

            $stmt1 = $mysqli->prepare($query1);
            $stmt2 = $mysqli->prepare($query2);
            $stmt3 = $mysqli->prepare($query3);


            $rc=$stmt1->bind_param('sssssssssssss',$a_id, $car_cat_id, $car_id, $car_name, $car_type, $car_regno, $b_duration, $c_name, $c_natidno, $p_method, $p_code, $p_amt, $p_ref_number);
            $rc=$stmt2->bind_param('si',$b_payment, $b_id);
            $rc=$stmt3->bind_param('si',$p_amt, $b_id);

            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();

            
            // var_dump($a_id, $car_cat_id, $car_id, $car_name, $car_type, $car_regno, $b_duration, $c_name, $c_natidno, $p_method, $p_code, $p_amt, $p_ref_number);exit;

            if($stmt1 && $stmt2 && $stmt3)
            {
                      $success = "Payment Submitted";
                      
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

    <div class="container-fluid mt--7">
        <?php
                            
            $b_id = $_GET['b_id'];
            $ret="SELECT  * FROM  crms_bookings  WHERE b_id=?";
            $stmt= $mysqli->prepare($ret) ;
            $stmt->bind_param('i',$b_id);
            $stmt->execute() ;//ok
            $res=$stmt->get_result();
            //$cnt=1;
            while($row=$res->fetch_object())
            {
        ?>
        <div class="row">
            <div class="card col-md-12">
                <h2 class="card-header">Pay  <?php echo $row->car_name;?> Hire</h2>
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
                                <label for="exampleInputEmail1">Payment Code</label>
                                    <?php 
                                        $length = 4;    
                                        $alph_num =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                        $num =  substr(str_shuffle('0123456789'),1,$length);

                                    ?>
                                <input type="text" required name="p_code" value="CRMS-P-<?php echo $alph_num;?>-<?php echo $num;?> " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            
                        </div>
                        
                        <div class="row">
                                                        
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Client Name</label>
                                <input type="text" readonly value="<?php echo $row->c_name;?>" required name="c_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Client ID Number</label>
                                <input type="text" readonly value="<?php echo $row->c_natidno;?>" required name="c_natidno" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Number Of Days Hired</label>
                                <input type="text" readonly name="b_duration" value="<?php echo $row->b_duration;?>" required  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Total Amount</label>
                                <input type="text" readonly value="<?php echo $row->revenue?>" required  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Amount Due</label>
                                <input type="text" readonly value="<?php echo $row->amount_due_pay?>" required name="p_amt" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Payment Method</label>
                                <select class="form-control" name="p_method">
                                    <option>Cash</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1">Input Paid Amount</label>
                                <small>Enter the amount paid by the customer</small>
                                <input type="text"  required name="p_ref_number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group col-md-12" style="display:none">
                                <label for="exampleInputEmail1">Booking Payment Status</label>
                                <input type="text"  required name="b_payment" value="Paid" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            

                        </div> 
                        <button type="submit" name="pay_hire" class="btn btn-outline-success">Pay</button>
                    </form>
                    <!-- ./ Form -->
                </div>    
            </div>

            <?php }?>
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
  </script>
</body>

</html>