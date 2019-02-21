<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
   google.charts.load("current", {packages:['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart() {
     var data = google.visualization.arrayToDataTable([
       ["Element", "Density", { role: "style" } ],
       ["January", 8.94, "#b87333"],
       ["February", 20.94, "#b87333"],
       ["March", 10.49, "silver"],
       ["April", 19.30, "gold"],
       ["May", 12.94, "#b87333"],
       ["June", 16.94, "#b87333"],
       ["July", 19.94, "#b87333"],
       ["August", 29.94, "#b87333"],
       ["September", 22.94, "#b87333"],
       ["October", 108.94, "#b87333"],
       ["November", 95.94, "#b87333"],
       ["December", 21.45, "color: #e5e4e2"]
     ]);
   
     var view = new google.visualization.DataView(data);
     view.setColumns([0, 1,
                      { calc: "stringify",
                        sourceColumn: 1,
                        type: "string",
                        role: "annotation" },
                      2]);
   
     var options = {
       title: "Admin Wallet Graph In 2018",
       width: 1200,
       height: 400,
       bar: {groupWidth: "95%"},
       legend: { position: "none" },
     };
     var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
     chart.draw(view, options);
   }
</script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Wallet</span> - Admin Wallet Graph</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">E-Wallet</a></li>
            <li class="active">Admin Wallet Graph</li>
         </ul>
        
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Customers -->
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h6 class="panel-title">Admin Wallet Graph</h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
         <div id="columnchart_values"></div>
      </div>
      <!-- /customers -->
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->