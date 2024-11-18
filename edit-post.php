<?php session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{

$pid=$_GET['pid'];
if(isset($_POST['Submit'])){
$category = $_POST['category'];
$titlename = $_POST['titlename'];
$package = $_POST['package'];
$packageDuration = $_POST['packageDuration'];
$Price = $_POST['Price'];
$photo = $_POST['photo'];
$description = $_POST['description'];
$sql="update tbladdpackage set category=:category,titlename=:titlename,PackageType=:package,
packageDuration=:packageDuration,Price=:Price,description=:description where id=:pid";

$query = $dbh -> prepare($sql);
$query->bindParam(':category',$category,PDO::PARAM_STR);
$query->bindParam(':titlename',$titlename,PDO::PARAM_STR);
$query->bindParam(':package',$package,PDO::PARAM_STR);
$query->bindParam(':packageDuration',$packageDuration,PDO::PARAM_STR);
$query->bindParam(':Price',$Price,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query -> execute();
$query->execute();

echo "<script>alert('Record Updated Successfully !!');</script>";

echo "<script>window.location.href='manage-post.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a">
   <title>Admin | Form Samples</title>
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
            
          <?php if($msg){ ?>
          <div class="alert alert-success" role="alert">
          <strong>Well Done!</strong> <?php echo htmlentities($msg);?>
          </div>
          <?php } ?>
	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
      
          <?php if($errormsg){ ?>
          <div class="alert alert-danger" role="alert">
          <strong>Danger!</strong> <?php echo htmlentities($errormsg);?></div>
          <?php } ?>
            <h3 class="tile-title">Update Post</h3>
               <?php
                   include  'include/config.php';
                  $sql="SELECT * FROM tbladdpackage as t1
                    join tblcategory as t2
                    on t1.category=t2.id
                    join tblpackage as t3
                    on t1.PackageType=t3.id where t1.id=:pid";
                  $query= $dbh->prepare($sql);
                  $query->bindParam(':pid',$pid, PDO::PARAM_STR);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>
            <div class="tile-body">
              <form class="row" method="post">
                <div class="form-group col-md-6">
                  <label class="control-label">Category</label>
                 <select name="category" id="category" class="form-control" onChange="getdistrict(this.value);">
                  <option value="<?php echo $result->id;?>"><?php echo $result->category_name;?></option>
                  <option value="NA">--select--</option>
                  <?php 
                  $stmt = $dbh->prepare("SELECT * FROM tblcategory ORDER BY category_name");
                  $stmt->execute();
                  $countriesList = $stmt->fetchAll();
                  foreach($countriesList as $country){
                  echo "<option value='".$country['id']."'>".$country['category_name']."</option>";
                  }
                  ?>
                  </select>
                 </select>
                </div>
                 <div class="form-group col-md-6">
                  <label class="control-label">Package Type</label>
                   <select name="package" id="package" class="form-control">
                     <option value="<?php echo $result->id;?>"><?php echo $result->PackageName;?></option>
                  	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
                 </select>
                </div>

                <div class="form-group col-md-6">
                  <label class="control-label">Title Name</label>
                  <input class="form-control" name="titlename" id="titlename" type="text" placeholder="Enter Title Name" value="<?php echo $result->titlename;?>">
                </div>

               	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->

                 <div class="form-group col-md-6">
                  <label class="control-label">Package Duration</label>
                  <input class="form-control" type="text" name="packageDuration" name="packageDuration" placeholder="Enter Package Duration" value="<?php echo $result->PackageDuration;?>">
                </div>

                 <div class="form-group col-md-6">
                  <label class="control-label">Price</label>
                  <input class="form-control" type="text" name="Price" id="Price" placeholder="Enter Price" value="<?php echo $result->Price;?>">
                </div>
                
   
                  <div class="form-group col-md-6">
                  <label class="control-label">Description</label>
                  <textarea name="description" id="description" class="form-control" cols="5" rows="10"><?php echo $result->Description;?></textarea> 
                </div>

                <div class="form-group col-md-4 align-self-end">
                  <input type="Submit" name="Submit" id="Submit" class="btn btn-primary" value="Submit">
                </div>
              </form>
            </div>
             <?php  $cnt=$cnt+1; } } ?>
          </div>
        </div>
      </div>
    </main>
    <?php include_once 'include/footer.php' ?>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/plugins/pace.min.js"></script>
  <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
  </body>
</html>


 <script>
function getdistrict(val) {
$.ajax({
type: "POST",
url: "ajaxfile.php",
data:'category='+val,
success: function(data){
$("#package").html(data);
}
});
}
</script>
<?php }?>	