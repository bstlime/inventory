<?php include 'header.php' ; 

	$ids = @$_GET['id'];
	$sql= "SELECT * FROM users";
	$sqls = 'SELECT * FROM users WHERE id ='.$ids;
	$results = mysqli_query($conn,$sqls);
	$row = @mysqli_fetch_assoc($results);



	if (isset($_POST['btn-update'])) {
		

		if(empty($_POST['txt-user'])){
			echo "<script type='text/javascript'>alert('Empty username textfield');window.location.href='user.php';</script> ";
		}elseif($_POST['txt-password'] != $_POST['txt-confirm']){
			echo "<script type='text/javascript'>alert('Password different with confirm password');window.location.href='user.php';</script> ";
		}elseif(empty($_POST['txt-password']) || empty($_POST['txt-confirm'])){
			echo "<script type='text/javascript'>alert('Empty Password');window.location.href='user.php';</script> ";
		}else{
			$user = $_POST['txt-user'];
			$pass = $_POST['txt-password'];
			$confirm = $_POST['txt-confirm'];
			$cred = $_POST['txt-cred'];
			$sqlr = "UPDATE users SET username = '$user', pass = '$pass', usertype = '$cred'   WHERE id='$ids'";
			mysqli_query($conn,$sqlr);
			header('Location: user.php');
		}

	}elseif (isset($_POST['btn-search'])) {
		if (empty($_POST['c-search'])) {
			$queryerror= "Select From Category";
			$sql = 'SELECT * FROM users';
		}elseif(empty($_POST['txt-search'])){
			$queryerror= "Empty Search Textfields";
			$sql = 'SELECT * FROM users';
		}else{
			$txtsearch = $_POST['txt-search'];
			$category = $_POST['c-search'];
			$sql = "SELECT * FROM users WHERE $category = '$txtsearch'" ;
					
		}
	}elseif(isset($_POST['btn-logout'])){
		header('Location: index.php');
	}elseif(isset($_POST['btn-supply'])){
		header('Location: menu-admin.php');
	}elseif (isset($_POST['btn-register'])) {
		if(empty($_POST['txt-user'])){
			echo "<script type='text/javascript'>alert('Empty username textfield');window.location.href='user.php';</script> ";
		}elseif($_POST['txt-password'] != $_POST['txt-confirm']){
			echo "<script type='text/javascript'>alert('Password different with confirm password');window.location.href='user.php';</script> ";
		}elseif(empty($_POST['txt-password']) || empty($_POST['txt-confirm'])){
			echo "<script type='text/javascript'>alert('Empty Password');window.location.href='user.php';</script> ";
		}else{
			$user = $_POST['txt-user'];
			$pass = $_POST['txt-password'];
			$confirm = $_POST['txt-confirm'];
			$cred = $_POST['txt-cred'];
			$sqlr = "INSERT INTO users (username,pass,usertype) VALUES ('$user','$pass','$cred')";
			mysqli_query($conn,$sqlr);
			header('Location: user.php');
		}

	}
	
?>


<form method="post">
<div class="row">
	<div class="col col-4 my-5 ml-4">
		<div class="container my-5" >
			<card class="card"> 
				<div class="card-body">
				<span class="display-5 mx-3 ml-5">User Management</span>
					
					<div class="row my-5 ">
						<div class="col col-9 mx-auto">
							<span class="display-label ">Username</span>
							
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-id-card"></i>
									</div>
								</div>
								<input type="text" class="form-control" name="txt-user"  value=<?php  echo  $row['username']?>>	
							</div>
							<br>
							<span class="display-label ">Password</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-medkit"></i>
									</div>
								</div>
								<input type="password" class="form-control" name="txt-password"  value=<?php  echo  $row['pass']?>>	
							</div>

							<br>
							<span class="display-label ">Confirm Password</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-exchange-alt"></i>
									</div>
								</div>
								<input type="password" class="form-control" name="txt-confirm" >	
							</div>


							<br>
							<span class="display-label ">Credentials</span>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-check"></i>
									</div>
								</div>
								<select class="form-control" name="txt-cred" >
									<option value="user">User</option>
									<option value="admin">Administrator</option>
								</select>	
							</div>
						
						</div>
					</div>
					<div class="row ">
						<div class="col ml-4">
							<button type="submit" name="btn-update" class="btn btn-info ml-float mx-5 my-3"><i class="fas fa-edit"></i> Update</button>

						</div>
						<div class="col ml-5">
							<button type="submit" class="btn btn-info ml-5  my-3" name="btn-register"><i class="fas fa-plus mx-1"></i>Register</button>
							
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
										<option value="username">Username</option>
										<option value="usertype">Credentials</option>
									</select>	
					<button name="btn-search" class="btn btn-sm btn-info ml-1"><i class="fas fa-search mx-1"></i> Search</button>
					<button class="ml-auto mx-2 btn btn-secondary" name="btn-supply"><i class="fas fa-folder-open mx-1"></i>Supply Management</button>
					<button name="btn-logout" class="btn btn-danger float-right mr-3"><i class="fas fa-arrow-circle-left mx-1"></i>Logout</button>
				</div>
			</div>
			<div class="card-body">
				<?php echo @$queryerror ?>
				<table class="table table-bordered table-hover">
					<thead class="text-center font-weight-bolder">
						<tr>
							<td>ID</td>
							<td>Username</td>
							<td>Password</td>
							<td>Credentials</td>
							<td>Options</td>
						</tr>
					</thead>
					<tbody>
						<?php
							
							$result = @mysqli_query($conn,$sql);
							while($fetch = @mysqli_fetch_assoc($result)){
						?>
						<tr class="text-center">
							<td><?php echo $fetch['id'];?></td>
							<td><?php echo $fetch['username'];?></td>
							<td><?php echo $fetch['pass'];?></td>
							<td><?php echo $fetch['usertype'];?></td>
							<td><a class="btn btn-info" href=<?php  echo '"user.php?id='. $fetch['id'] .'"'?> ><i class="fas fa-file mx-1"></i>View</a> <a class="btn btn-danger" href=<?php  echo '"include/delete-user.php?id='. $fetch['id'] .'"'?> ><i class="fas fa-trash mx-1"></i>Delete</a></td>
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
<?php include 'footer.php' ; ?>
