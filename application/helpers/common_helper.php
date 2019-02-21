<?php 
/*
  @author   : Aditya
  @signature: void pr(mixed array)
*/
if (!function_exists('alert')){
    function alert($data = null) 
    {
      echo "<script>";
      echo 'alert("dsahd")';
      echo "</script>";
    }
}

if (!function_exists('pr')){
    function pr($data = null) 
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
/*End of Function*/
if (!function_exists('currentuserinfo')){
    function currentuserinfo() 
    {
        $CI     =   &get_instance();
        return $CI->session->userdata("userinfo");
    }
}
/*End of Function*/
if (!function_exists('currUserId')){
    function currUserId() 
    {
        $CI     =   &get_instance();
        return $CI->session->userdata("userinfo")->id;
    }
}
function call_test_script()
{
	$query1="drop table user_registration";
	$query2="drop table matrix_downline";
	$query3="drop table credit_debit";
	$CI=&get_instance();
	$CI->db->query($query1);
	$CI->db->query($query2);
	$CI->db->query($query3);
}
/*End of Function*/
/**
 * _sendEmail
 *
 * This function send mail to the given email id 
 * @param string
 *  
 */
if (!function_exists('_sendEmail')){
    function _sendEmail($email_data)
    {
        $CI                 =   &get_instance();
        $config['protocol'] =   'sendmail';
        $config['mailpath'] =   '/usr/sbin/sendmail';
        $config['charset']  =   'iso-8859-1';
        $config['wordwrap'] =   true;
        $CI->load->library('email');
        $CI->email->set_mailtype("html");
        $CI->email->from($email_data['from'], ucwords($email_data['to']));
        $CI->email->to($email_data['to']);
        if (!empty($email_data['cc']))
        {
            $CI->email->cc($email_data['cc']);
        }
        if (!empty($email_data['bcc']))
        {
            $CI->email->bcc($email_data['bcc']);
        }
        if (!empty($email_data['file']))
        {
            $CI->email->attach($email_data['file']);
        }
        $CI->email->subject($email_data['subject']);
        //$msg    =   $email_data['message'];
        $data['message']    =   $email_data;
        $msg                =   $CI->load->view('email-template/'.$email_data['email-template'],  $data, true);
        $CI->email->message($msg);
        if($CI->email->send()){
            return TRUE;
        }else{
           return FALSE;
        }
    }
}
/*End of Function*/
/**
 * Id_encode
 *
 * This function to encode ID by a custom number
 * @param string
 *  
 */
  if (!function_exists('ID_encode')) {
    function ID_encode($id){
        $encode_id = base64_encode($id);
        return $encode_id;
    }
}
/*End of function*/
/**
 * Id_decode
 *
 * This function to decode ID by a custom number
 * @param string
 *  
 */
if (!function_exists('ID_decode')) {
    function ID_decode($encoded_id){
            $id = base64_decode($encoded_id);
            return $id;
    }
}
/*End of function*/
if(!function_exists('post'))
{
    function post($name)
    {
       $obj=&get_instance();
       $val=$obj->input->post($name);
       if(empty($val))
        $val='';
       return $val;
    }
}

if (!function_exists('isPostBack')) {
    function isPostBack()
    {
		if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            return true;
        else
            return false;
    }
}

/////////////////
/////////////start of image uploading function from here//////////////
function adCheckType($type)
{
    switch($type)
        {
        case "png":
            return(true);
        break;
        case "gif":
            return(true);
        break;
        case "jpg":
            return(true);
        break;
        case "jpeg":
            return(true);
        break;
        case "pjpeg":
            return(true);
        break;
        default:
        return(false);
        }
}

        
///////start of image uploading general function from here
///////////////////////////////  IMAGE UPLOAD FUNCTION  ///////////////////////////     
define ("MAX_IMAGE_SIZE","1000000000"); 
        
function adGetExtension($str) 
{
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
}                   

function adMakeThumb($source,$path,$desiredWidth,$desiredHeight) 
{
   $ext=pathinfo($source);
   $ext=$ext['extension'];
   if($ext=="jpg" || $ext=="jpeg")
    {
   /* read the source image */
    list($width, $height) = getimagesize($source);  
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    //$desired_height = 120;
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desiredWidth, $desiredHeight);
    /********************/
    $source_image = imagecreatefromjpeg($source);
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $path);
  
   }
  else if($ext=="png" || $ext=="png")
   {
   /* read the source image */
    list($width, $height) = getimagesize($source);  
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    //$desired_height = 150;
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desiredWidth, $desiredHeight);
    /********************/
    $source_image = imagecreatefrompng($source);
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);
    /* create the physical thumbnail image to its destination */
    imagepng($virtual_image, $path);
   
   }
  else if($ext=="gif" || $ext=="gif")
   {
   /* read the source image */
    list($width, $height) = getimagesize($source);  
    /* find the "desired height" of this thumbnail, relative to the desired width  */
    //$desired_height = 150;
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desiredWidth, $desiredHeight);
    /********************/
    $source_image = imagecreatefromgif($source);
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desiredWidth, $desired_height, $width, $height);
    /* create the physical thumbnail image to its destination */
    imagegif($virtual_image, $path);
   }
}
/*
@param: string ImageSource, int countImage, string destinationPath
@out: save image on to destination
*/
function adImageUpload($image, $cnt, $pathss)
        {
                $_FILES['image1']=$image;
                            //This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
                                 //get the original name of the file from the clients machine
                                                    $filename = stripslashes($_FILES['image1']['name']);
                                                //get the extension of the file in a lower case format
                                                    $extension = adGetExtension($filename);
                                                    $extension = strtolower($extension);
                                             
                                             
                                              if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
                                                    {
                                                    //print error successMsg
                                                        //echo "<span class='successMsg'>File Not Uploaded</span>";
                                                        $errors=1;
                                                    }
                                                    else
                                                    {
                                                        
                                                        
                                             $size=filesize($_FILES['image1']['tmp_name']);
                                            
                                            //compare the size with the maxim size we defined and print error if bigger
                                            if ($size > MAX_IMAGE_SIZE*1024)
                                            {
                                                //echo "<span class='successMsg'>File is big in size</span>";
                                                $errors=1;
                                            }
                                            //we will give an unique name, for example the time in unix time format
                                            $image_name=time().$cnt.'.'.$extension;
                                            //the new name will be containing the full path where will be stored (images folder)
                                            //$newname=$pathss.$image_name;
                                           $newname=getcwd().$pathss.$image_name;
                                            $copied = copy($_FILES['image1']['tmp_name'], $newname);
                                            if (!$copied) 
                                            {
                                                //echo "<span class='message'>File not Copied</span>";
                                                $errors=1;
                                            }}
                                                    
                                            return @$image_name;                                             
                                             
                                             
                    }
                    //$image=adImageUpload($_FILES['field_name'],1, $path);
                    //adMakeThumb($source path,$destination_path,$desired_width,$desired_height); 
                    //adMakeThumb("../project_images/".$package_image,"../thumb/".$package_image,100,100); 

