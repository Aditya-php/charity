<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Shop</span> - Categories Management</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Store Management</a></li>
            <li class="active">Categories Management</li>
         </ul>
         <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="icon-gear position-left"></i>
               Settings
               <span class="caret"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <?php 
      if(!empty($this->session->flashdata('flash_msg')))
      {
      ?>
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <!--<span class="text-semibold">Well done!</span> Message is sent successfully-->
         <?php echo $this->session->flashdata('flash_msg');?>
      </div>
      <?php    
      }
      ?>
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Add New Category</h5>
         </div>
         <?php 
            echo form_open(site_url()."admin/StoreManagement/addProductCategory",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
            ?>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-10">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Parent Category</label>
                     <div class="col-lg-9">
                              <select name="parent_id" id="parent_id" class="select-menu-color">
                                 <option value="">-Select Parent Category-</option>
                                 <!--
                                 <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="WY">Wyoming</option>
                                 </optgroup>
                                 -->
                                 <?php 
                                 if(!empty($all_shop_category) && count($all_shop_category)>0)
                                 {
                                    foreach ($all_shop_category as $category) 
                                    {
                                       if(!empty($category->child) && count($category->child)>0)
                                       {

                                 ?>
                                    <optgroup label="<?php echo $category->category_name;?>">
                                       <?php 
                                       if(!empty($category_id) && $category->id==$category_id)
                                       {
                                       ?>
                                        <option selected value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                                       <?php    
                                       }
                                       else 
                                       {
                                       ?>
                                       <option value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                                       <?php   
                                       }
                                       foreach ($category->child as $child) 
                                       {
                                          if(!empty($category_id) && $child->id==$category_id)
                                          {

                                       ?>
                                      <option selected value="<?php echo $child->id;?>"><?php echo $child->category_name;?></option>
                                       <?php      
                                          }
                                          else 
                                          {
                                       ?>
                                       <option value="<?php echo $child->id;?>"><?php echo $child->category_name;?></option>
                                       <?php      
                                          }
                                       }
                                       ?>
                                  </optgroup>  
                                 <?php      
                                       }
                                       else 
                                       {
                                          if(!empty($category_id) && $category->id==$category_id)
                                          {
                                       ?>
                                         <option selected value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                                       <?php       

                                          }
                                          else 
                                          {
                                       ?>
                                         <option value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                                       <?php      
                                          }
                                       }
                                    }//end foreach
                                 }//end if
                                 ?>
                              </select>
                        <span class="valid_users" style="color:red;font-weight:bold"></style>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Category Name:</label>
                     <div class="col-lg-9">
                        <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Here">
                        <span class="valid_category_name" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>
                  
                  <div class="text-right">
                     <button type="submit" name="btn" id="btn" value="send" class="btn btn-primary">Add<i class="icon-arrow-right14 position-right"></i></button>
                  </div>
               </div>
            </div>
         </div>
         <?php echo form_close();?>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
$(document).ready(function(){
   $("#btn").click(function(){
      if($("#category_name").val()=="")
      {
         $(".valid_category_name").text("Please enter category name!");
         $("#category_name").focus();
         return false;
      }
      return true;
   });//end btn click
   $("#category_name").keyup(function(){
     if($(this).val().length>0)
     {
      $(".valid_category_name").text('');
     }
   });//end keyup
});//end ready
</script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/form_select2.js"></script>
