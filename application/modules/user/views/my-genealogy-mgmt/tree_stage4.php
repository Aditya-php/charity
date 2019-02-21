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
            <li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
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
                                       
                                          <?php if(!empty($level1_user_id1))
                                             {
                                             ?>
                                         <a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level1_user_id1);?>">
										 
										 <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id1);?>" width="100"></p>
                                          <?php    
                                             }
                                             else
                                             {
                                             ?>
                                          <a href="javascript:void(0)">
										  <p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                          <?php   
                                             } 
                                             ?>
                                          
                                          
                                          <p><?php echo (!empty($level1_username1))?$level1_username1:'No User on level user1';?></p>
                                          <p><?php echo (!empty($level1_user_id1))?$level1_user_id1:'<br>';?></p>
                                       </a>
                                       <ul>
                                          <li>
                                                <?php if(!empty($level2_user_id1))
                                                   {
                                                   ?>
                                                <a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level2_user_id1);?>">
												 
												 <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id1);?>" width="100"></p>
                                                <?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                <a href="javascript:void(0)">
												 
												 <p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <?php   
                                                   } 
                                                   ?>
                                               
                                                <p><?php echo (!empty($level2_username1))?$level2_username1:'No User on leve2 user1';?></p>
                                                <p><?php echo (!empty($level2_user_id1))?$level2_user_id1:'<br>';?></p>
                                             </a>
											 <ul>
												<li>
														<?php if(!empty($level3_user_id1))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id1);?>">
														
														<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id1);?>" width="100"></p>
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														<p><?php echo (!empty($level3_username1))?$level3_username1:'No User on level3 user1';?></p>
														<p><?php echo (!empty($level3_user_id1))?$level3_user_id1:'<br>';?></p>
													 </a>
											 </li>
											 <li>
														<?php if(!empty($level3_user_id2))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id2);?>">
														<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id2);?>" width="100"></p>
														
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														<p><?php echo (!empty($level3_username2))?$level3_username2:'No User on level3 user2';?></p>
														<p><?php echo (!empty($level3_user_id2))?$level3_user_id2:'<br>';?></p>
													 </a>
											 </li>
											 
											 </ul>
                                          </li>
                                          <li>
                                            
                                                <?php if(!empty($level2_user_id2))
                                                   {
                                                   ?>
                                                 <a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level2_user_id2);?>">
												 
												  <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id2);?>" width="100"></p>
                                                <?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                <a href="javascript:void(0)">
												
												<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <?php   
                                                   } 
                                                   ?>
                                                
                                               
                                                <p><?php echo (!empty($level2_username2))?$level2_username2:'No User on level2 user2';?></p>
                                                <p><?php echo (!empty($level2_user_id2))?$level2_user_id2:'<br>';?></p>
                                             </a>
											 <ul>
												<li>
													 
														<?php if(!empty($level3_user_id3))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id3);?>">
														
														<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id3);?>" width="100"></p>
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														<p><?php echo (!empty($level3_username3))?$level3_username3:'No User on level3 user3';?></p>
														<p><?php echo (!empty($level3_user_id3))?$level3_user_id3:'<br>';?></p>
													 </a>
												</li>
												<li>
													 
														<?php if(!empty($level3_user_id4))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id4);?>">
														
														<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id4);?>" width="100"></p>
														
														
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														<p><?php echo (!empty($level3_username4))?$level3_username4:'No User on level3 user4';?></p>
														<p><?php echo (!empty($level3_user_id4))?$level3_user_id4:'<br>';?></p>
													 </a>
												</li>
												
											 </ul>
                                          </li>
                                       </ul>
                                    </li>
                                    <li>
                                       
                                          <?php if(!empty($level1_user_id2))
                                             {
                                             ?>
                                          <a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level1_user_id2);?>">
										  
										  <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id2);?>" width="100"></p>
                                          <?php    
                                             }
                                             else
                                             {
                                             ?>
                                          <a href="javascript:void(0)">
										  
										  <p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                          <?php   
                                             } 
                                             ?>
                                          
                                          <p><?php echo (!empty($level1_username2))?$level1_username2:'No User on level1 user2';?></p>
                                          <p><?php echo (!empty($level1_user_id2))?$level1_user_id2:'<br>';?></p>
                                       </a>
                                       <ul>
                                          <li>
                                             
                                                <?php if(!empty($level2_user_id3))
                                                   {
                                                   ?>
                                                <a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level2_user_id3);?>">
                                                <p> <img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id3);?>" width="100"></p>
												
												<?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                                <a href="javascript:void(0)">
												<p> <img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <?php   
                                                   } 
                                                   ?>
                                                
                                                <p><?php echo (!empty($level2_username3))?$level2_username3:'No User level2 user3';?></p>
                                                <p><?php echo (!empty($level2_user_id3))?$level2_user_id3:'<br>';?></p>
                                             </a>
											 <ul>
													<li>
													 
														<?php if(!empty($level3_user_id5))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id5);?>">
														<p> <img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id5);?>" width="100"></p>
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														<p> 
														<img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														<p><?php echo (!empty($level3_username5))?$level3_username5:'No User level3 user5';?></p>
														<p><?php echo (!empty($level3_user_id5))?$level3_user_id5:'<br>';?></p>
													 </a>
													</li>
													<li>
													 
														<?php if(!empty($level3_user_id6))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id6);?>">
														
														<p> <img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id6);?>" width="100"></p>
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														
														<p> <img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														<p><?php echo (!empty($level3_username6))?$level3_username6:'No User level3 user6';?></p>
														<p><?php echo (!empty($level3_user_id6))?$level3_user_id6:'<br>';?></p>
													 </a>
													</li>
											 
											 
											 </ul>
                                          </li>
                                          <li>
                                             
                                                <?php if(!empty($level2_user_id4))
                                                   {
                                                   ?>
                                                <a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level2_user_id4);?>">
												 <p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level2_user_id4);?>" width="100"></p>
												
                                                <?php    
                                                   }
                                                   else
                                                   {
                                                   ?>
                                               <a href="javascript:void(0)">
											    <p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
                                                <?php   
                                                   } 
                                                   ?>
                                               
                                                <p><?php echo (!empty($level2_username4))?$level2_username4:'No User on level2 user4';?></p>
                                                <p><?php echo (!empty($level2_user_id4))?$level2_user_id4:'<br>';?></p>
                                             </a>
											 <ul>
												<li>
													 
														<?php if(!empty($level3_user_id7))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id7);?>">
														<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id7);?>" width="100"></p>
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														
														<p><?php echo (!empty($level3_username7))?$level3_username7:'No User on level3 user7';?></p>
														<p><?php echo (!empty($level3_user_id7))?$level3_user_id7:'<br>';?></p>
													 </a>
												</li>
												<li>
													 
														<?php if(!empty($level3_user_id8))
														   {
														   ?>
														<a href="<?php echo site_url();?>user/MyGenealogy1/stage1Tree/<?php echo ID_encode($level3_user_id8);?>">
														<p><img src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level3_user_id8);?>" width="100"></p>
														<?php    
														   }
														   else
														   {
														   ?>
														<a href="javascript:void(0)">
														<p><img src="<?php echo base_url();?>images/male.jpg" width="100"></p>
														<?php   
														   } 
														   ?>
														
														<p><?php echo (!empty($level3_username8))?$level3_username8:'No User on level3 user8';?></p>
														<p><?php echo (!empty($level3_user_id8))?$level3_user_id8:'<br>';?></p>
													 </a>
												</li>
												
											 </ul>
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
   .tree li a
   {
   padding:0px;
   }
   #top-tree
   {
   height: 700px;
   overflow-x: scroll;
   overflow-y: scroll;
   }
   .tree
   {
   width:1300px;  
   }
</style>