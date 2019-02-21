<?php 
function getUserDetails($user_id)
{
  $obj=& get_instance();
  return $obj->db->select('*')->from('user_registration')->where('user_id',$user_id)->get()->row();
}
function isExistDownlineMember($user_id)
{
  $obj=& get_instance();
  $total_rows=$obj->db->select('id')->from('level_income_binary')->where('income_id',$user_id)->get()->num_rows();
  if($total_rows>0)
    return true;
  else 
    return false;
}

function getAllDownlineMember($user_id)
{
  $obj=& get_instance();
  return $obj->db->select(array('u.username','u.user_id','l.down_id','l.level','l.leg'))->from('level_income_binary l')->join('user_registration u','u.user_id=l.income_id')->where(array('l.income_id'=>$user_id,'l.level'=>'1'))->get()->result();
}

function generateTree($user_id)
{
  echo '<ol>';
  $user_arr=getAllDownlineMember($user_id);
  foreach($user_arr as $user)
    {
      $user=getUserDetails($user->down_id);
       if(isExistDownlineMember($user->user_id))
       {
      ?>
        <li>
          <label for="<?php echo $user->user_id;?>"><?php echo $user->username;?></label>
          <input type="checkbox" id="<?php echo $user->user_id;?>" />
          <?php 
          generateTree($user->user_id);
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
    }//end foreach here!
   echo '</ol>';
}
?>