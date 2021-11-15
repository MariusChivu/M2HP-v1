				<div id="modal2"></div>		
				  <div class="modal show modal2" style="display: block;">
				  <div class="modal-dialog">
					<div class="modal-content" style='background: #212121; color:#fff;'>

					  <!-- Modal Header -->
					  <div class="modal-header">
						<h4 class="modal-title"><?php print $lang["update_title"]; ?></h4>
					  </div>

					  <!-- Modal body -->
					  <div class="modal-body">
			<div style="text-align:left;"><br><h5>
								<script>
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress1").css("width", "100%");
								  }, 0);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress1").toggleClass("bg-info bg-danger");
								  }, 2200);
								});
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog4").css("display", "block");
									$(".hprog4").css("height", "125px");
								  }, 2400);
								});
								
								</script>
								<style> .progress-bar { transition: width 2s; }
										.progress { margin-bottom: 20px; }
										.hprog4 { margin-bottom: 20px; }
										</style>
								<?php print $lang["update_success_verify"]; ?><br>
								<div class="progress">
									<div class="progress-bar bg-info progress1" style="width:0%"></div>
								</div>
								
							</h5>
							</div>
								<div class='hprog4 alert alert-danger' style='display:none; overflow-y:hidden; height:25px; transition:height 0.5s;text-align: left;'>	
								<h4><?php print $lang["update_danger_install"]; ?></h4><br>
								<b href="<?php print$_SERVER['REQUEST_URI']; ?>" class="btn btn-success" data-dismiss="modal"><?php print $lang["update_success_install_close"]; ?></b>
								

						</div>
						<br>
						<img src='https://mariuschivu.ro/img/logo.png' style='width:150px'> 
						<img src='https://m2hp.mariuschivu.ro/m2hp_logo.png' style='width:290px'>
					  </div>

					</div>
				  </div>
				</div>