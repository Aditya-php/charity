<?php 
/*
@author : Aditya
@param  : none
@desc   : It's used to generate the unique user id
@return int(user id)
*/
if(!function_exists('generateUserId'))
{
	function generateUserId()
	{
		$obj=& get_instance();
		$encypt1=uniqid(rand(100000,999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$user_id_prefix=$obj->db->select('*')->from('user_id_setting')->where('id',1)->get()->row();
		$prefix='';
		if($user_id_prefix->type=='1')
		{
			$prefix=$user_id_prefix->prefix;
		}
		$pre_userid = $prefix.substr($usid1, 0, 7);
		$query=$obj->db->select('user_id')->from('user_registration')->where(array('user_id'=>$pre_userid))->get();
		if($query->num_rows()>0)
		{
		 generateUserId();
		}
		else
		{
		 return $pre_userid;
	    }
	}//end function    
}//end function exists
if(!function_exists('getNom'))
{
	function getNom($sponserid)
	{
			global $nom_id1,$lev;
			static $nom_id_info;
			$obj=& get_instance();
			foreach($sponserid as $key => $val)
			{
			//$query1="select * from user_registration where nom_id='$val' order by id asc";
			//$result1=mysql_query($query1);
			$query1=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$val))->order_by('id','ASC')->get();
			$num_ro1[]=$query1->num_rows();
			//$num_ro1[]=mysql_num_rows($result1);
			foreach($query1->result() as $row)
				{
					$rclid1[]=$row->user_id;
				}//end while
			}//end foreach
			foreach($num_ro1 as $key11 => $valu)
			{
				if($valu < 2)
				{
				$key1=$key11;
				break;
				}
			}//end foreach
			switch ($valu)
			{
			    case '0':
					 {
					  //echo "0";
					  $nom_leg_position="left";
					  $nom_id1=$sponserid[$key1];
					  //////////////////
					  $nom_id_info['nom_leg_position']=$nom_leg_position;
					  $nom_id_info['nom_id']=$nom_id1;
					  //return $nom_id_info;
					  break;
					 }
			    case '1':
					{
					  $nom_leg_position="right";
					  $nom_id1=$sponserid[$key1];
					  /////////////////
					  $nom_id_info['nom_leg_position']=$nom_leg_position;
					  $nom_id_info['nom_id']=$nom_id1;
					  //return $nom_id_info;
					  break;
					}
				case '2':
					if(!empty($nom_id1) && !empty($nom_leg_position))
					{
					 break;
					}
				getNom($rclid1);
			}//end switch
			return $nom_id_info;
			exit;
	}//end function
}//end function exists
if(!function_exists('getFollowMeMatrixNom'))
{
	function getFollowMeMatrixNom($sponserid=null,$posi=null)
	{
		$nom_id=null;
		$obj=& get_instance();
	    $query=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$sponserid,'nom_leg_position'=>$posi))->get();
        if($query->num_rows()>0)
        {
	        $query_obj=$query->row();
		    $rclid1=$query_obj->user_id;
			$left_query=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$rclid1,'nom_leg_position'=>'left'))->get();
			$left_count=$left_query->num_rows();
			$right_query=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$rclid1,'nom_leg_position'=>'right'))->get();
			$right_count=$right_query->num_rows();
			if($left_count>0 && $right_count>0)
			{ 
				$posi=$query_obj->ref_leg_position;
				
				if($rclid1!="")
				{
				   $ref_id123[]=$left_query->row()->user_id;
				   $ref_id123[]=$right_query->row()->user_id;
				   $nom_id_info=getNom($ref_id123);
				   //pr($nom_id_info);
				}
				else 
				{
					$nom_id_info['nom_id']=$sponserid;
			        $nom_id_info['nom_leg_position']=$posi;
				} 
			}
			else 
			{
			  //$nom_id=$query_obj->user_id; 
			  $nom_id_info['nom_id']=$query_obj->user_id;
			  if($left_count<=0)
			  {
			    $posi="left";
			  }
			  else if($right_count<=0)
			  {
				$posi="right";
			  }
			  else 
			  {
				$posi="left";
			  }
			  $nom_id_info['nom_leg_position']=$posi;
			}
        }
		else 
		{
			$nom_id_info['nom_id']=$sponserid;
			$nom_id_info['nom_leg_position']=$posi;
		}
		return $nom_id_info;
	}//end function
}//end function exists
/*
@author : Aditya
@param  : int(referral userid/sponsor user id), string(leg position)
@desc   : It's used to identify the nom id
@return int(nom_id)
*/
if(!function_exists('getNom1'))
{
	function getNom1($sponserid,$table_name)
	{
			global $nom_id1,$lev;
			static $nom_id_info;
			$obj=& get_instance();
			foreach($sponserid as $key => $val)
			{
			//$query1="select * from user_registration where nom_id='$val' order by id asc";
			//$result1=mysql_query($query1);
			$query1=$obj->db->select('*')->from($table_name)->where(array('nom_id'=>$val))->order_by('id','ASC')->get();
			$num_ro1[]=$query1->num_rows();
			//$num_ro1[]=mysql_num_rows($result1);
			foreach($query1->result() as $row)
				{
					$rclid1[]=$row->user_id;
				}//end while
			}//end foreach
			foreach($num_ro1 as $key11 => $valu)
			{
				if($valu < 2)
				{
				$key1=$key11;
				break;
				}
			}//end foreach
			switch ($valu)
			{
			    case '0':
					 {
					  $nom_leg_position="left";
					  $nom_id1=$sponserid[$key1];
					  ///
					  $nom_id_info['nom_leg_position']=$nom_leg_position;
					  $nom_id_info['nom_id']=$nom_id1;
					  break;
					 }
			    case '1':
					{
					  $nom_leg_position="right";
					  $nom_id1=$sponserid[$key1];
					  //////////
					  $nom_id_info['nom_leg_position']=$nom_leg_position;
					  $nom_id_info['nom_id']=$nom_id1;
					  break;
					}
				case '2':
					if(!empty($nom_id1) && !empty($nom_leg_position))
					{
					 break;
					}
				getNom1($rclid1,$table_name);
			}//end switch
			return $nom_id_info;
			exit;
	}//end function
}//end function exists
if(!function_exists('getFollowMeMatrixNom1'))
{
	function getFollowMeMatrixNom1($sponserid=null,$posi=null,$table_name)
	{
		$nom_id=null;
		$obj=& get_instance();
		///if sponser available
		$total_count=$obj->db->select('*')->from($table_name)->where('user_id',$sponserid)->get()->num_rows();
		if($total_count<=0)
		{
		   $i=0;
		   $all_sponsor=array();
		   while($total_count==0)
		   {
		       $all_sponsor[$i]=$sponserid;
			   $sponser_info=get_user_details($sponserid);
			   $sponserid=$sponser_info->ref_id;
			   if($sponserid==COMP_USER_ID)
			   {
			    $i++;
			    break;
			   }
			   $total_count=$obj->db->select('*')->from($table_name)->where('user_id',$sponserid)->get()->num_rows();
			   $i++;
		   }
		   $previous_sposnsor=$all_sponsor[$i-1];
		   $previous_sposnsor_info=get_user_details($previous_sposnsor);
		   $posi=$previous_sposnsor_info->ref_leg_position;
		   $query=$obj->db->select('*')->from($table_name)->where(array('nom_id'=>$sponserid,'nom_leg_position'=>$posi))->get();
		}
		else 
		{
			$query=$obj->db->select('*')->from($table_name)->where(array('nom_id'=>$sponserid,'nom_leg_position'=>$posi))->get();
		}
		if($query->num_rows()>0)
        {
	        $query_obj=$query->row();
		    $rclid1=$query_obj->user_id;
			$left_query=$obj->db->select('*')->from($table_name)->where(array('nom_id'=>$rclid1,'nom_leg_position'=>'left'))->get();
			$left_count=$left_query->num_rows();
			$right_query=$obj->db->select('*')->from($table_name)->where(array('nom_id'=>$rclid1,'nom_leg_position'=>'right'))->get();
			$right_count=$right_query->num_rows();
			if($left_count>0 && $right_count>0)
			{ 
				$posi=$query_obj->ref_leg_position;
				
				if($rclid1!="")
				{
				   $ref_id123[]=$left_query->row()->user_id;
				   $ref_id123[]=$right_query->row()->user_id;
				   $nom_id_info=getNom1($ref_id123,$table_name);
				}
				else 
				{
					$nom_id_info['nom_id']=$sponserid;
			        $nom_id_info['nom_leg_position']=$posi;
				} 
			}
			else 
			{
			  //$nom_id=$query_obj->user_id; 
			  $nom_id_info['nom_id']=$query_obj->user_id;
			  if($left_count<=0)
			  {
			    $posi="left";
			  }
			  else if($right_count<=0)
			  {
				$posi="right";
			  }
			  else 
			  {
				$posi="left";
			  }
			  $nom_id_info['nom_leg_position']=$posi;
			}
        }
		else 
		{
			$nom_id_info['nom_id']=$sponserid;
			$nom_id_info['nom_leg_position']=$posi;
		}
		return $nom_id_info;
	}//end function
}//end function exists
if(!function_exists('creditDirectCommission'))
{
	function creditDirectCommission($sponser_id,$registerd_package_amount,$user_id=null)
	{
		$obj= & get_instance();
		$matrix_stage=$obj->db->select('mp.total_stage')->from('matrix_plan as mp')->where('id','1')->get()->row();
		$total_stage=$matrix_stage->total_stage;
		for($i=$total_stage;$i>=0;$i--)
		{
			if($i==0)
			{
			  $stage=0;	
			}
			else 
			{
				
				$table_name='reg_stage'.$i;
				$stage_info=$obj->db->select('id')->from($table_name)->where('user_id',$sponser_id)->get();
				if($stage_info->num_rows()>0)
				{
					$stage=$i;
					break;
				}
			}
		}//end for loop
		if($stage==0)
		{
            $stage_key='feeder_stage';
		}
		else 
		{
            $stage_key='stage_'.$stage;
		}
       
	   
	   $commission_info=$obj->db->select(array('md.direct_commission','md.commission_type'))->from('matrix_direct_commission as md')->join('user_registration as u','u.pkg_id=md.package_id')->where(array('md.stage_key'=>$stage_key,'u.user_id'=>$sponser_id))->get()->row();
        /*
        commission_type=='1' percent commission
        commission_type=='2' flat commission
        */
        if($commission_info->commission_type=='1')
        {
        	$commission_amount=($registerd_package_amount*$commission_info->direct_commission)/100;
        }
        else 
        {
        	$commission_amount=$commission_info->direct_commission;
        }
        /////crediting direct commission
		if(!empty($commission_amount) && $commission_amount>0)
		{
			$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$sponser_id)->get()->row();
			$balance=$query_obj->amount+$commission_amount;
			$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id));
			//'1'=>debit for pkg purchased,'2'=> debit for ewallet withdrawl,'3'=>debit for balance transfer,'4'=>'credit for balance transfer received','5'=>credit for matrix direct commission,'6'=>credit for matrix commission,'9'=>credit for unilevel commission,'10'=>credit for rank bonus update,'11'=>debit for fund transfer, '12'=> credit by fund transfer,'13'=>Debit Amount for Withdrawl wallet amount request,'14'=>withdrawal request cancel refund,'15'=>deposit request credit,'16'=>debit for Epin purchased from E-wallet
			/*
			Note:status field '0'=>debit,'1'=>credit
			*/
			$obj->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$sponser_id,
					'credit_amt'=>$commission_amount,
					'debit_amt'=>'0',
					'balance'=>$balance,
					'admin_charge'=>'0',
					'receiver_id'=>$sponser_id,
					'sender_id'=>$user_id,
					'receive_date'=>date('Y-m-d'),
					'ttype'=>'Sponsor/Direct Commission Amount',
					'TranDescription'=>'Package Purchase by '.$user_id,
					'Cause'=>'Package Purchase by '.$user_id,
					'Remark'=>'Package Purchase by '.$user_id,
					'unique_identity'=>$stage_key,
					'invoice_no'=>'',
					'product_name'=>'',
					'status'=>'1',
					'ewallet_used_by'=>'Withdrawal Wallet',
					'current_url'=>site_url(),
					'reason'=>'5' //credit for matrix direct commission
					));
			}//end if
	   
	}//end function
}//function exists


