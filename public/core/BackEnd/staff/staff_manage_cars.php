<?php
  session_start();
  include('inc/config.php');
  include('inc/checklogin.php');
  check_login();
  //hold logged in user session.
  $s_id = $_SESSION['s_id'];
  //delete user account
  
  if(isset($_GET['delete_id']))
  {
        $id=intval($_GET['delete_id']);
        $adn="DELETE FROM  crms_cars WHERE car_id = ?";
        $stmt= $mysqli->prepare($adn);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $stmt->close();	 
  
          if($stmt)
          {
            $success = "Car Records Deleted";
          }
            else
            {
                $err = "Try Again Later";
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
        <!--Pie chart to show number of car categories-->
        <div class="row">
            <div class="card col-md-12">
                <h2 class="card-header">Manage Car Records</h2>
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
                                        <a href  ="staff_view_car.php?car_id=<?php echo $row->car_id;?>&car_regno=<?php echo $row->car_regno;?>" class="badge badge-success">
                                            <i class="fa fa-eye"></i> <i class="fa fa-car"></i>
                                                View
                                        </a>
                                        <a href  ="staff_update_car.php?car_id=<?php echo $row->car_id;?>&car_regno=<?php echo $row->car_regno;?>" class="badge badge-primary">
                                            <i class="fa fa-edit"></i> <i class="fa fa-car"></i> 
                                                Update
                                        </a>
                                        <a href  ="staff_manage_cars.php?delete_id=<?php echo $row->car_id;?>" class="badge badge-danger">
                                            <i class="fa fa-trash"></i> <i class="fa fa-car"></i>
                                                Delete
                                        </a>        
                                </td>
                                </tr>
                            <?php $cnt = 1+$cnt; }?>
                            </tbody>
                        </table>
                    </div>
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
  </script>
</body>

</html>