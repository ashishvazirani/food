<?php
$marker=Yii::app()->functions->getOptionAdmin('map_marker');
if (!empty($marker)){
   echo CHtml::hiddenField('map_marker',$marker);
}
?>

<form id="form_map" class="uk-form" onsubmit="return false;">
<div class="full_map_page">
  <div class="full_map_search">
       
    <div style="margin-bottom:5px;">
    <a href="<?php echo websiteUrl()."/store"?>"><i class="fa fa-home"></i><?php echo t("Home")?></a>
    <span class="sep">|</span>
    <a class="reset-geo" href="javascript:;"><?php echo t("Reset Map")?></a>
    <?php if ( Yii::app()->functions->getOptionAdmin("merchant_disabled_registration")==""):?>
    <span class="sep">|</span>
    <a href="<?php echo websiteUrl()."/store/merchantsignupselection"?>">
    <?php echo t("Restaurant Signup")?>
    </a>
    <?php endif;?>
    </div>
     
    <div class="uk-form-row">
     <?php echo CHtml::textField('geo_address','',array(
       'placeholder'=>t("Search by address"),
       'class'=>"",
       'data-validation'=>'required'
     ))?>
     <?php 
     echo CHtml::submitButton('Search',array(
      'class'=>"uk-button uk-button-success",
      'id'=>"geo_find"      
     ));
     echo CHtml::hiddenField('lat');
     echo CHtml::hiddenField('lng');
     ?>     
     </div>
      
  </div>
  <div id="map_area"></div>
</div>

</form>