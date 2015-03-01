		<div class="col-md-9">
			<h3>Add problem</h3>
			<hr>
			<form class="form-horizontal" action="<?php echo base_url(); ?>index.php/admin/addprob/<?php echo $code; ?>" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="probcode" class="col-md-2" ><h4>Problem Code</h4>
					</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="pcode" placeholder="Enter Problem code" >
					</div>
				</div>
				<?php echo form_error('pcode'); ?>
				<input type="hidden" name="code" value="<?php echo $code; ?>" >
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Name</h4>
					</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="pname" placeholder="Enter name" >
					</div>
				</div>
				<?php echo form_error('pname'); ?>
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Author</h4>
					</label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="pauthor" placeholder="Enter Author name" >
					</div>
				</div>
				<?php echo form_error('pauthor'); ?>
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Statement</h4>
					</label>
					<div class="col-md-7">
						<textarea class="form-control" name="pstat" rows="5" placeholder="Enter Statement" ></textarea>
					</div>
				</div>
				<?php echo form_error('pstat'); ?>
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Input</h4>
					</label>
					<div class="col-md-7">
						<textarea class="form-control" name="pinput" rows="5" placeholder="Enter input" ></textarea>
					</div>
				</div>
				<?php echo form_error('pinput'); ?>
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Output</h4>
					</label>
					<div class="col-md-7">
						<textarea class="form-control" name="poutput" rows="5" placeholder="Enter output" ></textarea>
					</div>
				</div>
				<?php echo form_error('poutput'); ?>
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Constraints</h4>
					</label>
					<div class="col-md-7">
						<textarea  class="form-control" name="pconstraint" rows="5" placeholder="Enter Constraints" ></textarea>
					</div>
				</div>
				<?php echo form_error('pconstraint'); ?>
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Example</h4>
					</label>
					<div class="col-md-7">
						<textarea  class="form-control" name="pexample" rows="5" placeholder="Enter Example" ></textarea>
					</div>
				</div>
				<?php echo form_error('pexample'); ?>
				<div class="form-group">
					<label for="name" class="col-md-2" ><h4>Languages</h4>
					</label>
					<div class="col-md-7">
						<textarea class="form-control" name="plang" rows="5" placeholder="Enter Languages" ></textarea>
					</div>
				</div>
				<?php echo form_error('plang'); ?>
				<div class="form-group">
					<div class="col-md-offset-2 col-md-5">
						<button type="submit" class="btn btn-danger" value="Add" >Add Problem</button>
				</div>

				

			</form>

		</div>
	</div>
</div>
<!-- end of body-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
              <script src="<?php echo base_url(); ?>js/bootstrap.js" ></script>
</body>
</html>
