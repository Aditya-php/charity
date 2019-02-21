<dl>
          <dt>Parent</dt>
          <?php 
		  if(!empty($parent) && count($parent)>0)
		  {
		  ?>
		  <dd><?php echo $parent->username;?>(<?php echo $parent->user_id;?>)</dd>
		  <?php 
		  }
		  else 
		  {
		  ?>
		  <dd>(0)</dd>
		  <?php 
		  }
		  ?>
</dl>
<dl>
          <dt>Sponsor</dt>
          <?php 
		  if(!empty($sponsor) && count($sponsor)>0)
		  {
		  ?>
          <dd><?php echo $sponsor->username;?>(<?php echo $sponsor->user_id;?>)</dd>
		  <?php 
		  }
		  else 
		  {
		  ?>
          <dd>(0)</dd>
		  <?php 
		  }
		  ?>
</dl>
<dl>
          <dt>Direct Downlines</dt>
          <dd><?php echo $total_direct_downline_member;?></dd>
</dl>

<dl>
          <dt>Referrals Downlines</dt>
          <dd><?php echo $total_downline_member;?></dd>
</dl>
