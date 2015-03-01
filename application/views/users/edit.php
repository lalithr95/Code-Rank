			<div class="col-sm-9">
				
					<h3>Profile</h3>
				
				<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>index.php/profile/update" method="POST">
				<div class="col-md-offset-8">
					
						<button type="submit" class="btn btn-primary" value="submit" >Update details</button>
					
				</div>
			
				
			<br>
			<div class="col-md-6" >
				
				<div class="panel panel-info" >
					<div class="panel-heading" >
						<h3 class="panel-title" >
							Email
						</h3>
					</div>
					<div class="panel-body">
						<div class="form-group" >

							<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" id="email" >
						</div>
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						<h3 class="panel-title" >Username</h3>
					</div>
					<div class="panel-body">
						<div class="form-group" >
							<input type="text" class="form-control" name="username" id="text" value="<?php echo $username; ?>" >
						</div>
						
					</div>
				</div>
				<!-- for password and 2 fields for confirm password -->
				<div class="panel panel-info" >
					<div class="panel-heading" >
						<h3 class="panel-title" >Current Password</h3>
					</div>
					<div class="panel-body">
						<div class="form-group" >
							<input type="passsword" class="form-control" name="password" id="text" placeholder="Current Password" >
						</div>
						
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						<h3 class="panel-title" >New Password</h3>
					</div>
					<div class="panel-body">
						<div class="form-group" >
							<input type="password" class="form-control"  name="newpass" id="text" placeholder="Enter New Password" >
						</div>
						
					</div>
				</div>
				<div class="panel panel-danger" >
					<div class="panel-heading" >
						<h3 class="panel-title" >Confirm Password</h3>
					</div>
					<div class="panel-body">
						<div class="form-group" >
							<input type="password" class="form-control" name="confpass" id="text" placeholder="Confirm new Password" >
						</div>
						
					</div>
				</div>
			</div>
		</form>
				<div class="col-md-offset-8" >
					<img src="http://www.gravatar.com/avatar/<?php echo $image; ?>" alt="Profile Image" class="img-circle" >
				</div>
				<!-- for loading image -->


			</div>
			
		</div>
	</div>
<br><br>
<footer class="footer" align="center">
    &copy Copyrights 2015
</footer>




	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.js" ></script>
</body>
</html>