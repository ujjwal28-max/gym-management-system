
<?php
session_start();
error_reporting(0);
require_once('include/config.php');
$msg = ""; 
if(isset($_POST['submit'])) {
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  if($email != "" && $password != "") {
    try {
      $query = "select id, name, email, mobile, password, create_date from tbladmin where email=:email and password=:password";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam('email', $email, PDO::PARAM_STR);
      $stmt->bindValue('password', $password, PDO::PARAM_STR);
      $stmt->execute();
      $count = $stmt->rowCount();
      $row   = $stmt->fetch(PDO::FETCH_ASSOC);
      if($count == 1 && !empty($row)) {
    
        $_SESSION['adminid']   = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['fname'];
       header("location: index.php");
      } else {
        $msg = "Invalid Login Credentials!";
      }
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  } else {
    $msg = "Both Fields Are Mandatory!";
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css" href="css/main.css">
   
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>NSUT Gym | Admin Login</title>
  </head>
  <body>
      <marquee onMouseOver="this.stop()" style="color: #e92f33;" onMouseOut="this.start()">This Is NSUT's Exclusive Facility.!</marquee>
	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>NSUT Gym | Admin Login</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
           <?php if($error){?><div class="errorWrap" style="color:red;"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap" style="color:red;"><strong>Error</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
          <div class="form-group">
            <label class="control-label">Email ID</label>
            <input class="form-control" name="email" id="email" type="text" placeholder="Email" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="utility">
      
  	<!-- 


	- Author Name: Samridhi, Ujjwal
	 -->
            </div>
          </div>
          <div class="form-group btn-container">
           
            <input type="submit" name="submit" id="submit" value="SIGN IN" class="btn btn-primary btn-block">
          </div>
          <hr />
          <a href="../index.php">Return To Home Page</a>
        </form>
        <form class="forget-form" action="index.html">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL ID</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i>Return To Login Page</a></p>
          </div>
        </form>
      </div>
    </section>
    <?php include_once 'include/footer.php' ?>
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>	