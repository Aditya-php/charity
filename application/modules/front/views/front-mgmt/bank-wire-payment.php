<!DOCTYPE html>
<html lang="en-US" class="no-js">	
<?php 	$this->load->view('common/header');	?>
	<link rel='stylesheet' id='bootstrap-css'  href='<?php echo base_url();?>front_assets/css/sky-forms.css' type='text/css' media='all' />	<body class="home page-template page-template-page-templates page-template-template-page-vc page-template-page-templatestemplate-page-vc-php page page-id-34 woocommerce-no-js wpb-js-composer js-comp-ver-5.4.7 vc_responsive">   
	<div class="over-loader loader-live"> 
	<div class="loader">    
	<div class="loader-item style5">  
	<div class="bounce1"></div>
	<div class="bounce2"></div>   
	<div class="bounce3"></div>  
	</div>     
    </div>    
	</div>  
    <div class="wrapper-boxed">  
	<div class="site-wrapper">    
  
	<?php 	
	$this->load->view('top-nav');
	?>     

	<div class="vc_row wpb_row vc_row-fluid sec-padding section-light">  
	<div class="container">  
	<div class="card card-hero animated slideInUp animation-delay-8 mb-6"> 
	<div class="card-body">                                      
	<form action="" class="sky-form">     
	<header>Pay Via Bank Wire</header>    
	<fieldset>    
	<section>         
	<div class="row">		
	<p><b>Dear User Please Make the Payment on Below Bank Detail</b></p>	
	<br>          
    <?php   
	$account_no=(!empty($bank_wire_detail->account_no))?$bank_wire_detail->account_no:null;      
	$bank_name=(!empty($bank_wire_detail->bank_name))?$bank_wire_detail->bank_name:null;                $account_holder_name=(!empty($bank_wire_detail->account_holder_name))?$bank_wire_detail->account_holder_name:null;
     $branch_name=(!empty($bank_wire_detail->branch_name))?$bank_wire_detail->branch_name:null;        
      ?>		
	  <table class='table table-bordered table-striped table-hover'> 
	  <tr>		   
	  <td style='text-align:left'>Bank Name : </td><td> <?php echo $bank_name;?></td>	
	  </tr>		
	  <tr>           
	  <td style='text-align:left'>Account Holder Name : </td><td> <?php echo $account_holder_name;?></td>	
	  </tr>		
	  <tr>            
	  <td style='text-align:left'>Account No. : </td><td> <?php echo $account_no;?></td>	
	  </tr>
<tr>         
     <td style='text-align:left'>Branch Code. : </td><td> <?php echo $branch_name;?></td>	
	 </tr>      
	 </table>  	
	<br>
	<p>
	Capitec:<br>

CBN<br>
1479849969<br>
Link : 0737405527<br>

Lesotho:<br>

Mpesa: 50623650<br>

<b>Bitcoins: </b>
1HbhADWAMWjqs7aqf86jV5K25Ebtsmqm9N
	</p>
	 
	 <br>        
	
	 <?php       
	 echo $this->session->userdata('flash_msg');      
	 ?>     
   	 
	 </div>      
	 </section>       
	 </fieldset>     
	 </form>           
	 <hr class="dotted">        
	 </div>  
	 </div>
	 </div>    
	 </div>       
   
	 <?php 		
	 $this->load->view('common/footer');	
	 ?>         
	   
     </div>   
	 </div>     
	 <?php 	  
	 $this->load->view('common/footer-script');
	 ?>  
	 </body>
	 </html>
	 <style>form.sky-form {    font-size: 18px !important;}</style>