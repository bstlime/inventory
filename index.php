<?php  include'header.php'; 

	if(isset($_POST['btn-login'])){
		if(empty($_POST['login-uid']) && empty($_POST['login-pass']) ){
			$error = '<div class="container-fluid m-auto text-danger ">Empty TextFields! </div>';
		}
		elseif(empty($_POST['login-uid']) ){
			$error = '<div class="container-fluid m-auto text-danger ">Empty Username! </div>';
		}
		elseif(empty($_POST['login-pass']) ){
			$error = '<div class="container-fluid m-auto text-danger ">Empty Password! </div>';
		}
		else{
			$user = $_POST['login-uid'];
			$pass = $_POST['login-pass'];

			$sql = "SELECT * FROM users WHERE username = '$user' AND pass= '$pass'";
			$result  = mysqli_query($conn,$sql);
			$checker = mysqli_num_rows($result);
			if($checker == 1){

				$fetch = mysqli_fetch_assoc($result);
				if($fetch['usertype'] == "admin"){
					header('Location: menu-admin.php');
				}
				else{
					header('Location: menu.php');
				}
			}
			else{
				$error = '<div class="container-fluid m-auto text-danger ">Wrong Username or Password! </div>';
			}

		}
		
	}




?>
<br><br><br><br>
<div class="row">
	<div class="col col-4 my-5 mx-auto">
		<form class="container my-5" method="post" >
			<card class="card"> 
				<div class="card-body">
				<span class="display-4 ml-5">Login</span>
					
					<div class="row my-5 ">
						
						<div class="col col-9 mx-auto">
						<?php echo @$error ?>
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-user"></i>
									</div>
								</div>
								<input type="text" class="form-control" name="login-uid" placeholder="Username...">	
							</div>
							<br>

							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i class="fas fa-asterisk"></i>
									</div>
								</div>
								<input type="password" class="form-control" name="login-pass" placeholder="Password...">	
							</div>
						
						</div>
					</div>
					<div class="row">
						<div class="col">
							<button type="submit" name="btn-login" class="btn btn-info mx-5 my-3">Login</button>
						</div>
					</div>

				</div>
			</card>
		</form>
	</div>
</div>



<?php  include'footer.php'; ?>