function matrix_commission_level($total_com,$down_id,$table_name,$stage_name)
{
	$obj=& get_instance();
	$query=$obj->db->query("select * from $table_name where down_id='".$down_id."' and level<='2' and matrix_commission_level='Unpaid'");
	
	$count=$query->num_rows();
	
	$all_upliner=$query->result_array();
	
	$main_com_amount=$total_com;
	
	if($count>0)
	{
		
		foreach($all_upliner as $all)
		{
			           $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$all['income_id'])->get()->row();
						$balance=$query_obj->amount+$main_com_amount;
						$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$all['income_id']));
						$obj->db->insert('credit_debit',array(
						'transaction_no'=>generateUniqueTranNo(),
						'user_id'=>$all['income_id'],
						'credit_amt'=>$main_com_amount,
						'debit_amt'=>'0',
						'balance'=>$balance,
						'admin_charge'=>'0',
						'receiver_id'=>$all['income_id'],
						'sender_id'=>$down_id,
						'receive_date'=>date('Y-m-d'),
						'ttype'=>$stage_name.' MATRIX COMMISSION',
						'TranDescription'=>'Matrix Commission get by '.$all['income_id'].' of stage '.$stage_name.' from '.$down_id,
						'Cause'=>'Matrix Commission get by '.$all['income_id'].' of stage '.$stage_name.' from '.$down_id,
						'Remark'=>'Matrix Commission get by '.$all['income_id'].' of stage '.$stage_name.' from '.$down_id,
						'invoice_no'=>'',
						'product_name'=>'',
						'status'=>'1',
						'ewallet_used_by'=>'Withdrawal Wallet',
						'current_url'=>site_url(),
						'reason'=>'37' //credit for matrix commission
						));	
						
			$obj->db->query("update $table_name set matrix_commission_level='Paid' where id='".$all['id']."'");			
			
		}
	}
	
}


if(!function_exists('creditMatrixCommission'))
{
	function creditMatrixCommission($upliner,$new_id,$stage,$platform)
	{
		$obj=& get_instance();
		$commission_info=$obj->db->select(array('m.matrix_commission','m.commission_type'))->from('matrix_commission as m')->join('user_registration as u','u.pkg_id=m.package_id')->where(array('m.stage_key'=>$stage,'u.user_id'=>$upliner))->get()->row();
		/*
		commission_type=='1' percent commission
		commission_type=='2' flat commission
		*/
		$package_info=$obj->db->select('p.amount')->from('package as p')->where('id',$platform)->get()->row();
		$registerd_package_amount=$package_info->amount;
		if($commission_info->commission_type=='1')
		{
		    $commission_amount=($registerd_package_amount*$commission_info->direct_commission)/100;
		}
		else 
		{
		    $commission_amount=$commission_info->matrix_commission;
		}
		        /////crediting direct commission
		$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
		$balance=$query_obj->amount+$commission_amount;
		$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
		//'1'=>debit for pkg purchased,'2'=> debit for ewallet withdrawl,'3'=>debit for balance transfer,'4'=>'credit for balance transfer received','5'=>credit for matrix direct commission,'6'=>credit for matrix commission,'9'=>credit for unilevel commission,'10'=>credit for rank bonus update,'11'=>debit for fund transfer, '12'=> credit by fund transfer,'13'=>Debit Amount for Withdrawl wallet amount request,'14'=>withdrawal request cancel refund,'15'=>deposit request credit,'16'=>debit for Epin purchased from E-wallet
		/*
		Note:status field '0'=>debit,'1'=>credit
		*/
		if($stage=="feeder_stage")
		{
			$stage_name="Feeder Stage";
		}
		else if($stage=="stage_1")
		{
			$stage_name="Stage 1";
		}
		else if($stage=="stage_2")
		{
			$stage_name="Stage 2";
		}
		else if($stage=="stage_3")
		{
			$stage_name="Stage 3";
		}
		else if($stage=="stage_4")
		{
			$stage_name="Stage 4";
		}
		else if($stage=="stage_5")
		{
			$stage_name="Stage 5";
		}
		else if($stage=="stage_6")
		{
			$stage_name="Stage 6";
		}
		$obj->db->insert('credit_debit',array(
				'transaction_no'=>generateUniqueTranNo(),
				'user_id'=>$upliner,
				'credit_amt'=>$commission_amount,
				'debit_amt'=>'0',
				'balance'=>$balance,
				'admin_charge'=>'0',
				'receiver_id'=>$upliner,
				'sender_id'=>$new_id,
				'receive_date'=>date('Y-m-d'),
				'ttype'=>'Matrix Commission Amount for '.$stage_name,
				'TranDescription'=>'Package Purchase by '.$new_id,
				'Cause'=>'Package Purchase by '.$new_id,
				'Remark'=>'Package Purchase by '.$new_id,
				'unique_identity'=>$stage,
				'invoice_no'=>'',
				'product_name'=>'',
				'status'=>'1',
				'ewallet_used_by'=>'Withdrawal Wallet',
				'current_url'=>site_url(),
				'reason'=>'6' //credit for matrix commission
				));
	}
}
/*
@author : Aditya
@param  : none
@desc   : It's used to register the user via ewallet user registration method
@return none
*/
if(!function_exists('ewalletUserRegistration'))
{
   function ewalletUserRegistration($registration_info=null)
   {
    $obj=& get_instance();
	validRegistrationMethod();

    //$registerData=$obj->session->all_userdata();//open  and close comment
     /***********Mandatory filed for user registartion in binary plan start from here******************/
    ////user_registration query
    /*Sponsor and account informtaion*/
    if(empty($registration_info))
	{
		$registration_info=$obj->session->userdata('registration_info');
	}
	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
	
	$ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'left';
	//$ref_id123[]=$sponser_id;
	$nom_id_info=getFollowMeMatrixNom($sponser_id,$ref_leg_position);
	//pr($nom_id_info);
	$nom_id=$nom_id_info['nom_id'];;
	$nom_id1=$nom_id;
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	if($nom_id!=$sponser_id && $nom_leg_position=='right')
		{
			$total=$obj->db->select('id')->from('user_registration')->where(array('nom_leg_position'=>'left','nom_id'=>$nom_id))->get()->num_rows();
			if($total<=0)
			{
				$nom_leg_position="left";
			}
		}
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:60;
	$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'B7';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	//bank account info
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	//Bit coin info///
	$bit_coin_id=(!empty($registration_info['bit_coin_info']['bit_coin_id']))?$registration_info['bit_coin_info']['bit_coin_id']:null;
	////////////
	$registration_info['sponsor_and_account_info']['account_type'];
	$account_type=(!empty($registration_info['sponsor_and_account_info']['account_type']))?$registration_info['sponsor_and_account_info']['account_type']:'1';

    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
			'account_type'=>$account_type,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			 'ref_leg_position'=>$ref_leg_position,
			 'nom_leg_position'=>$nom_leg_position,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
			 
    		 ////////
    		 'registration_date'=>date('Y-m-d'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
			 'registration_method_name'=>'E-wallet'
    		);
    $obj->db->insert('user_registration',$user_registration_data);
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0)); 
	$obj->db->insert('bit_coin_payment_details',array('user_id'=>$user_id,'bit_coin_id'=>$bit_coin_id));
       
	$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$sponser_id)->get()->row();
	
	$balance=$query_obj->amount-$pkg_amount;
	
	$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id));
	//'1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
	/*
	Note:status field '0'=>debit,'1'=>credit
	*/
	$obj->db->insert('credit_debit',array(
	    'transaction_no'=>generateUniqueTranNo(),
	    'user_id'=>$sponser_id,
	    'credit_amt'=>'0',
	    'debit_amt'=>$pkg_amount,
	    'balance'=>$balance,
	    'admin_charge'=>'0',
	    'receiver_id'=>$user_id,
	    'sender_id'=>$sponser_id,
	    'receive_date'=>date('Y-m-d'),
	    'ttype'=>'Package Purchased',
	    'TranDescription'=>'Package Purchase by '.$user_id,
	    'Cause'=>'Package Purchase by '.$user_id,
	    'Remark'=>'Package Purchase by '.$user_id,
	    'invoice_no'=>'',
	    'product_name'=>'',
	    'status'=>'0',
	    'ewallet_used_by'=>'Withdrawal Wallet',
	    'current_url'=>site_url(),
	    'reason'=>'1'
        ));

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
		
		$matrixcom_total_amount=20;
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
/*
@author : Aditya
@param  : none
@desc   : It's used to register the user via ewallet user registration method
@return none
*/



