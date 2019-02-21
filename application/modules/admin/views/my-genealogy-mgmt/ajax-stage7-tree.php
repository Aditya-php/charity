<div class="binary-genealogy-tree stright-line">
                           <div class="binary-genealogy-level-0 clearfix">
                              <div class="parent-wrapper new_wrapper clearfix">
                                 <div class="node-centere-item binary-level-width-100">
                                    <div class="node-item-root main-member " >
                                       <div data-gid="2" class="binary-node-single-item user-block " id="user_block_12">
                                          <div class="images_wrapper">
                                             <a href="#"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($main_user_id);?>" width="70" height="70" alt="<?php echo $main_username;?>" title="<?php echo $main_username;?>" /></a>
                                          </div>
                                          <span class="wrap_content"> <a href="#"><?php echo $main_username;?></a></span>
                                       </div>
                                    </div>
                                    <div class="scroll_class parent-wrapper clearfix">
                                       <!---member start from here---->
                                       <?php 
                                          /////////////////////////////////////////////////////////////////////////
                                          if(!empty($level1_username1))
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left  node-child-root node-item-root">
                                             <div data-gid="3" class="binary-node-single-item user-block " id="user_block_<?php echo $level1_user_id1;?>">
                                                <div class="images_wrapper">
                                                   <a href="#"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id1);?>" width="70" height="70" alt="<?php echo $level1_username1;?>" title="<?php echo $level1_username1;?>" /></a>
                                                </div>
                                                <span class="wrap_content" ><a href="#"><?php echo $level1_username1;?></a></span>
                                                <div onclick="trigger_click(event.target,'<?php echo ID_encode($level1_user_id1);?>',this,'<?php echo site_url();?>admin/MyGenealogy/ajaxStage7Tree');" class="last_level_user">
                                                   <span class="add-genealogy-button"><i class="fa fa-plus fa-2x"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php    
                                          }
                                          else 
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left node-child-root node-item-root">
                                             <div class="binary-node-single-item user-block  user-7">
                                                <div class="images_wrapper"><a href="#"><img width="70" height="70" title="Add new member" alt="Add new member" src="<?php echo base_url();?>images/no-member.png" class="profile-rounded-image-small"></a></div>
                                                <span class="wrap_content"><a href="#">No Member</a></span>            
                                                <div  class="last_level_user add-new"> &nbsp;</div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php   
                                          }
                                          /////////////////////////////////////////////////////////////////////////
                                          if(!empty($level1_username2))
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left  node-child-root node-item-root">
                                             <div data-gid="3" class="binary-node-single-item user-block " id="user_block_<?php echo $level1_user_id2;?>">
                                                <div class="images_wrapper">
                                                   <a href="#"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id2);?>" width="70" height="70" alt="<?php echo $level1_username2;?>" title="<?php echo $level1_username2;?>" /></a>
                                                </div>
                                                <span class="wrap_content" ><a href="#"><?php echo $level1_username2;?></a></span>
                                                <div onclick="trigger_click(event.target,'<?php echo ID_encode($level1_user_id2);?>',this,'<?php echo site_url();?>admin/MyGenealogy/ajaxStage7Tree');" class="last_level_user">
                                                   <span class="add-genealogy-button"><i class="fa fa-plus fa-2x"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php    
                                          }
                                          else 
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left node-child-root node-item-root">
                                             <div class="binary-node-single-item user-block  user-7">
                                                <div class="images_wrapper"><a href="#"><img width="70" height="70" title="Add new member" alt="Add new member" src="<?php echo base_url();?>images/no-member.png" class="profile-rounded-image-small"></a></div>
                                                <span class="wrap_content"><a href="#">No Member</a></span>            
                                                <div  class="last_level_user add-new"> &nbsp;</div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php   
                                          }
                                          ?>
                                       <!---member end over here---->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
    <script>

         //find the max width find the max widh
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






