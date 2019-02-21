<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Account Management</span> - <?php echo $title;?></h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Account Management</li>
							<?php echo $breadcrumb;?>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
                  <ol class="tree">
                  <?php 
                  $user=getUserDetails($user_id);
                  if(isExistDownlineMember($user_id))
                  {
                  ?>
                    <li>
                      <label for="menu-1"><?php echo $user->username;?></label>
                      <input type="checkbox" checked id="menu-1" />
                  <?php 
                         generateTree(COMP_USER_ID);
                  ?>  
                      </li>

                  <?php 
                  }
                  else 
                  {
                  ?>
                    <li class="file"><a href=""><?php echo $user->username;?></a></li>
                  <?php   
                  }
                  ?>
                  </ol>						
					</div>
					<!-- /vertical form options -->
					<!-- Footer -->
				  <?php
                  $this->load->view("common/footer-text");
                  ?>
					<!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
<style>
ol.tree{padding-left:30px;}
li{list-style-type:none;color:black;position:relative;margin-left:-15px;}
li label{padding-left:37px;cursor:pointer;background:url("https://www.thecssninja.com/demo/css_tree/folder-horizontal.png") no-repeat 15px 2px;display:block;}
li input{width:1em;height:1em;position:absolute;left:-0.5em;top:0;opacity:0;cursor:pointer;}
li input + ol{height:1em;margin:-24px 0 0 -44px;background:url("https://www.thecssninja.com/demo/css_tree/toggle-small-expand.png") no-repeat 40px 0;}
li input + ol > li{display:none;margin-left:-14px !important;padding-left:1px}
li.file{margin-left:-1px !important;}
li.file a{display:inline-block;padding-left:21px;color:black;text-decoration:none;background:url("https://www.thecssninja.com/demo/css_tree/document.png") no-repeat 0 0;}
li input:checked + ol{height:auto;margin:-27px 0 0 -44px;padding:25px 0 0 80px;background:url("https://www.thecssninja.com/demo/css_tree/toggle-small.png") no-repeat 40px 5px;}
li input:checked + ol > li{display:block;margin:0 0 0.063em;}
li input:checked + ol > li:first-child{margin:0 0 0.125em;}
    </style>
		