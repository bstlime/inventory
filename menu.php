<?php  include'header.php'; 
	$ids = @$_GET['id'];
	$sql= "SELECT * FROM supplies";
	$sqls = 'SELECT * FROM supplies WHERE id ='.$ids;
	$results = mysqli_query($conn,$sqls);
	$row = @mysqli_fetch_assoc($results);



	if (isset($_POST['btn-update'])) {
		$qty = $_POST['prod-qty'];
		$avail = $_POST['prod-avail'];
		$sql = "UPDATE supplies SET prod_qty = '$qty' , prod_ava='$avail' WHERE id='$ids'";
		mysqli_query($conn,$sql);
		header('Location: menu.php');
	}elseif (isset($_POST['btn-search'])) {
		if (empty($_POST['c-search']) || $_POST['c-search'] == "") {
			$queryerror= "Select From Category";
			$sql = 'SELECT * FROM supplies';
		}elseif(empty($_POST['txt-search'])){
			$queryerror= "Empty Search Textfields";
			$sql = 'SELECT * FROM supplies';
		}else{
			$txtsearch = $_POST['txt-search'];
			$category = $_POST['c-search'];
			$sql = "SELECT * FROM supplies WHERE $category = '$txtsearch'" ;
					
		}
	}elseif(isset($_POST['btn-logout'])){
		header('Location: index.php');
	}
	

?>

<form method="post">
<div class="row">
	<div class="col col-4 my-5 ml-4">
		<div class="container my-5" >
			<card class="card"> 
				<div class="card-body">
				<span class="display-5 mx-3 ml-5">Supply Management</span>
					
					<div class="row my-5 ">
						<div class="col col-9 mx-auto">
							<span class="display-label ">Product ID</span>
							
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-id-card"></i>
									</div>
								</div>
								<input type="text" class="form-control" name="prod-id" disabled value=<?php  echo  $row['id']?>>	
							</div>
							<br>
							<span class="display-label ">Product Name</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-medkit"></i>
									</div>
								</div>
								<input type="text" class="form-control" name="prod-name" disabled value=<?php  echo  $row['prod_id']?>>	
							</div>

							<br>
							<span class="display-label ">Product Quantity</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-exchange-alt"></i>
									</div>
								</div>
								<input type="text" class="form-control" name="prod-qty" value=<?php  echo  $row['prod_qty']?>>	
							</div>


							<br>
							<span class="display-label ">Product Availability</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-check"></i>
									</div>
								</div>
								<select class="form-control" name="prod-avail" >
									<option value="">Select Category</option>
									<option value="Available">Available</option>
									<option value="Not Available">Not Available</option>
								</select>	
							</div>
						
						</div>
					</div>
					<div class="row">
						<div class="col">
							<button type="submit" name="btn-update" class="btn btn-info mx-5 my-3"><i class="fas fa-edit"></i> Update</button>
						</div>
					</div>

				</div>
			</card>
		</div>
	</div>

	<div class="col col-7 mt-5 ml-4">
		<div class="card my-5">
			<div class="card-header">
				<div class="row">
					<input type="text" name="txt-search" class="form-control col-2 ml-5 mx-2" placeholder="Search">
					<select class="form-control-sm mt-1 col-2" name="c-search" >
										<option class="">Select...</option>
										<option value="prod_name">Product Name</option>
										<option value="prod_id">Product ID</option>
									</select>	
					<button name="btn-search" class="btn btn-sm btn-info ml-1"><i class="fas fa-search mx-1"></i> Search</button>
					<button name="btn-logout" class="btn btn-danger float-right mr-3 ml-auto"><i class="fas fa-arrow-circle-left mx-1"></i>Logout</button>
				</div>
			</div>
			<div class="card-body">
				
				<table class="table table-bordered table-hover">
					<thead class="text-center font-weight-bolder">
						<tr>
							<td>ID</td>
							<td>Product ID</td>
							<td>Product Name</td>
							<td>Quantity</td>
							<td>Availability</td>
							<td>Option</td>
						</tr>
					</thead>
					
					<tbody>
						<?php
							
							$result = @mysqli_query($conn,$sql);
							// $rows = mysqli_num_rows($result);
							// if($rows == 0){ $queryerror = "Record Doesnt Exist!"};
							//echo $queryerror;
							while($fetch = @mysqli_fetch_assoc($result)){
						?>
						<tr class="text-center">
							<td><?php echo $fetch['id'];?></td>
							<td><?php echo $fetch['prod_id'];?></td>
							<td><?php echo $fetch['prod_name'];?></td>
							<td><?php echo $fetch['prod_qty'];?></td>
							<td><?php echo $fetch['prod_ava'];?></td>
							<td><a class="btn btn-info" href=<?php  echo '"menu.php?id='. $fetch['id'] .'"'?> ><i class="fas fa-file mx-1"></i>View</a> <a class="btn btn-danger" href=<?php  echo '"include/delete.php?id='. $fetch['id'] .'"'?> ><i class="fas fa-trash mx-1"></i>Delete</a></td>
						</tr>
						<?php
							}
						
						  ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

</form>




<?php  include'footer.php'; ?>