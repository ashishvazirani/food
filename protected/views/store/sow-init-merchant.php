<?php
$db_ext=new DbExt;
$error='';
$success='';
$amount_to_pay=0;
$payment_description=Yii::t("default",'Payment to merchant');
$payment_ref=Yii::app()->functions->generateCode()."TT".Yii::app()->functions->getLastIncrement('{{order}}');
$data_get=$_GET;

if ( $data=Yii::app()->functions->getOrder($_GET['id'])){	
	$merchant_id=isset($data['merchant_id'])?$data['merchant_id']:'';
	//dump($merchant_id);
	$payment_description.=isset($data['merchant_name'])?" ".$data['merchant_name']:'';	
		
    $mtid=Yii::app()->functions->getOption('merchant_sanbox_sisow_secret_key',$merchant_id);
    $mtkey=Yii::app()->functions->getOption('merchant_sandbox_sisow_pub_key',$merchant_id);
    $mtshopid=Yii::app()->functions->getOption('merchant_sandbox_sisow_shopid',$merchant_id);
    $mode=Yii::app()->functions->getOption('merchant_sisow_mode',$merchant_id);
    
    /*COMMISSION*/
	if ( Yii::app()->functions->isMerchantCommission($merchant_id)){	
		$mtid=Yii::app()->functions->getOptionAdmin('admin_sanbox_sisow_secret_key');
        $mtkey=Yii::app()->functions->getOptionAdmin('admin_sandbox_sisow_pub_key');
        $mtshopid=Yii::app()->functions->getOptionAdmin('admin_sandbox_sisow_shopid');
        $mode=Yii::app()->functions->getOptionAdmin('admin_sisow_mode');
	}
    
    $amount_to_pay=isset($data['total_w_tax'])?Yii::app()->functions->standardPrettyFormat($data['total_w_tax']):'';
    $amount_to_pay=is_numeric($amount_to_pay)?unPrettyPrice($amount_to_pay):'';
        
    if ( empty($mtid) || empty($mtkey)){
		$error=Yii::t("default","This payment method is not properly configured");
	} else {
		$sisow = new Sisow($mtid, $mtkey,$mtshopid);
	}
    
	if (empty($error)){
		if (isset($_POST["issuerid"])) {
			
			$data_post=$_POST;							
			$return_url=Yii::app()->getBaseUrl(true)."/store/sisowinit/id/".$data_get['id'];
											
			$sisow->purchaseId = $payment_ref;
			$sisow->description = $payment_description;
			$sisow->amount = $amount_to_pay;
			$sisow->payment = $data_post['payment_method'];
			$sisow->issuerId = $data_post["issuerid"];
			$sisow->returnUrl = $return_url;
			$sisow->notifyUrl = $sisow->returnUrl;			
			
			if (($ex = $sisow->TransactionRequest()) < 0) {				
				$error=$sisow->errorCode." ".$sisow->errorMessage;
			} else header("Location: " . $sisow->issuerUrl);			
			
		} else if (isset($_GET["trxid"])) {
						
			if ($data_get['status']=="Success"){				
				$params_logs=array(
		          'order_id'=>$data_get['id'],
		          'payment_type'=>Yii::app()->functions->paymentCode('sisow'),
		          'raw_response'=>json_encode($data_get),
		          'date_created'=>date('c'),
		          'ip_address'=>$_SERVER['REMOTE_ADDR'],
		          'payment_reference'=>$data_get['trxid']
		        );
		        $db_ext->insertData("{{payment_order}}",$params_logs);

		        	        
		        $params_update=array('status'=>'paid');	        
	            $db_ext->updateData("{{order}}",$params_update,'order_id',$data_get['id']);
		        
		        header('Location: '.Yii::app()->request->baseUrl."/store/receipt/id/".$_GET['id']);
		        die();
			} else $error=Yii::t("default","Payment Failed"." ".$data_get['status']);	
		} else {		
			$testmode = $mode=="Sandbox"?true:false;
			$sisow->DirectoryRequest($select, true, $testmode);	
		}
	}	
} else  $error=Yii::t("default","Sorry but we cannot find what your are looking for.");	
?>


<div class="page-right-sidebar payment-option-page">
  <div class="main">  
  <?php if ( !empty($error)):?>
  <p class="uk-text-danger"><?php echo $error;?></p>  
  
  <?php else :?>
  
  <h2><?php echo Yii::t("default","Pay using Sisow")?></h2>
   
  <form class="uk-form uk-form-horizontal forms"  method="POST" >
  <input type="hidden" id="action" name="action" value="sisowPaymentMerchant">
    
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
  
  
  <?php $back_url=Yii::app()->request->baseUrl."/store/paymentOption";?>
  <div style="height:10px;"></div>
  <a href="<?php echo $back_url;?>"><?php echo Yii::t("default","Go back")?></a>
  
  </div> <!--main-->
</div> <!--page-->