if(!function_exists('epinUserRegistration'))
{
   function epinUserRegistration($registration_info=null)
   {
    $obj=& get_instance();
	validRegistrationMethod();
    //$registerData=$obj->session->all_userdata();//open  and close comment
     /***********Mandatory filed for user registartion in binary plan start from here******************/
    ////user_registration query
    /*Sponsor and account informtaion*/
    if(empty($registration_info))
	{
		$registration_info=$obj->session->userdata('registration_info');
	}
	
	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
	$ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'left';
	//////////////
	$nom_id_info=getFollowMeMatrixNom($sponser_id,$ref_leg_position);
	//pr($nom_id_info);
	$nom_id=$nom_id_info['nom_id'];;
	$nom_id1=$nom_id;
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	if($nom_id!=$sponser_id && $nom_leg_position=='right')
		{
			$total=$obj->db->select('id')->from('user_registration')->where(array('nom_leg_position'=>'left','nom_id'=>$nom_id))->get()->num_rows();
			if($total<=0)
			{
				$nom_leg_position="left";
			}
		}
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:60;
	$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'O';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	//bank account info
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	//Bit coin info///
	$bit_coin_id=(!empty($registration_info['bit_coin_info']['bit_coin_id']))?$registration_info['bit_coin_info']['bit_coin_id']:null;
	////////////
	$account_type=(!empty($registration_info['sponsor_and_account_info']['account_type']))?$registration_info['sponsor_and_account_info']['account_type']:'1';
    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
			'account_type'=>$account_type,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'ref_leg_position'=>$ref_leg_position,
			'nom_leg_position'=>$nom_leg_position,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('Y-m-d'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
			 'registration_method_name'=>'E-Pin'
    		);
    $obj->db->insert('user_registration',$user_registration_data);
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

	//creditDirectCommission($sponser_id,$pkg_amount,$user_id);
    ////////////////////////
	check_upliners1($user_id,$pkg_id);
	/*************/
	
////////matrix commission////////////////
		
		$matrixcom_total_amount=20;
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
/*
@author : Aditya
@param  : none
@desc   : It's used to register the user via ewallet user registration method
@return none
*/
if(!function_exists('bankWireUserRegistration'))
{
   function bankWireUserRegistration($id)
   {
    $obj=& get_instance();
    /*Sponsor and account informtaion*/
	$obj->db->update('bank_wired_user_registration',array('status'=>'1','action_date'=>date('Y-m-d H:i:s')),array('id'=>$id));	
    $register_user_details=$obj->db->select('*')->from('bank_wired_user_registration')->where('id',$id)->get()->row();
    $sponser_id=$register_user_details->ref_id;
    //////////////
	$ref_leg_position=(!empty($register_user_details->ref_leg_position))?$register_user_details->ref_leg_position:'left';
	$nom_id_info=getFollowMeMatrixNom($sponser_id,$ref_leg_position);
	//pr($nom_id_info);
	$nom_id=$nom_id_info['nom_id'];;
	$nom_id1=$nom_id;
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	if($nom_id!=$sponser_id && $nom_leg_position=='right')
		{
			$total=$obj->db->select('id')->from('user_registration')->where(array('nom_leg_position'=>'left','nom_id'=>$nom_id))->get()->num_rows();
			if($total<=0)
			{
				$nom_leg_position="left";
			}
		}
	
	$pkg_id=(!empty($register_user_details->platform))?$register_user_details->platform:1;
    $pkg_amount=(!empty($register_user_details->package_fee))?$register_user_details->package_fee:60;

    $username=$register_user_details->username;
    $user_password=(!empty($register_user_details->password))?$register_user_details->password:'123';
    $transaction_pwd=(!empty($register_user_details->t_code))?$register_user_details->t_code:'123';
    $user_id=generateUserId();
    /*Personal informtaion*/
    $first_name=(!empty($register_user_details->first_name))?$register_user_details->first_name:null;
    $last_name=(!empty($register_user_details->last_name))?$register_user_details->last_name:null;
    $email=(!empty($register_user_details->email))?$register_user_details->email:null;
    $contact_no=(!empty($register_user_details->contact_no))?$register_user_details->contact_no:null;
    $country=(!empty($register_user_details->country))?$register_user_details->country:null;
    $state=(!empty($register_user_details->state))?$register_user_details->state:null;
    $city=(!empty($register_user_details->city))?$register_user_details->city:null;
    $zip_code=(!empty($register_user_details->zip_code))?$register_user_details->zip_code:null;
    $address_line1=(!empty($register_user_details->address_line1))?$register_user_details->address_line1:null;
    $date_of_birth=(!empty($register_user_details->date_of_birth))?$register_user_details->date_of_birth:null;

    /*Bank Account information*/
    $account_no=(!empty($register_user_details->account_no))?$register_user_details->account_no:null;
    $branch_name=(!empty($register_user_details->branch_name))?$register_user_details->branch_name:null;
    $bank_name=(!empty($register_user_details->bank_name))?$register_user_details->bank_name:null;
    $ifsc_code=(!empty($register_user_details->ifsc_code))?$register_user_details->ifsc_code:null;
    $account_holder_name=(!empty($register_user_details->account_holder_name))?$register_user_details->account_holder_name:null;
	/*Bit coin information*/
    $bit_coin_id=(!empty($register_user_details->bit_coin_id))?$register_user_details->bit_coin_id:null;
	///////
	$account_type=(!empty($register_user_details->account_type))?$register_user_details->account_type:'1';
	if(!empty($register_user_details->payment_method))
	{
		if($register_user_details->payment_method=='1')
		{
			$registration_method_name="Bank-Wire";
		}
		else if($register_user_details->payment_method=='2')
		{
			$registration_method_name="Bit-Coin";
		}
		else if($register_user_details->payment_method=='3')
		{
			$registration_method_name="Mobile Money";
		}
	}
	else 
	{
		$registration_method_name="Bank-Wire";
	}
    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
			'account_type'=>$account_type,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'ref_leg_position'=>$ref_leg_position,
			 'nom_leg_position'=>$nom_leg_position,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'date_of_birth'=>$date_of_birth,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('Y-m-d'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
			 'registration_method_name'=>$registration_method_name
    		);
    $obj->db->insert('user_registration',$user_registration_data);
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
	//creditDirectCommission($sponser_id,$pkg_amount,$user_id);
    ////////////////////////

	check_upliners1($user_id,$pkg_id);

	/*************/
	/*************/
	
	////////matrix commission////////////////
		
		$matrixcom_total_amount=20;
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
function check_upliners1($new_id,$platform)
{
	echo "\n checkupliner 1";
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		$info=$obj->db->select('*')->from('matrix_downline')->where(array('down_id'=>$new_id))->get()->result_array();
		
		
		//$commission_amount=85;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'feeder_stage'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			
			$lev1_num=$obj->db->select('*')->from('matrix_downline')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_downline')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			////////////////////
			
			$lev1_num_info=$obj->db->select('*')->from('matrix_downline')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_downline')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			///////////////////
			if($lev1_num==2 && $lev2_num==4)
			{
			    /*
			    Crediting matrix completion commission into BRONZE STAGE to the upliners
			    */
			    ///start of Crediting matrix commission from here
				
			    if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
				    {
				    $commission_paid_flag=true;
					/*creditMatrixCommission($upliner,$new_id,"feeder_stage",$platform);*/
					/*Start of crediting matrix commission*/
                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
					$balance=$query_obj->amount+$commission_amount;
					$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
					$obj->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$upliner,
					'credit_amt'=>$commission_amount,
					'debit_amt'=>'0',
					'balance'=>$balance,
					'admin_charge'=>'0',
					'receiver_id'=>$upliner,
					'sender_id'=>$new_id,
					'receive_date'=>date('Y-m-d'),
					'ttype'=>'WORKER STAGE COMPLETION BONUS',
					'TranDescription'=>'WORKER STAGE COMPLETION BONUS',
					'Cause'=>'Package Purchase by '.$new_id,
					'Remark'=>'Package Purchase by '.$new_id,
					'unique_identity'=>'feeder_stage',
					'invoice_no'=>'',
					'product_name'=>'',
					'status'=>'1',
					'ewallet_used_by'=>'Withdrawal Wallet',
					'current_url'=>site_url(),
					'reason'=>'6' //credit for matrix commission
					));
					
					///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='1'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='1'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'1',
							'summary'=>'WORKER STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
					
						///////////////////////incentive/////////////////////////////////
					
					
					$obj->db->update('matrix_downline',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
				    $obj->db->update('matrix_downline',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));
					
					  $obj->db->update('user_registration',array('rank_name'=>'SUPERVISOR Stage'),array('user_id'=>$upliner));
					}
					/* end of credit matrix commission over here*/
			    //end of Crediting matrix commission for RECEPTION STAGE over here
			}
			if($lev1_num==2 && $lev2_num==4)
			{
 				$stage1_num=$obj->db->select('*')->from('reg_stage1')->get()->num_rows();
				if($stage1_num==0)
				{
				    $upliner_info=get_user_details($upliner);
					$ref_leg_position=$upliner_info->ref_leg_position;
				    $nom_leg_position=$ref_leg_position;	
					//break point if anybody is not available in next stage
					$obj->db->insert('reg_stage1',array(
						'user_id'=>$upliner,
						'nom_id'=>'cmp',
						'nom_leg_position'=>$nom_leg_position,
						'plan_type'=>$platform
						));
					$obj->db->update('user_registration',array('rank_name'=>'SUPERVISOR Stage'),array('user_id'=>$upliner));
				}
				else ///if someone is available but it's not guarantee that your sponsor will be available
				{
					$n1=$obj->db->select('*')->from('reg_stage1')->where('user_id',$upliner)->get()->num_rows();
					if($n1==0)
					{
					$obj->db->update('user_registration',array('rank_name'=>'SUPERVISOR Stage'),array('user_id'=>$upliner));
					move_stage1($upliner,$platform);
					}
				}
				/*************************************/
			}
	    }//end foreach
}//end check_upliners1() function
function move_stage1($upliner,$platform)
{
	$obj=& get_instance();
	///main break point
	//if someone is available in next stage but it's not guarantee that you sponser will be available
	//we have position and sponsor both to find out according to user registration
	//$two=$obj->db->select('*')->from('reg_stage1')->where('status','0')->limit('1','0')->get()->row_array();
	//old sponsor and and own  ref_leg position passed
	$upliner_info=get_user_details($upliner);
	$nom_id_info=getFollowMeMatrixNom1($upliner_info->ref_id,$upliner_info->ref_leg_position,'reg_stage1');
	$nom=$nom_id_info['nom_id'];
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	echo "move stage1 p1\n";
	/////////////////////////////////////////////////
	if(!empty($nom) && !empty($nom_leg_position))
	{
		echo "move stage1 p2\n";
		$two=$obj->db->select('*')->from('reg_stage1')->where(array('status'=>'0','user_id'=>$nom))->limit('1','0')->get()->row_array();
		//$nom=$two['user_id'];
		//break point
		$obj->db->insert('reg_stage1',array(
			'user_id'=>$upliner,
			'nom_id'=>$nom,
			'nom_leg_position'=>$nom_leg_position,
			'plan_type'=>$platform
			));
		if($two['final_status']==0)
		{
		  $obj->db->update("reg_stage1",array("final_status"=>"1"),array("id"=>$two['id']));
		}
		else if($two['final_status']==1)
		{
		  $obj->db->update("reg_stage1",array("final_status"=>"2","status"=>"1"),array("id"=>$two['id']));
		}
		$date=date('Y-m-d');
		$l=1;
		echo "move stage1 p3\n";
		while($nom!='cmp')
		{
		    if($nom!='cmp')
		    {
				//break point
				$obj->db->insert('matrix_stage1',array(
					'down_id'=>$upliner,
					'income_id'=>$nom,
					'l_date'=>$date,
					'status'=>'0',
					'level'=>$l,
					'nom_leg_position'=>$nom_leg_position,
					'pay_status'=>'Unpaid',
					'plan_type'=>$platform
					));
				$l++;
				
				$exist=$obj->db->select('nom_id')->from('reg_stage1')->where('user_id',$nom)->get()->num_rows();
				if($exist<=0)
				{
					$nom='123456';
				}
				else 
				{
					$selectnompos=$obj->db->select('nom_id')->from('reg_stage1')->where('user_id',$nom)->get()->row_array();
					$nom=$selectnompos['nom_id'];
				}
				
			}//end if
		}//end while
		echo "move stage1 p4\n";
		
		////////matrix commission////////////////
		
		$matrixcom_total_amount=75;
		$table_name='matrix_stage1';
		$stage_name='SUPERVISOR STAGE';
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
						
	    ////////matrix commission////////////////	
		
       //echo "\n move_stage1";		
	}
	check_upliners2($upliner,$platform);
}//end move_stage1() function
function check_upliners2($new_id,$platform)
{
	echo "\n checkupliner 2";
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		//echo "\ncheck_upliners2\n";
		$info=$obj->db->select('*')->from('matrix_stage1')->where('down_id',$new_id)->get()->result_array();
		//$commission_amount=970;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'stage_1'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			$lev1_num=$obj->db->select('*')->from('matrix_stage1')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_stage1')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			
			
		
			
			/*Start of Crediting matrix commission for SILVER stage*/
			$lev1_num_info=$obj->db->select('*')->from('matrix_stage1')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_stage1')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			
			
			
			if($lev1_num==2 && $lev2_num==4)
				{
					if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
					    {
						$commission_paid_flag=true;
					    //creditMatrixCommission($upliner,$new_id,"stage_1",$platform);
						/*Start of crediting matrix of Silver Stage commission*/
						
	                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
						$balance=$query_obj->amount+$commission_amount;
						$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
						
						$obj->db->insert('credit_debit',array(
						'transaction_no'=>generateUniqueTranNo(),
						'user_id'=>$upliner,
						'credit_amt'=>$commission_amount,
						'debit_amt'=>'0',
						'balance'=>$balance,
						'admin_charge'=>'0',
						'receiver_id'=>$upliner,
						'sender_id'=>$new_id,
						'receive_date'=>date('Y-m-d'),
						'ttype'=>'SUPERVISOR STAGE COMPLETION BONUS',
						'TranDescription'=>'SUPERVISOR STAGE COMPLETION BONUS',
						'Cause'=>'Package Purchase by '.$new_id,
						'Remark'=>'Package Purchase by '.$new_id,
						'unique_identity'=>'stage_1',
						'invoice_no'=>'',
						'product_name'=>'',
						'status'=>'1',
						'ewallet_used_by'=>'Withdrawal Wallet',
						'current_url'=>site_url(),
						'reason'=>'6' //credit for matrix commission
						));
						
						
						///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='2'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='2'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'2',
							'summary'=>'SUPERVISOR STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
					
						///////////////////////incentive/////////////////////////////////
						
						
						$obj->db->update('matrix_stage1',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
						
						$obj->db->update('matrix_stage1',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));
						
						
						$obj->db->update('user_registration',array('rank_name'=>'MANAGER Stage'),array('user_id'=>$upliner));
					}//end unpaid if here			
					//echo "\nend of check_upliners2 out unpaid\n";

				}
				if($lev1_num==2 && $lev2_num==4)
				{
					$stage2_num=$obj->db->select('*')->from('reg_stage2')->get()->num_rows();
					if($stage2_num==0)
					{
						//echo "\nend of check_upliners2 if\n";
						$upliner_info=get_user_details($upliner);
						$ref_leg_position=$upliner_info->ref_leg_position;
						$nom_leg_position=$ref_leg_position;	
					   //break point if anybody is not available in next stage
						$obj->db->insert('reg_stage2',array(
							'user_id'=>$upliner,
							'nom_id'=>'cmp',
							'nom_leg_position'=>$nom_leg_position,
							'plan_type'=>$platform
							));
						$obj->db->update('user_registration',array('rank_name'=>'MANAGER Stage'),array('user_id'=>$upliner));
					}
					else
					{
						$n1=$obj->db->select('*')->from('reg_stage2')->where('user_id',$upliner)->get()->num_rows();
						if($n1==0)
						{
						$obj->db->update('user_registration',array('rank_name'=>'MANAGER Stage'),array('user_id'=>$upliner));
						echo "\nend of check_upliners2 near move stage2\n";
						move_stage2($upliner,$platform);
						}
					}
					/*************************************/
				  
				}
	    }//end foreach
		echo "\nend of check_upliners2\n";
}//end check_upliners2() function	    
function move_stage2($upliner,$platform)
{
	$obj=& get_instance();
	///main break point
	//if someone is available in next stage but it's not guarantee that you sponser will be available
	//we have position and sponsor both to find out according to user registration
	//$two=$obj->db->select('*')->from('reg_stage1')->where('status','0')->limit('1','0')->get()->row_array();
	//old sponsor and and own  ref_leg position passed
    //echo "move stage2 befor nom method\n";
	$upliner_info=get_user_details($upliner);
	$nom_id_info=getFollowMeMatrixNom1($upliner_info->ref_id,$upliner_info->ref_leg_position,'reg_stage2');
	 //echo "move stage2 after nom method\n";
	$nom=$nom_id_info['nom_id'];
	$nom_leg_position=$nom_id_info['nom_leg_position'];

	//////////////////////////////////////////
	if(!empty($nom) && !empty($nom_leg_position))
	{
		$two=$obj->db->select('*')->from('reg_stage2')->where(array('status'=>'0','user_id'=>$nom))->limit('1','0')->get()->row_array();
		//$nom=$two['user_id'];
		//break point
		$obj->db->insert('reg_stage2',array(
			'user_id'=>$upliner,
			'nom_id'=>$nom,
			'nom_leg_position'=>$nom_leg_position,
			'plan_type'=>$platform
			));
		if($two['final_status']==0)
		{
		  $obj->db->update("reg_stage2",array("final_status"=>"1"),array("id"=>$two['id']));
		}
		else if($two['final_status']==1)
		{
		  $obj->db->update("reg_stage2",array("final_status"=>"2","status"=>"1"),array("id"=>$two['id']));
		}
		$date=date('Y-m-d');
		$l=1;
		while($nom!='cmp')
		{
		    if($nom!='cmp')
		    {
				$obj->db->insert('matrix_stage2',array(
					'down_id'=>$upliner,
					'income_id'=>$nom,
					'l_date'=>$date,
					'status'=>'0',
					'level'=>$l,
					'nom_leg_position'=>$nom_leg_position,
					'pay_status'=>'Unpaid',
					'plan_type'=>$platform
					));
				$l++;
				$exist=$obj->db->select('nom_id')->from('reg_stage2')->where('user_id',$nom)->get()->num_rows();
				if($exist<=0)
				{
					$nom='123456';
				}
				else 
				{
				$selectnompos=$obj->db->select('nom_id')->from('reg_stage2')->where('user_id',$nom)->get()->row_array();
				$nom=$selectnompos['nom_id'];
				}
			}//end if
		}//end while	

		////////matrix commission////////////////
		
		$matrixcom_total_amount=140;
		$table_name='matrix_stage2';
		$stage_name='MANAGER STAGE';
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
						
	    ////////matrix commission////////////////
		
	}
	check_upliners3($upliner,$platform);
}//end move_stage2() function
function check_upliners3($new_id,$platform)
{
	echo "\n checkupliner 3";
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		//echo "check_upliners3";
		$info=$obj->db->select('*')->from('matrix_stage2')->where('down_id',$new_id)->get()->result_array();
		//$commission_amount=10000;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'stage_2'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			$lev1_num=$obj->db->select('*')->from('matrix_stage2')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_stage2')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			
			
			
			/*Start of Crediting matrix commission for Gold stage*/
			
			$lev1_num_info=$obj->db->select('*')->from('matrix_stage2')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_stage2')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			
			
			if($lev1_num==2 && $lev2_num==4)
			{
				if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
				    {
					$commission_paid_flag=true;
				    //creditMatrixCommission($upliner,$new_id,"stage_1",$platform);
					/*Start of crediting matrix of Gold Stage commission*/
					
                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
					$balance=$query_obj->amount+$commission_amount;
					$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
					$obj->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$upliner,
					'credit_amt'=>$commission_amount,
					'debit_amt'=>'0',
					'balance'=>$balance,
					'admin_charge'=>'0',
					'receiver_id'=>$upliner,
					'sender_id'=>$new_id,
					'receive_date'=>date('Y-m-d'),
					'ttype'=>'MANAGER STAGE COMPLETION BONUS',
					'TranDescription'=>'MANAGER STAGE COMPLETION BONUS',
					'Cause'=>'Package Purchase by '.$new_id,
					'Remark'=>'Package Purchase by '.$new_id,
					'unique_identity'=>'stage_2',
					'invoice_no'=>'',
					'product_name'=>'',
					'status'=>'1',
					'ewallet_used_by'=>'Withdrawal Wallet',
					'current_url'=>site_url(),
					'reason'=>'6' //credit for matrix commission
					));
					
					
					///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='3'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='3'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'3',
							'summary'=>'MANAGER STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
					
						///////////////////////incentive/////////////////////////////////
					
					$obj->db->update('matrix_stage2',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
					
					$obj->db->update('matrix_stage2',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));
					
					
					$obj->db->update('user_registration',array('rank_name'=>'GENERAL MANAGER Stage'),array('user_id'=>$upliner));
					
				}//end unpaid if here			
			}
			if($lev1_num==2 && $lev2_num==4)
			{
			    $stage3_num=$obj->db->select('*')->from('reg_stage3')->get()->num_rows();
				if($stage3_num==0)
				{
					$upliner_info=get_user_details($upliner);
					$ref_leg_position=$upliner_info->ref_leg_position;
				    $nom_leg_position=$ref_leg_position;	
					//break point if anybody is not available in next stage
					$obj->db->insert('reg_stage3',array(
						'user_id'=>$upliner,
						'nom_id'=>'cmp',
						'nom_leg_position'=>$nom_leg_position,
						'plan_type'=>$platform
						));
					$obj->db->update('user_registration',array('rank_name'=>'GENERAL MANAGER Stage'),array('user_id'=>$upliner));
				}
				else
				{
					$n1=$obj->db->select('*')->from('reg_stage3')->where('user_id',$upliner)->get()->num_rows();
					if($n1==0)
					{
					$obj->db->update('user_registration',array('rank_name'=>'GENERAL MANAGER Stage'),array('user_id'=>$upliner));
					move_stage3($upliner,$platform);
					}
				}
			}
	    }//end foreach
}//end check_upliners3() function
function move_stage3($upliner,$platform)
{
	$obj=& get_instance();
	///main break point
	//if someone is available in next stage but it's not guarantee that you sponser will be available
	//we have position and sponsor both to find out according to user registration
	//$two=$obj->db->select('*')->from('reg_stage1')->where('status','0')->limit('1','0')->get()->row_array();
	//old sponsor and and own  ref_leg position passed
	//echo "\nmove stage3";
	$upliner_info=get_user_details($upliner);
	$nom_id_info=getFollowMeMatrixNom1($upliner_info->ref_id,$upliner_info->ref_leg_position,'reg_stage3');
	$nom=$nom_id_info['nom_id'];
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	/////////////////////
	//echo "move stage3\n";
	if(!empty($nom) && !empty($nom_leg_position))
	{
		$two=$obj->db->select('*')->from('reg_stage3')->where(array('status'=>'0','user_id'=>$nom))->limit('1','0')->get()->row_array();
		//$nom=$two['user_id'];
		//break point
		$obj->db->insert('reg_stage3',array(
			'user_id'=>$upliner,
			'nom_id'=>$nom,
			'nom_leg_position'=>$nom_leg_position,
			'plan_type'=>$platform
			));
		if($two['final_status']==0)
		{
		  $obj->db->update("reg_stage3",array("final_status"=>"1"),array("id"=>$two['id']));
		}
		else if($two['final_status']==1)
		{
		  $obj->db->update("reg_stage3",array("final_status"=>"2","status"=>"1"),array("id"=>$two['id']));
		}
		$date=date('Y-m-d');
		$l=1;
		while($nom!='cmp')
		{
		    if($nom!='cmp')
		    {
				$obj->db->insert('matrix_stage3',array(
					'down_id'=>$upliner,
					'income_id'=>$nom,
					'l_date'=>$date,
					'status'=>'0',
					'level'=>$l,
					'nom_leg_position'=>$nom_leg_position,
					'pay_status'=>'Unpaid',
					'plan_type'=>$platform
					));
				$l++;
				$exist=$obj->db->select('nom_id')->from('reg_stage3')->where('user_id',$nom)->get()->num_rows();
				if($exist<=0)
				{
					$nom='123456';
				}
				else 
				{
				$selectnompos=$obj->db->select('nom_id')->from('reg_stage3')->where('user_id',$nom)->get()->row_array();
				$nom=$selectnompos['nom_id'];
				}
			}//end if
		}//end while	

		////////matrix commission////////////////
		
		$matrixcom_total_amount=500;
		$table_name='matrix_stage3';
		$stage_name='GENERAL MANAGER STAGE';
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
						
	    ////////matrix commission////////////////
		
		
	}
	check_upliners4($upliner,$platform);

}//end move_stage3() function