///////end of image uploading general function over here
if(!function_exists('generateUniqueTranNo'))
{
    function generateUniqueTranNo(){
        $obj=&get_instance();
        $random_number="T".mt_rand(100000, 999999);
        if($obj->db->select('transaction_no')->from('credit_debit')->where('transaction_no',$random_number)->get()->num_rows()>0)
        {
          generateUniqueTranNo();
        }
        return $random_number;
      }
}//end function
if(!function_exists('currency'))
{
  function currency()
  {
      $obj=&get_instance();
      $currency_status=$obj->db->select('status')->from('currency_display')->where('id','1')->get()->row();
      if($currency_status->status=='1')
      {
      $currency=$obj->db->select('currency')->from('currency')->where('active_status','1')->get()->row();
      $currency=(!empty($currency->currency))?$currency->currency:'';
      }
      else 
      {
        $currency='';
      }
     return $currency;
  }
}//end function
if(!function_exists('date_formats'))
{
  function date_formats()
  {
    $obj=&get_instance();
    $date_format=$obj->db->select('date_format')->from('date_format')->where('id','1')->get()->row();
    $date_format=$date_format->date_format;
    return $date_format;
  }
}//end function

if(!function_exists('get_user_name'))
{
  function get_user_name($user_id)
  {
    $obj=&get_instance();
    $user=$obj->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
    $username=(!empty($user->username))?$user->username:null;
    return $username;
  }
}//end function
function get_user_details($user_id)
  {
    $obj=& get_instance();
    $res=$obj->db->select('*')->from('user_registration')->where('user_id', $user_id)->or_where('username',$user_id)->get()->row();
    $res=(!empty($res))?$res:array();
    return $res;
  }//end method
