			<div class="col-sm-9">
				
					<h3>Profile</h3>
				
				
				<div class="col-md-offset-8">
					
						<button type="button" class="btn btn-primary" onclick="window.location.href='<?php echo base_url(); ?>index.php/profile/edit'" >Edit details</button>
					
				</div>
			
				
			<br>
			<div class="col-md-6" >
				


				<div class="panel panel-danger" >
					<div class="panel-heading" >
						<h3 class="panel-title" >
							User ID
						</h3>
					</div>
					<div class="panel-body">
						<?php echo $id; ?>
					</div>
				</div>
				<div class="panel panel-info" >
					<div class="panel-heading" >
						<h3 class="panel-title" >
							Email
						</h3>
					</div>
					<div class="panel-body">
						<?php echo $email; ?>
					</div>
				</div>
				<div class="panel panel-primary" >
					<div class="panel-heading" >
						<h3 class="panel-title" >Username</h3>
					</div>
					<div class="panel-body">
						<?php echo $username; ?>
					</div>
				</div>
			</div>
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