function check_upliners4($new_id,$platform)
{
	echo "\n checkupliner 4";
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		$info=$obj->db->select('*')->from('matrix_stage3')->where('down_id',$new_id)->get()->result_array();
		//$commission_amount=75000;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'stage_3'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			$lev1_num=$obj->db->select('*')->from('matrix_stage3')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_stage3')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			
			
			
			/*Start of Crediting matrix commission for PLATINUM stage*/
			$lev1_num_info=$obj->db->select('*')->from('matrix_stage3')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_stage3')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			
		

			if($lev1_num==2 && $lev2_num==4)
			{
				if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
				    {
				    //creditMatrixCommission($upliner,$new_id,"stage_1",$platform);
					/*Start of crediting matrix commission*/
					$commission_paid_flag=true;
                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
					$balance=$query_obj->amount+$commission_amount;
					$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
					$obj->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$upliner,
					'credit_amt'=>$commission_amount,
					'debit_amt'=>'0',
					'balance'=>$balance,
					'admin_charge'=>'0',
					'receiver_id'=>$upliner,
					'sender_id'=>$new_id,
					'receive_date'=>date('Y-m-d'),
					'ttype'=>'GENERAL MANAGER STAGE COMPLETION BONUS',
					'TranDescription'=>'GENERAL MANAGER STAGE COMPLETION BONUS',
					'Cause'=>'Package Purchase by '.$new_id,
					'Remark'=>'Package Purchase by '.$new_id,
					'unique_identity'=>'stage_3',
					'invoice_no'=>'',
					'product_name'=>'',
					'status'=>'1',
					'ewallet_used_by'=>'Withdrawal Wallet',
					'current_url'=>site_url(),
					'reason'=>'6' //credit for matrix commission
					));
					
					///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='4'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='4'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'4',
							'summary'=>'GENERAL MANAGER STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
					
						///////////////////////incentive/////////////////////////////////
					
					$obj->db->update('matrix_stage3',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
					
					$obj->db->update('matrix_stage3',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));
					
					
					
					$obj->db->update('user_registration',array('rank_name'=>'ASSISTANT DIRECTOR Stage'),array('user_id'=>$upliner));
				}//end unpaid if here			
			}
			/*End of Crediting matrix commission for MANAGER ZONE stage*/
			if($lev1_num==2 && $lev2_num==4)
			{
			    $stage4_num=$obj->db->select('*')->from('reg_stage4')->get()->num_rows();
				if($stage4_num==0)
				{
				    $upliner_info=get_user_details($upliner);
					$ref_leg_position=$upliner_info->ref_leg_position;
				    $nom_leg_position=$ref_leg_position;	
					//break point if anybody is not available in next stage
					$obj->db->insert('reg_stage4',array(
						'user_id'=>$upliner,
						'nom_id'=>'cmp',
						'nom_leg_position'=>$nom_leg_position,
						'plan_type'=>$platform
						));
					$obj->db->update('user_registration',array('rank_name'=>'ASSISTANT DIRECTOR Stage'),array('user_id'=>$upliner));
				}
				else
				{
					$n1=$obj->db->select('*')->from('reg_stage4')->where('user_id',$upliner)->get()->num_rows();
					if($n1==0)
					{
					$obj->db->update('user_registration',array('rank_name'=>'ASSISTANT DIRECTOR Stage'),array('user_id'=>$upliner));
					move_stage4($upliner,$platform);
					}
				}
				
			}
	    }//end foreach
}//end check_upliners4() function

