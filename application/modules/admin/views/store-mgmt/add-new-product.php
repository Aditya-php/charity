<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/uploader_bootstrap.js"></script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Shop</span> - Add New Product</h4>
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
            <li class="active">Add New Product</li>
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
            echo form_open(site_url()."admin/StoreManagement/addNewProduct",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
         ?>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-10">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Parent Category</label>
                     <div class="col-lg-9">
                              <select name="product_category" id="product_category" class="select-menu-color">
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
                        <span class="valid_product_category" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Product Name:</label>
                     <div class="col-lg-9">
                        <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter Product Name">
                        <span class="valid_product_name" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-lg-3 control-label">Product Price:</label>
                     <div class="col-lg-9">
                        <input type="number" min="1" name="product_price" id="product_price" class="form-control" placeholder="Enter Product Price">
                        <span class="valid_product_price" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Stock:</label>
                     <div class="col-lg-9">
                        <input type="number" min="1" type="text" name="stock" id="stock" class="form-control" placeholder="Enter Stock">
                        <span class="valid_stock" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>


                  <div class="form-group">
                     <label class="col-lg-3 control-label">Description:</label>
                     <div class="col-lg-9">
                        <textarea type="text" name="description" id="description" class="form-control"></textarea>
                        <span class="valid_description" style="color:red;font-weight:bold"></style>
                     </div>
                  </div>

                  <div class="form-group">
                     <label class="col-lg-3 control-label">Image:</label>
                     <div class="col-lg-9">
                        <input type="file" id="image" class="form-control file-input" placeholder="Select Image">
                        <span class="valid_image" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Discount(No/Yes):</label>
                     <div class="col-lg-9">
                        <input type="radio" name="discount" class="discount" value="0" checked>No
                        <input type="radio" name="discount" class="discount" value="1">Yes
                     </div>
                  </div>
                  <div id="discount_div">
                  </div>   
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Commission(No/Yes):</label>
                     <div class="col-lg-9">
                        <input type="radio" name="commission" class="commission" value="0" checked>No
                        <input type="radio" name="commission" class="commission" value="1">Yes
                        <span class="valid_commission" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>
                  <div id="commission_div">
                  </div>   
                  <div id="unlimited_level_div"> 
                  </div>   
                  <div id="limited_level_div"> 
                  </div>   
                  <div class="form-group" id="add_more_group" style="display:none">
                     <label class="col-lg-3 control-label"></label>
                     <div class="col-lg-9"><a href="#" id="add_more_level">Add More Level Commission</a></div>
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
var level=1;
$(document).ready(function(){
   $(".discount").click(function(){
      var discount=$(this).val();
      if(discount=='1')
      {
         var discount_div ='<div class="form-group">';
             discount_div +='<label class="col-lg-3 control-label">Discount Type(Percent/Flat):</label>';
             discount_div +='<div class="col-lg-9">';
             discount_div +='<input type="radio" name="discount_type" value="0" checked>Percent';
             discount_div +='<input type="radio" name="discount_type" value="1">Flat';
             discount_div +='</div>';
             discount_div +='</div>';
             discount_div +='<div class="form-group">';
             discount_div +='<label class="col-lg-3 control-label">Discount Amount:</label>';
             discount_div +='<div class="col-lg-9">';
             discount_div +='<input type="number" min="1" name="discount_amount" id="discount_amount" class="form-control" placeholder="Enter Discount Amount">';
             discount_div +='<span class="valid_discount_amount" style="color:red;font-weight:bold"></span>'
             discount_div +='</div>';
             discount_div +='</div>';
         $("#discount_div").append(discount_div);    
      }
      else 
      {
          $("#discount_div").children().remove();    

      }
   });//end discount click here
   ///////////////////////////////////////////////////////
   $(".commission").click(function(){
      var commission=$(this).val();
      if(commission=='1')
      {
          //level_type==0=>unlimited, level_type==1=>limited 
          var commission_div ='<div class="form-group">';
              commission_div +='<label class="col-lg-3 control-label">Commission Type(Percent/Flat):</label>';
              commission_div +='<div class="col-lg-9">';
              commission_div +='<input type="radio" name="commission_type" value="0" checked>Percent';
              commission_div +='<input type="radio" name="commission_type" value="1">Flat';
              commission_div +='</div>';
              commission_div +='</div>';
              commission_div ='<div class="form-group">';
              commission_div +='<label class="col-lg-3 control-label">Level Type(Unlimited/Limited):</label>';
              commission_div +='<div class="col-lg-9">';
              commission_div +='<input type="radio" class="level_type" name="commission_type" value="0" checked>Unlimited';
              commission_div +='<input type="radio" class="level_type" name="commission_type" value="1">Limited';
              commission_div +='</div>';
              commission_div +='</div>';              

         $("#commission_div").append(commission_div);    

            var unlimited_level_div='<div class="form-group">';
            unlimited_level_div +='<label class="col-lg-3 control-label">Commission:</label>';
            unlimited_level_div +='<div class="col-lg-9">';
            unlimited_level_div +='<input type="number" min="0" name="commission_amount" id="commission_amount" class="form-control" placeholder="Commission">';
            unlimited_level_div +='<span class="valid_commission_amount" style="color:red;font-weight:bold"></span>';
            unlimited_level_div +='</div>';
            unlimited_level_div +='</div>';
            $("#unlimited_level_div").html(unlimited_level_div);

      }
      else 
      {
          $("#commission_div").children().remove();    

      }
   });//end commission click here
////////////////////////////

      /////////Level type code start from here/////////////////////


      $(document).on('click','input[class=level_type]',function(){


         var level_type=$(this).val();
         //level_type==0=>unlimited, level_type==1=>limited 
         if(level_type==0)
         {
            var unlimited_level_div='<div class="form-group">';
            unlimited_level_div +='<label class="col-lg-3 control-label">Commission:</label>';
            unlimited_level_div +='<div class="col-lg-9">';
            unlimited_level_div +='<input type="number" min="0" name="commission_amount" id="commission_amount" class="form-control" placeholder="Commission">';
            unlimited_level_div +='<span class="valid_commission_amount" style="color:red;font-weight:bold"></span>';
            unlimited_level_div +='</div>';
            unlimited_level_div +='</div>';
            $("#unlimited_level_div").html(unlimited_level_div);
            $("#add_more_group").css('display','none');
            $("#limited_level_div").children().remove();
            level=1;
         }
         else 
         {
            var limited_level_div='<div class="form-group">';
            limited_level_div +='<label class="col-lg-3 control-label">Level1:</label>';
            limited_level_div +='<div class="col-lg-9">';
            limited_level_div +='<input type="number" min="0" name="level_commission[]" class="form-control" placeholder="Level 1 Commission">';
            limited_level_div +='</div>';
            limited_level_div +='</div>';
            $("#limited_level_div").html(limited_level_div);
            $("#add_more_group").css('display','');
            $("#unlimited_level_div").children().remove();
         }
      })//end of level type click 
      $("#add_more_level").click(function(){
            level++;
            var limited_level_div='<div class="form-group level_group" id="level_'+level+'">';
            limited_level_div +='<label class="col-lg-3 control-label level_label">Level '+level+':</label>';
            limited_level_div +='<div class="col-lg-9">';
            limited_level_div +='<input type="number" min="0" name="level_commission[]" class="form-control level_input" placeholder="Level '+level+' Commission">';
            limited_level_div +='<a href="#" class="remove_level_click" onclick="return remove_level('+level+')">Remove</a></div>';
            limited_level_div +='</div>';
            $("#limited_level_div").append(limited_level_div);
            return false;
      });//end add more level click here
      /////////////////////////////////////////////////////////////
      //////////Validation code start from here
      $("#btn").click(function(){

           if($("#product_name").val()=="")
           {
            $(".valid_product_name").text('Please enter product name!');
            $("#product_name").focus();
            return false;
           }

           if($("#product_price").val()=="")
           {
            $(".valid_product_price").text('Please enter product price!');
            $("#product_price").focus();
            return false;
           }

           if($("#stock").val()=="")
           {
            $(".valid_stock").text('Please enter stock!');
            $("#stock").focus();
            return false;
           }

           if($("#image").val()=="")
           {
            $(".valid_image").text('Please select image!');
            $("#image").focus();
            return false;
           }

           if($("#discount_amount").val()=="")
           {
            $(".valid_discount_amount").text('Please enter discount amount!');
            $("#discount_amount").focus();
            return false;
           }


           if($("#commission_amount").val()=="")
           {
            $(".valid_commission_amount").text('Please enter commission amount!');
            $("#commission_amount").focus();
            return false;
           }


           return true;
      });
   ///////////////////////////////
   $("#product_name").keyup(function(){
      if($(this).val().length>0){
         $(".valid_product_name").text('');
      }
   });

   $("#product_price").keyup(function(){
      var product_price=$(this).val();
      if($(this).val()=='' || $(this).val()<1 || $(this).val()==0 || isNaN($(this).val()))
      {
         $("#product_price").val('');
         $(".valid_product_price").text('Please enter valid product price!');
      }
      else 
      {
         $(".valid_product_price").text('');
      }
   });

   $("#product_price").change(function(){
      $(".valid_product_price").text('');
   });

   $("#stock").keyup(function(){
      var stock=$(this).val();
      if($(this).val()=='' || $(this).val()<1 || $(this).val()==0 || isNaN($(this).val()))
      {
         $("#stock").val('');
         $(".valid_stock").text('Please enter valid stock!');
      }
      else 
      {
         $(".valid_stock").text('');
      }
   });

   $("#stock").change(function(){
      $(".valid_stock").text('');
   });
   $("#image").change(function(){
      if($(this).val().length>0)
      {
         $(".valid_image").text('');
      }
   });
   $(document).on('keyup','#discount_amount',function(){
      if($(this).val()=='' || $(this).val()<1 || $(this).val()==0 || isNaN($(this).val()))
      {
         $("#discount_amount").val('');
         $(".valid_discount_amount").text('Please enter valid stock!');
      }
      else 
      {
         $(".valid_discount_amount").text('');
      }
   });
   $(document).on("change","#discount_amount",function(){
      $(".valid_discount_amount").text('');
   });


   $(document).on('keyup','#commission_amount',function(){
      //alert("call");
      if($(this).val()=='' || $(this).val()<1 || $(this).val()==0 || isNaN($(this).val()))
      {
         $("#commission_amount").val('');
         $(".valid_commission_amount").text('Please enter valid commission!');
      }
      else 
      {
         $(".valid_commission_amount").text('');
      }
   });
   $(document).on("change","#commission_amount",function(){
      $(".valid_commission_amount").text('');
   });


});//end ready
function remove_level(levels)
   {
     $("#level_"+levels).remove();
     /////////////////
     level=1; 
     $('.level_label').each(function(){
       level++;
       $(this).html("level"+level+":");
     });
     ////////////////
     level=1;
     $(".level_group").each(function(){
       level++;
       $(this).attr('id',"level_"+level);
     });
     //////////////////
     level=1;
     $(".level_input").each(function(){
        level++;
        $(this).attr("placeholder","Level "+level+" Commission");
     });
     ////////////////////
     level=1;
     $(".remove_level_click").each(function(){
      level++;
      $(this).attr('onclick',"return remove_level("+level+")");
     });
     return false;
   }
</script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/form_select2.js"></script>
<script>
   CKEDITOR.replace('description');
</script>
<style>
   input[type="radio"]{
   border: 5px solid;
   border-color: grey;
   width: 20px;
   height: 20px;
   border-radius: 100%;
   }
</style>