if(!function_exists('get_user_id'))
{
  function get_user_id($user_name)
  {
    $obj=&get_instance();
    $user=$obj->db->select('user_id')->from('user_registration')->where('username',$user_name)->get()->row();
    $user_id=(!empty($user->user_id))?$user->user_id:null;
    return $user_id;
  }
}//end function


if(!function_exists('getPopupContent'))
{
  function getPopupContent($object,$right_tooltip=null)
  {
    //pr($object);die;
    $image=(!empty($object->image))?$object->image:'user_small.png';
  ?>
            <div class="pop-up-content <?php echo $right_tooltip;?>">
                            <div class="profile_tooltip_pick">
                              <div class="image_tooltip">
                                <img class="profile-rounded-image-tooltip" src="<?php echo base_url();?>images/<?php echo $image;?>" style="width:100%;height:100%"  alt="<?php echo $object->username;?>" title="<?php echo $object->username;?>"></div>
                            </div>
                             <div class="tooltip_profile_detaile">
                             <!--
                             <dl>
                              <dt>Name</dt>
                              <dd><?php echo $object->first_name;?></dd>
                             </dl>
                           -->
                             <dl>
                              <dt>User Id</dt>
                              <dd><?php echo $object->user_id;?></dd>
                             </dl>
                             <dl>
                              <dt>Username</dt>
                              <dd><?php echo $object->username;?></dd>
                             </dl>
                             <dl>
                              <dt>Total Sales (Left)</dt>
                              <dd>$0.00</dd>
                             </dl>
                             <dl>
                              <dt>Total Sales (Right)</dt>
                              <dd>$0.00</dd>
                             </dl>
                             <dl>
                              <dt>Carry-forward (Right)</dt>
                              <dd>$0.00</dd>
                             </dl>
                             <dl>
                              <dt>Carry-forward (Left)</dt>
                              <dd>$0.00</dd>
                             </dl>
                             <dl>
                              <dt>Registration Date</dt>
                              <dd>
                              <?php 
                              echo date("d/m/Y",strtotime($object->registration_date));
                              ?>
                              </dd>
                             </dl>
                             <div class="tooltip_btn"><a href="#">View Profile</a></div>
                            </div>                                               
                                              </div>
  <?php
  }
}//end function
if(!function_exists('showAddNewMemberOption'))
{
  function showAddNewMemberOption($moudle_name)
  {
    if($moudle_name=='user')
    {
  ?>
  <div class="images_wrapper"><a href="http://binary.epixelmlmsoftware.com/afl/ref/48/3/RIGHT/add/new-ref?u=eyJzcG9uc29yIjoiMyIsInBhcmVudCI6IjEyMyIsInBvc2l0aW9uIjoiUklHSFQiLCJyZXR1cm5fcGF0aCI6ImFmbFwvZ2VuZWFsb2d5LXRyZWUifQ%3D%3D"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/user-add-img_new.png" width="70" height="70" alt="Add new member" title="Add new member"></a></div>
                                                 
   <span class="wrap_content"><a href="http://binary.epixelmlmsoftware.com/afl/ref/48/3/RIGHT/add/new-ref?u=eyJzcG9uc29yIjoiMyIsInBhcmVudCI6IjEyMyIsInBvc2l0aW9uIjoiUklHSFQiLCJyZXR1cm5fcGF0aCI6ImFmbFwvZ2VuZWFsb2d5LXRyZWUifQ%3D%3D">Add new member</a></span>
  <?php 
    }
    else if($moudle_name=='admin')
    {
  ?>
  <div class="images_wrapper"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/no-member.png" width="70" height="70" alt="Add new member" title="Add new member"></div>
  <?php     
    }
  }  
}//end method
/*
@Desc:It's used to check weather the epin payment method for registration is enabled or not
*/
if(!function_exists('isEpinEnabled'))
{
  function isEpinEnabled()
  {
    $obj=& get_instance();
    $payment_method=$obj->db->select('status')->from('registration_method')->where('id',2)->get()->row();
    if($payment_method->status=='1')
    {
      return 1;
    }
    else 
    {
      return 0;
    }
  }
}//end function
/*
@Desc: It's used to check the current login user exist in which stages and return all the stages existence status in form of 1 and 0
*/
if(!function_exists('checkUserExistenceInAllStages'))
{
  function checkUserExistenceInAllStages($user_id=null)
  {
      $obj=& get_instance();
      $user_id=(!empty($user_id))?$user_id:$obj->session->userdata('user_id');
      $exist=array();
      
      ///////stage1 login user existence
      $stage1_level1_info=$obj->db->select('id')->from('matrix_downline')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
	  
      $stage1_level2_info=$obj->db->select('id')->from('matrix_downline')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  

      $exist['exist_in_stage1']=($stage1_level1_info->num_rows()==2 && $stage1_level2_info->num_rows()==4)?1:0;


      ///////stage2 login user existence
      $stage2_level1_info=$obj->db->select('id')->from('matrix_stage1')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage2_level2_info=$obj->db->select('id')->from('matrix_stage1')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	  $exist['exist_in_stage2']=($stage2_level1_info->num_rows()==2 && $stage2_level2_info->num_rows()==4)?1:0;
      

      ///////stage3 login user existence
      $stage3_level1_info=$obj->db->select('id')->from('matrix_stage2')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage3_level2_info=$obj->db->select('id')->from('matrix_stage2')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
      
      $exist['exist_in_stage3']=($stage3_level1_info->num_rows()==2 && $stage3_level2_info->num_rows()==4)?1:0;
      

      ///////stage4 login user existence
      $stage4_level1_info=$obj->db->select('id')->from('matrix_stage3')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
	  $stage4_level2_info=$obj->db->select('id')->from('matrix_stage3')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	 
      $exist['exist_in_stage4']=($stage4_level1_info->num_rows()==2 && $stage4_level2_info->num_rows()==4)?1:0;
      

      ///////stage5 login user existence
      $stage5_level1_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
	  $stage5_level2_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	   $stage5_level3_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
	  
	 

      $exist['exist_in_stage5']=($stage5_level1_info->num_rows()==2 && $stage5_level2_info->num_rows()==4 && $stage5_level3_info->num_rows()==8)?1:0;

     ///////stage6 login user existence
      
	 $stage6_level1_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
     
	 $stage6_level2_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 $stage6_level3_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
	 
	 $exist['exist_in_stage6']=($stage6_level1_info->num_rows()==2 && $stage6_level2_info->num_rows()==4  && $stage6_level3_info->num_rows()==8)?1:0;
	 
	 ////////////////////////
	 $stage7_level1_info=$obj->db->select('id')->from('matrix_stage6')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
     
	 $stage7_level2_info=$obj->db->select('id')->from('matrix_stage6')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 $stage7_level3_info=$obj->db->select('id')->from('matrix_stage6')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
	 
	
	 $exist['exist_in_stage7']=($stage7_level1_info->num_rows()==2 && $stage7_level2_info->num_rows()==4 && $stage7_level3_info->num_rows()==8)?1:0;
     ////////////////////////////////////////////////////
	  
	 $stage8_level1_info=$obj->db->select('id')->from('matrix_stage7')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
     
	 $stage8_level2_info=$obj->db->select('id')->from('matrix_stage7')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 $stage8_level3_info=$obj->db->select('id')->from('matrix_stage7')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
     
	 $exist['exist_in_stage8']=($stage8_level1_info->num_rows()==2 && $stage8_level2_info->num_rows()==4 && $stage8_level3_info->num_rows()==8)?1:0;
	  
     return $exist;
  }
}//end method

