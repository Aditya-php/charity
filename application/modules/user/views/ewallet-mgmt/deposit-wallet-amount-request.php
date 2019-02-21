<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><a href="#"><i class="icon-arrow-left52 position-left"></i></a> <span class="text-semibold">Wallet Management</span> - <?php echo $title;?></h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active"><a href="<?php echo site_url();?>user/ewallet/depositWalletAmountRequestList">Deposit Wallet Amount Request List</a></li>
							<li class="active"><?php echo $title;?></li>
						</ul>
						<ul class="breadcrumb"></ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title"><?php echo $title;?></h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url()."user/ewallet/".$action_url,array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Wallet Amount:</label>
													<div class="col-lg-9">
														<input id="wallet_amount" disabled type="text" value="<?php echo $current_balance;?>" class="form-control">
														<div id="show_amount_div">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Deposit Amount:</label>
													<div class="col-lg-9">
														<input id="deposit_amount" name="deposit_amount" type="text" class="form-control" placeholder="Deposit Amount">
														<span id="valid_deposit_amount" style="color:red;font-weight:bold"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Deposit Title:</label>
													<div class="col-lg-9">
														<input name="deposit_title" type="text" class="form-control" placeholder="Deposit Title">
													</div>
												</div>										
												<div class="form-group">
													<label class="col-lg-3 control-label">Upload Deposit Proof:</label>
													<div class="col-lg-9">
														<input id="deposit_proof" name='deposit_proof' type="file" class="file-input">
														<span id="valid_deposit_proof" style="color:red;font-weight:bold"></span>

													</div>
												</div>

												<input type="hidden" name="action" value="<?php echo $action;?>">
												<div class="text-right">
													<button id="submit_btn" type="submit" name="btn" value="addNewRank" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
												</div>
											</div>
										<!--</form>-->
										<?php echo form_close();?>
								</div>
								<!-- /basic layout -->
						</div>
					</div>
					<!-- /vertical form options -->
					<!-- Footer -->
                  <?php
                  $this->load->view("common/footer-text");
                  ?>
                     <!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
<script>
$(document).ready(function(){
   $("#deposit_amount").keyup(function()
   {
    $("#show_amount_div").html(null);
   	var deposit_amount=parseInt($(this).val());
   	var wallet_amount=parseInt($("#wallet_amount").val());
    if(isNaN($(this).val()))
    {
    $("#valid_deposit_amount").text("Please enter valid deposit amount!").css('display','');
    return false;
    }
    $("#valid_deposit_amount").text(null).css('display','none');
    var rem_amount=wallet_amount+deposit_amount;
    var rem_msg="Your Amount Will Be: "+rem_amount;
    $("#show_amount_div").html(rem_msg);
   });//end keyUp
   $("#submit_btn").click(function(){
	   	var deposit_amount=parseInt($("#deposit_amount").val());
	   	var wallet_amount=parseInt($("#wallet_amount").val());
	    if($("#deposit_amount").val()=='' || $("#deposit_amount").val()==null)
	    {
	    $("#valid_deposit_amount").text("Please enter deposit amount!").css('display','');
	    return false;
	    }
	    if($("#deposit_proof").val()=="" || $("#deposit_proof").val()==null)
	    {
	    $("#valid_deposit_proof").text("Please upload deposit proof!").css('display','');
	    return false;
	    }
	    return true;


	});//end submit btn click here
});//end ready
</script>				