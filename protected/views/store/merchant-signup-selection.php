<?php 
$percent=Yii::app()->functions->getOptionAdmin('admin_commision_percent');
$commision_type=Yii::app()->functions->getOptionAdmin('admin_commision_type');
$currency=adminCurrencySymbol();
?>

<div class="page">
  <div class="main signup-selection"> 
  <h3><?php echo t("Please Choose A Package Below To Signup")?></h3>
  
  
  <div class="table">
  
  <li>
  <a class="a rounded" href="<?php echo Yii::app()->createUrl("/store/merchantSignup")?>">
  <h5><?php echo t("Membership Click here")?></h5>
  <p><?php echo t("You will be charged a monthly or yearly fee")?>.</p>
  </a>
  </li>
  
  
  <li>
  <a class="b rounded" href="<?php echo Yii::app()->createUrl("/store/merchantsignupinfo")?>">
  <h5><?php echo t("Commission Click here")?></h5>
  <?php if ( $commision_type=="fixed"):?>  
  <p><?php echo displayPrice($currency,$percent)." ".t("commission per order")?>.</p>
  <?php else:?>
  <p><?php echo standardPrettyFormat($percent)."% ".t("commission per order")?>.</p>
  <?php endif;?>
  </a>
  </li>
  
  </div>
   
  <div class="clear"></div>
  
  </div> <!--main-->
</div> <!--page-->