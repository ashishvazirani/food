<?php
$merchant_id=getMerchantID();
$sms=Yii::app()->functions->getOption("sms_alert_change_status",$merchant_id);
$order=Yii::app()->functions->getOrder2($this->data['order_id']);
?>

<!--<link href="<?php echo assetsURL()?>/css/store.css?ver=1.0" rel="stylesheet" />-->

<div class="pop-wrap" style="width:500px;padding:10px;">
   <div class="modal-header">
     <h3 class="left"><?php echo Yii::t("default","Send SMS To Customer")?></h3>
     <a class="right fc-close" href="javascript:;"><i class="fa fa-times"></i></a>
     <div class="clear"></div>
 </div>
 
 <form id="frm-modal-sendsms" class="frm-modal-sendsms" method="POST" onsubmit="return false;" >
 <?php echo CHtml::hiddenField('action','sendUpdateOrderSMS');?>
 <?php echo CHtml::hiddenField('order_id',$this->data['order_id']);?>
 
 <div class="modal-body">
 
 <?php if (is_array($order) && count($order)>=1):?>
 <?php 
 $sms=smarty('customer-name',$order['full_name'],$sms);
 $sms=smarty('orderno',$order['order_id'],$sms);
 $sms=smarty('order-status',$order['status'],$sms);
 ?>
 <?php  
 echo CHtml::textArea('sms_order_change_msg',$sms,array(
  'style'=>"width:100%;"
 ));
 ?>
 <div class="action-wrap">
   <div class="inner right">
	  <input style="display:inline;" type="submit" class="ux-button-red2 ux-button-big" value="<?php echo Yii::t("default","Send")?>">	  
	  
	  <input style="display:inline;" onclick="javascript:close_fb();" type="button" class="ux-button-red2 ux-button-big" value="<?php echo Yii::t("default","Cancel")?>">
	  
   </div>
   <div class="clear"></div>
 </div> <!--action-wrap-->
 <?php else :?>
 <p><?php echo t("Sory but we cannot find the order information");?></p>
 <?php endif;?>
 
 </form>
 
</div> <!--pop-wrap-->


<script type="text/javascript">
$.validate({ 	
    form : '#frm-modal-sendsms',    
    onError : function() {      
    },
    onSuccess : function() {     
      form_submit('frm-modal-sendsms');
      return false;
    }  
})
</script>