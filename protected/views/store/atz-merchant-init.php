<?php
$db_ext=new DbExt;
$error='';
$success='';
$amount_to_pay=0;
$payment_description=Yii::t("default",'Payment to merchant');
$payment_ref=Yii::app()->functions->generateCode()."TT".Yii::app()->functions->getLastIncrement('{{order}}');

$data_get=$_GET;
$data_post=$_POST;

$merchant_default_country=Yii::app()->functions->getOptionAdmin('merchant_default_country');  

if ( $data=Yii::app()->functions->getOrder($_GET['id'])){	
	$merchant_id=isset($data['merchant_id'])?$data['merchant_id']:'';
	
	$mode_autho=Yii::app()->functions->getOption('merchant_mode_autho',$merchant_id);
    $autho_api_id=Yii::app()->functions->getOption('merchant_autho_api_id',$merchant_id);
    $autho_key=Yii::app()->functions->getOption('merchant_autho_key',$merchant_id);
		
	$payment_description.=isset($data['merchant_name'])?" ".$data['merchant_name']:'';	
		
    $mtid=Yii::app()->functions->getOption('merchant_sanbox_sisow_secret_key',$merchant_id);
    $mtkey=Yii::app()->functions->getOption('merchant_sandbox_sisow_pub_key',$merchant_id);
    $mtshopid=Yii::app()->functions->getOption('merchant_sandbox_sisow_shopid',$merchant_id);
    $mode=Yii::app()->functions->getOption('merchant_sisow_mode',$merchant_id);
    
    /*COMMISSION*/
	if ( Yii::app()->functions->isMerchantCommission($merchant_id)){			
		$mode_autho=Yii::app()->functions->getOptionAdmin('admin_mode_autho');
        $autho_api_id=Yii::app()->functions->getOptionAdmin('admin_autho_api_id');
        $autho_key=Yii::app()->functions->getOptionAdmin('admin_autho_key');        
	}
    
	define("AUTHORIZENET_API_LOGIN_ID",$autho_api_id); 
    define("AUTHORIZENET_TRANSACTION_KEY",$autho_key);
    define("AUTHORIZENET_SANDBOX",$mode_autho=="sandbox"?true:false);       
    //define("TEST_REQUEST", $mode_autho=="sandbox"?"FALSE":"TRUE"); 
	
    $amount_to_pay=isset($data['total_w_tax'])?Yii::app()->functions->standardPrettyFormat($data['total_w_tax']):'';
    $amount_to_pay=is_numeric($amount_to_pay)?unPrettyPrice($amount_to_pay):'';
        
    /*dump($payment_description);
    dump($amount_to_pay);*/    
    
    if (isset($_POST['x_card_num'])){
    	
    	require_once 'anet_php_sdk/AuthorizeNet.php';
        $transaction = new AuthorizeNetAIM;
        $transaction->setSandbox(AUTHORIZENET_SANDBOX);
                
        $params= array(
        //'company'     => $res['restaurant_name'],
        'description' => $payment_description,
        'amount'     => $amount_to_pay, 
        'card_num'   => $_POST['x_card_num'], 
        'exp_date'   => $_POST['expiration_month']."/".$_POST['expiration_yr'],
        'first_name' => $_POST['x_first_name'],
        'last_name'  => $_POST['x_last_name'],
        'address'    => $_POST['x_address'],
        'city'       => $_POST['x_city'],
        'state'      => $_POST['x_state'],
        'country'    => $_POST['x_country'],
        'zip'        => $_POST['x_zip'],
        //'email'      => $_POST['x_email'],
        'card_code'  => $_POST['cvv'],
        );
        //dump($params);
        
        $transaction->setFields($params);        
        $response = $transaction->authorizeAndCapture();
        if ($response->approved) {
        	$resp_transaction = $response->transaction_id;
        	
        	$params_logs=array(
	          'order_id'=>$data_get['id'],
	          'payment_type'=>Yii::app()->functions->paymentCode('authorize'),
	          'raw_response'=>json_encode($response),
	          'date_created'=>date('c'),
	          'ip_address'=>$_SERVER['REMOTE_ADDR'],
	          'payment_reference'=>$resp_transaction
	        );
	        $db_ext->insertData("{{payment_order}}",$params_logs);
	        	       
	        $params_update=array('status'=>'paid');	        
            $db_ext->updateData("{{order}}",$params_update,'order_id',$data_get['id']);
	        
	        header('Location: '.Yii::app()->request->baseUrl."/store/receipt/id/".$_GET['id']);
	        die();
        	
        } else $error=$response->response_reason_text;    	
    }        
} else  $error=Yii::t("default","Sorry but we cannot find what your are looking for.");	
?>
<div class="page-right-sidebar payment-option-page">
  <div class="main">  
  
  
  <h2><?php echo Yii::t("default","Pay using Authorize.net")?></h2>
  
  <?php if ( !empty($error)):?>
  <p class="uk-text-danger"><?php echo $error;?></p>  
  <?php endif;?>
  
  <form id="forms-normal" class="uk-form uk-form-horizontal forms"  method="POST" >
    
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
  <label class="uk-form-label"><?php echo Yii::t("default","Credit Card Number")?></label>
  <?php echo CHtml::textField('x_card_num',
  isset($data_post['x_card_num'])?$data_post['x_card_num']:''
  ,array(
  'class'=>'uk-form-width-large numeric_only' ,
  'data-validation'=>"required"  
  ))?>
  </div>    
   
  <div class="uk-form-row">           
      <label class="uk-form-label"><?php echo Yii::t("default","Exp. month")?></label>       
      <?php echo CHtml::dropDownList('expiration_month',
      isset($data_post['expiration_month'])?$data_post['expiration_month']:''
      ,
      Yii::app()->functions->ccExpirationMonth()
      ,array(
       'class'=>'uk-form-width-large',
       'placeholder'=>Yii::t("default","Exp. month"),
       'data-validation'=>"required"  
      ))?>
   </div>             
   
   <div class="uk-form-row">                  
      <label class="uk-form-label"><?php echo Yii::t("default","Exp. year")?></label>       
      <?php echo CHtml::dropDownList('expiration_yr',
      isset($data_post['expiration_yr'])?$data_post['expiration_yr']:''
      ,
      Yii::app()->functions->ccExpirationYear()
      ,array(
       'class'=>'uk-form-width-large',
       'placeholder'=>Yii::t("default","Exp. year") ,
       'data-validation'=>"required"  
      ))?>
   </div>             
   
   <div class="uk-form-row">                  
      <label class="uk-form-label"><?php echo Yii::t("default","CCV")?></label>       
      <?php echo CHtml::textField('cvv',
      isset($data_post['cvv'])?$data_post['cvv']:''
      ,array(
       'class'=>'uk-form-width-large numeric_only',       
       'data-validation'=>"required",
       'maxlength'=>4
      ))?>
   </div>   
   
   
 <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","First Name")?></label>
  <?php echo CHtml::textField('x_first_name',
  isset($data_post['x_first_name'])?$data_post['x_first_name']:''
  ,array(
  'class'=>'uk-form-width-large ',
  'data-validation'=>"required"  
  ))?>
  </div>       
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Last Name")?></label>
  <?php echo CHtml::textField('x_last_name',
  isset($data_post['x_last_name'])?$data_post['x_last_name']:''
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"  
  ))?>
  </div>       
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Address")?></label>
  <?php echo CHtml::textField('x_address',
  isset($data_post['x_address'])?$data_post['x_address']:''
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"  
  ))?>
  </div>       
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","City")?></label>
  <?php echo CHtml::textField('x_city',
  isset($data_post['x_city'])?$data_post['x_city']:'' 
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"   
  ))?>
  </div>       
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","State")?></label>
  <?php echo CHtml::textField('x_state',
  isset($data_post['x_state'])?$data_post['x_state']:''
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"    
  ))?>
  </div>       
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Zip Code")?></label>
  <?php echo CHtml::textField('x_zip',
  isset($data_post['x_zip'])?$data_post['x_zip']:''
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"  
  ))?>
  </div>       
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Country")?></label>
  <?php echo CHtml::dropDownList('x_country',
  isset($data_post['country_code'])?$data_post['country_code']:$merchant_default_country,
  (array)Yii::app()->functions->CountryListMerchant(),          
  array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required"
  ))?>
  </div>       
  
  <div class="uk-form-row">
  <label class="uk-form-label"></label>
  <input type="submit" value="<?php echo Yii::t("default","Pay Now")?>" class="uk-button uk-form-width-medium uk-button-success">
  </div>   

  </form>
    
  
  </div>
</div>