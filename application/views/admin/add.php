		<div class="col-md-9" >
			<h3>Add Contest</h3>
			<hr>
			<form class="form-horizontal" action="/coderank/index.php/admin/addcontest" method="POST" >
					<div  class="form-group">
						
						<label for="code" class="col-md-2"><h4>Code</h4></label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="code" placeholder="Enter Code">
						</div>
					</div>
					<?php echo form_error('code'); ?>
					<div class="form-group">
						<label for="name" class="col-md-2"><h4>Name</h4></label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="name" placeholder="Enter name">
						</div>
					</div>
					<?php echo form_error('name'); ?>
					<div class="form-group">
						<label for="starttime" class="col-md-2"><h4>Start Time</h4></label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="starttime" placeholder="YYYY/MM/DD HH:MM:SS">
						</div>
					</div>
					<?php echo form_error('starttime'); ?>
					<div class="form-group">
						<label for="starttime" class="col-md-2"><h4>End Time</h4></label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="endtime" placeholder="YYYY/MM/DD HH:MM:SS">
						</div>
					</div>
					<?php echo form_error('endtime'); ?>
					<div class="form-group">
						<label for="name" class="col-md-2"><h4>Content</h4></label>
						<div class="col-md-6">
							<textarea  class="form-control" name="content" rows="6" placeholder="Enter Contest Description"></textarea>
						</div>
					</div>
					<?php echo form_error('content'); ?>
					<div class="form-group">
						<div class="col-md-offset-2 col-md-5">
						<button type="submit"  value="submit" class="btn btn-danger" >Submit</button>
						</div>
					</div>		
				
			</form>
		</div>
	</div>
</div>





<!-- Donot touch javascript functionalities -->
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
              <script src="<?php echo base_url(); ?>js/bootstrap.js" ></script>

              
</body>
</html>





			