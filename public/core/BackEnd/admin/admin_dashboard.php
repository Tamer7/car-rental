<?php
  session_start();
  include('inc/config.php');
  include('inc/checklogin.php');
  check_login();
  //hold logged in user session.
  $a_id = $_SESSION['a_id'];
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
    <div class="header  pb-8 pt-5 pt-md-8" style="min-height: 500px;  background-color:black; background-size: cover; background-position: center top;">
    <span class="mask bg-gradient-default opacity-5"></span>
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Clients</h5>
                      <?php
                          //code for summing up number of Clients
                          $result ="SELECT count(*) FROM crms_clients ";
                          $stmt = $mysqli->prepare($result);
                          $stmt->execute();
                          $stmt->bind_result($clients);
                          $stmt->fetch();
                          $stmt->close();
                      ?>
                      <span class="h2 font-weight-bold mb-0"><?php  echo $clients;?> </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Returns</h5>
                        <?php
                              //code for summing up number of bookings
                              $result ="SELECT count(*) FROM crms_bookings WHERE b_car_return_status  = 'Returned' ";
                              $stmt = $mysqli->prepare($result);
                              $stmt->execute();
                              $stmt->bind_result($booking);
                              $stmt->fetch();
                              $stmt->close();
                        ?>
                      <span class="h2 font-weight-bold mb-0"><?php echo $booking;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-clipboard-check"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            
            
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Staffs</h5>
                        <?php
                            //code for summing up number of staff
                            $result ="SELECT count(*) FROM crms_staff ";
                            $stmt = $mysqli->prepare($result);
                            $stmt->execute();
                            $stmt->bind_result($staff);
                            $stmt->fetch();
                            $stmt->close();
                        ?>
                      <span class="h2 font-weight-bold mb-0"><?php echo $staff;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fa fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Cars</h5>
                        <?php
                              //code for summing up all number of Cars
                              $result ="SELECT count(*) FROM crms_cars ";
                              $stmt = $mysqli->prepare($result);
                              $stmt->execute();
                              $stmt->bind_result($cars);
                              $stmt->fetch();
                              $stmt->close();
                        ?>
                      <span class="h2 font-weight-bold mb-0"><?php echo $cars;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-car"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>

          </div>
          <br>
          <div class="row">

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Payments</h5>
                      <?php
                          //code for summing up number of payments done by clients
                          // $result ="SELECT SUM(p_amt) FROM crms_car_payments ";
                          // $stmt = $mysqli->prepare($result);
                          // $stmt->execute();
                          // $stmt->bind_result($clients_payments);
                          // $stmt->fetch();
                          // $stmt->close();
                          $result ="SELECT SUM(revenue) FROM crms_bookings ";
                          $stmt = $mysqli->prepare($result);
                          $stmt->execute();
                          $stmt->bind_result($clients_payments);
                          $stmt->fetch();
                          $stmt->close();
                      ?>
                      <span class="h2 font-weight-bold mb-0">$<?php  echo $clients_payments;?> </span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-money-check-alt"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>
            
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Hired Cars</h5>
                        <?php
                              //code for summing up number of hired cars
                              $result ="SELECT count(*) FROM crms_cars WHERE  car_status  = 'Hired' ";
                              $stmt = $mysqli->prepare($result);
                              $stmt->execute();
                              $stmt->bind_result($hired_cars);
                              $stmt->fetch();
                              $stmt->close();
                        ?>
                      <span class="h2 font-weight-bold mb-0"><?php echo $hired_cars;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-car"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Car Types</h5>
                        <?php
                              //code for summing up number of Cars
                              $result ="SELECT count(*) FROM crms_car_categories ";
                              $stmt = $mysqli->prepare($result);
                              $stmt->execute();
                              $stmt->bind_result($cars_type);
                              $stmt->fetch();
                              $stmt->close();
                        ?>
                      <span class="h2 font-weight-bold mb-0"><?php echo $cars_type;?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                        <i class="fas fa-car"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"></span>
                    <span class="text-nowrap"></span>
                  </p>
                </div>
              </div>
            </div>

            

          </div>
        </div>
      </div>
    </div>
    <div class="card col-md-12">
                <h2 class="card-header">Car Records</h2>
                <div class="card-body">
                    <div class="table-responsive">
                    <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">RegNo.</th>
                                <th scope="col">Category</th>
                                <th scope="col">Availability</th>
                                <th scope="col">Action<th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //get details of all cars
                                    $ret="SELECT * FROM crms_cars  ORDER BY RAND() "; 
                                    $stmt= $mysqli->prepare($ret) ;
                                    $stmt->execute() ;//ok
                                    $res=$stmt->get_result();
                                    $cnt=1;
                                    while($row=$res->fetch_object())
                                    {
                            ?>
                                <tr>
                                <th scope="row">
                                    <?php echo $cnt;?>
                                </th>
                                <td>
                                    <?php echo $row->car_name;?>
                                </td>
                                <td>
                                    <?php echo $row->car_regno;?>
                                </td>
                                
                                <td>
                                    <?php echo $row->car_type;?>
                                </td>
                                
                                <td>
                                    <?php 
                                        if($row->car_status == 'Available')
                                        {
                                            echo '<span class="badge badge-success">Available</span>';
                                        }
                                        else
                                        {
                                            echo '<span class="badge badge-danger">Hired</span>';
                                        }
                                    ?>
                                </td>
                                <td>
                                        <a href  ="admin_view_car.php?car_id=<?php echo $row->car_id;?>&car_regno=<?php echo $row->car_regno;?>" class="badge badge-success">
                                            <i class="fa fa-eye"></i> <i class="fa fa-car"></i>
                                                View
                                        </a>
                                              
                                </td>
                                </tr>
                            <?php $cnt = 1+$cnt; }?>
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
            <div class="card col-md-12">
                <h2 class="card-header">Booking Records</h2>
                <div class="card-body">
                    <div class="table-responsive">
                    <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Car Name</th>
                                <th scope="col">RegNo.</th>
                                <th scope="col">Category</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Date Hired</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            //get details of all cars
                                    $ret="SELECT * FROM crms_bookings  ORDER BY RAND() "; 
                                    $stmt= $mysqli->prepare($ret) ;
                                    $stmt->execute() ;//ok
                                    $res=$stmt->get_result();
                                    $cnt=1;
                                    while($row=$res->fetch_object())
                                    {
                                        //Trim Timestamp To DD-MM-YYYY
                                        $mysqlDateTime = $row->b_date;
                            ?>
                                <tr>
                                <th scope="row">
                                    <?php echo $cnt;?>
                                </th>
                                <td>
                                    <?php echo $row->car_name;?>
                                </td>
                                <td>
                                    <?php echo $row->car_regno;?>
                                </td>
                                
                                <td>
                                    <?php echo $row->car_type;?>
                                </td>

                                <td>
                                    <?php echo $row->c_name;?>
                                </td>

                                <td>
                                    <?php echo date("d-m-Y", strtotime($mysqlDateTime));?>
                                </td>
                                
                                <td>
                                    <?php 
                                    //If Approved show in Green If Pending Red
                                        if($row->b_status == 'Approved')
                                        {
                                            echo '<span class="badge badge-success">Approved</span>';
                                        }
                                        else
                                        {
                                            echo '<span class="badge badge-danger">Pending</span>';
                                        }
                                    ?>
                                </td>
                                
                                </tr>
                            <?php $cnt = 1+$cnt; }?>
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
      

      <!-- Footer -->
         
    </div>
  </div>
  <!--   Core   -->
  <script>
      window.onload = function () {

      var chart1 = new CanvasJS.Chart("chartContainer", {
        theme: "light",
      //  exportFileName: "Doughnut Chart",
       // exportEnabled: true,
        animationEnabled: true,
        title:{
          text: ""
        },
        legend:{
          cursor: "pointer",
          itemclick: explodePie
        },
        data: [{
          type: "doughnut",
          innerRadius: 90,
          showInLegend: true,
          toolTipContent: "<b>{name}</b>: {y} (#percent%)",
          indexLabel: "{name} - #percent%",
          dataPoints: [
            { 
              y:
                <?php
                  //code for summing up number of hatch backs
                  $result ="SELECT count(*) FROM crms_cars WHERE car_type  = 'Hatchback' ";
                  $stmt = $mysqli->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($hatchback);
                  $stmt->fetch();
                  $stmt->close();
                  echo $hatchback;
                  ?> , name: "Hatchback" },

            { y:
                <?php
                    //code for summing up number of Sedan | Saloon
                    $result ="SELECT count(*) FROM crms_cars WHERE car_type  = 'Sedan | Saloon' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($sedan);
                    $stmt->fetch();
                    $stmt->close();
                    echo $sedan;
                    ?> , name: "Sedan | Saloon" },

            { y:
              <?php
                    //code for summing up number of Multi-Purpose Vehicle (MPV)
                    $result ="SELECT count(*) FROM crms_cars WHERE car_type  = 'Multi-Purpose Vehicle (MPV)' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($MPV);
                    $stmt->fetch();
                    $stmt->close();
                    echo $MPV;
              ?> , name: "Multi-Purpose Vehicle (MPV)" },

            { y:
              <?php
                    //code for summing up number of Sports Utility Vehicle (SUV)
                    $result ="SELECT count(*) FROM crms_cars WHERE car_type  = 'Sports Utility Vehicle (SUV)' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($SUV);
                    $stmt->fetch();
                    $stmt->close();
                    echo $SUV;
              ?>, name: "Sports Utility Vehicle (SUV)" },

            { y: 
              <?php
                    //code for summing up number of Crossover
                    $result ="SELECT count(*) FROM crms_cars WHERE car_type  = 'Crossover' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($Crossover);
                    $stmt->fetch();
                    $stmt->close();
                    echo $Crossover;
              ?> , name: "Crossover" },

            { y:
              <?php
                    //code for summing up number of Coupe
                    $result ="SELECT count(*) FROM crms_cars WHERE car_type  = 'Coupe' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($Coupe);
                    $stmt->fetch();
                    $stmt->close();
                    echo $Coupe;
              ?>, name: "Coupe"},

            { y:
              <?php
                    //code for summing up number of Convertible
                    $result ="SELECT count(*) FROM crms_cars WHERE car_type  = 'Convertible' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($Convertible);
                    $stmt->fetch();
                    $stmt->close();
                    echo $Convertible;
              ?> , name: "Convertible" }
          ]
        }]
      });

      var chart2 = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        title: {
          text: ""
        },
        data: [{
          type: "pie",
          startAngle: 240,
          yValueFormatString: "##0.00'%'",
          indexLabel: "{label} {y}",
          dataPoints: [
            { 
              y:
                <?php
                  //code for summing up number of hatch backs
                  $result ="SELECT count(*) FROM crms_bookings WHERE car_type  = 'Hatchback' AND b_status ='Approved' ";
                  $stmt = $mysqli->prepare($result);
                  $stmt->execute();
                  $stmt->bind_result($hatchback);
                  $stmt->fetch();
                  $stmt->close();
                  echo $hatchback;
                  ?> , label: "Hatchback" },

            { y:
                <?php
                    //code for summing up number of Sedan | Saloon
                    $result ="SELECT count(*) FROM crms_bookings WHERE car_type  = 'Sedan | Saloon' AND b_status ='Approved' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($sedan);
                    $stmt->fetch();
                    $stmt->close();
                    echo $sedan;
                    ?> , label: "Sedan | Saloon" },

            { y:
              <?php
                    //code for summing up number of Multi-Purpose Vehicle (MPV)
                    $result ="SELECT count(*) FROM crms_bookings WHERE car_type  = 'Multi-Purpose Vehicle (MPV)' AND b_status ='Approved' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($MPV);
                    $stmt->fetch();
                    $stmt->close();
                    echo $MPV;
              ?> , label: "Multi-Purpose Vehicle (MPV)" },

            { y:
              <?php
                    //code for summing up number of Sports Utility Vehicle (SUV)
                    $result ="SELECT count(*) FROM crms_bookings WHERE car_type  = 'Sports Utility Vehicle (SUV)' AND b_status ='Approved' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($SUV);
                    $stmt->fetch();
                    $stmt->close();
                    echo $SUV;
              ?>, label: "Sports Utility Vehicle (SUV)" },

            { y: 
              <?php
                    //code for summing up number of Crossover
                    $result ="SELECT count(*) FROM crms_bookings WHERE car_type  = 'Crossover' AND b_status ='Approved' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($Crossover);
                    $stmt->fetch();
                    $stmt->close();
                    echo $Crossover;
              ?> , label: "Crossover" },

            { y:
              <?php
                    //code for summing up number of Coupe
                    $result ="SELECT count(*) FROM crms_bookings WHERE car_type  = 'Coupe' AND b_status ='Approved' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($Coupe);
                    $stmt->fetch();
                    $stmt->close();
                    echo $Coupe;
              ?>, label: "Coupe"},

            { y:
              <?php
                    //code for summing up number of Convertible
                    $result ="SELECT count(*) FROM crms_bookings WHERE car_type  = 'Convertible' AND b_status ='Approved' ";
                    $stmt = $mysqli->prepare($result);
                    $stmt->execute();
                    $stmt->bind_result($Convertible);
                    $stmt->fetch();
                    $stmt->close();
                    echo $Convertible;
              ?> , label: "Convertible" }
          ]
        }]
      });
      chart1.render();
      chart2.render();

      function explodePie (e) {
        if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
          e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
        } else {
          e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
        }
        e.chart.render();
      }

      }
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