function move_stage4($upliner,$platform)
{
	$obj=& get_instance();
	///main break point
	//if someone is available in next stage but it's not guarantee that you sponser will be available
	//we have position and sponsor both to find out according to user registration
	//$two=$obj->db->select('*')->from('reg_stage1')->where('status','0')->limit('1','0')->get()->row_array();
	//old sponsor and and own  ref_leg position passed
	//echo "\nmove stage4";
	$upliner_info=get_user_details($upliner);
	$nom_id_info=getFollowMeMatrixNom1($upliner_info->ref_id,$upliner_info->ref_leg_position,'reg_stage4');
	$nom=$nom_id_info['nom_id'];
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	////////////////////////////////////////////
	//echo "\nmove stage4\n";
	if(!empty($nom) && !empty($nom_leg_position))
	{
		$two=$obj->db->select('*')->from('reg_stage4')->where(array('status'=>'0','user_id'=>$nom))->limit('1','0')->get()->row_array();
		$obj->db->insert('reg_stage4',array(
			'user_id'=>$upliner,
			'nom_id'=>$nom,
			'nom_leg_position'=>$nom_leg_position,
			'plan_type'=>$platform
			));
		if($two['final_status']==0)
		{
		  $obj->db->update("reg_stage4",array("final_status"=>"1"),array("id"=>$two['id']));
		}
		else if($two['final_status']==1)
		{
		  $obj->db->update("reg_stage4",array("final_status"=>"2","status"=>"1"),array("id"=>$two['id']));
		}
		$date=date('Y-m-d');
		$l=1;
		while($nom!='cmp')
		{
		    if($nom!='cmp')
		    {
				$obj->db->insert('matrix_stage4',array(
					'down_id'=>$upliner,
					'income_id'=>$nom,
					'l_date'=>$date,
					'status'=>'0',
					'level'=>$l,
					'nom_leg_position'=>$nom_leg_position,
					'pay_status'=>'Unpaid',
					'plan_type'=>$platform
					));
				$l++;
				$exist=$obj->db->select('nom_id')->from('reg_stage4')->where('user_id',$nom)->get()->num_rows();
				if($exist<=0)
				{
					$nom='123456';
				}
				else 
				{
				$selectnompos=$obj->db->select('nom_id')->from('reg_stage4')->where('user_id',$nom)->get()->row_array();
				$nom=$selectnompos['nom_id'];
				}
			}//end if
		}//end while

		////////matrix commission////////////////
		
		$matrixcom_total_amount=2500;
		$table_name='matrix_stage4';
		$stage_name='ASSISTANT DIRECTOR STAGE';
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
						
	    ////////matrix commission////////////////
		
	}
	check_upliners5($upliner,$platform);
}//end move_stage4() function
function check_upliners5($new_id,$platform)
{
	echo "\n checkupliner 5";
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		//echo "\ncheck_upliners5";
		$info=$obj->db->select('*')->from('matrix_stage4')->where('down_id',$new_id)->get()->result_array();
		//$commission_amount=250000;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'stage_4'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			$lev1_num=$obj->db->select('*')->from('matrix_stage4')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_stage4')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			
			
			
			/*Start of Crediting matrix commission for DIAMOND stage*/
			$lev1_num_info=$obj->db->select('*')->from('matrix_stage4')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_stage4')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			
			
			

			if($lev1_num==2 && $lev2_num==4)
			{
				if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
				    {
					$commission_paid_flag=true;
				    //creditMatrixCommission($upliner,$new_id,"stage_1",$platform);
					/*Start of crediting matrix of Diamond stage commission*/
                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
					$balance=$query_obj->amount+$commission_amount;
					$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
					$obj->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$upliner,
					'credit_amt'=>$commission_amount,
					'debit_amt'=>'0',
					'balance'=>$balance,
					'admin_charge'=>'0',
					'receiver_id'=>$upliner,
					'sender_id'=>$new_id,
					'receive_date'=>date('Y-m-d'),
					'ttype'=>'ASSISTANT DIRECTOR STAGE COMPLETION BONUS',
					'TranDescription'=>'ASSISTANT DIRECTOR STAGE COMPLETION BONUS',
					'Cause'=>'Package Purchase by '.$new_id,
					'Remark'=>'Package Purchase by '.$new_id,
					'unique_identity'=>'stage_4',
					'invoice_no'=>'',
					'product_name'=>'',
					'status'=>'1',
					'ewallet_used_by'=>'Withdrawal Wallet',
					'current_url'=>site_url(),
					'reason'=>'6' //credit for matrix commission
					));

					///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='5'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='5'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'5',
							'summary'=>'ASSISTANT DIRECTOR STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
					
						///////////////////////incentive/////////////////////////////////
					
					$obj->db->update('matrix_stage4',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
					
					$obj->db->update('matrix_stage4',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));
					
					
					
					$obj->db->update('user_registration',array('rank_name'=>'DIRECTOR Stage'),array('user_id'=>$upliner));
				}//end unpaid if here				
			}
			/*End of Crediting matrix commission for GENERAL MANAGER  stage*/			
			if($lev1_num==2 && $lev2_num==4)
			{
			    
			    $stage5_num=$obj->db->select('*')->from('reg_stage5')->get()->num_rows();
				if($stage5_num==0)
				{
					$upliner_info=get_user_details($upliner);
					$ref_leg_position=$upliner_info->ref_leg_position;
				    $nom_leg_position=$ref_leg_position;	
					//break point if anybody is not available in next stage
					$obj->db->insert('reg_stage5',array(
						'user_id'=>$upliner,
						'nom_id'=>'cmp',
						'nom_leg_position'=>$nom_leg_position,
						'plan_type'=>$platform
						));
					$obj->db->update('user_registration',array('rank_name'=>'DIRECTOR Stage'),array('user_id'=>$upliner));
				}
				else
				{
					$n1=$obj->db->select('*')->from('reg_stage5')->where('user_id',$upliner)->get()->num_rows();
					if($n1==0)
					{
					$obj->db->update('user_registration',array('rank_name'=>'DIRECTOR Stage'),array('user_id'=>$upliner));
					move_stage5($upliner,$platform);
					}
				}
				
			}
	    }//end foreach
}//end check_upliners5() function

