<?php $ListlimitedPost=Yii::app()->functions->ListlimitedPost();?>
<div class="page">
  <div class="main packages-wrap"> 
  <div class="inner">    
   <?php if ($res=Yii::app()->functions->getPackagesList()):?>
   
   <h2 class="uk-h2 uk-text-muted"><?php echo Yii::t("default","Please select one of our package")?></h2>
   <div class="packages-wrapper">
   <ul class="packages-list">
   <?php foreach ($res as $val):?>
   <?php $color=Yii::app()->functions->randomColor();?>
   <li>
     <h2><?php echo $val['title']?></h2>
     <h3 style="color:<?php echo $color;?>">       
       <?php if ( $val['promo_price']>=1):?>
       <span class="normal-price">
       <?php echo Yii::app()->functions->adminCurrencySymbol().prettyFormat($val['price'])?>
       </span>
       <?php echo Yii::app()->functions->adminCurrencySymbol().prettyFormat($val['promo_price'])?>
       <?php else :?>
       <?php echo Yii::app()->functions->adminCurrencySymbol().prettyFormat($val['price'])?>
       <?php endif;?>
     </h3>
     <p class="uk-text-muted"><?php echo $val['description']?></p>
     <p class="even">	
     <?php if ( $val['expiration_type']=="year"):?>
     <?php echo Yii::t("default","Membership Limit")?> <?php echo $val['expiration']/365;?> <?php echo Yii::t("default",ucwords($val['expiration_type']))?>
     <?php else :?>
     <?php echo Yii::t("default","Membership Limit")?> <?php echo $val['expiration']?> <?php echo Yii::t("default",ucwords($val['expiration_type']))?>
     <?php endif;?>
     </p>
     
     <p class="uk-text-warning">
        <?php if ( $val['sell_limit'] <=0):?>
		<?php echo Yii::t("default","Sell limit")?> : <?php echo Yii::t("default","Unlimited")?>
		<?php else :?>
		<?php echo Yii::t("default","Sell limit")?> : <?php echo $val['sell_limit']?>
		<?php endif;?>
     </p>
     
     <p class="uk-text-muted"><?php echo Yii::t("default","Usage:")?> <?php echo $ListlimitedPost[$val['unlimited_post']]?></p>
     <a style="background-color:<?php echo $color;?>" href="<?php echo Yii::app()->request->baseUrl; ?>/store/merchantSignup/Do/step2/id/<?php echo $val['package_id']?>">
     <?php echo Yii::t("default","Sign up")?>
     </a>
   </li>
   <?php endforeach;?>   
   </ul>
   <div class="clear"></div>
   </div>
   <div class="clear"></div>
   <?php else :?>
   <p class="uk-text-danger">
     <?php echo Yii::t("default","No packages found.")?>
   </p>
   <?php endif;?>
   
   <div class="spacer2"></div><div class="spacer2"></div>
   <hr></hr>
   <p class="uk-text-muted"><?php echo Yii::t("default","Resume Signup? click")?> <a class="resume-app-link" href="javascript:;"><?php echo Yii::t("default","here")?></a></p>
   
   <form onsubmit="return false;" method="POST" class="uk-width-1-2 frm-resume-signup uk-panel uk-panel-box uk-form has-validation-callback" id="frm-resume-signup">
   
   <input type="hidden" id="action" name="action" value="merchantResumeSignup">
   <input type="hidden" id="do-action" name="do-action" value="sigin">         
   <?php echo CHtml::hiddenField('currentController','store')?>  
   
    <div class="uk-form-row">
   <input type="text" id="email_address" name="email_address" value="" data-validation="required" placeholder="<?php echo Yii::t("default","Email")?>" class="uk-width-1-1"></div> 
   
    <div class="uk-form-row">
    <input type="submit" class="uk-button uk-width-1-1 uk-button-success" value="<?php echo Yii::t("default","Submit")?>">
    </div>
   
   </form>
   
   </div>
  </div> <!--main-->
</div> <!--END page-->