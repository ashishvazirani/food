
<div class="page">
  <div class="main">   
  <div class="inner">
  <div class="spacer"></div>
  
  <?php if ($res=Yii::app()->functions->getMerchantByToken($_GET['token'])):?>
  <p class="uk-text-success"><?php echo Yii::t("default","Congratulation your merchant is now ready.")?></p>
  <p class="uk-text-muted"><?php echo Yii::t("default","to login")?> <a href="<?php echo Yii::app()->request->baseUrl;?>/merchant"><?php echo Yii::t("default","click here")?></a></p>
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
  <?php endif;?>
  
  </div>
  </div> <!--main-->
</div> <!--page  -->