function move_stage5($upliner,$platform)
{
	$obj=& get_instance();
	///main break point
	//if someone is available in next stage but it's not guarantee that you sponser will be available
	//we have position and sponsor both to find out according to user registration
	//$two=$obj->db->select('*')->from('reg_stage1')->where('status','0')->limit('1','0')->get()->row_array();
	//old sponsor and and own  ref_leg position passed
	//echo "\nmove_stage5";
	$upliner_info=get_user_details($upliner);
	$nom_id_info=getFollowMeMatrixNom1($upliner_info->ref_id,$upliner_info->ref_leg_position,'reg_stage5');
	$nom=$nom_id_info['nom_id'];
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	//echo "move stage5\n";
	///////////////////////////////////////////
	if(!empty($nom) && !empty($nom_leg_position))
	{
		$two=$obj->db->select('*')->from('reg_stage5')->where(array('status'=>'0','user_id'=>$nom))->limit('1','0')->get()->row_array();
		$obj->db->insert('reg_stage5',array(
			'user_id'=>$upliner,
			'nom_id'=>$nom,
			'nom_leg_position'=>$nom_leg_position,
			'plan_type'=>$platform
			));
		if($two['final_status']==0)
		{
		  $obj->db->update("reg_stage5",array("final_status"=>"1"),array("id"=>$two['id']));
		}
		else if($two['final_status']==1)
		{
		  $obj->db->update("reg_stage5",array("final_status"=>"2","status"=>"1"),array("id"=>$two['id']));
		}
		$date=date('Y-m-d');
		$l=1;
		while($nom!='cmp')
		{
		    if($nom!='cmp')
		    {
				$obj->db->insert('matrix_stage5',array(
					'down_id'=>$upliner,
					'income_id'=>$nom,
					'l_date'=>$date,
					'status'=>'0',
					'level'=>$l,
					'nom_leg_position'=>$nom_leg_position,
					'pay_status'=>'Unpaid',
					'plan_type'=>$platform
					));
				$l++;
				$exist=$obj->db->select('nom_id')->from('reg_stage5')->where('user_id',$nom)->get()->num_rows();
				if($exist<=0)
				{
					$nom='123456';
				}
				else 
				{
				$selectnompos=$obj->db->select('nom_id')->from('reg_stage5')->where('user_id',$nom)->get()->row_array();
				$nom=$selectnompos['nom_id'];
				}
			}//end if
		}//end while		
		
		////////matrix commission////////////////
		
		$matrixcom_total_amount=16000;
		$table_name='matrix_stage5';
		$stage_name='DIRECTOR STAGE';
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
						
	    ////////matrix commission////////////////
		
	}
	check_upliners6($upliner,$platform);
}//end move_stage5() function