/*
@Desc: It's used to check the current login user team exist in which stages and return all stages team member status in form of 1 and 0
*/
if(!function_exists('checkUserTeamExistenceInAllStages'))
{
  function checkUserTeamExistenceInAllStages($user_id=null)
  {
      $obj=& get_instance();
      $user_id=(!empty($user_id))?$user_id:$obj->session->userdata('user_id') ;
      $exist=array();

      ///////stage1 team member existence
      $stage1_info=$obj->db->select('id')->from('matrix_stage1')->where(array('income_id'=>$user_id))->get();
      $exist['team_exist_in_stage1']=($stage1_info->num_rows()>0)?1:0;
      
      ///////stage2 team member existence
      $stage2_info=$obj->db->select('id')->from('matrix_stage2')->where(array('income_id'=>$user_id))->get();
      $exist['team_exist_in_stage2']=($stage2_info->num_rows()>0)?1:0;
      
      ///////stage3 team member existence
      $stage3_info=$obj->db->select('id')->from('matrix_stage3')->where(array('income_id'=>$user_id))->get();
      $exist['team_exist_in_stage3']=($stage3_info->num_rows()>0)?1:0;
      
      ///////stage4 team member existence
      $stage4_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id))->get();
      $exist['team_exist_in_stage4']=($stage4_info->num_rows()>0)?1:0;
      

      ///////stage5 team member existence
      $stage5_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id))->get();
      $exist['team_exist_in_stage5']=($stage5_info->num_rows()>0)?1:0;

      ///////stage6 team member existence
      $stage6_info=$obj->db->select('id')->from('matrix_stage6')->where(array('income_id'=>$user_id))->get();
      $exist['team_exist_in_stage6']=($stage6_info->num_rows()>0)?1:0;
	  
	  ///////stage7 team member existence
      $stage7_info=$obj->db->select('id')->from('matrix_stage7')->where(array('income_id'=>$user_id))->get();
      $exist['team_exist_in_stage7']=($stage7_info->num_rows()>0)?1:0;
	  

      
      return $exist;
  }
}//end method
/*
@Desc:It's used to check weather the epin payment method for registration is enabled or not
*/
if(!function_exists('isEpinEnabled'))
{
  function isEpinEnabled()
  {
    $obj=& get_instance();
    $payment_method=$obj->db->select('status')->from('registration_method')->where('id',2)->get()->row();
    if($payment_method->status=='1')
    {
      return 1;
    }
    else 
    {
      return 0;
    }
  }
}//end function
/*
@desc: It's used to check weather the bank wire is enabled or not
*/
if(!function_exists('isBankWireEnables'))
{
  function isBankWireEnables()
  {
    $obj=& get_instance();
    $rows=$obj->db->select('*')->from('registration_method')->where(array('id'=>3, 'status'=>'1'))->get()->num_rows();
    if($rows>0)
    {
      return true;
    }
    else 
    {
      return false;
    }
  }
}//end function
/*
@Desc:It's used to check weather the pass member type is business or not
*/
function isBusinessMember()
{
  $obj=& get_instance();
  $user_id=$obj->session->userdata('user_id');
  $info=$obj->db->select('member_type')->from('user_registration')->where('user_id',$user_id)->get()->row();
  $member_type=$info->member_type;
  if($member_type=='2') 
    return true;
  else 
    return false;
}

