<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>Admin | User Registration Report</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">

   <?php include 'include/header.php'; ?>
    
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
      <marquee onMouseOver="this.stop()" style="color: #e92f33;" onMouseOut="this.start()">This Is NSUT's Exclusive Facility.!</marquee>

    <main class="app-content">
     
	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
    <div class="row">
        
        <div class="col-md-12">
          <div class="tile">
        
          	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
                      <h3 class="tile-title">Registration Report</h3>
            <div class="tile-body">
              <form class="row" method="post">
               <div class="form-group col-md-6">
                  <label class="control-label">Start Date</label>
                  <input class="form-control" type="date" name="fdate" id="fdate" placeholder="Enter Starting Date">
                </div>
	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
                 <div class="form-group col-md-6">
                  <label class="control-label">End Date</label>
                  <input class="form-control" type="date" name="todate" id="todate" placeholder="Enter Ending Date">
                </div>
                <div class="form-group col-md-4 align-self-end">
                  <input type="Submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
      <?php 
if(Isset($_POST['Submit'])){?>
<?php
 $fdate=$_POST['fdate'];
 $tdate=$_POST['todate'];
?>
       <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
              <th>Serial No.</th>
              <th>Name</th>
              <th>Email ID</th>
              <th>Mobile</th>
              <th>State</th>
              <th>City</th>
       
        	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
                    
                  </tr>
                </thead>
                  <?php
                  $sql="SELECT id, fname, lname, email, mobile, password, state, city, address, create_date from tbluser
where date(create_date) between :fdate and :tdate";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':fdate',$fdate, PDO::PARAM_STR);
                  $query->bindParam(':tdate',$tdate, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>
	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
                <tbody>
                  <tr>
                    <td><?php echo($cnt);?></td>
                    <td><?php echo htmlentities($result->fname);?> <?php echo htmlentities($result->lname);?></td>
                    <td><?php echo htmlentities($result->email);?></td>
                    <td><?php echo htmlentities($result->mobile);?></td>
                    <td><?php echo htmlentities($result->state);?></td>
                    <td><?php echo htmlentities($result->city);?></td>
                    	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
                     
                  </tr>
                    <?php  $cnt=$cnt+1; } } ?>
              
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php }?>
    </main>
    <?php include_once 'include/footer.php' ?>

     <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  </body>	
</html>
<?php } ?>