function check_upliners6($new_id,$platform)
{
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		//echo "\ncheck_upliners6";
		$info=$obj->db->select('*')->from('matrix_stage5')->where('down_id',$new_id)->get()->result_array();
		//$commission_amount=750000;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'stage_5'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			$lev1_num=$obj->db->select('*')->from('matrix_stage5')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_stage5')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			
			
			
			/*Start of Crediting matrix commission for SENIOR DIAMOND stage*/
			$lev1_num_info=$obj->db->select('*')->from('matrix_stage5')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_stage5')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			
			
			if($lev1_num==2 && $lev2_num==4)
			{
				if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
				    {
					$commission_paid_flag=true;
				    //creditMatrixCommission($upliner,$new_id,"stage_1",$platform);
					/*Start of crediting matrix of SENIOR DIAMOND commission*/
					
                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
					$balance=$query_obj->amount+$commission_amount;
					$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
					$obj->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$upliner,
					'credit_amt'=>$commission_amount,
					'debit_amt'=>'0',
					'balance'=>$balance,
					'admin_charge'=>'0',
					'receiver_id'=>$upliner,
					'sender_id'=>$new_id,
					'receive_date'=>date('d-m-Y'),
					'ttype'=>'DIRECTOR Stage COMPLETION BONUS',
					'TranDescription'=>'CROWN DIAMOND Stage COMPLETION BONUS',
					'Cause'=>'Package Purchase by '.$new_id,
					'Remark'=>'Package Purchase by '.$new_id,
					'unique_identity'=>'stage_5',
					'invoice_no'=>'',
					'product_name'=>'',
					'status'=>'1',
					'ewallet_used_by'=>'Withdrawal Wallet',
					'current_url'=>site_url(),
					'reason'=>'6' //credit for matrix commission
					));
					
					///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='6'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='6'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'6',
							'summary'=>'DIRECTOR STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
					
						///////////////////////incentive/////////////////////////////////
					
					$obj->db->update('matrix_stage5',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
					
					$obj->db->update('matrix_stage5',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));

					
					
					$obj->db->update('user_registration',array('rank_name'=>'ACTING CEO Stage'),array('user_id'=>$upliner));
					}//end unpaid if here			
			}
			
			/*End of Crediting matrix commission for DIRECTOR ZONE stage*/	
			if($lev1_num==2 && $lev2_num==4)
			{
			    $stage6_num=$obj->db->select('*')->from('reg_stage6')->get()->num_rows();
				if($stage6_num==0)
				{
					$upliner_info=get_user_details($upliner);
					$ref_leg_position=$upliner_info->ref_leg_position;
				    $nom_leg_position=$ref_leg_position;	
					//break point if anybody is not available in next stage
					$obj->db->insert('reg_stage6',array(
							'user_id'=>$upliner,
							'nom_id'=>'cmp',
							'nom_leg_position'=>$nom_leg_position,
							'plan_type'=>$platform
					));
					$obj->db->update('user_registration',array('rank_name'=>'ACTING CEO SATGE'),array('user_id'=>$upliner));
				}
				else
				{
					$n1=$obj->db->select('*')->from('reg_stage6')->where('user_id',$upliner)->get()->num_rows();
					if($n1==0)
					{
					//mysql_query("update user_registration set rank_name='B. O. T. Partner' where user_id='".$upliner."'");
					$obj->db->update('user_registration',array('rank_name'=>'ACTING CEO Stage'),array('user_id'=>$upliner));
					move_stage6($upliner,$platform);
					}
				}
				
			}
	    }//end foreach
}//end check_upliners6() function
function move_stage6($upliner,$platform)
{
	$obj=& get_instance();
	///main break point
	//if someone is available in next stage but it's not guarantee that you sponser will be available
	//we have position and sponsor both to find out according to user registration
	//$two=$obj->db->select('*')->from('reg_stage1')->where('status','0')->limit('1','0')->get()->row_array();
	//old sponsor and and own  ref_leg position passed
	//echo "move stage6\n";
	$upliner_info=get_user_details($upliner);
	$nom_id_info=getFollowMeMatrixNom1($upliner_info->ref_id,$upliner_info->ref_leg_position,'reg_stage6');
	$nom=$nom_id_info['nom_id'];
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	//echo "move stage6\n";
	//////////////////////
	if(!empty($nom) && count($nom_leg_position)>0)
	{
		$two=$obj->db->select('*')->from('reg_stage6')->where(array('status'=>'0','user_id'=>$nom))->limit('1','0')->get()->row_array();
		$obj->db->insert('reg_stage6',array(
			'user_id'=>$upliner,
			'nom_id'=>$nom,
			'nom_leg_position'=>$nom_leg_position,
			'plan_type'=>$platform
			));
		if($two['final_status']==0)
		{
		  $obj->db->update("reg_stage6",array("final_status"=>"1"),array("id"=>$two['id']));
		}
		else if($two['final_status']==1)
		{
		  $obj->db->update("reg_stage6",array("final_status"=>"2","status"=>"1"),array("id"=>$two['id']));
		}
		$date=date('Y-m-d');
		$l=1;
		while($nom!='cmp')
		{
		    if($nom!='cmp')
		    {
				$obj->db->insert('matrix_stage6',array(
					'down_id'=>$upliner,
					'income_id'=>$nom,
					'l_date'=>$date,
					'status'=>'0',
					'level'=>$l,
					'nom_leg_position'=>$nom_leg_position,
					'pay_status'=>'Unpaid',
					'plan_type'=>$platform
					));
				$l++;
				$exist=$obj->db->select('nom_id')->from('reg_stage6')->where('user_id',$nom)->get()->num_rows();
				if($exist<=0)
				{
					$nom='123456';
				}
				else 
				{
				$selectnompos=$obj->db->select('nom_id')->from('reg_stage6')->where('user_id',$nom)->get()->row_array();
				$nom=$selectnompos['nom_id'];
				}
			}//end if
		}//end while	

		////////matrix commission////////////////
		
		$matrixcom_total_amount=20000;
		$table_name='matrix_stage6';
		$stage_name='ACTING CEO';
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
						
	    ////////matrix commission////////////////	
	}
	check_upliners7($upliner,$platform);
}//end move_stage6() function
function check_upliners7($new_id,$platform)
{
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		//echo "\ncheck_upliners7";
		$info=$obj->db->select('*')->from('matrix_stage6')->where('down_id',$new_id)->get()->result_array();
		//$commission_amount=150000;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'stage_6'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			$lev1_num=$obj->db->select('*')->from('matrix_stage6')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_stage6')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			
			
			
			//////////////////////////////////////////////

			$lev1_num_info=$obj->db->select('*')->from('matrix_stage6')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_stage6')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			
			

			if($lev1_num==2 && $lev2_num==4)
			{
			    /*
			    Crediting matrix completion commission into TITANIUM stages to the upliners
			    */
			    ///start of Crediting matrix commission of TITANIUM stage from here
				   
					if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
				    {
						 $commission_paid_flag=true;
					    //creditMatrixCommission($upliner,$new_id,"stage_1",$platform);
						/*Start of crediting matrix of TITANIUM Stage commission*/
						
	                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
						$balance=$query_obj->amount+$commission_amount;
						$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
						$obj->db->insert('credit_debit',array(
						'transaction_no'=>generateUniqueTranNo(),
						'user_id'=>$upliner,
						'credit_amt'=>$commission_amount,
						'debit_amt'=>'0',
						'balance'=>$balance,
						'admin_charge'=>'0',
						'receiver_id'=>$upliner,
						'sender_id'=>$new_id,
						'receive_date'=>date('d-m-Y'),
						'ttype'=>'ACTING CEO STAGE COMPLETION BONUS',
						'TranDescription'=>'ACTING CEO STAGE COMPLETION BONUS',
						'Cause'=>'Package Purchase by '.$new_id,
						'Remark'=>'Package Purchase by '.$new_id,
						'unique_identity'=>'stage_6',
						'invoice_no'=>'',
						'product_name'=>'',
						'status'=>'1',
						'ewallet_used_by'=>'Withdrawal Wallet',
						'current_url'=>site_url(),
						'reason'=>'6' //credit for matrix commission
						));	
						
						///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='7'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='7'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'7',
							'summary'=>'ACTING CEO STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
											///////////////////////incentive/////////////////////////////////
					     
						 $obj->db->update('matrix_stage6',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
					     
						 $obj->db->update('matrix_stage6',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));
						 
						 
						 
						 $obj->db->update('user_registration',array('rank_name'=>'CEO Stage'),array('user_id'=>$upliner));
						 
					}
			  //all stage matrix completion code here
			}//end level if
			
			
			/*End of Crediting matrix commission for DIRECTOR ZONE stage*/	
			if($lev1_num==2 && $lev2_num==4)
			{
			    $stage6_num=$obj->db->select('*')->from('reg_stage7')->get()->num_rows();
				if($stage6_num==0)
				{
					$upliner_info=get_user_details($upliner);
					$ref_leg_position=$upliner_info->ref_leg_position;
				    $nom_leg_position=$ref_leg_position;	
					//break point if anybody is not available in next stage
					$obj->db->insert('reg_stage7',array(
							'user_id'=>$upliner,
							'nom_id'=>'cmp',
							'nom_leg_position'=>$nom_leg_position,
							'plan_type'=>$platform
					));
					$obj->db->update('user_registration',array('rank_name'=>'CEO Stage'),array('user_id'=>$upliner));
				}
				else
				{
					$n1=$obj->db->select('*')->from('reg_stage7')->where('user_id',$upliner)->get()->num_rows();
					if($n1==0)
					{
					//mysql_query("update user_registration set rank_name='B. O. T. Partner' where user_id='".$upliner."'");
					$obj->db->update('user_registration',array('rank_name'=>'CEO Stage'),array('user_id'=>$upliner));
					move_stage7($upliner,$platform);
					}
				}
				
			}
			
			
	    }//end foreach
}//end check_upliners7() function


function move_stage7($upliner,$platform)
{
	$obj=& get_instance();
	///main break point
	//if someone is available in next stage but it's not guarantee that you sponser will be available
	//we have position and sponsor both to find out according to user registration
	//$two=$obj->db->select('*')->from('reg_stage1')->where('status','0')->limit('1','0')->get()->row_array();
	//old sponsor and and own  ref_leg position passed
	//echo "move stage6\n";
	$upliner_info=get_user_details($upliner);
	$nom_id_info=getFollowMeMatrixNom1($upliner_info->ref_id,$upliner_info->ref_leg_position,'reg_stage7');
	$nom=$nom_id_info['nom_id'];
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	//echo "move stage6\n";
	//////////////////////
	if(!empty($nom) && count($nom_leg_position)>0)
	{
		$two=$obj->db->select('*')->from('reg_stage7')->where(array('status'=>'0','user_id'=>$nom))->limit('1','0')->get()->row_array();
		$obj->db->insert('reg_stage7',array(
			'user_id'=>$upliner,
			'nom_id'=>$nom,
			'nom_leg_position'=>$nom_leg_position,
			'plan_type'=>$platform
			));
		if($two['final_status']==0)
		{
		  $obj->db->update("reg_stage7",array("final_status"=>"1"),array("id"=>$two['id']));
		}
		else if($two['final_status']==1)
		{
		  $obj->db->update("reg_stage7",array("final_status"=>"2","status"=>"1"),array("id"=>$two['id']));
		}
		$date=date('Y-m-d');
		$l=1;
		while($nom!='cmp')
		{
		    if($nom!='cmp')
		    {
				$obj->db->insert('matrix_stage7',array(
					'down_id'=>$upliner,
					'income_id'=>$nom,
					'l_date'=>$date,
					'status'=>'0',
					'level'=>$l,
					'nom_leg_position'=>$nom_leg_position,
					'pay_status'=>'Unpaid',
					'plan_type'=>$platform
					));
				$l++;
				$exist=$obj->db->select('nom_id')->from('reg_stage7')->where('user_id',$nom)->get()->num_rows();
				if($exist<=0)
				{
					$nom='123456';
				}
				else 
				{
				$selectnompos=$obj->db->select('nom_id')->from('reg_stage7')->where('user_id',$nom)->get()->row_array();
				$nom=$selectnompos['nom_id'];
				}
			}//end if
		}//end while	

			////////matrix commission////////////////
		
		$matrixcom_total_amount=200000;
		$table_name='matrix_stage7';
		$stage_name='CEO STAGE';
		
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
		
	////////matrix commission////////////////
		
	}
	check_upliners8($upliner,$platform);
}//end move_stage6() function


