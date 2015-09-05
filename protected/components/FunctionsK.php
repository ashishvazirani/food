<?php
class FunctionsK extends DbExt 
{	
	public function validateMerchantUserAccount($username='',$email='',$id='')
    {    
    	$and="";    	    
    	    	
    	$msg='';
     	$stmt1="SELECT * FROM
     	{{merchant}}
     	WHERE
     	username=".Yii::app()->functions->q($username)."
     	LIMIT 0,1
     	";
     	if ($res1=$this->rst($stmt1)){
     		$msg=t("Username already exist");
     	}
     	
     	$stmt1="SELECT * FROM
     	{{merchant}}
     	WHERE
     	contact_email=".Yii::app()->functions->q($email)."
     	LIMIT 0,1
     	";
     	if ($res1=$this->rst($stmt1)){
     		$msg=t("Email address already exist");
     	}
     	
     	if (is_numeric($id)){
     		$and=" AND merchant_user_id !=".Yii::app()->functions->q($id)." ";
     	}
     	$stmt1="SELECT * FROM
     	{{merchant_user}}
     	WHERE
     	username=".Yii::app()->functions->q($username)."
     	$and
     	LIMIT 0,1
     	";     	
     	if ($res1=$this->rst($stmt1)){
     		$msg=t("Username already exist");
     	}
     	
     	$stmt1="SELECT * FROM
     	{{merchant_user}}
     	WHERE
     	contact_email=".Yii::app()->functions->q($email)."
     	$and
     	LIMIT 0,1
     	";     	
     	if ($res1=$this->rst($stmt1)){
     		$msg=t("Email address already exist");
     	}
     	     	
     	if (empty($msg)){
     		return false;
     	}     	
     	return $msg;
    }           
        
   public function getSMSPackagesById($package_id='')
    {    	
    	$stmt="SELECT * FROM
    	{{fax_package}}
    	WHERE
    	fax_package_id='$package_id'
    	LIMIT 0,1
    	";
    	if ( $res=$this->rst($stmt)){
    		return $res[0];
    	}
    	return false;    
    }    
    
    public function getFaxPackagesById($package_id='')
    {
    	return $this->getSMSPackagesById($package_id);
    }
    
    public function getFaxPackage()
    {    	
    	$stmt="SELECT * FROM
    	{{fax_package}}
    	WHERE
    	status in ('publish')
    	ORDER BY 
    	sequence ASC
    	";
    	if ( $res=$this->rst($stmt)){
    		return $res;
    	}
    	return false;    
    }
    
