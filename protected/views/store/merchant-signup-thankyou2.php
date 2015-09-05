
<div class="page">
  <div class="main">   
  <div class="inner">
  <div class="spacer"></div>
  
  <?php if ($res=Yii::app()->functions->getMerchantByToken($_GET['token'])):?>
  <p class="uk-text-success"><?php echo Yii::t("default","Congratulation for signing up. Please wait while our administrator validated your request.")?></p>  
  <p class="uk-text-muted"><?php echo Yii::t("default","You will receive email once your merchant has been approved. Thank You.")?></p>  
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
  <?php endif;?>
  </div>
  </div> <!--main-->
</div> <!--page  -->