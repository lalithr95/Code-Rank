		<div class="col-md-9" >
			<h3><?php echo $prob->name; ?></h3>
			<hr>
			<strong><h3>Statement</h3></strong>
			<div class="well">
				<?php echo $prob->statement; ?>
			</div>
			<strong><h3>Input</h3></strong>
			<div class="well" >
				<?php echo $prob->input; ?>
			</div>
			<strong><h3>Output</h3></strong>
			<div class="well">
				<?php echo $prob->output; ?>
			</div>
			<strong><h3>Constraints</h3></strong>
			<div class="well">
				<?php echo $prob->constraint; ?>
			</div>
			<strong><h3>Example</h3></strong>
			<div class="well">
				<?php echo $prob->example; ?>
			</div>
			
			<table class="table table-hover" >
				<thead>
					<tr>
					<th>Time</th>
					<th>Memory Limit</th>
					<th>Languages</th>
					<th>Author</th>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $prob->timelimit; ?> sec</td>
						<td><?php echo $prob->maxfilesize; ?> Bytes</td>
						<td><?php echo $prob->lang; ?></td>
						<td><?php echo $prob->author; ?></td>
					</tr>
				</tbody>
			</table>
		<form class="form-horizontal" action ="<?php echo base_url(); ?>index.php/submit/send/<?php echo $prob->prb_code; ?>" method="POST"  enctype="multipart/form-data" >
			
		<div class="form-group">
			<label class="col-md-2" for="lang" >Language</label>	
			<div class="col-md-2">
				<select onChange="getlang()" id="lang" class="form-control" name="lang" >
					<?php
						for($i=0;$i<count($lang);$i++)
						{
							echo "<option>".strtoupper($lang[$i])."</option>";
						}
					?>
				</select>
			</div>
		</div>

				<div class="form-group">
					<label for="probcode" ><h3>Your Code</h3></label>
					<textarea name="code"  rows="15" id="codeeditor" class="form-control" placeholder="Enter Code" ></textarea>
				</div>
				<div class="form-group">
					<div class="col-md-5" >
						<button type="submit" class="btn btn-primary" >Submit code</button>
					</div>
				</div>

			</form>
			<!-- Editor and a form to submit code -->
		</div>


	</div>
</div>





<!-- Donot touch javascript functionalities -->
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
              <script src="<?php echo base_url(); ?>js/bootstrap.js" ></script>
              <script src="<?php  echo base_url(); ?>js/codemirror.js"></script>
              <script src="<?php  echo base_url(); ?>js/clike.js"></script>
              <script type="text/javascript">
              		//var lang = new array("c","c++","java","python","ruby","scala","php","javascript");
              		var config = {
              			lineNumbers:true,
              			matchBrackets:true,
              			mode:"text/x-"+getlang()
              			}
              		var editor = CodeMirror.fromTextArea(document.getElementById("codeeditor"),config);
              		function getlang()
              		{
              			var option = document.getElementById('lang');
              			var lang = option.options[option.selectedIndex].value;
              			//alert(lang);
              			loadcode(lang);
              		}

              		function loadcode(x)
              		{
              			var lang = new Array("c","c++","java","python","ruby","scala","php","javascript");
              			var item = x;
              			for (var i=0;i < lang.length;i++)
              			{
              				
              				if(item.toLowerCase() == lang[i])
              				{
              					break;
              				}
              			}
              			//alert(lang[i]);
              			return lang[i];
              			
              		}

              </script>
              

</body>
</html>