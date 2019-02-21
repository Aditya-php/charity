<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/dashboard.js"></script>
<script type="text/javascript" src="https://www.amcharts.com/lib/3/amcharts.js"></script>
		<script type="text/javascript" src="https://www.amcharts.com/lib/3/serial.js"></script>
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"categoryField": "category",
					"angle": 10,
					"autoMarginOffset": 40,
					"depth3D": 15,
					"marginRight": 70,
					"marginTop": 70,
					"startDuration": 1,
					"addClassNames": true,
					"autoDisplay": true,
					"fontSize": 13,
					"processCount": 995,
					"theme": "default",
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[title]] In [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-1",
							"title": "Total Package Sold",
							"type": "column",
							"valueField": "column-1"
						},
						{
							"balloonText": "[[title]] In [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-2",
							"title": "Total Matrix Commission",
							"type": "column",
							"valueField": "column-2"
						},
						{
							"balloonText": "[[title]] In [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-3",
							"title": "Total Stage Completion Commission",
							"type": "column",
							"valueField": "column-3"
						},
						{
							"balloonText": "[[title]] In [[category]]:[[value]]",
							"fillAlphas": 0.9,
							"id": "AmGraph-4",
							"title": "Total Company Profit",
							"type": "column",
							"valueField": "column-4"
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": "Value In N"
						}
					],
					"allLabels": [],
					"balloon": {},
					"titles": [],
					"dataProvider": [
					<?php
					foreach($Commission_chart as $key=>$cc)
					{
					?>
						{
							"category": "<?php echo $cc['month']; ?>",
							"column-1": <?php echo $cc['Package_sold']; ?>,
							"column-2": <?php echo $cc['total_matrix_commission']; ?>,
							"column-3": <?php echo $cc['total_matrix_complete_commission']; ?>,
							"column-4": <?php echo $cc['company_profit']; ?>
						}
						<?php
						if($key!=4)
						{
							?>
							,
						<?php
						}
					}
						?>
					]
				}
			);
		</script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin/"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">Dashboard</li>
         </ul>
        
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   
    <style>
   .myclasss
   {
	    background-color: #26a69a !important; 
        color:#fff;		
   }
   </style>
   
   <div class="content">
   <div class='row'>
	   <h4>Commission Chart</h4>
	   <div id="chartdiv" style="width: 100%; height: 500px; background-color: #FFFFFF;" ></div><br>
	  
	  </div>
	  
	  <script>
		
			$(window).load(ajaxdata());
        
           
			
			function ajaxdata()
			{
		url="<?php echo site_url()?>admin/admin/ajaxalldata";
		 var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) 
			{
				
				var result=JSON.parse(this.responseText);
				
				
				
				//setTimeout(function() { ajaxdata(); }, 5000);
				
			    document.getElementById("member_registered_today").innerHTML = result['member_registered_today'];
			    document.getElementById("this_week_registered_member").innerHTML = result['this_week_registered_member'];
				document.getElementById("this_month_registered_member").innerHTML = result['this_month_registered_member'];
				document.getElementById("total_member").innerHTML = result['total_member'];
				document.getElementById("total_package_sold_amount").innerHTML = result['total_package_sold_amount'];
				
				document.getElementById("TotalcompanyMatrixCompleteCommission").innerHTML = result['TotalcompanyMatrixCompleteCommission'];
				document.getElementById("TotalcompanyMatrixCommission").innerHTML = result['TotalcompanyMatrixCommission'];
				document.getElementById("company_total_commission").innerHTML = result['company_total_commission'];
				
				document.getElementById("company_total_profit").innerHTML = result['company_total_profit'];
				
				document.getElementById("total_member_matrix_complete_commission").innerHTML = result['total_member_matrix_complete_commission'];
				document.getElementById("total_all_member_matrix_commission").innerHTML = result['total_all_member_matrix_commission'];
				
				document.getElementById("Member_gross_commission").innerHTML = result['Member_gross_commission'];
			  
			}
		  };
		  xhttp.open("GET", url, true);
		  xhttp.send();
				
			}
			
        </script>
	  
	  
      <!-- Main charts -->
      <div class="row">
         <div class="col-sm-6 col-md-3">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin" id="member_registered_today"></h3>
                     <span class="text-uppercase text-size-mini">Member Registered Today</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="this_week_registered_member"></h3>
                     <span class="text-uppercase text-size-mini">Member Registered This Week</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-3">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="this_month_registered_member"></h3>
                     <span class="text-uppercase text-size-mini">Member Registered This Month</span>
                  </div>
               </div>
            </div>
         </div>
		 <div class="col-sm-6 col-md-3">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-users4 icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="total_member"></h3>
                     <span class="text-uppercase text-size-mini">Total Member</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <!-- /inside tabs -->
      <!--Wallet Balance -->
      <div class="row">
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin" id="total_package_sold_amount"></h3>
                     <span class="text-uppercase text-size-mini">Total Package Sold</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class=" icon-task icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         
		 <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="company_total_profit"></h3>
                     <span class="text-uppercase text-size-mini">Gross Company Profit</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  <!-------admin commission report---------------->
	   <!--<div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin" id="total_company_direct_commission"></h3>
                     <span class="text-uppercase text-size-mini">Company Direct Commission</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class=" icon-task icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="TotalcompanyMatrixCommission"></h3>
                     <span class="text-uppercase text-size-mini">Company Matrix Commission</span>
                  </div>
               </div>
            </div>
         </div>
		 </div>-->
		 <div class="row">
		 <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="TotalcompanyMatrixCommission"></h3>
                     <span class="text-uppercase text-size-mini">Company Matrix Commission</span>
                  </div>
               </div>
            </div>
         </div>
		<div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="TotalcompanyMatrixCompleteCommission"></h3>
                     <span class="text-uppercase text-size-mini">Company Stage Complete  Commission</span>
                  </div>
               </div>
            </div>
         </div>		
		 <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="company_total_commission"></h3>
                     <span class="text-uppercase text-size-mini">Company Gross Commission</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  <!--------------User commission Report------------>
	  <!---<div class="row">
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin" id="total_all_member_direct_commission"></h3>
                     <span class="text-uppercase text-size-mini">Members Direct Commission</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class=" icon-task icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="total_all_member_matrix_commission"></h3>
                     <span class="text-uppercase text-size-mini">Members Matrix Commission</span>
                  </div>
               </div>
            </div>
         </div>
		 </div>-->
		 <div class="row">
		  <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="total_all_member_matrix_commission"></h3>
                     <span class="text-uppercase text-size-mini">Members Matrix Commission</span>
                  </div>
               </div>
            </div>
         </div>
		 <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="total_member_matrix_complete_commission"></h3>
                     <span class="text-uppercase text-size-mini">Members Matrix Complete Commission</span>
                  </div>
               </div>
            </div>
         </div>
		 
		 <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-calculator icon-3x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin" id="Member_gross_commission"></h3>
                     <span class="text-uppercase text-size-mini">Members Gross Commission</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  
      <!--Wallet Balance -->
