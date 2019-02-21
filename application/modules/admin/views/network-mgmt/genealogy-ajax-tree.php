<div class="binary-genealogy-tree binary_tree_extended">
                        <div class="binary-genealogy-level-0 clearfix">
                           <div class="no_padding parent-wrapper clearfix">
                              <div class="node-centere-item binary-level-width-100">
								 <!--main root start from here-->
                                 <?php
								 $rootImage=base_url().'images/user_small.png';
								 ?>
								 <!--root-->
								 <div class="node-item-root root">
                                    <div class="binary-node-single-item user-block user-0">
                                       <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $rootImage;?>" width="70" height="70" alt="business.admin" title="business.admin"></a></div>
                                       <span class="wrap_content "><a href="#"></a><a href=""><?php echo $root_object->username;?></a></span>
                                       <?php
									   echo getPopupContent($root_object);
									   ?>
                                    </div>
                                 </div>
								 <!--main root end over here-->
								 <!--child element of main root start from here-->
                                 <div class="parent-wrapper clearfix">
                                    <div class="node-left-item binary-level-width-50">
                                       <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
										 <?php
										 $rootImage=base_url().'images/user_small.png';
										 ?>
										 <!--root_left-->
                                       <?php
									   if(!empty($root_left_object))
									   {
									   ?>
									   <div class="node-item-1-child-left  node-item-root root_left">
                                          <div class="binary-node-single-item user-block user-1">
                                             <div class="images_wrapper"><a href="http://binary.epixelmlmsoftware.com/user/12"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/user_small.png" width="70" height="70" alt="mlm.member" title="mlm.member"></a></div>
                                             <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_left_object->username;?></a></span>
                                             <?php
											 echo getPopupContent($root_left_object);
											 ?>
                                          </div>
                                       </div>
									   <?php
									   }
									   else
									   {
									   ?>
									   <!---->
                                       <div class="node-item-1-child-left root_left">
                                          <div class="binary-node-single-item user-block user-1">
                                               
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                          </div>
										  <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                       </div>
									   <?php
									   }//end if else
									   if(!empty($root_left_object))
									   {
									   ?>
                                       <div class="parent-wrapper clearfix">
                                          <div class="node-left-item binary-level-width-25">
                                             <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-12"></span>
											 <?php
											 $root_left_left_image=base_url().'images/user_small.png';
											 ?>
											 <!--root_left_left-->
											 <?php
											 if(!empty($root_left_left_object))
											 {
											 ?>
											 <div class="node-item-2-child-left node-item-root  root_left_left">
                                                <div class="binary-node-single-item user-block user-3">
                                                   <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_left_left_image;?>" width="70" height="70" alt="<?php echo $root_left_left_object->username;?>" title="<?php echo $root_left_left_object->username;?>"></a></div>
                                                   <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_left_left_object->username;?></a></span>
                                                  <?php
												   echo getPopupContent($root_left_left_object);
												  ?>
                                                </div>
                                             </div>
											 <?php
											 }
											 else
											 {
											 ?>
                                            <div class="node-item-2-child-left root_left_left">
                                                <div class="binary-node-single-item user-block user-3">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                </div>
												<div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                             </div>
											 <?php
											 }
											 if(!empty($root_left_left_object))
											 {
											 ?>
                                             <div class="parent-wrapper clearfix">
                                                <div class="node-left-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                                   <!--root_left_left_left-->
													 <?php
													 $root_left_left_left_object_image=base_url().'images/user_small.png';
													 ?>
													 <?php
													 if(!empty($root_left_left_left_object))
													 {
													 ?>
												   <div class="node-item-1-child-left root_left_left_left">
                                                      <div class="binary-node-single-item user-block user-7">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_left_left_left_object_image;?>" width="70" height="70" alt="<?php echo $root_left_left_left_object->username;?>" title="<?php echo $root_left_left_left_object->username;?>"></a></div>
                                                         <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_left_left_left_object->username;?></a></span>
                                                        <?php
														echo getPopupContent($root_left_left_left_object);
														?>
                                                      </div>
                                                      <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_left_left_left_object->user_id;?>',this)"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
                                                   <div class="node-item-1-child-left root_left_left_left">
                                                      <div class="binary-node-single-item user-block user-7">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
                                                      <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                                <div class="node-right-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-right binary-hr-line-width-25"></span>
												   <!--root_left_left_right-->
													 <?php
													 $root_left_left_right_object_image=base_url().'images/user_small.png';
													 ?>
													 <?php
													 if(!empty($root_left_left_right_object))
													 {
													 ?>
												   <div class="node-item-1-child-right root_left_left_right">
                                                      <div class="binary-node-single-item user-block user-8">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_left_left_right_object_image;?>" width="70" height="70" alt="<?php echo $root_left_left_right_object->username;?>" title="<?php echo $root_left_left_right_object->username;?>"></a></div>
                                                         <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_left_left_right_object->username;?></a></span>
                                                        <?php
														echo getPopupContent($root_left_left_right_object);
														?>
                                                      </div>
                                                      <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_left_left_right_object->user_id;?>',this)"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
												   <div class="node-item-1-child-right root_left_left_right">
                                                      <div class="binary-node-single-item user-block user-8">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
                                                       <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                             </div>											 
											 <?php
											 }
											 ?>
                                          </div>
                                          <div class="node-right-item binary-level-width-25">
                                             <span class="binary-hr-line binar-hr-line-right binary-hr-line-width-12"></span>
											 <!--root_left_right-->
											 <?php
											 $root_left_right_image=base_url().'images/user_small.png';
											 ?>
											 <?php
											 if(!empty($root_left_right_object))
											 {
											 ?>
											 <div class="node-item-2-child-right node-item-root  root_left_right">
                                                <div class="binary-node-single-item user-block user-4">
                                                   <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_left_right_image;?>" width="70" height="70" alt="<?php echo $root_left_right_object->username;?>" title="<?php echo $root_left_right_object->username;?>"></a></div>
                                                   <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_left_right_object->username;?></a></span>
                                                   <?php
												  echo getPopupContent($root_left_right_object);
												   ?>
                                                </div>
                                             </div>
											 <?php
											 }
											 else
											 {
											 ?>
											 <div class="node-item-2-child-right root_left_right">
                                                <div class="binary-node-single-item user-block user-4">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                </div>
												 <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                             </div>
											 <?php
											 }
											 if(!empty($root_left_right_object))
											 {
											 ?>
											 <div class="parent-wrapper clearfix">
                                                <div class="node-left-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
												     <!--root_left_right_left-->
													 <?php
													 $root_left_right_left_object_image=base_url().'images/user_small.png';
													 ?>
													 <?php
													 if(!empty($root_left_right_left_object))
													 {
													 ?>
													 <div class="node-item-1-child-left  root_left_right_left">
                                                      <div class="binary-node-single-item user-block user-9">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_left_right_left_object_image;?>" width="70" height="70" alt="<?php echo $root_left_right_left_object->username;?>" title="<?php echo $root_left_right_left_object->username;?>"></a></div>
                                                         <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_left_right_left_object->username;?></a></span>
                                                         <?php
														 echo getPopupContent($root_left_right_left_object);
														 ?>
                                                      </div>
                                                      <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_left_right_left_object->user_id;?>',this)"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
                                                    <div class="node-item-1-child-left  root_left_right_left">
                                                      <div class="binary-node-single-item user-block user-9">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
                                                       <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                                <div class="node-right-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-right binary-hr-line-width-25"></span>
												   <!--root_left_right_right-->
													 <?php
													 $root_left_right_right_object_image=base_url().'images/user_small.png';
													 ?>
													 <?php
													 if(!empty($root_left_right_right_object))
													 {
													 ?>
												   <div class="node-item-1-child-right  root_left_right_right">
                                                      <div class="binary-node-single-item user-block user-10">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_left_right_right_object_image;?>" width="70" height="70" alt="<?php echo $root_left_right_right_object->username;?>" title="<?php echo $root_left_right_right_object->username;?>"></a></div>
                                                         <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_left_right_right_object->username;?></a></span>
                                                         <?php
														 echo getPopupContent($root_left_right_right_object);
														 ?>
                                                      </div>
                                                      <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_left_right_right_object->user_id;?>',this)"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
												   <div class="node-item-1-child-right  root_left_right_right">
                                                      <div class="binary-node-single-item user-block user-10">
                                                        <div class="binary-node-single-item user-block user-12">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
                                                       <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                             </div>
											 <?php 
											 }
											 ?>
											 </div>
                                       </div>
									   <?php
									   }
									   ?>
									   
									   <!---->
                                      </div>
									
                                    <!---right part start from here-->
									<div class="node-right-item binary-level-width-50">
                                       <span class="binary-hr-line binar-hr-line-right binary-hr-line-width-25"></span>
									   <!--root_right-->
										 <?php
										$root_right_object_image=base_url().'images/user_small.png';
										 ?>
									   <?php
									   if(!empty($root_right_object))
									   {
									   ?>
									   <div class="node-item-1-child-right  node-item-root root_right">
                                          <div class="binary-node-single-item user-block user-2">
                                             <div class="images_wrapper"><a href="http://binary.epixelmlmsoftware.com/user/13"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/user_small.png" width="70" height="70" alt="second.memeber" title="second.memeber"></a></div>
                                             <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_right_object->username;?></a></span>
                                             <?php
											  echo getPopupContent($root_right_object,"right_tooltip");
											 ?>
                                          </div>
                                       </div>
									   <?php
									   }
									   else
									   {
									   ?>
									   <div class="node-item-1-child-right root_right">
                                          <div class="binary-node-single-item user-block user-2">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                          </div>
										   <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                       </div>
									   <?php
									   }
									   if(!empty($root_right_object))
									   {
									   ?>
									   <div class="parent-wrapper clearfix">
                                          <div class="node-left-item binary-level-width-25">
                                             <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-12"></span>
											 <!--root_right_left-->
											 <?php
											 $root_right_left_object_image=base_url().'images/user_small.png';
											 ?>
											 <?php
											 if(!empty($root_right_left_object))
											 {
											 ?>
											 <div class="node-item-2-child-left node-item-root root_right_left">
                                                <div class="binary-node-single-item user-block user-5">
                                                   <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_right_left_object_image;?>" width="70" height="70" alt="<?php echo $root_right_left_object->username;?>" title="<?php echo $root_right_left_object->username;?>"></a></div>
                                                   <span class="wrap_content "><a href="#"></a><a href=""><?php echo $root_right_left_object->username;?></a></span>
                                                  <?php
												  echo getPopupContent($root_right_left_object,"right_tooltip");
												  ?>
                                                </div>
                                             </div>
											 <?php
											 }
											 else
											 {
											 ?>
											 <div class="node-item-2-child-left root_right_left">
                                                <div class="binary-node-single-item user-block user-5">
                                                  <div class="binary-node-single-item user-block user-12">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                </div>
												 <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                             </div>
											 <?php
											 }
											 if(!empty($root_right_left_object))
											 {
											 ?>
											 <div class="parent-wrapper clearfix">
                                                <div class="node-left-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
												   <!--root_right_left_left-->
													 <?php
													 $root_right_left_left_object_image=base_url().'images/user_small.png';
													 ?>
													 <?php
													 if(!empty($root_right_left_left_object))
													 {
													 ?>
												   <div class="node-item-1-child-left root_right_left_left">
                                                      <div class="binary-node-single-item user-block user-11">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_right_left_left_object_image;?>" width="70" height="70" alt="<?php echo $root_right_left_left_object->username;?>" title="<?php echo $root_right_left_left_object->username;?>"></a></div>
                                                        <span class="wrap_content "><a href="#"></a><a href=""><?php echo $root_right_left_left_object->username;?></a></span>
													  <?php
													  echo getPopupContent($root_right_left_left_object,"right_tooltip");
													  ?>
                                                      </div>
													  <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_right_left_left_object->user_id;?>',this)"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
                                                   <div class="node-item-1-child-left root_right_left_left">
                                                      <div class="binary-node-single-item user-block user-11">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
													   <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                                <div class="node-right-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-right binary-hr-line-width-25"></span>
                                                   <!--root_right_left_right-->
													 <?php
													 $root_right_left_right_object_image=base_url().'images/user_small.png';
													 ?>
													 <?php
													 if(!empty($root_right_left_right_object))
													 {
													 ?>
												   <div class="node-item-1-child-right root_right_left_right">
                                                      <div class="binary-node-single-item user-block user-12">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_right_left_right_object_image;?>" width="70" height="70" alt="<?php echo $root_right_left_right_object->username;?>" title="<?php echo $root_right_left_right_object->username;?>"></a></div>
                                                        <span class="wrap_content "><a href="#"></a><a href=""><?php echo $root_right_left_right_object->username;?></a></span>
													  <?php
													  echo getPopupContent($root_right_left_right_object,"right_tooltip");
													  ?>
                                                      </div>
                                                       <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_right_left_right_object->user_id;?>',this)"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
												   <div class="node-item-1-child-right root_right_left_right">
                                                      <div class="binary-node-single-item user-block user-12">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
                                                       <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                             
											 <?php 
											 }
											 ?>
                                             </div>
                                          </div>
                                          <div class="node-right-item binary-level-width-25">
                                             <span class="binary-hr-line binar-hr-line-right binary-hr-line-width-12"></span>
											<!--root_right_right-->
											 <?php
											 $root_right_right_object_image=base_url().'images/user_small.png';
											 ?>
											 <?php
											 if(!empty($root_right_right_object))
											 {
											 ?>
											<div class="node-item-2-child-right node-item-root root_right_right">
                                                <div class="binary-node-single-item user-block user-6">
                                                   <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_right_right_object_image;?>" width="70" height="70" alt="<?php echo $root_right_right_object->username;?>" title="<?php echo $root_right_right_object->username;?>"></a></div>
                                                   <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_right_right_object->username;?></a></span>
                                                   <?php
												   echo getPopupContent($root_right_right_object,"right_tooltip");
												   ?>
                                                </div>
                                             </div>
											 <?php
											 }
											 else
											 {
											 ?>
											 <div class="node-item-2-child-right root_right_right">
                                                <div class="binary-node-single-item user-block user-6">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                </div>
												<div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                             </div>
											 <?php
											 }
											 if(!empty($root_right_right_object))
											 {
											 ?>
											 <div class="parent-wrapper clearfix">
                                                <div class="node-left-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                                 <!-- root_right_right_left-->
												 <!--root_right_right_left-->
												 <?php
												 $root_right_right_left_object_image=base_url().'images/user_small.png';
												 ?>
												 <?php
												 if(!empty($root_right_right_left_object))
												 {
												 ?>
												 <div class="node-item-1-child-left  root_right_right_left">
                                                      <div class="binary-node-single-item user-block user-13">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_right_right_left_object_image;?>" width="70" height="70" alt="<?php echo $root_right_right_left_object->username;?>" title="<?php echo $root_right_right_left_object->username;?>"></a></div>
                                                        <span class="wrap_content "><a href="#"></a><a href=""><?php echo $root_right_right_left_object->username;?></a></span>
													  <?php
													  echo getPopupContent($root_right_right_left_object,"right_tooltip");
													  ?>
                                                      </div>
                                                       <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_right_right_left_object->user_id;?>',this)"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
												    <div class="node-item-1-child-left  root_right_right_left">
                                                      <div class="binary-node-single-item user-block user-13">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
                                                       <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                                <div class="node-right-item binary-level-width-50">
                                                   <span class="binary-hr-line binar-hr-line-right binary-hr-line-width-25"></span>
                                                  <!--root_right_right_right-->
													 <?php
													 $root_right_right_right_object_image=base_url().'images/user_small.png';
													 ?>
													 <?php
													 if(!empty($root_right_right_right_object))
													 {
													 ?>
												  <div class="node-item-1-child-right root_right_right_right">
                                                      <div class="binary-node-single-item user-block user-14">
                                                         <div class="images_wrapper"><a href="#"><img class="profile-rounded-image-small" src="<?php echo $root_right_right_right_object_image;?>" width="70" height="70" alt="<?php echo $root_right_right_right_object->username;?>" title="<?php echo $root_right_right_right_object->username;?>"></a></div>
                                                         <span class="wrap_content "><a href="#"></a><a href="#"><?php echo $root_right_right_right_object->username;?></a></span>
                                                        <?php
														echo getPopupContent($root_right_right_right_object,"right_tooltip");
														?>
                                                      </div>
                                                      <div class="last_level_user" onclick="trigger_click('<?php echo site_url();?>',event.target,'<?php echo $root_right_right_right_object->user_id;?>',this);"><i class="fa fa-plus-square-o fa-2x"></i></div>
                                                   </div>
												   <?php
												   }
												   else
												   {
												   ?>
												   <div class="node-item-1-child-right root_right_right_right">
                                                      <div class="binary-node-single-item user-block user-14">
											  <?php 
											  echo showAddNewMemberOption($module_name);
											  ?>

                                                      </div>
                                                      <div class="last_level_user"><i class="fa fa-2x">&nbsp;</i></div>
                                                   </div>
												   <?php
												   }
												   ?>
                                                </div>
                                            
											 <?php 
											 }
											 ?>
                                              </div>
                                          </div>
                                       </div>
                                    
									   <?php 
									   }
									   ?>
                                       </div>
                                 </div><!--end root right-->
								 <!--child element of main root start from here-->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>