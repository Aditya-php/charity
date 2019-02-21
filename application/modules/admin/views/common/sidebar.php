<?php 
   $moduleName=$this->router->fetch_module();
   $controllerName=$this->router->fetch_class();
   $actionName=$this->router->fetch_method();
   $admin=getProfileInfo();
?>
<div class="sidebar sidebar-main">
   <div class="sidebar-content">
      <!-- User menu -->
      <div class="sidebar-user">
         <div class="category-content">
            <div class="media">
               <a href="#" class="media-left"><img src="<?php echo base_url();?>images/<?php echo $admin->image;?>" class="img-circle img-sm" alt=""></a>
               <div class="media-body">
                  <span class="media-heading text-semibold"><?php echo $admin->username;?></span>
                  <div class="text-size-mini text-muted">
                     <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /user menu -->
      <!-- Main navigation -->
                    <!-- user profile -->
          
          <!-- / user profile-->
                              <!-- nav -->
          <nav ui-nav class="navi clearfix">
            <ul class="nav menu-navigation">
            <ul class="navigation navigation-main navigation-accordion">
               <!-- Main -->
               <li class="navigation-header"><span></span> <i class="icon-menu" title="Main pages"></i></li>
               <li <?php echo ($controllerName=="admin")?'class=active':'';?>><a href="<?php echo site_url();?>admin/"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
               <li class="navigation-divider"></li>
               
               <li <?php echo ($controllerName=="setting" && $actionName=='currencySetting')?'class=active':'';?>><a href="<?php echo site_url();?>admin/setting/currencySetting"><i class="icon-coins"></i> <span>Currency Setting</span></a></li>
               
               <li <?php echo ($controllerName=="setting" && $actionName=='userIdSetting')?'class=active':'';?>><a href="<?php echo site_url();?>admin/setting/userIdSetting"><i class="icon-wrench3"></i> <span>User Id Setting</span></a></li>
               
               
               <li <?php echo ($controllerName=="setting" && $actionName=='dateFormatManagement')?'class=active':'';?>><a href="<?php echo site_url();?>admin/setting/dateFormatManagement"><i class="icon-clipboard5"></i> <span>Date Format Setting</span></a></li>
               <li <?php echo ($controllerName=="setting" && $actionName=='paymentModeSetting')?'class=active':'';?>><a href="<?php echo site_url();?>admin/setting/paymentModeSetting"><i class="icon-portfolio"></i> <span>Payment Mode Setting</span></a></li>
               
               
               <!--
               <li <?php echo ($controllerName=="setting" && $actionName=='payoutSetting')?'class=active':'';?>><a href="<?php echo site_url();?>admin/setting/payoutSetting"><i class="icon-shuffle"></i> <span>Payout Setting</span></a></li>
               -->
              
               
               <li class="navigation-divider"></li>
               
         <!--My Genealogy1-->
			<li <?php echo ($controllerName=="MyGenealogy1")?'class=active':'';?>>
                  <a href="#"><i class="icon-tree6"></i><span>My Genealogy</span></a>
                  <ul>
				  
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="feederStagetree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/feederStagetree"><i class="icon-tree5"></i>WORKER TREE</a>
                   </li>
                    <?php
                    $exist=checkUserExistenceInAllStages(COMP_USER_ID);
                    if($exist['exist_in_stage1'])
                    {
                    ?>
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="stage1Tree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/stage1Tree"><i class="icon-tree5"></i>SUPERVISOR TREE</a>
                   </li>
                    <?php   
                    }//end if
                    ?>
                    <?php 
                    if($exist['exist_in_stage2'])
                    {
                    ?>
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="stage2Tree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/stage2Tree"><i class="icon-tree5"></i>MANAGER TREE</a>
                    <?php   
                    }//end if
                    ?>
                   </li>
                    <?php 
                    if($exist['exist_in_stage3'])
                    {
                    ?>
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="stage3Tree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/stage3Tree"><i class="icon-tree5"></i>GENERAL MANAGER TREE</a>
                    <?php   
                    }//end if
                    ?>
                   </li>
                    <?php 
                    if($exist['exist_in_stage4'])
                    {
                    ?>
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="stage4Tree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/stage4Tree"><i class="icon-tree5"></i>ASSISTANT DIRECTOR TREE</a>
                    <?php   
                    }//end if
                    ?>
                   </li>
                    <?php 
                    if($exist['exist_in_stage5'])
                    {
                    ?>
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="stage5Tree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/stage5Tree"><i class="icon-tree5"></i>DIRECTOR TREE</a>
                   </li>
                    <?php   
                    }//end if
                    ?>
                    <?php 
                    if($exist['exist_in_stage6'])
                    {
                    ?>
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="stage6Tree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/stage6Tree"><i class="icon-tree5"></i>ACTING CEO TREE</a>
                   </li>
                    <?php   
                    }
					if($exist['exist_in_stage7'])
                    {
                    ?>
                   <li <?php echo ($controllerName=="MyGenealogy1" && $actionName=="stage7Tree")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MyGenealogy1/stage7Tree"><i class="icon-tree5"></i>CEO TREE</a>
                   </li>
                    <?php   
                    }
                    ?>
                  </ul>
			   </li> 
               <li <?php echo ($controllerName=="member")?'class=active':'';?>>
                  <a href="#"><i class="icon-people"></i> <span>Member Management</span></a>
                  <ul>
                     <li <?php echo ($actionName=="viewAllMember")?'class=active':'';?>><a href="<?php echo site_url();?>admin/member/viewAllMember"><i class="icon-collaboration"></i> View All Member</a></li>
                     <li <?php echo ($actionName=="activeMember")?'class=active':'';?>><a href="<?php echo site_url();?>admin/member/activeMember"><i class="icon-user-check"></i> Active Member</a></li>
                     <li <?php echo ($actionName=="inactiveMember")?'class=active':'';?>><a href="<?php echo site_url();?>admin/member/inactiveMember"><i class="icon-user-cancel"></i> Inactive Member</a></li>
                     <li <?php echo ($actionName=="blockUnblockMember")?'class=active':'';?>><a href="<?php echo site_url();?>admin/member/blockUnblockMember"><i class="icon-user-block"></i> Block/Unblock Member</a></li>
                     <li class="navigation-divider"></li>
                     <li <?php echo ($actionName=="passwordTracker")?'class=active':'';?>><a href="<?php echo site_url();?>admin/member/passwordTracker"><i class="icon-lock"></i> Password Tracker</a></li>
                  </ul>
               </li>
			   
			    <li <?php echo ($controllerName=="stage_wise_member")?'class=active':'';?>>
                  <a href="#"><i class="icon-people"></i> <span>All Member Stage Wise List</span></a>
                  <ul>
                     <li <?php echo ($actionName=="feeder_stage_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/feeder_stage_member"><i class="icon-collaboration"></i>Worker Stage List</a></li>
					 
					 <li <?php echo ($actionName=="stage1_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/stage1_member"><i class="icon-collaboration"></i>Supervisor List</a></li>
					 
					 <li <?php echo ($actionName=="stage2_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/stage2_member"><i class="icon-collaboration"></i>Manager List</a></li>
					 
					 
					 <li <?php echo ($actionName=="stage3_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/stage3_member"><i class="icon-collaboration"></i>General Manager List</a></li>
					 
					 
					 
					 <li <?php echo ($actionName=="stage4_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/stage4_member"><i class="icon-collaboration"></i>Assistant director List</a></li>
					 
					 
					 <li <?php echo ($actionName=="stage5_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/stage5_member"><i class="icon-collaboration"></i>Director list</a></li>
					 
					 
					 <li <?php echo ($actionName=="stage6_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/stage6_member"><i class="icon-collaboration"></i>Acting CEO list</a></li>
					 
					 
					 <li <?php echo ($actionName=="stage7_member")?'class=active':'';?>><a href="<?php echo site_url();?>admin/stage_wise_member/stage7_member"><i class="icon-collaboration"></i>CEO List</a></li>
					 
					 
					 
                  </ul>
               </li>
			   
			   
			   <li <?php echo ($controllerName=="incentive")?'class=active':'';?>>
                  <a href="#"><i class="icon-people"></i> <span>Incentive Achiever</span></a>
                  <ul>
                   <li <?php echo ($actionName=="")?'class=active':'';?>><a href="<?php echo site_url();?>admin/incentive/"><i class="icon-collaboration"></i> Incentive Achiever List</a></li>
                  </ul>
               </li>
			   
			   
			   
               <!---Report Management section start from here-->
               <li <?php echo ($controllerName=="PayoutReport" || $controllerName=="CommissionReport")?'class=active':'';?>>
                  <a href="#"><i class="icon-stats-bars"></i> <span>Report Management</span></a>
                  <ul>
                     <li <?php echo ($controllerName=="PayoutReport")?'class=active':'';?>>
                        <a href="#"><i class="icon-price-tag"></i> Payout Report</a>
                        <ul>
                           <li <?php echo ($actionName=="activePayout")?'class=active':'';?>><a href="<?php echo site_url();?>admin/PayoutReport/activePayout"><i class="icon-inbox"></i> Active Payout</a></li>
                           <li <?php echo ($actionName=="payoutCompleted")?'class=active':'';?>><a href="<?php echo site_url();?>admin/PayoutReport/payoutCompleted"><i class="icon-task"></i> Payout Completed</a></li>
                           <li <?php echo ($actionName=="payoutCancelled")?'class=active':'';?>><a href="<?php echo site_url();?>admin/PayoutReport/payoutCancelled"><i class="icon-close2"></i> Payout Cancelled</a></li>
                           <li <?php echo ($actionName=="payoutGraph")?'class=active':'';?>><a href="<?php echo site_url();?>admin/PayoutReport/payoutGraph"><i class="icon-graph"></i> Payout Graph</a></li>
                        </ul>
                     </li>
                     <li <?php echo ($controllerName=="CommissionReport")?'class=active':'';?>>
                        <a href="#"><i class="icon-coins"></i> Commission Report</a>
                        <ul>
                           <!--<li <?php echo ($actionName=="directReferralCommission")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/directReferralCommission"><i class="icon-user-plus"></i> Direct Referral Commission</a></li>
						   
						   
						   
						   <li <?php echo ($actionName=="welcomebonus")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/welcomebonus"><i class="icon-cash"></i>Welcome Bonus </a></li>-->
						   
						   <li <?php echo ($actionName=="matrixstagelevelCommission")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/matrixstagelevelCommission"><i class="icon-cash"></i>Matrix Stage Commission </a></li>
						   
						   <li <?php echo ($actionName=="matrixcompleteCommission")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/matrixcompleteCommission"><i class="icon-cash"></i>Stage Complete Commission </a></li>
						   
						   
						   
						   
						   
                           <!--<li <?php echo ($actionName=="unilevelCommission")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/unilevelCommission"><i class="icon-users4"></i> Unilevel Commission</a></li>
                           <li <?php echo ($actionName=="rankBonus")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/rankBonus"><i class="icon-users4"></i> Rank Bonus</a></li>--->
                        </ul>
                     </li>
                     <li <?php echo ($actionName=="rankAchieverReport")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/rankAchieverReport"><i class="icon-medal-first"></i> Rank Achiever Report</a></li>
                     <li <?php echo ($actionName=="topEarnerReport")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/topEarnerReport"><i class="icon-trophy3"></i> Top Earner Report</a></li>
                     <li <?php echo ($actionName=="topRecruiterReport")?'class=active':'';?>><a href="<?php echo site_url();?>admin/CommissionReport/topRecruiterReport"><i class="icon-trophy4"></i> Top Recruiter Report</a></li>
                  </ul>
               </li>
               <!---Report Management section end over here-->
               <li <?php echo ($controllerName=="AdminWallet" || $controllerName=="UserWallet")?'class=active':'';?>>
                  <a href="#"><i class="icon-wallet"></i> <span>E-Wallet Management</span></a>
                  <ul>
                     <li <?php echo ($controllerName=="AdminWallet")?'class=active':'';?>>
                        <a href="#"><i class="icon-user-tie"></i> Admin Wallet</a>
                        <ul>
                           <li <?php echo ($actionName=="viewAminWalletReport")?'class=active':'';?>><a href="<?php echo site_url();?>admin/AdminWallet/viewAminWalletReport"><i class="icon-inbox"></i>Wallet Report</a></li>

                           <li <?php echo ($actionName=="viewEwalletBalance")?'class=active':'';?>><a href="<?php echo site_url();?>admin/AdminWallet/viewEwalletBalance"><i class="icon-coins"></i>My Wallet Balance</a></li>
                           
                           <li <?php echo ($actionName=="viewAminWalletGraph")?'class=active':'';?>><a href="<?php echo site_url();?>admin/AdminWallet/viewAminWalletGraph"><i class="icon-graph"></i>Wallet Graph</a></li>
                        </ul>
                     </li>
                     <li <?php echo ($controllerName=="UserWallet")?'class=active':'';?>>
                        <a href="#"><i class="icon-vcard"></i> User Wallet</a>
                        <ul>
                           <li <?php echo ($actionName=="userWalletBalance")?'class=active':'';?>><a href="<?php echo site_url();?>admin/UserWallet/userWalletBalance"><i class="icon-coins"></i>User Wallet Balance</a></li>
                           <li <?php echo ($actionName=="manageUserWallet")?'class=active':'';?>><a href="<?php echo site_url();?>admin/UserWallet/manageUserWallet"><i class="icon-database"></i> Manage User Wallet</a></li>
                           <li <?php echo ($actionName=="pendingDepositRequestList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/UserWallet/pendingDepositRequestList"><i class="icon-warning22"></i> Pending Deposit Request</a></li>
                           <li <?php echo ($actionName=="approvedDepositRequestList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/UserWallet/approvedDepositRequestList"><i class="icon-database-check"></i> Approved Deposit Request</a></li>
                           <li <?php echo ($actionName=="cancelledDepositRequestList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/UserWallet/cancelledDepositRequestList"><i class="icon-database-remove"></i> Cancelled Deposit Request</a></li>
                        </ul>
                     </li>
                  </ul>
               </li>
			
               <li <?php echo ($controllerName=="payment_mode_setting")?'class=active':'';?>>
                        <a href="#"><i class="icon-coins"></i><span>Payment Mode Details</span></a>
                        <ul>
						 
						  <li <?php echo ($actionName=="bankWirePaymentDetailsList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/payment_mode_setting/bankWirePaymentDetailsList"><i class="icon-coins"></i>Bank Wire Payment</a></li>
						  
						  <li <?php echo ($actionName=="mobileMoneyProviderList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/payment_mode_setting/mobileMoneyProviderList"><i class="icon-coins"></i>Mobile Money Provider</a></li>
                        </ul>
              </li>
               <?php 
               if(isBankWireEnables())
                 {
               ?>
                 <!--Bank wire member report-->
                 <li <?php echo ($controllerName=="BankWireMemberReport")?'class=active':'';?>>
                           <a href="#"><i class="icon-collaboration"></i><span>Pending Member Report</span></a>
                           <ul>
                            
							  

                             <li <?php echo ($actionName=="pendingMember")?'class=active':'';?>><a href="<?php echo site_url();?>admin/BankWireMemberReport/pendingMember"><i class="icon-user-tie"></i>Pending Member</a></li>
                             
                             <li <?php echo ($actionName=="approvedMember")?'class=active':'';?>><a href="<?php echo site_url();?>admin/BankWireMemberReport/approvedMember"><i class="icon-users4"></i>Approved Member</a></li>

                             <li <?php echo ($actionName=="cancelledMember")?'class=active':'';?>><a href="<?php echo site_url();?>admin/BankWireMemberReport/cancelledMember"><i class="icon-users4"></i>Cancelled Member</a></li>
                            
                           </ul>
                 </li>
                 <?php  
                 }
                 if(isEpinEnabled())
                  {
                  ?>
               <li <?php echo ($controllerName=="Epin")?'class=active':'';?>>
                  <a href="#"><i class="icon-power-cord"></i> <span>E-Pin Management</span></a>
                  <ul>
                     <li <?php echo ($actionName=="pendingEpinRequestList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/pendingEpinRequestList"><i class="icon-clipboard2"></i> Pin Request </a></li>
                     <li <?php echo ($actionName=="createNewPin")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/createNewPin"><i class="icon-switch"></i> Create New Pin </a></li>
                     <li <?php echo ($actionName=="approvedEpinRequestList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/approvedEpinRequestList"><i class="icon-clipboard2"></i>Confirm Pin Request</a></li>
                     <li <?php echo ($actionName=="cancelledEpinRequestList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/cancelledEpinRequestList"><i class="icon-clipboard2"></i>Cancelled Pin Request</a></li>
                     <li <?php echo ($actionName=="activePinList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/activePinList"><i class="icon-database-check"></i>Active Pin</a></li>
                     <li <?php echo ($actionName=="usedPinList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/usedPinList"><i class="icon-database-time2"></i>Used Pin</a></li>
                     <li <?php echo ($actionName=="deleteBlockEpinList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/deleteBlockEpinList"><i class="icon-database-remove"></i> Delete/Block Pin </a></li>
                     <li <?php echo ($actionName=="transferEpin")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/transferEpin"><i class="icon-loop"></i> Transfer Pin </a></li>
                     <li <?php echo ($actionName=="transferredPinList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/transferredPinList"><i class="icon-database-arrow"></i>Pin Transfer Report</a></li>
                     <li <?php echo ($actionName=="showWebsiteEpinRequest")?'class=active':'';?>><a href="<?php echo site_url();?>admin/epin/showWebsiteEpinRequest"><i class="icon-clipboard2"></i>Show Website Epin Request</a></li>
                     <!--
                        <li><a href="#"><i class="icon-clipboard2"></i> Pin Request </a></li>
                        <li><a href="#"><i class="icon-switch"></i> Create New Pin </a></li>
                        <li><a href="#"><i class="icon-database-check"></i> Active Pin </a></li>
                        <li><a href="#"><i class="icon-database-time2"></i> Used Pin </a></li>
                        <li><a href="#"><i class="icon-database-remove"></i> Delete/Block Pin </a></li>
                        <li><a href="#"><i class="icon-loop"></i> Transfer Pin </a></li>
                        <li><a href="#"><i class="icon-database-arrow"></i> Pin Transfer Report </a></li>
                        -->
                  </ul>
               </li>
               <?php   
                  }
                  ?>
               <li class="navigation-divider"></li>
               <li <?php echo ($controllerName=="SupportTicket")?'class=active':'';?>>
                  <a href="#"><i class="icon-question4"></i> <span>Support Ticket</span></a>
                  <ul>
                     <li <?php echo ($actionName=="openTicket")?'class=active':'';?>><a href="<?php echo site_url();?>admin/SupportTicket/openTicket"><i class="icon-enter3"></i> Open Ticket </a></li>
                     <li <?php echo ($actionName=="closedTicket")?'class=active':'';?>><a href="<?php echo site_url();?>admin/SupportTicket/closedTicket"><i class="icon-cancel-square2"></i> Closed Ticket </a></li>
                  </ul>
               </li>
               <li <?php echo ($controllerName=="MessagePanel")?'class=active':'';?>>
                  <a href="#"><i class="icon-envelop"></i> <span>Message Panel</span></a>
                  <ul>
                     <li <?php echo ($actionName=="inbox")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MessagePanel/inbox"><i class="icon-envelop3"></i> Inbox </a></li>
                     <li <?php echo ($actionName=="composeMessage")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MessagePanel/composeMessage"><i class="icon-compose"></i> Compose Message </a></li>
                     <li <?php echo ($actionName=="sentMessage")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MessagePanel/sentMessage"><i class="icon-task"></i> Sent Message </a></li>
                  </ul>
               </li>
               <li <?php echo ($controllerName=="MarketingTools")?'class=active':'';?>>
                  <a href="#"><i class="icon-power-cord"></i> <span>Marketing Tools</span></a>
                  <ul>
                     <li <?php echo ($actionName=="viewReferralLinks")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MarketingTools/viewReferralLinks"><i class="icon-collaboration"></i> Referral Link </a></li>
                     <li <?php echo ($actionName=="viewSocialMediaLinks")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MarketingTools/viewSocialMediaLinks"><i class="icon-share3"></i> Social Media Links </a></li>
                     
                     <li <?php echo ($controllerName=="MarketingTools" && ($actionName=="viewImageList" || $actionName=="viewAllImages" || $actionName=="viewVideoList" || $actionName=="viewAllVideo"))?'class=active':'';?>>
                       
                        <a href="#"><i class="icon-video-camera"></i> Files & Videos</a>
                        
                        <ul>
                           <li <?php echo ($actionName=="viewImageList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MarketingTools/viewImageList"><i class="icon-image3"></i>Image List</a></li>

                           <li <?php echo ($actionName=="viewAllImages")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MarketingTools/viewAllImages"><i class="icon-image4"></i>View All Images</a></li>
                           
                           <li <?php echo ($actionName=="viewVideoList")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MarketingTools/viewVideoList"><i class="icon-play"></i>Video List</a></li>
                           
                           <li <?php echo ($actionName=="viewAllVideo")?'class=active':'';?>><a href="<?php echo site_url();?>admin/MarketingTools/viewAllVideo"><i class="icon-clapboard-play"></i>View All Video</a></li>
                        
                        </ul>
                     </li>
                  </ul>
               </li>
               <li <?php echo ($controllerName=="policy")?'class=active':'';?>>
                  <a href="#"><i class="icon-file-eye2"></i> <span>Policy Section</span></a>
                  <ul>
                     <li <?php echo ($actionName=="editPrivacyPolicy")?'class=active':'';?>><a href="<?php echo site_url();?>admin/policy/editPrivacyPolicy"><i class="icon-book2"></i> Privacy Policies </a></li>
                     <li <?php echo ($actionName=="editTermsCondition")?'class=active':'';?>><a href="<?php echo site_url();?>admin/policy/editTermsCondition"><i class="icon-book"></i> Terms and Conditions </a></li>
                  </ul>
               </li>
               <li class="navigation-divider"></li>
               <li <?php echo ($controllerName=="account")?'class=active':'';?>>
                  <a href="#"><i class="icon-hammer-wrench"></i> <span>Account Setting</span></a>
                  <ul>
                     <li <?php echo ($actionName=="profileManagement")?'class=active':'';?>><a href="<?php echo site_url();?>admin/account/profileManagement"><i class="icon-user-tie"></i>Profile Management</a></li>
                     <li <?php echo ($actionName=="changePassword")?'class=active':'';?>><a href="<?php echo site_url();?>admin/account/changePassword"><i class="icon-key"></i> Change Password </a></li>
                  </ul>
               </li>
               <li class="navigation-divider"></li>
               
              
            </ul>
			</ul>
      <!-- /main navigation -->
	  </nav>
   </div>
</div>
<style>
.navbar-inverse {
    background-color: #28353c !important;
    border-color: #28353c !important;
}
.sidebar {
    background-color: #28353c;
}
.navigation>li.active>a, .navigation>li.active>a:hover, .navigation>li.active>a:focus {
    background-color: #26a69a;
    color: #fff;
}
</style>