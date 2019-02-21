<?php 
/*
@author : Aditya
@param  : int(referral userid/sponsor user id)
@desc   : It's used to get binary commission for any user on the behalf of passed user_id parameter
@return assoc array
commission_amount_status=boolean (if get commission amount then status true otherwise status false),
commission_amount=int,
carry_forward_status=boolean (if get carry forward amount then status true otherwise status false),
carry_forward_amount=int,
carry_forward_leg=String(left/right)
*/
function getBinaryPairingCommission($user_id=null)
{
  $obj=& get_instance();
  /*
  Note: 
	  ->if type==1 then percent and type==2 then flat commission
	  ->if enabled_carry_forward==1 then carry forward is enabled and if enabled_carry_forward==0 then carry forward is not enabled 
	  ->if enabled_capping==1 then  capping is enabled and if enabled_capping==0 then  capping is not enabled 
	  ->if carry_forward_less_capping==1 then carry forward should be less than capping  and if carry_forward_less_capping==0 then carry forward can be more than capping
  */	
  $data=array();
  $query=$obj->db->query("SELECT b.commission as commission, b.type as typ, b.enabled_carry_forward,b.enabled_capping,b.capping_amount,b.carry_forward_less_capping FROM user_registration as u 
  join binary_commission as b on u.pkg_id=b.pkg_id where u.user_id='$user_id' and active_status='1'");
  if($query->num_rows()>0)
  {
     $res=$query->result();
     $res=$res[0];
     $date=date('Y-m-d');
     ////////
     $total_left_amount_query=$obj->db->query("select sum(bv) as total_left_amount from manage_bv_history where status='0' and income_id='$user_id' and position='left' and date<='$date'");
     $total_left_amount_query_res=$total_left_amount_query->result();
     $leftamt=$total_left_amount_query_res[0]->total_left_amount;
     /////////////
     $total_right_amount_query=$obj->db->query("select sum(bv) as total_right_amount from manage_bv_history where status='0' and income_id='$user_id' and position='right' and date<='$date'");
     $total_right_amount_query_res=$total_right_amount_query->result();
     $rightamt=$total_right_amount_query_res[0]->total_right_amount;
	 $carry=null;
	 $pos=null;
     ////////code for lesser bv///////
	 if($leftamt<$rightamt)
		{
		$lesser_bv=$leftamt;
		$carry=$rightamt-$leftamt;
		$pos='right';
		}
	 else if($leftamt>$rightamt)
		{

		$lesser_bv=$rightamt;	
		$carry=$leftamt-$rightamt;
		$pos='left';
		}
	  else if($leftamt==$rightamt)
	   {
		$lesser_bv=$rightamt;	
	   }
	////////code to obtain commission amount////////////////////// 
	   if($res->typ==1)//it's percent type commission
	   {
         $commission_amount=($lesser_bv*$res->commission)/100;
	   }
	   elseif ($res->typ==2)//it's flat commission
	   {
	   	$commission_amount=$res->commission;
	   }
	   if($res->enabled_capping==1)//it's used if capping is enabled
	   {
	      if($commission_amount>=$res->capping_amount)//if commission amount is more than capping amount
	      	 {
                $commission_amount=$res->capping_amount;//
	      	 }
	   }
	  $data['commission_amount']=$commission_amount;
	  if($data['commission_amount']<=0)
	  {
	     $data['commission_amount_status']=false;//indicate that commission is not get
	  }
	  else if($data['commission_amount']>0) 
	  {
		  $data['commission_amount_status']=true; //indicate that commission is get
	  }
	  $data['carry_forward_status']=true;//set default carry forward status true
	  $data['carry']=$carry; //assigning carry forward amount
	  $data['pos']=$pos;    //assigning carry forward position
	 ///////////////code to obtain carry amount if capping is enabled and carry_forward_less_capping==1/////////////////////////////////  
	  if($res->enabled_carry_forward=='1')//if carry forward is enabled by admin
	  {
           if($res->enabled_capping=='1')  //if capping also enabled
           {
           	   if($res->carry_forward_less_capping==1)  //if set true that carry forward shoud be less than capping
           	   {
                     if($carry>=$res->capping_amount) //if carry is more than capping amount
                     {
                     	$carry=$res->capping_amount;///then assign capping amount to carry
                        $data['carry']=$carry;
                     }
           	   }
           }
	  } 
	  elseif($res->enabled_carry_forward=='0')//if carry forward is disabled by admin
	  {
	  	$data['carry_forward_status']=false;
	  	$data['carry']=null;
	  	$data['pos']=null;
	  }
	  /////////////////////////// 
  }
  else
  {
  	$data['commission_amount_status']=false;
	$data['commission_amount']=null;
	$data['carry_forward_status']=null;
	$data['carry']=null;
	$data['pos']=null;
  }//end num_rows>0 if else here
  return $data;
}//end function
/*
@author : Aditya
@param  : None
@desc   : It's used to credit the binary pairing commission
@return : int(creditStatus)
*/
function creditBinaryCommission()
{
	//insert commission in user ewallet by fetching from level income table code start here
	$obj=& get_instance();
	$all_user_query=$obj->db->select('*')->from('user_registration')->where(array('nom_id !=' => '','active_status'=>'1'))->get();
	$date=date('Y-m-d');
	$current_timestamp=date("Y-m-d H:i:s");
	$creditStatus=0;
	if($all_user_query->num_rows()>0)
	{
			foreach($all_user_query->result() as $userObj)
			{
					$user_id=$userObj->user_id;
					
					$commission_info=getBinaryPairingCommission($user_id);
					if($commission_info['carry']>0)
					{
					  //mysql_query("insert into manage_bv_history values(NULL,'$uid','$uid','1','$carry','$pos','Carry Forward BV','$expire',CURRENT_TIMESTAMP,'0')");
					  $obj->db->insert("manage_bv_history",array("income_id"=>$user_id,"downline_id"=>$user_id,"level"=>'1',"bv"=>$commission_info['carry'],"position"=>$commission_info['pos'],"description"=>'Carry Forward BV',"date"=>$date,"ts"=>$current_timestamp,"status"=>0));
					}//end if
					if($commission_info['commission_amount']>0)
					{
						$commission_amount=$commission_info['commission_amount'];
						$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$user_id)->get()->row();
						$balance=$query_obj->amount+$commission_amount;
						$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id));
						//reason enum filed '1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
						/*
						Note: status field '0'=>debit,'1'=>credit
						*/
						$obj->db->insert('credit_debit',array(
								'transaction_no'=>generateUniqueTranNo(),
								'user_id'=>$user_id,
								'credit_amt'=>$commission_amount,
								'debit_amt'=>'0',
								'balance'=>$balance,
								'admin_charge'=>'0',
								'receiver_id'=>$user_id,
								'sender_id'=>COMP_USER_ID,
								'receive_date'=>date('d-m-Y'),
								'ttype'=>'Binary Income',
								'TranDescription'=>'Earn Binary Pairing Income',
								'Cause'=>'Commission of Binary Pairing Income',
								'Remark'=>'Binary Pairing Income',
								'invoice_no'=>'',
								'product_name'=>'',
								'status'=>'1',
								'ewallet_used_by'=>'',
								'matching_commission_status	'=>'0',
								'current_url'=>site_url(),
								'reason'=>'6'
								));
					$creditStatus++;
					}//end if
			}//end foreach loop here		
	}//end if
	$receive_date=date('Y-m-d');
	$obj->db->update("manage_bv_history",array("status"=>'1'),array("date <"=>$receive_date));
	return $creditStatus;
}//end function
/*
@author : Aditya
@param  : int(user_id), int(binary_income),int(level)
@desc   : It's used to get the matching commission
@return :int(commission_amount)
*/
function getMatchingCommission($user_id=null,$binary_income=null,$level=null)
{
	$obj=& get_instance();
	/*
	->note: if level_type==1 then limited and if level_type==0 unlimited
	->note: if commission_type==1 the percent type commission and if commission_type==2 then flat type commission 
	
	SELECT u.user_id as user_id, u.pkg_id as pkg_id, mm.level as level,m.level_type as level_type,m.commission_type as com_type, m.flush_out_enabled as flush_out_enabled, 
    m.flush_out_amount as flush_out_amount, mm.level_commission as commission FROM user_registration as u join matching_commission as m on u.rank_id=m.rank_id and u.pkg_id=m.pkg_id 
    join matching_commission_meta as mm on m.id=mm.matching_commission_id and mm.level='1'
    where u.user_id=COMP_USER_ID;
	*/
	$commission_amount=0;
	$level_type_query=$obj->db->query("SELECT m.level_type as level_type FROM user_registration as u join matching_commission as m on u.pkg_id=m.pkg_id where u.user_id='$user_id'");
	if($level_type_query->num_rows()>0)
	{
	  $level_type=$level_type_query->row();
	  /*
	    for Unlimited level
	  */
	  if($level_type->level_type==0)
	  {
		 $query=$obj->db->query("SELECT m.commission_type as com_type, m.commission as commission FROM user_registration as u 
                           join matching_commission as m on u.pkg_id=m.pkg_id  where u.user_id='$user_id'");
						   
	     if($query->num_rows()>0)
		 {
			 $query_result=$query->row();
			 /*
			 percent commission
			 */
			 if($query_result->com_type==1)
			 {
				 $commission_amount=($binary_income*$query_result->commission)/100; 
			 }
			 /*
			 flat commission
			 */
			if($query_result->com_type==2)
			{
				$commission_amount=$query_result->commission; 
			}
		 }//end num_rows if here!
	  }
	  /*
	  for limited level
	  */
	  else if($level_type->level_type==1)
	  {
		   $query=$obj->db->query("SELECT u.user_id as user_id, m.commission_type as com_type,  mm.level_commission as commission FROM user_registration as u join matching_commission as m on u.pkg_id=m.pkg_id 
			join matching_commission_meta as mm on m.id=mm.matching_commission_id and mm.level='$level'
			where u.user_id='$user_id'");
			if($query->num_rows()>0)
			{
			   $query_result=$query->row();
			   /*
			   percent commission
			   */
			   if($query_result->com_type==1)
			   {
				 $commission_amount=($binary_income*$query_result->commission)/100;
			   }
			   /*
			   flat commission
			   */
			   else if($query_result->com_type==2)
			   {
				   $commission_amount=$query_result->commission;
			   }				
			}//end num_rows if here!
	  }//end level type else if here
	}//end if 
    $commission_amount;
	return $commission_amount;
	exit;
}//end function
/*
@author : Aditya
@param  : None
@desc   : It's used to credit the Matching commission
@return : int(creditStatus)
*/
/*
 Note: matching commission is provided on the basis of binary income
*/
function creditMatchingCommission()
{
	/*
	note:
    $user_id vs $user_ids
    $user_ids is upliner of $user_id
	*/
	$obj=& get_instance();
	//$user_id=COMP_USER_ID;
	$date=date('d-m-Y');
	$creditStatus=0;
	//$rd=mysql_query("select * from credit_debit where receive_date='$end' and ttype='Binary Income'");
	$matching_income_user_query=$obj->db->select('*')->from('credit_debit')->where(array('receive_date <='=>$date, 'reason ='=>'6', 'matching_commission_status ='=>'0'))->get();
	if($matching_income_user_query->num_rows()>0)
	{
		//echo "call";die;
		$nom_id=null;
		foreach($matching_income_user_query->result() as $userObj)
		{
            $level=1;
			while($nom_id!='cmp')
			{
					$user_id=$userObj->user_id;
					$nom_id=$user_id;
					$binary_income=$userObj->credit_amt;

				    $upliner_query=$obj->db->query("select nom_id,user_id from user_registration where user_id='$nom_id'");	
					if($upliner_query->num_rows()>0)
					{
						$upliner_obj=$upliner_query->row();
						$nom_id=$upliner_obj->nom_id;
						$user_ids=$upliner_obj->user_id;
						//////////////
						//if($nom_id!='cmp')
						//{
							$commission_amount=getMatchingCommission($user_ids,$binary_income,$level);
							if($commission_amount>0)
							{
								$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$user_ids)->get()->row();
								$balance=$query_obj->amount+$commission_amount;
								$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_ids));
								//reason enum filed '1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
								/*
								Note: status field '0'=>debit,'1'=>credit
								*/
								$obj->db->insert('credit_debit',array(
											'transaction_no'=>generateUniqueTranNo(),
											'user_id'=>$user_ids,
											'credit_amt'=>$commission_amount,
											'debit_amt'=>'0',
											'balance'=>$balance,
											'admin_charge'=>'0',
											'receiver_id'=>$user_ids,
											'sender_id'=>COMP_USER_ID,
											'receive_date'=>date('d-m-Y'),
											'ttype'=>'Matching Income',
											'TranDescription'=>'Earn Matching Income',
											'Cause'=>'Commission of Matching Income',
											'Remark'=>'Matching Income',
											'invoice_no'=>'',
											'product_name'=>'',
											'status'=>'1',
											'ewallet_used_by'=>'',
											'current_url'=>site_url(),
											'reason'=>'7'
											));		
							$creditStatus++;
							}//end commision_amount>0 if here							
						   $level++;   							
						//}//end nom_id if here
					} //$upliner_query->num_rows()>0 end here
			}//end while			
		}//end foreach here!
	}//end if!
	$obj->db->update('credit_debit',array('matching_commission_status'=>'1'),array('receive_date ='=>$date, 'reason ='=>'6', 'matching_commission_status ='=>'0'));
	return $creditStatus;
}//end function
?>