

<div class="page-right-sidebar payment-option-page">
  <div class="main">
  
   <?php    
   //$paypal_con=Yii::app()->functions->getPaypalConnection();   
   $paypal_con=Yii::app()->functions->getPaypalConnection($_SESSION['kr_merchant_id']); 
   
   /*get admin paypal connection if merchant is commission*/
   if ( Yii::app()->functions->isMerchantCommission($_SESSION['kr_merchant_id'])){
   	   unset($paypal_con);   	   
   	   $paypal_con=Yii::app()->functions->getPaypalConnectionAdmin();
   } 
   
   $paypal=new Paypal($paypal_con);
   ?>
   <?php if ($res_paypal=$paypal->getExpressDetail()): //dump($res_paypal);?>
   <?php $token=$res_paypal['TOKEN'];?>
	   <?php if ($order_info=Yii::app()->functions->getOrderByPayPalToken($token)):?>
	     <?php $order_id=$order_info['order_id'];?>
	     
	     <?php
	     if ( $data=Yii::app()->functions->getOrder($order_id)){	     	
			$merchant_id=$data['merchant_id'];
			$json_details=!empty($data['json_details'])?json_decode($data['json_details'],true):false;
			if ( $json_details !=false){
				/*Yii::app()->functions->displayOrderHTML(
				  array('merchant_id'=>$data['merchant_id']),$json_details,true,$order_id
				);*/
				
				Yii::app()->functions->displayOrderHTML(array(
			       'merchant_id'=>$data['merchant_id'],
			       'order_id'=>$order_id,
			       'delivery_type'=>$data['trans_type'],
			       'delivery_charge'=>$data['delivery_charge'],
			       'packaging'=>$data['packaging'],
			       'cart_tip_value'=>$data['cart_tip_value'],
				   'cart_tip_percentage'=>$data['cart_tip_percentage'],
				   'card_fee'=>$data['card_fee']
			    ),$json_details,true);
				
				$data2=Yii::app()->functions->details;
				?>
				<div class="receipt-main-wrap">
				<h3><?php echo Yii::t("default","Review your order")?></h3>
				<div class="receipt-wrap order-list-wrap">
				
				<div class="input-block">
	             <div class="label"><?php echo Yii::t("default","Paypal Name")?> :</div>
	             <div class="value"><?php echo $res_paypal['FIRSTNAME']." ".$res_paypal['LASTNAME']?></div>
	             <div class="clear"></div>
	            </div>
	            
				<div class="input-block">
	             <div class="label"><?php echo Yii::t("default","Paypal Email")?> :</div>
	             <div class="value"><?php echo $res_paypal['EMAIL']?></div>
	             <div class="clear"></div>
	            </div>	           	           
				
				<?php echo $data2['html'];?>
				</div> <!--receipt-wrap order-list-wrap-->
				
				<div style="height:10px;"></div>
				
				<form method="POST" id="forms" class="forms" onsubmit="return false;">				
				<input type="hidden" name="token" value="<?php echo $_GET['token']?>">
				<input type="hidden" name="payerid" value="<?php echo $res_paypal['PAYERID']?>">
				<input type="hidden" name="amount" value="<?php echo $res_paypal['AMT']?>">
				<?php echo CHtml::hiddenField('action','paypalCheckoutPayment')?>
				<?php echo CHtml::hiddenField('currentController','store')?>
				<input type="hidden" name="order_id" value="<?php echo $order_id;?>">
				<div class="action-wrap">
				
				<input type="submit" value="<?php echo Yii::t("default","Pay Now")?>" class="paypal_paynow right uk-button uk-button-success">          <div class="clear"></div>
				</div>
				</form>
				
				</div><!-- receipt-main-wrap-->
				<?php				
			}	
		 } else echo "<p class=\"uk-text-danger\">".Yii::t("default","ERROR: Cannot get order details.")."</p>";
	     ?>
	     
	   <?php else :?>
	      <p class="uk-text-danger"><?php echo Yii::t("default","ERROR: Under ID not found.")?></p>
	   <?php endif;?>
   <?php else :?>
     <p class="uk-text-danger"><?php echo $paypal->getError();?></p>
   <?php endif;?>
  
  </div> <!--main-->
</div> <!--page-->