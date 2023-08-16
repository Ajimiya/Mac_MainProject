<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status=1;
$sql = "UPDATE tblbikebooking SET status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();


}



 ?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Zoom Cabs |Admin Manage Bookings   </title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>

	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Manage Bike booking</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Bike bookings</div>
							<div class="panel-body">
                            
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>Email</th>
											<th>Bike choosen</th>
											<th>Contact No</th>
											<th>Posting date</th>
											<th>Action</th>
                                           
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>Email</th>
											<th>Bike choosen</th>
											<th>Contact No</th>
											<th>Posting date</th>
											<th>Action</th>
										</tr>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT * from  tblbikebooking ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->name);?></td>
											<td><?php echo htmlentities($result->EmailId);?></td>
											<td><?php echo htmlentities($result->ContactNumber);?></td>
											<td><?php echo htmlentities($result->Bikechoosen);?></td>
											<td><?php echo htmlentities($result->PostingDate);?></td>
																<?php if($result->status==1)
                                                                

                                                                
{
    // ...
$query -> execute();

// Get the user's email address
$email = $result->EmailId;

// Prepare the email subject and message
$subject = "Bike Booking Approval";
$message = "Hello " . htmlentities($result->name) . ",\n\n";
$message .= "Your bike booking has been approved by the admin.\n\n";
$message .= "Details:\n";
$message .= "Name: " . htmlentities($result->name) . "\n";
$message .= "Email: " . htmlentities($result->EmailId) . "\n";
$message .= "Bike Chosen: " . htmlentities($result->Bikechoosen) . "\n";
$message .= "Contact Number: " . htmlentities($result->ContactNumber) . "\n";
$message .= "Posting Date: " . htmlentities($result->PostingDate) . "\n\n";
$message .= "Thank you for choosing our service.";

// Send the email
$headers = "From: your_email@example.com"; // Replace with your email
mail($email, $subject, $message, $headers);

	 ?><td>Approved</td>
    
    
<?php } else {?>
    
    

<td><a href="Bike-bookingdetails.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to approve')" >Pending</a>
</td>
<?php } ?>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>
                          
						

							</div>
						</div>

					

					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>