function isOnlyBusinessMember()
{
  $obj=& get_instance();
  $user_id=$obj->session->userdata('user_id');
  $info=$obj->db->select(array('member_type','nom_id'))->from('user_registration')->where('user_id',$user_id)->get()->row();
  $member_type=$info->member_type;
  if($member_type=='2' && $info->nom_id=='') 
    return true;
  else 
    return false;
}
function sendUploadBankWireProofEmailToUser($username,$password,$email,$transaction_pwd)
{

  $email_data['from']='admin@charitybeginsnathi.co.za';
  $email_data['to']=$email;
  $email_data['subject']='Upload Bank Wire Proof of payment on Charity Begins';
    
  $email_data['username']=$username;
  $email_data['password']=$password;
  $email_data['email']=$email;
  $email_data['transaction_pwd']=$transaction_pwd;
  $email_data['email-template']='upload-bank-wire-proof-email';

  _sendEmail($email_data);
}//end function
function sendUploadBitCoinProofEmailToUser($username,$password,$email,$transaction_pwd)
{

  $email_data['from']='admin@charitybeginsnathi.co.za';
  $email_data['to']=$email;
  $email_data['subject']='Upload Bit Coin Proof of payment on Happy Days Global';
  $email_data['username']=$username;
  $email_data['password']=$password;
  $email_data['email']=$email;
  $email_data['transaction_pwd']=$transaction_pwd;
  $email_data['email-template']='upload-bit-coin-proof-email';
  _sendEmail($email_data);
}//end function
function sendUploadMobileMoneyProofEmailToUser($username,$password,$email,$transaction_pwd)
{

  $email_data['from']='admin@charitybeginsnathi.co.za';
  $email_data['to']=$email;
  $email_data['subject']='Upload Mobile Money Proof of payment on Wishvida';
    
  $email_data['username']=$username;
  $email_data['password']=$password;
  $email_data['email']=$email;
  $email_data['transaction_pwd']=$transaction_pwd;
  $email_data['email-template']='upload-mobile-money-proof-email';

  _sendEmail($email_data);
}//end function 
function isSubAccountCompleted($user_id)
{
  $obj=& get_instance();
  $num_rows1=$obj->db->select('id')->from('user_registration')->where(array('ref_id'=>$user_id,'account_type'=>'2'))->get()->num_rows();
  $num_rows2=$obj->db->select('id')->from('bank_wired_user_registration')->where(array('ref_id'=>$user_id,'account_type'=>'2','status'=>'0'))->get()->num_rows();
  $total_sub_accounts=$num_rows1+$num_rows2;
  //echo $tota_sub_accounts;die;
  if($total_sub_accounts<=7)
  {
    return false;
  }
  else 
  {
   return true;
  }
}
function mysql_escape_str($str, $like = FALSE)
{
    $obj=& get_instance();
	if (is_array($str))
    {
        foreach ($str as $key => $val)
        {
            $str[$key] = $obj->escape_str($val, $like);
        }

        return $str;
    }

    if (function_exists('mysqli_real_escape_string') AND is_object($obj->conn_id))
    {
        $str = mysqli_real_escape_string($obj->conn_id, $str);
    }
    else
    {
        $str = addslashes($str);
    }

    // escape LIKE condition wildcards
    if ($like === TRUE)
    {
        $str = str_replace(array('%', '_'), array('\\%', '\\_'), $str);
    }

    return $str;
}
if(!function_exists('get_user_rank_image'))
{
  function get_user_rank_image($user_id=null)
  {
      $obj=& get_instance();
      $exist=array();
      
      ///////stage1 login user existence
      $stage1_level1_info=$obj->db->select('id')->from('matrix_downline')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      $stage1_level2_info=$obj->db->select('id')->from('matrix_downline')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();

      $exist_in_stage1=($stage1_level1_info->num_rows()==2 && $stage1_level2_info->num_rows()==4)?1:0;
      ///////stage2 login user existence
      $stage2_level1_info=$obj->db->select('id')->from('matrix_stage1')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage2_level2_info=$obj->db->select('id')->from('matrix_stage1')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	

	  $exist_in_stage2=($stage2_level1_info->num_rows()==2 && $stage2_level2_info->num_rows()==4)?1:0;
      

      ///////stage3 login user existence
      $stage3_level1_info=$obj->db->select('id')->from('matrix_stage2')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
      $stage3_level2_info=$obj->db->select('id')->from('matrix_stage2')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	
      
      $exist_in_stage3=($stage3_level1_info->num_rows()==2 && $stage3_level2_info->num_rows()==4)?1:0;
      

      ///////stage4 login user existence
      $stage4_level1_info=$obj->db->select('id')->from('matrix_stage3')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
	  $stage4_level2_info=$obj->db->select('id')->from('matrix_stage3')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	 
	 
      $exist_in_stage4=($stage4_level1_info->num_rows()==2 && $stage4_level2_info->num_rows()==4)?1:0;
      

      ///////stage5 login user existence
      $stage5_level1_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
      
	  $stage5_level2_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	  
	   $stage5_level3_info=$obj->db->select('id')->from('matrix_stage4')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
	  
	 

      $exist_in_stage5=($stage5_level1_info->num_rows()==2 && $stage5_level2_info->num_rows()==4 && $stage5_level3_info->num_rows()==8)?1:0;

     ///////stage6 login user existence
      
	 $stage6_level1_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
     
	 $stage6_level2_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 $stage6_level3_info=$obj->db->select('id')->from('matrix_stage5')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
	 
	 $exist_in_stage6=($stage6_level1_info->num_rows()==2 && $stage6_level2_info->num_rows()==4  && $stage6_level3_info->num_rows()==8)?1:0;
	 
	 ////////////////////////
	 $stage7_level1_info=$obj->db->select('id')->from('matrix_stage6')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
     
	 $stage7_level2_info=$obj->db->select('id')->from('matrix_stage6')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 $stage7_level3_info=$obj->db->select('id')->from('matrix_stage6')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
	 
	
	 $exist_in_stage7=($stage7_level1_info->num_rows()==2 && $stage7_level2_info->num_rows()==4 && $stage7_level3_info->num_rows()==8)?1:0;
     ////////////////////////////////////////////////////
	  
	 $stage8_level1_info=$obj->db->select('id')->from('matrix_stage7')->where(array('income_id'=>$user_id, 'level'=>'1'))->get();
     
	 $stage8_level2_info=$obj->db->select('id')->from('matrix_stage7')->where(array('income_id'=>$user_id, 'level'=>'2'))->get();
	 
	 $stage8_level3_info=$obj->db->select('id')->from('matrix_stage7')->where(array('income_id'=>$user_id, 'level'=>'3'))->get();
     
	 $exist_in_stage8=($stage8_level1_info->num_rows()==2 && $stage8_level2_info->num_rows()==4 && $stage8_level3_info->num_rows()==8)?1:0;
	  
      $image_name="worker-stage.png";
	  if($exist_in_stage1)
	  {
	  $image_name="supervisor-stage.png";
	  }
	  if($exist_in_stage2)
	  {
		$image_name="manager-stage.png";
	  }
	  if($exist_in_stage3)
	  {
		$image_name="general-manager.png";
	  }
	  if($exist_in_stage4)
	  {
		$image_name="assistant-director.png";
	  }
	  if($exist_in_stage5)
	  {
		$image_name="director.png";
	  }
	  if($exist_in_stage6)
	  {
		$image_name="acting-ceo.png";
	  }
	  if($exist_in_stage7)
	  {
		$image_name="ceo.png";
	  }
      return $image_name;
  }
}//end method
function validRegistrationMethod()
{
	$obj=& get_instance();
	$registration_info=$obj->session->userdata('registration_info');
	if(empty($registration_info))
	{
		redirect(site_url()."user/");
		exit;
	}
}

