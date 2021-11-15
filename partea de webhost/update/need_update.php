				<div id="modal2"></div>		
				  <div class="modal show" style="display: block;">
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
									$(".progress1").toggleClass("bg-info bg-success");
								  }, 2200);
								});
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog2").css("display", "block");
									$(".progress2").css("width", "100%");
								  }, 2400);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress2").toggleClass("bg-info bg-success");
								  }, 4600);
								});
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog3").css("display", "block");
									$(".progress3").css("width", "100%");
								  }, 4800);
								});
								$(document).ready(function() {
								  setTimeout(function() {
									$(".progress3").toggleClass("bg-info bg-success");
								  }, 7000);
								});
								
								$(document).ready(function() {
								  setTimeout(function() {
									$(".hprog4").css("display", "block");
									$(".hprog4").css("height", "125px");
								  }, 7400);
								});
								
								</script>
								<style> .progress-bar { transition: width 2s; }
										.progress { margin-bottom: 20px; }
										.hprog4 { margin-bottom: 20px; } 
										.btn { color: #fff; }
										</style>
								<?php print $lang["update_success_verify"]; ?><br>
								<div class="progress">
									<div class="progress-bar bg-info progress1" style="width:0%"></div>
								</div>
								
								<div class="hprog2" style="display:none;">
									<?php print $lang["update_success_download"]; ?><br>
									<div class="progress">
										<div class="progress-bar bg-info progress2" style="width:0%;"></div>
									</div>
								</div>
								
								<div class="hprog3" style="display:none;">
									<?php print $lang["update_success_install"]; ?><br>
									<div class="progress">
										<div class="progress-bar bg-info progress3" style="width:0%;"></div>
									</div>
								</div>
								
							</h5>
							</div>
								<div class='hprog4 alert alert-success' style='display:none; overflow-y:hidden; height:25px; transition:height 0.5s;text-align: left;'>	
								<h4><?php print $lang["update_success_install2"]; ?></h4><br>
								<b href="<?php print$_SERVER['REQUEST_URI']; ?>" class="btn btn-success modal2" data-dismiss="modal"><?php print $lang["update_success_install_close"]; ?></b>
								

						</div>
						<br>
						<img src='https://mariuschivu.ro/img/logo.png' style='width:70px'> 
						<img src='https://m2hp.mariuschivu.ro/m2hp_logo.png' style='width:120px'>
					  </div>

					</div>
				  </div>
				</div>