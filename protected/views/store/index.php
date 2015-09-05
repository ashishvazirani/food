<?php 
$cuisine=Yii::app()->functions->Cuisine(false);
$city=Yii::app()->functions->getCityList();
?>

<div class="home-page"></div>

<div class="ie-no-supported-msg">
<div class="main">
<h2><?php echo Yii::t("default","Oopps..It Seems that you are using browser which is not supported.")?></h2>
<p class="uk-text-danger">
<?php echo Yii::t("default","Restaurant will not work properly..")?>
<?php echo Yii::t("default","Please use firefox,chrome or safari instead. THANK YOU!")?></p>
</div>
</div>

<div class="browse-wrapper" style="display:none;">
  <div class="main" style="min-height: 0;">
      <!--<h2 class="uk-h2"><i class="fa fa-bars"></i> Featured Restaurant</h2>      -->      
  </div>
</div> <!--END browse-wrapper-->