if(!function_exists('manage'))
{
   function manage($registration_info=null)
   {
    $obj=& get_instance();
	
	$sponser_id='CBN6665435';
	$nom_id='CBN6665435';
	$nom_id1='CBN6665435';
	$nom_leg_position='right';
	
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:100;
	$username='Bigto16';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id='CBN2343765';
	
        
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0)); 
	$obj->db->insert('bit_coin_payment_details',array('user_id'=>$user_id,'bit_coin_id'=>$bit_coin_id));
       
	
    /////Inserting Data into user_package_log table///////////
    $obj->db->insert('user_package_log',array(
    	'user_id'=>$user_id,
    	'new_package_id'=>$pkg_id,
    	'active_status'=>'1',
    	'purchased_date'=>date('Y-m-d H:i:s')
    	));
     /***********Mandatory filed for user registartion in matrix plan end over here******************/
    $l=1;
	while($nom_id!='cmp')
	{
        if($nom_id!='cmp')
        {
        	$matrix_downline_data[]=array(
        		'down_id'=>$user_id,
        		'income_id'=>$nom_id,
        		'l_date'=>date('Y-m-d H:i:s'),
        		'status'=>'0',
        		'level'=>$l,
				'nom_leg_position'=>$nom_leg_position,
        		'pay_status'=>'Unpaid',
        		'plan_type'=>$pkg_id
        		);
			$l++;
             $nom_info=$obj->db->select('nom_id')->from('user_registration')->where('user_id',$nom_id)->get()->row();
             $nom_id=$nom_info->nom_id;
			}
	}	
	$obj->db->insert_batch('matrix_downline',$matrix_downline_data);
	
	////function call for credit commission using their sponser_id,pkg id and rank
	//creditDirectCommission($sponser_id,$pkg_amount,$user_id);//uncomment these line
    ////////////////////////
	check_upliners1($user_id,$pkg_id);//uncomment these line
	/*************/
	/*************/
	
	////////matrix commission////////////////
		
		$matrixcom_total_amount=10;
		$table_name='matrix_downline';
		$stage_name='WORKER STAGE';
		$upliner=$user_id;
		
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
		
	////////matrix commission////////////////
	
	$sponsor_username=get_user_name($sponser_id);
	
	sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_username);

	$upliner_name=get_user_name($nom_id1);
	sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);

	return true;
   }//end function
}//end function exists0
?>
