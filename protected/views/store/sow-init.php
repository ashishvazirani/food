<?php
$db_ext=new DbExt;
$data_get=$_GET;
$error='';
$success='';
$amount_to_pay=0;
$token=isset($_GET['token'])?$_GET['token']:'';
$back_url=Yii::app()->request->baseUrl."/store/merchantSignup/Do/step3/token/".$token;

$mtid=Yii::app()->functions->getOptionAdmin('admin_sanbox_sisow_secret_key');
$mtkey=Yii::app()->functions->getOptionAdmin('admin_sandbox_sisow_pub_key');
$mtshopid=Yii::app()->functions->getOptionAdmin('admin_sandbox_sisow_shopid');
$mode=Yii::app()->functions->getOptionAdmin('admin_sisow_mode');

$payment_description='';
$payment_ref=Yii::app()->functions->generateCode()."TT".Yii::app()->functions->getLastIncrement('{{package_trans}}');

$my_token=isset($_GET['token'])?$_GET['token']:'';
$package_id=isset($_GET['package_id'])?$_GET['package_id']:'';	

$extra_params='';
if (isset($_GET['renew'])){
	$extra_params="/renew/1/package_id/".$package_id;
}

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
	$amount_to_pay=standardPrettyFormat($res['package_price']);
	
	if ( empty($mtid) || empty($mtkey)){
		$error=Yii::t("default","This payment method is not properly configured");
	} else {
		$sisow = new Sisow($mtid, $mtkey,$mtshopid);
	}
	
	if ( empty($error)){
		if (isset($_POST["issuerid"])) {	
			$data=$_POST;			
			$return_url=Yii::app()->getBaseUrl(true)."/store/merchantSignup/Do/step3b/token/$my_token/gateway/ide".$extra_params;
											
			$sisow->purchaseId = $payment_ref;
			$sisow->description = $payment_description;
			$sisow->amount = $amount_to_pay;
			$sisow->payment = $data['payment_method'];
			$sisow->issuerId = $data["issuerid"];
			$sisow->returnUrl = $return_url;
			$sisow->notifyUrl = $sisow->returnUrl;			
			//$sisow->callbackurl = $call_back;				
			if (($ex = $sisow->TransactionRequest()) < 0) {				
				$error=$sisow->errorCode." ".$sisow->errorMessage;
			} else header("Location: " . $sisow->issuerUrl);			
						
		} else if (isset($_GET["trxid"])) {
			
			if ($data_get['status']=="Success"){
				
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
			          'payment_type'=>Yii::app()->functions->paymentCode('sisow'),
			          'membership_expired'=>$membership_info['membership_expired'],
			          'date_created'=>date('c'),
			          'ip_address'=>$_SERVER['REMOTE_ADDR'],
			          'PAYPALFULLRESPONSE'=>json_encode($data_get),
			           'TRANSACTIONID'=>$data_get['trxid'],
			           'TOKEN'=>$data_get['ec']
			        );		

			         $stmt="SELECT * FROM
			         {{package_trans}} 			         
			         WHERE
			         TRANSACTIONID='".$data_get['trxid']."'
			         AND
			         TOKEN='".$data_get['ec']."'
			         AND
			         payment_type='".Yii::app()->functions->paymentCode('sisow')."'
			         ";			         
			         if ( $check_res=$check=$db_ext->rst($stmt)){			         				         	
			         } else  {
			         	$db_ext->insertData("{{package_trans}}",$params);	
			         }							       
			        //$db_ext->insertData("{{package_trans}}",$params);	
			        
			        $params_update=array(
					  'package_id'=>$package_id,
					  'package_price'=>$membership_info['package_price'],
					  'membership_expired'=>$membership_info['membership_expired'],				  
					  'status'=>'active'
				 	 );		
				 	 
					 $db_ext->updateData("{{merchant}}",$params_update,'merchant_id',$res['merchant_id']);	  
					
				} else {
					$params=array(
			           'package_id'=>$res['package_id'],	          
			           'merchant_id'=>$res['merchant_id'],
			           'price'=>$res['package_price'],
			           'payment_type'=>Yii::app()->functions->paymentCode('sisow'),
			           'membership_expired'=>$res['membership_expired'],
			           'date_created'=>date('c'),
			           'ip_address'=>$_SERVER['REMOTE_ADDR'],
			           'PAYPALFULLRESPONSE'=>json_encode($data_get),
			           'TRANSACTIONID'=>$data_get['trxid'],
			           'TOKEN'=>$data_get['ec']
			         );

			          $stmt="SELECT * FROM
			         {{package_trans}} 			         
			         WHERE
			         TRANSACTIONID='".$data_get['trxid']."'
			         AND
			         TOKEN='".$data_get['ec']."'
			         AND
			         payment_type='".Yii::app()->functions->paymentCode('sisow')."'
			         ";			         
			         if ( $check_res=$check=$db_ext->rst($stmt)){			         				         	
			         } else  {
			         	$db_ext->insertData("{{package_trans}}",$params);	
			         }			
			         		         
			         //$db_ext->insertData("{{package_trans}}",$params);	
			         
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
				
			} else $error=Yii::t("default","Payment Failed"." ".$data_get['status']);			
		} else {
			$testmode = $mode=="Sandbox"?true:false;
			$sisow->DirectoryRequest($select, true, $testmode);	
		}
	}
} else $error=Yii::t("default","Failed. Cannot process payment");  
?>

<div class="page-right-sidebar payment-option-page">
  <div class="main">  
  <?php if ( !empty($error)):?>
  <p class="uk-text-danger"><?php echo $error;?></p>  
  
  <?php else :?>
  
  <h2><?php echo Yii::t("default","Pay using Sisow")?></h2>
   
  <form class="uk-form uk-form-horizontal forms"  method="POST" >
  <input type="hidden" id="action" name="action" value="sisowPayment">
    
  <?php echo CHtml::hiddenField('payment_ref',
  $payment_ref
  ,array(
  'class'=>'uk-form-width-large'  
  ))?>  
  <?php echo CHtml::hiddenField('description',
  $payment_description
  ,array(
  'class'=>'uk-form-width-large'  
  ))?>
  
  <!--<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Payment reference")?></label>
  <?php echo CHtml::hiddenField('payment_ref',
  $payment_ref
  ,array(
  'class'=>'uk-form-width-large'  
  ))?>
  </div>  -->
  
  
  <!--<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Description")?></label>
  <?php echo CHtml::hiddenField('description',
  $payment_description
  ,array(
  'class'=>'uk-form-width-large'  
  ))?>
  </div>    -->
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Amount")?></label>
  <?php echo CHtml::textField('amount',
  $amount_to_pay
  ,array(
  'class'=>'uk-form-width-large',
  'disabled'=>true
  ))?>
  </div>    
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Payment Method")?></label>
   <select name="payment_method" class="uk-form-width-large" id="payment_method" >
    <option value="">iDEAL</option>
    <option value="sofort">DIRECTebanking</option>
    <option value="mistercash">MisterCash</option>
    <option value="webshop">WebShop GiftCard</option>
    <option value="podium">Podium Cadeaukaart</option>
  </select>
</div>

 <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Bank")?></label>
  <?php echo $select;?>
 </div>
 
<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Pay Now")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>   
     
  </form>
  
  <?php endif;?>
  
  <a href="<?php echo $back_url.$extra_params;?>"><?php echo Yii::t("default","Go back")?></a>
  
  </div> <!--main-->
</div> <!--page-->