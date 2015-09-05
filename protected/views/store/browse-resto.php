<?php
unset($_SESSION['kr_item']);
unset($_SESSION['kr_merchant_id']);
unset($_SESSION['voucher_code']);
unset($_SESSION['less_voucher']);
$marker=Yii::app()->functions->getOptionAdmin('map_marker');
if (!empty($marker)){
   echo CHtml::hiddenField('map_marker',$marker);
}
?>
<div class="menu-wrapper page-right-sidebar" id="browse-resto-page">
  <div class="main">
      <h2 class="uk-h2"><i class="fa fa-bars"></i> <?php echo Yii::t("default","Restaurants")?></h2>            
      
      <div class="two-columns">
        <div class="grid-1 left">
        
        <div class="uk-grid" id="tabs">
	        <div class="uk-width-small-1-3">
	            <ul data-uk-tab="{connect:'#tab-left-content'}" class="uk-tab uk-tab-left">
	                <li class="uk-active"><a href="#"><i class="fa fa-cutlery"></i> <?php echo Yii::t("default","Restaurants")?></a></li>
	                <li class=""><a href="#"><i class="fa fa-bolt"></i> <?php echo Yii::t("default","Newest")?></a></li>
	                <li class=""><a href="#"><i class="fa fa-star-o"></i> <?php echo Yii::t("default","Featured")?></a></li>	            
	
	        </div>
	        <div class="uk-width-medium-1-2">
	            <ul class="uk-switcher" id="tab-left-content">
	                <li class="uk-active">	                   
	                   <?php Widgets::displayMerchant(Yii::app()->functions->getAllMerchant());?>
	                </li>
	                <li class="">
	                   <?php Widgets::displayMerchant(Yii::app()->functions->getAllMerchantNewest());?>
	                </li>
	                <li class="">
	                   <?php Widgets::displayMerchant(Yii::app()->functions->getFeaturedMerchant());?>
	                </li>
	            </ul>
	        </div>
	    </div><!-- uk-grid-->
        
        </div> <!--left-->
        <div class="grid-2 left">
          <div class="maps_side" id="maps_side"></div>
        </div>
        <div class="clear"></div>
      </div><!-- two-columns-->     
      
  </div> <!--main-->
</div> <!--END browse-wrapper-->