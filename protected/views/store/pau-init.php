<?php
$db_ext=new DbExt;
$error='';
$my_token=isset($_GET['token'])?$_GET['token']:'';
$package_id=isset($_GET['package_id'])?$_GET['package_id']:'';	

$back_url=Yii::app()->request->baseUrl."/store/merchantSignup/Do/step3/token/".$my_token;
$payment_ref=Yii::app()->functions->generateCode()."TT".Yii::app()->functions->getLastIncrement('{{package_trans}}');

if ( $res=Yii::app()->functions->getMerchantByToken($my_token)){ 			
	
	if (isset($_GET['renew'])){ 		
		if ($new_info=Yii::app()->functions->getPackagesById($package_id)){	    					
			$res['package_name']=$new_info['title'];
			$res['package_price']=$new_info['price'];
			if ($new_info['promo_price']>0){
				$res['package_price']=$new_info['promo_price'];
			}			
		}
	}
	
	$merchant_id=$res['merchant_id'];
	$payment_description="Membership Package - ".$res['package_name'];
	$amount_to_pay=normalPrettyPrice($res['package_price']);
	/*dump($payment_description);
	dump($amount_to_pay);*/
	
} else $error=Yii::t("default","Failed. Cannot process payment");  

?>
<div class="page-right-sidebar payment-option-page">
  <div class="main">  
  <?php if ( !empty($error)):?>
  <p class="uk-text-danger"><?php echo $error;?></p>  
  <?php else :?>
  
  <?php require_once("payu.php")?>
  <?php 
  if ( $success==TRUE){
  	  echo 'insert logs';
  	 if (isset($_GET['renew'])){   
  	 	
	    if ($new_info=Yii::app()->functions->getPackagesById($package_id)){	    					
			$res['package_name']=$new_info['title'];
			$res['package_price']=$new_info['price'];
			if ($new_info['promo_price']>0){
				$res['package_price']=$new_info['promo_price'];
			}			
		}
																										
		$membership_info=Yii::app()->functions->upgradeMembership($res['merchant_id'],$package_id);
										
		$params=array(
	      'package_id'=>$package_id,	          
	      'merchant_id'=>$res['merchant_id'],
	      'price'=>$res['package_price'],
	      'payment_type'=>Yii::app()->functions->paymentCode('payumoney'),
	      'membership_expired'=>$membership_info['membership_expired'],
	      'date_created'=>date('c'),
	      'ip_address'=>$_SERVER['REMOTE_ADDR'],
	      'PAYPALFULLRESPONSE'=>json_encode($_POST),
	       'TRANSACTIONID'=>isset($_POST['txnid'])?$_POST['txnid']:'',	      
	    );		
	    	     					        					       
	    $db_ext->insertData("{{package_trans}}",$params);	
	    
	    $params_update=array(
		  'package_id'=>$package_id,
		  'package_price'=>$membership_info['package_price'],
		  'membership_expired'=>$membership_info['membership_expired'],				  
		  'status'=>'active'
	 	 );		
	 	 
		 $db_ext->updateData("{{merchant}}",$params_update,'merchant_id',$res['merchant_id']);	  				
		 $okmsg=Yii::t("default","transaction was susccessfull");		         					 
  	 } else {	 
	  	 $params=array(
	       'package_id'=>$res['package_id'],	          
	       'merchant_id'=>$res['merchant_id'],
	       'price'=>$res['package_price'],
	       'payment_type'=>Yii::app()->functions->paymentCode('payumoney'),
	       'membership_expired'=>$res['membership_expired'],
	       'date_created'=>date('c'),
	       'ip_address'=>$_SERVER['REMOTE_ADDR'],
	       'PAYPALFULLRESPONSE'=>json_encode($_POST),
	       'TRANSACTIONID'=>$_POST['txnid']       
	     );					 		         
	     $db_ext->insertData("{{package_trans}}",$params);	
	     
	     $db_ext->updateData("{{merchant}}",
								  array(
								    'payment_steps'=>3,
								    'membership_purchase_date'=>date('c')
								  ),'merchant_id',$res['merchant_id']);
								  		         		    
	     $okmsg=Yii::t("default","transaction was susccessfull");		         
  	 }
     
     if (isset($_GET['renew'])){
         header('Location: '.Yii::app()->request->baseUrl."/store/renewSuccesful");
     } else header('Location: '.Yii::app()->request->baseUrl."/store/merchantSignup/Do/step4/token/$my_token"); 
     die();
  }
  ?>
  
  <?php endif;?>      
  <div style="height:10px;"></div>
  <a href="<?php echo $back_url;?>"><?php echo Yii::t("default","Go back")?></a>
  
  </div>
</div>