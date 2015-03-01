		<div class="col-md-9" >
			<h3><?php echo $cname;
			 // contest name ?>
			</h3>
			<hr>
			<a href="<?php echo base_url(); ?>index.php/admin/addproblem/<?php echo $name; ?>" class="btn btn-info">Add Problem</a>
			<br><h3>Problems</h3>
			<br>	
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Problem</th>
						<th>Code</th>
						<th>Submission</th>
						<th>Author</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach($problems as $prob)
						{
							echo "<tr>";
							echo "<td>".$prob->name."</td>";
							echo "<td><a href='".base_url()."index.php/compete/prob/".$prob->prb_code."' >".$prob->prb_code."</a></td>";
							echo "<td>".$prob->submission."</td>";
							echo "<td>".$prob->author."</td>";
							echo "</tr>";
						}
					?>
				</tbody>
			</table>

		</div>

	
	</div>
  </div>

<!-- Donot touch javascript functionalities -->
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
              <script src="http://localhost/coderank/js/bootstrap.js" ></script>

</body>
</html>
