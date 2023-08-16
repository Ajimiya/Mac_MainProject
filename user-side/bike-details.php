<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_POST['send']))
  {
$name=$_POST['fullname'];
$email=$_POST['email'];
$bikechoosen=$_POST['bikechoosen'];
$contactno=$_POST['contactno'];
$sql="INSERT INTO  tblbikebooking(name,EmailId,Bikechoosen,ContactNumber) VALUES(:name,:email,:bikechoosen,:contactno)";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':bikechoosen',$bikechoosen,PDO::PARAM_STR);
$query->bindParam(':contactno',$contactno,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Query Sent. Booking successfully completed,we will update you within 2 days ";
}
else 
{
$error="Something went wrong. Please try again";
}

}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Zoom Cabs| bike details</details></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
</head>
<body>

<?php include('includes/colorswitcher.php');?>
        
<?php include('includes/header.php');?>
<br>

<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT addbikes.*,tblbikebrands.BrandName,tblbikebrands.id as bid  from addbikes join tblbikebrands on tblbikebrands.id=addbikes.Brand where addbikes.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['Brand']=$result->BrandName;  
?>  

<section id="listing_img_slider">
  <div ><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Bike_image);?>" class="img-responsive" alt="image" width="100%" height="300" ></div>

  </section>


  <section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->Bike_name);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>₹<?php echo htmlentities($result->Bike_price);?> </p>Priceun
         
        </div>
      </div>
    </div>
              <h5><?php echo htmlentities($result->Bike_desc);?></h5>
              <p></p>
            </li>
          </ul>
          <h5>You can book your bike using advance booking facility<span style="color:crimson;"> (Pay Rs 10000/- in advance)</span></h4>
          <h3 style="color:crimson">Please fill the following details to proceed</h3>
          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <div class="contact_form gray-bg">
          <form  method="post">
            <div class="form-group">
              <label class="control-label">Full Name <span>*</span></label>
              <input type="text" name="fullname" class="form-control white_bg" id="fullname" required>
            </div>
            <div class="form-group">
              <label class="control-label">Email Address <span>*</span></label>
              <input type="email" name="email" class="form-control white_bg" id="emailaddress" required>
            </div>
            <div class="form-group">
              <label class="control-label">Bike choosed <span>*</span></label>
              <input type="text" class="form-control white_bg" name="bikechoosen" id="bikechoosen" required>
            </div>
            <div class="form-group">
              <label class="control-label">Phone Number <span>*</span></label>
              <input type="text" name="contactno" class="form-control white_bg" id="phonenumber" required maxlength="10" pattern="[0-9]+">
            </div>
           
            <div class="form-group">
              <button class="btn" type="submit" name="send" type="submit">submit<span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </div>
          </form>
        </div>
  </div>
</section>
        </div>

  </section>
  <?php }} ?>

<?php include('includes/footer.php');?>
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<?php include('includes/login.php');?>
<?php include('includes/registration.php');?>

<?php include('includes/forgotpassword.php');?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</htm