function check_upliners8($new_id,$platform)
{
		$obj=& get_instance();
		//$qr=mysql_query("select * from matrix_downline where down_id='$new_id'");
		//echo "\ncheck_upliners7";
		$info=$obj->db->select('*')->from('matrix_stage7')->where('down_id',$new_id)->get()->result_array();
		//$commission_amount=150000;
		
		$commission_info=$obj->db->select('*')->from('matrix_stage_commission_meta')->where(array('pkg_id'=>$platform,'stage_key'=>'stage_7'))->get()->row();
		
		$commission_amount=$commission_info->commission;
		
		
		$commission_paid_flag=false;
		foreach($info as $row)
		{
			$upliner=$row['income_id'];
			$lev1_num=$obj->db->select('*')->from('matrix_stage7')->where(array('income_id'=>$upliner,'level'=>'1'))->get()->num_rows();
			
			$lev2_num=$obj->db->select('*')->from('matrix_stage7')->where(array('income_id'=>$upliner,'level'=>'2'))->get()->num_rows();
			
			
			
			//////////////////////////////////////////////

			$lev1_num_info=$obj->db->select('*')->from('matrix_stage7')->where(array('income_id'=>$upliner,'level'=>'1'))->limit('1','0')->get()->row();
			
			$lev2_num_info=$obj->db->select('*')->from('matrix_stage7')->where(array('income_id'=>$upliner,'level'=>'2'))->limit('1','0')->get()->row();
			
			

			if($lev1_num==2 && $lev2_num==4)
			{
			    /*
			    Crediting matrix completion commission into TITANIUM stages to the upliners
			    */
			    ///start of Crediting matrix commission of TITANIUM stage from here
				   
					if($lev1_num_info->pay_status=='Unpaid' && $lev2_num_info->pay_status=='Unpaid')
				    {
						 $commission_paid_flag=true;
					    //creditMatrixCommission($upliner,$new_id,"stage_1",$platform);
						/*Start of crediting matrix of TITANIUM Stage commission*/
						
	                    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$upliner)->get()->row();
						$balance=$query_obj->amount+$commission_amount;
						$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$upliner));
						$obj->db->insert('credit_debit',array(
						'transaction_no'=>generateUniqueTranNo(),
						'user_id'=>$upliner,
						'credit_amt'=>$commission_amount,
						'debit_amt'=>'0',
						'balance'=>$balance,
						'admin_charge'=>'0',
						'receiver_id'=>$upliner,
						'sender_id'=>$new_id,
						'receive_date'=>date('d-m-Y'),
						'ttype'=>'CEO STAGE COMPLETION BONUS',
						'TranDescription'=>'CROWN AMBASSADOR STAGE COMPLETION BONUS',
						'Cause'=>'Package Purchase by '.$new_id,
						'Remark'=>'Package Purchase by '.$new_id,
						'unique_identity'=>'stage_7',
						'invoice_no'=>'',
						'product_name'=>'',
						'status'=>'1',
						'ewallet_used_by'=>'Withdrawal Wallet',
						'current_url'=>site_url(),
						'reason'=>'6' //credit for matrix commission
						));	
						
						///////////////////////incentive/////////////////////////////////
					
						$incentive_exist=$obj->db->query("select * from incentive_achiever where user_id='".$upliner."' and incentive_id='8'")->num_rows();
						
						if($incentive_exist==0)
						{
							$empty_cond=$obj->db->query("select * from incentive where id='8'")->row_array();
							
							if(!empty($empty_cond['name']))
							{
							$insert_data=array(
							'user_id'=>$upliner,
							'incentive_id'=>'8',
							'summary'=>'CEO STAGE COMPLETION INCENTIVE',
							'create_date'=>date('Y-m-d')
							);	
							$obj->db->insert('incentive_achiever',$insert_data);
							}							
						}				
					
					
						///////////////////////incentive/////////////////////////////////
						
					     
						 $obj->db->update('matrix_stage7',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'1'));
					     
						 $obj->db->update('matrix_stage7',array('pay_status'=>'Paid'),array('income_id'=>$upliner,'level'=>'2'));
						 
						 
						 
						
						 
					}
			  //all stage matrix completion code here
			}//end level if
			
			
	    }//end foreach
}//end check_upliners7() function


function sendWelcomeEmailToUser($user_id,$username,$password,$transaction_pwd,$email,$sponsor_user_name)
{

	$email_data['from']='admin@charitybeginsnathi.co.za';
	$email_data['to']=$email;
	$email_data['subject']='Registration Successful on Charity Begins';
	$email_data['user_id']=$user_id;
	$email_data['username']=$username;
	$email_data['password']=$password;
	$email_data['transaction_pwd']=$transaction_pwd;
	$email_data['email']=$email;
	$email_data['sponsor_user_name']=$sponsor_user_name;
	$email_data['email-template']='user-welcome-mail';
	_sendEmail($email_data);
}//end function 
function sendNewRegistrationEmailToAdmin($user_id,$username,$password,$sponsor_username,$upliner,$email)
{

    $email_data['from']='victorglobalmlm@gmail.com';
    $email_data['to']='victorglobalmlm@gmail.com';
    $email_data['subject']='New member registration on Charity Begins';
    
    $email_data['template_header_msg']='New Member is Registered on your site <a target="_blank" href="'.site_url().'">'.site_url().'</a>';
    $email_data['user_id']=$user_id;
    $email_data['username']=$username;
    $email_data['password']=$password;
    $email_data['sponsor_username']=$sponsor_username;
    $email_data['upliner']=$upliner;
    $email_data['email']=$email;
    $email_data['email-template']='email-to-admin';
    _sendEmail($email_data);
}//end function
if(!function_exists('csvUserRegistration'))
{
   function csvUserRegistration($row_array)
   {
    $obj=& get_instance();
	echo "csvmethod\n";
    //$registerData=$obj->session->all_userdata();//open  and close comment
     /***********Mandatory filed for user registartion in binary plan start from here******************/
    ////user_registration query
    /*Sponsor and account informtaion*/
	$sponser_id=$row_array['ref_id'];
	$ref_leg_position=$row_array['ref_leg_position'];
	//$ref_id123[]=$sponser_id;
	$sponsor_exist=$obj->db->select('id')->from('user_registration')->where('user_id',$row_array['ref_id'])->get()->num_rows();
	if($sponsor_exist<=0)
	{
		$sponser_id='123456';
	}
	$nom_id_info=getFollowMeMatrixNom($sponser_id,$ref_leg_position);
	//pr($nom_id_info);
	$nom_id=$nom_id_info['nom_id'];
	$nom_id1=$nom_id;
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	if(empty($nom_leg_position))
	{
		//pr($nom_id_info);
	    echo "call";	
		die;
	}
	$pkg_id=1;
	$pkg_amount=60;
	$username=$row_array['username'];
	$user_password=$row_array['password'];
	$transaction_pwd=$row_array['t_code'];
    $user_id=$row_array['user_id'];
	
	//personal informtaion
	$first_name=$row_array['first_name'];
	$last_name=$row_array['last_name'];
	$email=$row_array['email'];
	$contact_no=$row_array['contact_no'];
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:'xxx';
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:'xxx';
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:'xxx';
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:'xxx';
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:'xxx';
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:'xxx';
	//bank account info
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:'xxx';
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:'xxx';
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:'xxx';
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:'xxx';
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:'xxx';
	//Bit coin info///
	$bit_coin_id=(!empty($registration_info['bit_coin_info']['bit_coin_id']))?$registration_info['bit_coin_info']['bit_coin_id']:'xxx';
	////////////
	$registration_info['sponsor_and_account_info']['account_type'];
	$account_type=(!empty($registration_info['sponsor_and_account_info']['account_type']))?$registration_info['sponsor_and_account_info']['account_type']:'1';

    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
			'account_type'=>$account_type,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			 'ref_leg_position'=>$ref_leg_position,
			 'nom_leg_position'=>$nom_leg_position,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
			 
    		 ////////
    		 'registration_date'=>date('Y-m-d'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
			 'registration_method_name'=>'E-wallet'
    		);
    $obj->db->insert('user_registration',$user_registration_data);
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
            $exist=$obj->db->select('nom_id')->from('user_registration')->where('user_id',$nom_id)->get()->num_rows();
				if($exist<=0)
				{
					$nom_id='123456';
				}
				else 
				{
				 $nom_info=$obj->db->select('nom_id')->from('user_registration')->where('user_id',$nom_id)->get()->row();
				 $nom_id=$nom_info->nom_id;
				}
				
			}
	}	
	$obj->db->insert_batch('matrix_downline',$matrix_downline_data);
	
	////function call for credit commission using their sponser_id,pkg id and rank
	creditDirectCommission($sponser_id,$pkg_amount,$user_id);//uncomment these line
    ////////////////////////
	check_upliners1($user_id,$pkg_id);//uncomment these line
	/*************/
	/*************/
	
	$sponsor_username=get_user_name($sponser_id);
	
	//sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_username);

	$upliner_name=get_user_name($nom_id1);
	//sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);

	return true;
   }//end function
}//end function exists0


if(!function_exists('testRegistration'))
{
   function testRegistration($username,$ref_leg_position)
   {
    $obj=& get_instance();

    //$registerData=$obj->session->all_userdata();//open  and close comment
     /***********Mandatory filed for user registartion in binary plan start from here******************/
    ////user_registration query
    /*Sponsor and account informtaion*/
    if(empty($registration_info))
	{
		$registration_info=$obj->session->userdata('registration_info');
	}
	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
	
	//$ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'left';
	//$ref_id123[]=$sponser_id;
	$nom_id_info=getFollowMeMatrixNom($sponser_id,$ref_leg_position);
	//pr($nom_id_info);
	$nom_id=$nom_id_info['nom_id'];;
	$nom_id1=$nom_id;
	$nom_leg_position=$nom_id_info['nom_leg_position'];
	
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:100;
	//$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'B7';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	//bank account info
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	//Bit coin info///
	$bit_coin_id=(!empty($registration_info['bit_coin_info']['bit_coin_id']))?$registration_info['bit_coin_info']['bit_coin_id']:null;
	////////////
	$registration_info['sponsor_and_account_info']['account_type'];
	$account_type=(!empty($registration_info['sponsor_and_account_info']['account_type']))?$registration_info['sponsor_and_account_info']['account_type']:'1';

    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
			'account_type'=>$account_type,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			 'ref_leg_position'=>$ref_leg_position,
			 'nom_leg_position'=>$nom_leg_position,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
			 
    		 ////////
    		 'registration_date'=>date('Y-m-d'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
			 'registration_method_name'=>'E-wallet'
    		);
    $obj->db->insert('user_registration',$user_registration_data);
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
	
	////////matrix commission////////////////
		
		$matrixcom_total_amount=20;
		$table_name='matrix_downline';
		$stage_name='WORKER STAGE';
		$upliner=$user_id;
		
		matrix_commission_level($matrixcom_total_amount,$upliner,$table_name,$stage_name);
		
	////////matrix commission////////////////
	
	check_upliners1($user_id,$pkg_id);//uncomment these line
	
	
	
	$sponsor_username=get_user_name($sponser_id);
	
	sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_username);

	$upliner_name=get_user_name($nom_id1);
	sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);

	return true;
   }//end function
}//end function exists0
?>