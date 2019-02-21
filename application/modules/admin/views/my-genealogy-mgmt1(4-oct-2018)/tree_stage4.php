<link href="<?php echo base_url();?>user_assets/css/styles.css" rel="stylesheet" type="text/css">
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">My Genealogy Management</span> - <?php echo $title;?></h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">My Genealogy Management</li>
            <?php echo $breadcrumb;?>
         </ul>
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
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
               </div>
               <!--<form method="post" class="form-horizontal">-->                        
               <div class="panel-body">
                  <div class="row">
                     <div class="col-md-12">
					 <div id="top-tree">
                        <div class="tree">
                           <ul>
                              <li>
                                 <a href="javascript:void(0)">
                                    <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($main_user_id);?>" width="100"></p>
                                    <p><?php echo $main_user_id;?></p>
                                    <p><?php echo $main_username;?></p>
                                 </a>
                                 <ul>
                                    <li>
                                       <a
                                          <?php if(!empty($level1_user_id1))
                                             {
                                             ?>
                                          href="<?php echo site_url();?>admin/MyGenealogy1/stage4Tree/<?php echo ID_encode($level1_user_id1);?>">
										  <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id1);?>" width="100"></p>
                                          <p><?php echo (!empty($level1_username1))?$level1_username1:'No User';?></p>
                                          <p><?php echo (!empty($level1_user_id1))?$level1_user_id1:'<br>';?></p>
                                          <?php    
                                             }
                                             else
                                             {
                                             ?>
                                          href="javascript:void(0)">
										  <p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                          <p><?php echo (!empty($level1_username1))?$level1_username1:'No User';?></p>
                                          <p><?php echo (!empty($level1_user_id1))?$level1_user_id1:'<br>';?></p>
                                          <?php   
                                             } 
                                             ?>
                                          
                                       </a>
                                       <ul>
                                          <li>
                                             <a
                                                <?php if(!empty($level2_user_id1))
                                                   {
                                                   ?>
                                                href="<?php echo site_url();?>admin/MyGenealogy1/stage4Tree/<?php echo ID_encode($level2_user_id1);?>">
												<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id1);?>" width="100"></p>
                                                <p><?php echo (!empty($level2_username1))?$level2_username1:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id1))?$level2_user_id1:'<br>';?></p>
                                                <?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                href="javascript:void(0)">
												<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <p><?php echo (!empty($level2_username1))?$level2_username1:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id1))?$level2_user_id1:'<br>';?></p>
                                                <?php   
                                                   } 
                                                   ?>
                                                
                                                
                                             </a>
                                          </li>
                                          <li>
                                             <a
                                                <?php if(!empty($level2_user_id2))
                                                   {
                                                   ?>
                                                href="<?php echo site_url();?>admin/MyGenealogy1/stage4Tree/<?php echo ID_encode($level2_user_id2);?>">
												<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id2);?>" width="100"></p>
                                                <p><?php echo (!empty($level2_username2))?$level2_username2:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id2))?$level2_user_id2:'<br>';?></p>
                                                <?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                href="javascript:void(0)">
												<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <p><?php echo (!empty($level2_username2))?$level2_username2:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id2))?$level2_user_id2:'<br>';?></p>
                                                <?php   
                                                   } 
                                                   ?>
                                                
                                             </a>
                                          </li>
                                       </ul>
                                    </li>
                                    <li>
                                       <a
                                          <?php if(!empty($level1_user_id2))
                                             {
                                             ?>
                                          href="<?php echo site_url();?>admin/MyGenealogy1/stage4Tree/<?php echo ID_encode($level1_user_id2);?>">
                                          <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id2);?>" width="100"></p>
                                          <p><?php echo (!empty($level1_username2))?$level1_username2:'No User';?></p>
                                          <p><?php echo (!empty($level1_user_id2))?$level1_user_id2:'<br>';?></p>
                                          <?php    
                                             }
                                             else
                                             {
                                             ?>
                                          href="javascript:void(0)">
                                          <p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                          <p><?php echo (!empty($level1_username2))?$level1_username2:'No User';?></p>
                                          <p><?php echo (!empty($level1_user_id2))?$level1_user_id2:'<br>';?></p>
                                          <?php   
                                             } 
                                             ?>
                                       </a>
                                       <ul>
                                          <li>
                                             <a
                                                <?php if(!empty($level2_user_id3))
                                                   {
                                                   ?>
                                                href="<?php echo site_url();?>admin/MyGenealogy1/stage4Tree/<?php echo ID_encode($level2_user_id3);?>">
                                                <p> <img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id3);?>" width="100"></p>
                                                <p><?php echo (!empty($level2_username3))?$level2_username3:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id3))?$level2_user_id3:'<br>';?></p>
                                                <?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                href="javascript:void(0)">
                                                <p> <img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <p><?php echo (!empty($level2_username3))?$level2_username3:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id3))?$level2_user_id3:'<br>';?></p>
                                                <?php   
                                                   } 
                                                   ?>
                                             </a>
                                          </li>
                                          <li>
                                             <a
                                                <?php if(!empty($level2_user_id4))
                                                   {
                                                   ?>
                                                href="<?php echo site_url();?>admin/MyGenealogy1/stage4Tree/<?php echo ID_encode($level2_user_id4);?>">
                                                <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id4);?>" width="100"></p>
                                                <p><?php echo (!empty($level2_username4))?$level2_username4:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id4))?$level2_user_id4:'<br>';?></p>

                                                <?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                href="javascript:void(0)">
                                                <p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <p><?php echo (!empty($level2_username4))?$level2_username4:'No User';?></p>
                                                <p><?php echo (!empty($level2_user_id4))?$level2_user_id4:'<br>';?></p>
                                                <?php   
                                                   } 
                                                   ?>
                                             </a>
                                          </li>
                                       </ul>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
						</div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /vertical form options -->
            <!-- Footer -->
            <!-- /footer -->
         </div>
         <?php
            $this->load->view("common/footer-text");
            ?>
         <!-- /content area -->
      </div>
   </div>
</div>
<script>
   $(document).ready(function(){
   });//end ready
</script>
<style>
.tree{
	width:700px;
}
#top-tree
   {
   overflow-x: scroll;
   }
</style>