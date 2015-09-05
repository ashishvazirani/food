<?php 
$renew=false;
if (isset($_GET['action'])){
	 $package_id=isset($_GET['package_id'])?$_GET['package_id']:'';  	 
	 $renew=true;
}
?>                            
<div class="page merchant-payment-option">
  <div class="main">   
  <div class="inner">
  <div class="spacer"></div>

  
  <?php if ($merchant=Yii::app()->functions->getMerchantByToken($_GET['token'])):?>
  <?php $merchant_id=$merchant['merchant_id'];?>
  
  <?php 
  if ($renew==TRUE){
  	  $merchant['package_price']=1;
  }
  ?>
  
  <?php if ($merchant['package_price']>=1):?>
  
<form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','merchantPayment')?>
  <?php echo CHtml::hiddenField('currentController','store')?>
  <?php echo CHtml::hiddenField('token',$_GET['token'])?>  
    
  <?php if ($renew==TRUE):?>
    <?php echo CHtml::hiddenField("renew",1);?>
    <?php echo CHtml::hiddenField("package_id",$package_id);?>
    <?php if (is_numeric($package_id)):?>
    <?php Yii::app()->functions->adminPaymentList();?>      
    <?php else :?>
    <P class="uk-text-danger"><?php echo Yii::t("default","No Selecetd Membership package. Please go back.")?></P>
    <?php endif;?>
  <?php else :?>  
     <?php Yii::app()->functions->adminPaymentList();?>      
  <?php endif;?>  
         
<div class="spacer"></div>
<div class="uk-form-row">
<input type="submit" value="<?php echo Yii::t("default","Next")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>
         
        </form>    
                
        <div class="spacer"></div>
        
        <div class="credit_card_wrap hidden">    
                                            
            <form id="frm-creditcard" class="frm-creditcard uk-panel uk-panel-box uk-form" method="POST" onsubmit="return false;">
            
<h3><?php echo Yii::t("default","Credit Card information")?> <a href="javascript:;" class="cc-add uk-button"><?php echo Yii::t("default","Add new card")?></a></h3>
            
            <p class="uk-text-muted"><?php echo Yii::t("default","select credit card below")?></p>
            <ul class="uk-list uk-list-striped uk-list-cc">           
            </ul>
                                       
              <div class="cc-add-wrap hidden">
               <p class="uk-text-bold"><?php echo Yii::t("default","New Card")?></p>
               <?php echo CHtml::hiddenField('action','addCreditCardMerchant')?>
               <?php echo CHtml::hiddenField('currentController','store')?>
               <?php echo CHtml::hiddenField('merchant_id',$merchant_id)?>
               
               <div class="uk-form-row">                  
	              <?php echo CHtml::textField('card_name','',array(
	               'class'=>'uk-width-1-1',
	               'placeholder'=>Yii::t("default","Card name"),
	               'data-validation'=>"required"  
	              ))?>
               </div>             
               
               <div class="uk-form-row">                  
	              <?php echo CHtml::textField('credit_card_number','',array(
	               'class'=>'uk-width-1-1 numeric_only',
	               'placeholder'=>Yii::t("default","Credit Card Number"),
	               'data-validation'=>"required",
	               'maxlength'=>20
	              ))?>
               </div>             
               
               <div class="uk-form-row">                  
	              <?php echo CHtml::dropDownList('expiration_month','',
	              Yii::app()->functions->ccExpirationMonth()
	              ,array(
	               'class'=>'uk-width-1-1',
	               'placeholder'=>Yii::t("default","Exp. month"),
	               'data-validation'=>"required"  
	              ))?>
               </div>             
               
               <div class="uk-form-row">                  
	              <?php echo CHtml::dropDownList('expiration_yr','',
	              Yii::app()->functions->ccExpirationYear()
	              ,array(
	               'class'=>'uk-width-1-1',
	               'placeholder'=>Yii::t("default","Exp. year") ,
	               'data-validation'=>"required"  
	              ))?>
               </div>             
               
               <div class="uk-form-row">                  
	              <?php echo CHtml::textField('cvv','',array(
	               'class'=>'uk-width-1-1',
	               'placeholder'=>Yii::t("default","CVV"),
	               'data-validation'=>"required",
	               'maxlength'=>4
	              ))?>
               </div>             
               
               <div class="uk-form-row">                  
	              <?php echo CHtml::textField('billing_address','',array(
	               'class'=>'uk-width-1-1',
	               'placeholder'=>Yii::t("default","Billing Address") ,
	               'data-validation'=>"required"  
	              ))?>
               </div>             
               
               <div class="uk-form-row">   
                  <input type="submit" value="<?php echo Yii::t("default","Add Credit Card")?>" class="uk-button uk-button-success uk-width-1-1">
               </div>
             </div> 
             </form>
        </div> <!--credit_cart_wrap-->
        
     <?php else :?>        
     <p class="uk-text-success">
     <?php echo Yii::t("default","You have selected a package which is free of charge. You can now proceed to next steps.")?>
     </p>
     <div class="uk-form-row">   
       <input type="submit" data-token="<?php echo $_GET['token']?>" value="<?php echo Yii::t("default","Next")?>" class="next_step_free_payment uk-button uk-button-success uk-width-1-3">
     </div>
     <?php endif;?>
        
      <?php else :?>
       <p class="uk-text-danger"><?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
      <?php endif;?>
  
   </div>
  </div> <!--main-->
</div>  <!--page-->