<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
$bname=$_POST['bname'];
$bprice=$_POST['bprice'];
$bdesc=$_POST['bdesc'];
$vimage1=$_FILES["img"]["name"];
$brand=$_POST['brandname'];

move_uploaded_file($_FILES["img"]["tmp_name"],"img/vehicleimages/".$_FILES["img"]["name"]);
$sql="INSERT INTO addbikes(Bike_name,Bike_price,Bike_desc,Bike_image,Brand) VALUES(:bname,:bprice,:bdesc,:vimage1,:brand)";

$query = $dbh->prepare($sql);
$query->bindParam(':bname',$bname,PDO::PARAM_STR);
$query->bindParam(':bprice',$bprice,PDO::PARAM_STR);
$query->bindParam(':bdesc',$bdesc,PDO::PARAM_STR);
$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
$query->bindParam(':brand',$brand,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Bike posted successfully";
}
else 
{
$error="Something went wrong. Please try again";
}

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
	
	<title>Zoom Cabs | Admin Dashboard</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
<?php include('includes/header.php');?>

	<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Add bike</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="container">
                                            <div class="row-justify-content-center">
                                                <div class="col-md-6 bg-light rounded mt-5 ">
                                                    <h3>Add new bikes</h3><br>
                                                    <h4 class="text-center"></h4>
                                                    <form action="" method="post" class="p-2" enctype="multipart/form-data" id="form-box">
                                                        <div class="form-group">
                                                         <b> <input type="text" name="bname" class="form-control" placeholder="Bike Name" required></b>
                                                        </div>
                                                        <div class="form-group">
                                                         <b> <input type="text" name="bprice" class="form-control" placeholder="Bike Price" required></b>
                                                        </div>
                                                        <div class="form-group">
                                                         <b> <input type="text" name="bdesc" class="form-control" placeholder="Description" required></b>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-4">
                                                                <select class="selectpicker" name="brandname" required>
                                                                    <option value="" style="width: max-content;">Select</option>
                                                                    <?php
                                                                    $rel="Select id,BrandName from tblbikebrands";
                                                                    $query=$dbh->prepare($rel);
                                                                    $query->execute();
                                                                    $result=$query->fetchAll(PDO::FETCH_OBJ);
                                                                    if($query->rowCount()>0)
                                                                    {
                                                                        foreach($result as $result)
                                                                        {
                                                                        ?>

                                                                        <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
                                                                        <?php 
                                                                        }  
                                                                    } 
                                                                        ?>
                                                                 </select>
                                                            </div>
                                                        </div><br><br><br>
                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <label for="customFile" class="custom-file-label">Choose bike image</label>
                                                                <input type="file" name="img" class="custom-file-input" id="customFile" required>
                                                                
                                                            </div>

                                                        </div>

                                                        <div class="form-group">
                                                           <input type="submit" name="submit" class="btn btn-primary btn-block " value="Add">
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

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