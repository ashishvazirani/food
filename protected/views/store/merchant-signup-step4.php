<?php 
$continue=true;
if ($merchant=Yii::app()->functions->getMerchantByToken($_GET['token'])){	
	if ( $merchant['package_price']>=1){
		if ($merchant['payment_steps']!=3){
			$continue=false;
		}
	}
} else $continue=false;
?>

<div class="page">
  <div class="main">   
  <div class="inner">
  <div class="spacer"></div>
  
  
  <?php if ($continue==TRUE):?>
  <div  class="signup-merchant-wrap"> 
  <p class="uk-text-success">
  <?php echo Yii::t("default","Almost Done..")?><br/>
  <?php echo Yii::t("default","Your merchant registration is successfull. An email was sent to your email with activation code.")?>
  </p>
  
  <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','activationMerchant')?> 
  <?php echo CHtml::hiddenField('currentController','store')?>
  <?php echo CHtml::hiddenField('token',$_GET['token'])?> 
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Enter Activation Code")?></label>
  <?php echo CHtml::textField('activation_code',
  ''
  ,array(
  'class'=>'uk-form-width-large',
  'data-validation'=>"required",
  'maxlength'=>10
  ))?>
  </div>      
  

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Submit")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>  
  
  </form>
  
  <p class="uk-text-muted"><?php echo Yii::t("default","Did not receive activation code? click")?> <a class="resend-activation-code"href="javascript:;"><?php echo Yii::t("default","here")?></a> <?php echo Yii::t("default","to resend again.")?></p>
  
  </div> <!--signup-merchant-wrap-->
  
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
  <?php endif;?>
  
  </div>
  </div> <!--main-->
</div> <!--page-->