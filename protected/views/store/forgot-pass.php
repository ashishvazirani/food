

<div class="page-right-sidebar" id="lost-pass-wrap">
  <div class="main">
  
  <?php if ($res=Yii::app()->functions->getLostPassToken($_GET['token']) ):?>
  
  
  <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','changePassword')?>
  <?php echo CHtml::hiddenField('token',$_GET['token'])?>
  <?php echo CHtml::hiddenField('currentController','store')?>

  <h2><?php echo Yii::t("default","Reset Password")?></h2>
  
  <div class="uk-form-row">  
  <?php 
  echo CHtml::passwordField('password',''  
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required",
  'placeholder'=>Yii::t("default","New Password")
  ))
  ?>
  </div>

  <div class="uk-form-row">  
  <?php 
  echo CHtml::passwordField('confirm_password',''  
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required",
  'placeholder'=>Yii::t("default","Confirm Password")
  ))
  ?>
  </div>
  
  <div class="uk-form-row">   
    <input type="submit" value="<?php echo Yii::t("default","Submit")?>" class="change-pass-btn uk-button uk-button-success uk-width-1-4">
  </div>
  </form>
  
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","ERROR: Invalid token.")?></p>
  <?php endif;?>  
  </div> <!--main-->
</div> <!-- page-->