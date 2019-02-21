<div class="binary-genealogy-tree stright-line">
                                       <div class="binary-genealogy-level-0 clearfix">
                                          <div class="parent-wrapper new_wrapper clearfix">
                                             <div class="node-centere-item binary-level-width-100">
                                              <?php 
                                              $root_member_image=(!empty($root->image))?$root->image:'user_small.png';
                                              ?>
												                      <div class="node-item-root main-member">
                                                   <div data-gid="3" onmouseover="trigger_hover(this)"  class="binary-node-single-item user-block " id="user_block_<?php echo $root->user_id;?>">
                                                      <div class="images_wrapper">
                                                         <a href="/afl/genealogy-tree/1"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($root->user_id);?>" width="70" height="70" alt="business.admin" title="business.admin" /></a>
                                                      </div>
                                                      <span class="wrap_content"> <a href="/user/<?php echo $root->user_id;?>"><?php echo $root->username;?>
                                                      (<?php echo $root->user_id;?>)</a></span>
                                                      <div class="pop-up-content">
                                                         <div class="profile_tooltip_pick">
                                                            
                                                            <h2>
                                                               <a href="/user/<?php echo $root->user_id;?>"><?php echo $root->username;?>(<?php echo $root->user_id;?>)</a>
                                                            </h2>
                                                            <div class="genology-view">
                                                               <a href="/afl/genealogy-tree/1"><i class="fa fa-sitemap"></i></a>
                                                            </div>
                                                         </div>
                                                         
                                                         <div class="rank_area">
                                                            <dl class="created-dl">
                                                               <dt><i class="fa fa-clock-o"></i></dt>
                                                               <dd><?php echo date(date_formats(),strtotime($root->registration_date));?>
                                                               </dd>
                                                            </dl>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                                <style type="text/css">
                                                   .pop-up-content:after{
                                                   background: url("/sites/all/modules/custom/afl_plan/comon_images/img/tree/tooltip-arrow.png") no-repeat scroll 0 0 transparent !important;
                                                   }
                                                   .pop-up-content.right_tooltip:after{
                                                   background: url("/sites/all/modules/custom/afl_plan/comon_images/img/tree/tooltip-arrow-right.png") no-repeat scroll 0 0 transparent !important;
                                                   }
                                                </style>
                                                <div class="scroll_class parent-wrapper clearfix">
                                                   <!------start loop-------->
												   <?php 
												    $grid_no=1;
												    if(!empty($all_direct_member) && count($all_direct_member)>0)
												    {	
													   foreach($all_direct_member as $member)
													   {
														$grid_no++; 
                            $member_image=(!empty($member->image))?$member->image:'user_small.png';  
													   ?>
														<div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
															  <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
															  <div class="node-item-1-child-left  node-child-root node-item-root">
																 <div data-gid="<?php echo $member->user_id;?>" onmouseover="trigger_hover(this)" class="binary-node-single-item user-block " id="user_block_<?php echo $member->user_id;?>">
																	<div class="images_wrapper">
																	   <a href="/afl/genealogy-tree/<?php echo $member->user_id;?>"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($member->user_id);?>" width="70" height="70" alt="mlm.member" title="mlm.member" /></a>
																	</div>
																	<span class="wrap_content" ><a href="/afl/genealogy-tree/<?php echo $member->user_id;?>"><?php echo $member->username;?></a></span>
																	<div onclick="trigger_click(event.target,'<?php echo $member->user_id;?>',this,'<?php echo site_url();?>user/MyGenealogy/');" class="last_level_user">
																	   <span class="add-genealogy-button"><i class="fa fa-plus fa-2x"></i></span>
																	</div>
																	<div class="mx_pop_content pop-up-content">
																	   <div class="profile_tooltip_pick">
																		  
																		  <h2>
																			 <a href="/user/<?php echo $member->user_id;?>"><?php echo $member->username;?>
																			 (<?php echo $member->user_id;?>)</a>                    
																		  </h2>
																		  <div class="genology-view">
																			 <a href="/afl/genealogy-tree/<?php echo $member->user_id;?>"><i class="fa fa-sitemap"></i></a>
																		  </div>
																	   </div>
																	   <div class="rank_area">
																		  <dl class="created-dl">
																			 <dt><i class="fa fa-clock-o"></i></dt>
																			 <dd><?php echo date(date_formats(),strtotime($member->registration_date));?>
																			 </dd>
																		  </dl>
																	   </div>
																	</div>
																 </div>
																 <!-- <div class="count-members">250</div>
																	<div class="count-members">250</div>
																	<div class="count-members">250</div> -->
															  </div>
														</div>
	                                                   <style type="text/css">
	                                                      .pop-up-content:after{
	                                                      background: url("/sites/all/modules/custom/afl_plan/comon_images/img/tree/tooltip-arrow.png") no-repeat scroll 0 0 transparent !important;
	                                                      }
	                                                      .pop-up-content.right_tooltip:after{
	                                                      background: url("/sites/all/modules/custom/afl_plan/comon_images/img/tree/tooltip-arrow-right.png") no-repeat scroll 0 0 transparent !important;
	                                                      }
	                                                   </style>														   
												   <?php
													   }
													}
												   ?>
												   <!-------end loop-------->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
<script>
   function max_width(){
      w_max=0;
      jQuery('.binary-genealogy-tree').each(function(){
         max_w_ele = jQuery(this).find('.last_level_user').parent().parent().width();
         n = jQuery(this).find('.last_level_user').length;
         max_w = max_w_ele*n;
        if(w_max<max_w){
          w_max = max_w;
        }
      });
      return w_max;
   }
    w = window.innerWidth
   // jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.parent-wrapper').eq(0).css('width',window.innerWidth+'px');
          w1 = max_width();
   
        jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').css('width', 'auto');
              jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).children().css('overflow-x','hidden');
              jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).children().css('overflow-y','hidden');
   
          if (w < w1) {
              jQuery('#block-system-main').css('width', w1+'px');
          } else {
            jQuery('#block-system-main').css('width', 'auto');
            jQuery('#block-system-main').css('overflow-x','hidden');
   
   
          }
   
          //balance the tree
          max_val = 1;
          /*jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.node-item-root').each(function(){
              if(!jQuery(this).hasClass('main-member')){
                 count = jQuery(this).find('.count-members').length;
                 if(count > max_val){
                   max_val = count;
                 }
              }
   
          });*/
   
          /*jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.node-item-root').each(function(){
              if(!jQuery(this).hasClass('main-member')){
                 count = jQuery(this).find('.count-members').length;
                 if(count < max_val){
                   jQuery(this).append('<div class="last_level_user count-members">0</div>');
                 }
              }
   
          });*/
   
</script>