    public function adminPaymentList()
    {
    	$enabled_stripe=Yii::app()->functions->getOptionAdmin('admin_stripe_enabled');
    	$admin_enabled_paypal=Yii::app()->functions->getOptionAdmin('admin_enabled_paypal');    	
    	$admin_enabled_card=Yii::app()->functions->getOptionAdmin('admin_enabled_card'); 
    	$admin_mercado_enabled=Yii::app()->functions->getOptionAdmin('admin_mercado_enabled'); 
    	$merchant_payline_enabled=Yii::app()->functions->getOptionAdmin('admin_payline_enabled'); 
    	$admin_sisow_enabled=Yii::app()->functions->getOptionAdmin('admin_sisow_enabled');     	
    	$admin_payu_enabled=Yii::app()->functions->getOptionAdmin('admin_payu_enabled');     	    	
    	
    	$admin_bankdeposit_enabled=Yii::app()->functions->getOptionAdmin('admin_bankdeposit_enabled');
    	$admin_paysera_enabled=Yii::app()->functions->getOptionAdmin('admin_paysera_enabled');
    	
    	$admin_enabled_barclay=Yii::app()->functions->getOptionAdmin('admin_enabled_barclay');    	
    	$admin_enabled_epaybg=Yii::app()->functions->getOptionAdmin('admin_enabled_epaybg');
    	?>
    	<h4><?php echo Yii::t("default","Choose Payment option")?></h4>
    	<div class="uk-panel uk-panel-box">
    	
    	<?php if ( $admin_enabled_paypal==""):?>
    	 <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>"pyp"))?> <?php echo Yii::t("default","Paypal")?>
         </div>   
         <?php endif;?>
                          
         
         <?php if ( $admin_bankdeposit_enabled=="yes"):?>
         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>"obd"))?> <?php echo Yii::t("default","Bank Deposit")?>
         </div>     
         <?php endif;?>              
         
         <?php if ( $enabled_stripe=="yes"):?>
         <div class="uk-form-row">
         <?php echo CHtml::radioButton('payment_opt',false,
         array('class'=>"icheck payment_option",'value'=>"stp"))?> <?php echo Yii::t("default","Stripe")?>
         </div>     
         <?php endif;?>
         
    	</div> <!--uk-panel-->
    	<?php
    }    
        
    public function getPackageFaxTransByMerchant($package_id='',$merchant_id='')
    {    	
    	$stmt="SELECT a.*,
    	(
    	select title
    	from
    	{{fax_package}}
    	where
    	fax_package_id = a.fax_package_id 	
    	) as title
    	 FROM
    	{{fax_package_trans}} a
    	WHERE
    	id='$package_id'
    	AND
    	merchant_id=".Yii::app()->db->quoteValue($merchant_id)."
    	LIMIT 0,1    	
    	";        	
    	if ( $res=$this->rst($stmt)){    		
    		return $res[0];
    	}
    	return false;    
    }                    
    
    public function getFaxTransaction($id='')
    {    	
    	$stmt="
    	SELECT a.*,
    	(
    	select restaurant_name
    	from {{merchant}}
    	where
    	merchant_id=a.merchant_id
    	) as merchant_name,
    	
    	(
    	select title
    	from {{fax_package}}    
    	where fax_package_id=a.fax_package_id
    	) as sms_package_name
    	    	
    	FROM
    	{{fax_package_trans}} a
    	WHERE
    	id=".Yii::app()->functions->q($id)."
    	";        	
    	if ( $res=$this->rst($stmt)){    		
    		return $res[0];
    	}
    	return false;    
    }                        
    
    public function getFaxTransactionByRef($ref='')
    {    	
    	$stmt="
    	SELECT a.*,
    	(
    	select restaurant_name
    	from {{merchant}}
    	where
    	merchant_id=a.merchant_id
    	) as merchant_name,
    	
    	(
    	select title
    	from {{fax_package}}    
    	where fax_package_id=a.fax_package_id
    	) as sms_package_name
    	    	
    	FROM
    	{{fax_package_trans}} a
    	WHERE
    	payment_reference=".Yii::app()->functions->q($ref)."
    	";        	
    	if ( $res=$this->rst($stmt)){    		
    		return $res[0];
    	}
    	return false;    
    }   
    
    public function faxGetTotalSend($merchant_id='')
    {
    	$stmt="
    	SELECT count(*) as total
    	FROM
    	{{fax_broadcast}}
    	WHERE
    	merchant_id=".Yii::app()->functions->q($merchant_id)."
    	";
    	if ( $res=$this->rst($stmt)){
    		return $res[0]['total'];
    	}
    	return 0;
    }
    
    public function faxGetTotalSuccesful($merchant_id='')
    {
    	$stmt="
    	SELECT count(*) as total
    	FROM
    	{{fax_broadcast}}
    	WHERE
    	status='success'
    	AND
    	merchant_id=".Yii::app()->functions->q($merchant_id)."
    	";
    	if ( $res=$this->rst($stmt)){
    		return $res[0]['total'];
    	}
    	return 0;
    }
    
    public function faxGetTotalFailed($merchant_id='')
    {
    	$stmt="
    	SELECT count(*) as total
    	FROM
    	{{fax_broadcast}}
    	WHERE
    	status='failure'
    	AND
    	merchant_id=".Yii::app()->functions->q($merchant_id)."
    	";
    	if ( $res=$this->rst($stmt)){
    		return $res[0]['total'];
    	}
    	return 0;
    }   
    
    public function faxSendNotification($merchant_info='',$package_id='',$payment_method='',$price)
    {
    	$fax_email_notification=Yii::app()->functions->getOptionAdmin("fax_email_notification");
    	/*dump($merchant_info);
    	dump($package_id);
    	dump($payment_method);*/
    	$package_info=$this->getFaxPackagesById($package_id);    	
    	if (!empty($fax_email_notification) && is_array($package_info) && count($package_info)>=1){
    		$tpl=EmailTPL::faxNotification();
    		$tpl=smarty('merchant-name',$merchant_info['restaurant_name'],$tpl);
    		$tpl=smarty('amount',displayPrice(getCurrencyCode(),prettyFormat($price)),$tpl);
    		$tpl=smarty('payment-method',$payment_method,$tpl);
    		$tpl=smarty('package-name',$package_info['title'],$tpl);    		
    		sendEmail($fax_email_notification,'',"New Fax Payment Has been receive",$tpl);
    	}
    }  

    public function getShippingRates($mtid='',$units='')
    {
    	$stmt="SELECT * FROM
    	{{shipping_rate}}
    	WHERE
    	merchant_id=".Yii::app()->functions->q($mtid)."
    	AND
    	shipping_units=".Yii::app()->functions->q($units)."
    	ORDER BY id ASC
    	";
    	//dump($stmt);
    	if ( $res=$this->rst($stmt)){
    		//dump($res);
    		return $res;
    	}
    	return false;
    }   
    
    public function getDeliveryChargesByDistance($mtid='',$distance='',$unit='',$delivery_fee='')
    {    	
    	//$distance=round($distance);
    	switch (strtolower($unit)){
    		case "miles":    
    		case "mi":	
    			$unit='mi';
    			break;
    		case "kilometers":		
    		case "km":		
    		    $unit='km';
    			break;
    		case "ft":	
    		    $unit='mi';
    		    $distance=1;
    			break;
    	}
    	//dump($mtid);
    	//dump($distance);
    	//dump($unit);
    	$charge=$delivery_fee;
    	if ( $res=$this->getShippingRates($mtid,$unit)){    		
    		foreach ($res as $val) {       			    			    			
    			if ( $val['distance_from']<=$distance && $val['distance_to']>=$distance){
    				//dump($val);
    				$charge=$val['distance_price'];
    			}
    		}
    	}
    	return $charge;
    }
    
    public function ajaxDataTables($aColumns='')
    {
    	/* 
		 * Paging
		 */
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".( $_GET['iDisplayStart'] ).", ".
				( $_GET['iDisplayLength'] );
		}
		
		/*
		 * Ordering
		 */
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
					 	".( $_GET['sSortDir_'.$i] ) .", ";
				}
			}
			
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		
		/* 
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		$sWhere = "";
		if ( $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= $aColumns[$i]." LIKE '%".($_GET['sSearch_'.$i])."%' ";
			}
		}

		return array(
		  'sWhere'=>$sWhere,
		  'sOrder'=>$sOrder,
		  'sLimit'=>$sLimit
		);
    }
    
    public function checkIfUserCanRateMerchant($user_id='',$merchant_id='')
    {
    	$stmt="SELECT * FROM
    	{{order}}
    	WHERE
    	client_id=".yii::app()->functions->q($user_id)."
    	AND
    	merchant_id=".yii::app()->functions->q($merchant_id)."
    	LIMIT 0,1
    	";    	
    	if ($res=$this->rst($stmt)){
    		return true;
    	}
    	return false;
    }
    
    public function tipsList($list=false)
    {
    	if ( $list==true){
    		return array(
    		   ''=>t("none"),
	    	   '0.1'=>"10%",
	    	   '0.15'=>"15%",
	    	   '0.2'=>"20%",
	    	   '0.25'=>"25%"    	   
    	    );
    	} else {
	    	return array(
	    	   '0.1'=>"10%",
	    	   '0.15'=>"15%",
	    	   '0.2'=>"20%",
	    	   '0.25'=>"25%"    	   
	    	);
    	}
    }
    
    public function MerchantSendBankInstruction($merchant_id='',$amount='',$ref='')
    {    
    	$amount=standardPrettyFormat($amount);
    	$link=Yii::app()->getBaseUrl(true)."/store/depositverify/?ref=".$ref;
    	$links="<a href=\"$link\" target=\"_blank\" >".Yii::t("default","Click on this link")."</a>";
    	
    	$sender=Yii::app()->functions->getOption('merchant_deposit_sender',$merchant_id);
    	$subject=Yii::app()->functions->getOption('merchant_deposit_subject',$merchant_id);
    	$instructions=Yii::app()->functions->getOption('merchant_deposit_instructions',$merchant_id);
    	$instructions=smarty('amount',displayPrice(adminCurrencySymbol(),$amount),$instructions);
    	$instructions=smarty('verify-payment-link',$links,$instructions);
    	    	
    	$client_info=Yii::app()->functions->getClientInfo(Yii::app()->functions->getClientId());
    	if (is_array($client_info) && count($client_info)>=1){
    		Yii::app()->functions->sendEmail(
    		   $client_info['email_address'],
    		   '',
    		   $subject,
    		   $instructions
    		);
    	}   
    	return false; 	
    }
    
    public function googleRegister($data='')
    {    	    	
    	if ($social_info=yii::app()->functions->accountExistSocial($data['email'])){     		
    		return $social_info[0];
    	} else {
    		$params=array(
    		  'first_name'=>addslashes($data['given_name']),
    		  'last_name'=>addslashes($data['family_name']),
    		  'email_address'=>addslashes($data['email']),
    		  'social_strategy'=>'google',
    		  'password'=>md5(addslashes($data['id'])),
    		  'date_created'=>date('c'),
    		  'ip_address'=>$_SERVER['REMOTE_ADDR']    		
    		);    	    		
    		if ( $this->insertData("{{client}}",$params)){
    			return $params;
    		} 
    	}
    	return false;
    }
    
    public function checkIFVoucherCodeExists($voucher_name='')
    {
    	$stmt="SELECT * FROM
		{{voucher_new}}
		WHERE
		voucher_name=".Yii::app()->functions->q($voucher_name)."
		LIMIT 0,1
		";
    	if ( $res=$this->rst($stmt)){
    		return $res;
    	}
    	return false;
    }
    
    public function checkIFVoucherCodeExisting($voucher_name='',$voucher_id='')
    {
    	$stmt="SELECT * FROM
		{{voucher_new}}
		WHERE
		voucher_name=".Yii::app()->functions->q($voucher_name)."
		AND
		voucher_id NOT IN ('$voucher_id')
		LIMIT 0,1
		";
    	if ( $res=$this->rst($stmt)){
    		return $res;
    	}
    	return false;
    }    
    
    public function getUsedVoucher($voucher_name='')
    {
    	$stmt="
    	SELECT a.*,
    	(
    	select concat(first_name,' ',last_name)
    	from {{client}}
    	where
    	client_id=a.client_id
    	) as client_name
    	FROM
    	{{order}} a
    	WHERE
    	voucher_code =".Yii::app()->functions->q($voucher_name)."
    	ORDER BY order_id ASC
    	";
    	if ( $res=$this->rst($stmt)){
    		return $res;
    	}
    	return false;
    }
    
    public function reCheckDelivery($data='',$mtid='')
    {
    	//dump($data);
    	$mt_delivery_miles=Yii::app()->functions->getOption("merchant_delivery_miles",$mtid);   
    	$delivery_fee=Yii::app()->functions->getOption("merchant_delivery_charges",$mtid);
    	//dump("delivery_fee=>".$delivery_fee);
    	//dump($mt_delivery_miles);
    	
    	$shipping_enabled=Yii::app()->functions->getOption("shipping_enabled",$mtid);  
    	if ( $shipping_enabled!=2){
    		return true;
    	}
    	//dump($shipping_enabled);
    	
    	if (is_numeric($mt_delivery_miles) || $shipping_enabled==2){
    		$merchant_distance_type=Yii::app()->functions->getOption("merchant_distance_type",$mtid);
            //dump("unit=>".$merchant_distance_type);
	    	$delivery_address=$data['street'];	    	
	    	$delivery_address.=" ".$data['city'];
	    	$delivery_address.=" ".$data['state'];
	    	$delivery_address.=" ".$data['zipcode'];	    	
	    	
	    	$merchant_address='';
	    	$country_code=Yii::app()->functions->adminCountry();
	    	if ( $merchant_info=Yii::app()->functions->getMerchant($mtid)){
	    		$merchant_address=$merchant_info['street'];
	    		$merchant_address.=" ".$merchant_info['city'];
	    		$merchant_address.=" ".$merchant_info['state'];
	    		$merchant_address.=" ".$merchant_info['post_code'];
	    		$country_code=$merchant_info['country_code'];
	    	}
	    	
	    	if ( isset($data['address_book_id'])){
	    		if ($address_book=Yii::app()->functions->getAddressBookByID($data['address_book_id'])){
	        		$data['street']=$address_book['street'];
	        		$data['city']=$address_book['city'];
	        		$data['state']=$address_book['state'];
	        		$data['zipcode']=$address_book['zipcode'];
	        		$data['location_name']=$address_book['location_name'];
	        		$delivery_address=$data['street'];	    	
	    	        $delivery_address.=" ".$data['city'];
	    	        $delivery_address.=" ".$data['state'];
	    	        $delivery_address.=" ".$data['zipcode'];
	        	}	    		        
	    	}
	    	
	    	if ( $data['map_address_toogle']==2){
	    		if ( isset($data['map_address_lat']) && isset($data['map_address_lng'])){
	    		   $geo_res=geoCoding($data['map_address_lat'],$data['map_address_lng']);
	    		   //dump($geo_res);
	    		   $data['street']=isset($geo_res['street_number'])?$geo_res['street_number']." ":'';
    			   $data['street'].=isset($geo_res['street'])?$geo_res['street']." ":'';
    			   $data['street'].=isset($geo_res['street2'])?$geo_res['street2']." ":'';
    			       			
	    		   $data['city']=$geo_res['locality'];
	    		   $data['state']=$geo_res['admin_1'];
	    		   $data['zipcode']=isset($geo_res['postal_code'])?$geo_res['postal_code']:'';
	    		   
	    		   $delivery_address=$data['street'];	    	
	    	       $delivery_address.=" ".$data['city'];
	    	       $delivery_address.=" ".$data['state'];
	    	       $delivery_address.=" ".$data['zipcode'];
	    	        
    			   $country_code=$geo_res['country_code'];    			   
	    		}
	    	}
	    	
	    	/*dump("delivery address =>".$delivery_address);	
	    	dump("merchant address=>".$merchant_address);  
	    	dump($country_code);*/
	    	
	    	$miles=getDeliveryDistance2($delivery_address,$merchant_address,$country_code);  
            //dump($miles);
                        
            $use_distance1='';
            $unit='';
            $ft=false;
            if (is_array($miles) && count($miles)>=1){  	   
			  	if ( $merchant_distance_type=="km"){			  	  	  
			  	  	  $use_distance1=$miles['km'];		
			  	  	  $unit='km';
			  	} else {			  	  				  	  	  
			  	  	  $use_distance1=$miles['mi'];			  	  	  
			  	  	  $unit='mi';
			  	}     
			  	if (preg_match("/ft/i",$miles['mi'])) {
			  	  	$use_distance1=str_replace("ft",'',$miles['mi']);     			        
			        $unit='ft';	 
			        $ft=true;         
			  	}
			 } 
			  			  
			 /*dump("use_distance1=>".$use_distance1);
			 dump("Unit=>".$unit);*/
			  
			 $is_ok_delivered=1;
			 if (is_numeric($mt_delivery_miles)){
				  if ( $mt_delivery_miles>=$use_distance1){
				  	 $is_ok_delivered=1;
				  } else $is_ok_delivered=2;
				  if ($ft==TRUE){
				  	   $is_ok_delivered=1;
				  }
			 }			  
			 //dump($is_ok_delivered);	    	
			 if ( $is_ok_delivered==1){
			  	 $delivery_fee=$this->getDeliveryChargesByDistance(
	        	  $mtid,
	        	  $use_distance1,
	        	  $unit,
	        	  $delivery_fee);        	
	        	  
	        	  /*dump($use_distance1);
	        	  dump($unit);
	        	  dump($delivery_fee);*/
	        	  $_SESSION['shipping_fee']=$delivery_fee;
	        	  return true;
			 } else return false;			 
    	}
    	return true;
    }
    
    public function clientRegistrationCustomFields($label=false,$data='')
    {
        	
    	$one=Yii::app()->functions->getOptionAdmin('client_custom_field_name1');
    	$two=Yii::app()->functions->getOptionAdmin('client_custom_field_name2');
    	?>    	
    	<?php if (!empty($one)):?>    	
	    	<?php if ( $label ):?>
	    	<div class="uk-form-row">
			  <label class="uk-form-label"><?php echo t($one)?></label>
			  <?php 
			  echo CHtml::textField('custom_field1',
			  isset($data['custom_field1'])?$data['custom_field1']:''
			  ,
			  array(
			    'class'=>'uk-form-width-large',
			    'data-validation'=>"required"
			  ));
			  ?>
			  </div>
		    <?php else :?>
		    <div class="uk-form-row">
		      <?php echo CHtml::textField('custom_field1','',array(
		       'class'=>'uk-width-1-1',
		       'placeholder'=>Yii::t("default",$one)	       
		      ))?>
		     </div>
		    <?php endif;?>	    
	    <?php endif;?>	    
	    
	    <?php if (!empty($two)):?>
		    <?php if ( $label ):?>
	    	<div class="uk-form-row">
			  <label class="uk-form-label"><?php echo t($two)?></label>
			  <?php 
			  echo CHtml::textField('custom_field2',
			  isset($data['custom_field2'])?$data['custom_field2']:''
			  ,
			  array(
			    'class'=>'uk-form-width-large',
			    'data-validation'=>"required"
			  ));
			  ?>
			  </div>
		    <?php else :?> 
		     <div class="uk-form-row">
		      <?php echo CHtml::textField('custom_field2','',array(
		       'class'=>'uk-width-1-1',
		       'placeholder'=>Yii::t("default",$two)	       
		      ))?>
		     </div>
		    <?php endif;?>
	    <?php endif;?>
    	<?php
    }
        
} /*END CLASS*/