<!-- Inside tabs -->
      <div class="row">
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Payout Request</h6>
                     <span class="text-muted"><?php echo $total_payout_request;?> Requests</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-coins icon-2x"></i>
                  </div>
               </div>
               <div class="progress progress-micro bg-blue mb-10">
                  <div class="progress-bar bg-white" style="width: 100%">
                     <span class="sr-only"><?php echo $total_payout_request_completion_rate;?>% Complete</span>
                  </div>
               </div>
               <?php echo currency()." ".$total_payout_request_amount;?>
            </div>
         </div>
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-check icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Success Payout</h6>
                     <span class="text-muted"><?php echo $total_completed_payout_request;?></span>
                  </div>
               </div>
               <div class="progress progress-micro mb-10 bg-success">
                  <div class="progress-bar bg-white" style="width: 100%">
                     <span class="sr-only"><?php echo $total_payout_request_completion_rate;?>% Complete</span>
                  </div>
               </div>
               <?php echo currency()." ".$total_completed_payout_request_amount;?>
            </div>
         </div>
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-notice icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Pending Payout</h6>
                     <span class="text-muted"><?php echo $total_pending_payout_request;?></span>
                  </div>
               </div>
               <div class="progress progress-micro mb-10 bg-indigo">
                  <div class="progress-bar bg-white" style="width: 100%">
                     <span class="sr-only"><?php echo $total_payout_request_pending_rate;?>% Pending</span>
                  </div>
               </div>
               <span class="pull-right"> </span>
               <?php echo currency()." ".$total_pending_payout_request_amount;?>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Open Ticket</h6>
                     <span class="text-muted"><?php echo $total_open_ticket;?> Requests</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class=" icon-arrow-down-right32 icon-2x"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6">
            <div class="panel panel-body myclasss has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-check icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Closed Ticket</h6>
                     <span class="text-muted"><?php echo $total_closed_ticket;?></span>
                  </div>
               </div>
            </div>
         </div>
         <!--
         <div class="col-sm-6 col-md-4">
            <div class="panel panel-body bg-indigo-400 has-bg-image">
               <div class="media no-margin-top content-group">
                  <div class="media-left media-middle">
                     <i class=" icon-shield-notice icon-2x"></i>
                  </div>
                  <div class="media-body">
                     <h6 class="no-margin text-semibold">Pending Ticket</h6>
                     <span class="text-muted">5</span>
                  </div>
               </div>
            </div>
         </div>
         -->
      </div>
     
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->