<div class="page-right-sidebar">
  <div class="main">
  <div class="inner">
  
<?php 
echo CHtml::hiddenField('mobile_country_code',Yii::app()->functions->getAdminCountrySet(true));
?>  
  
  <form class="profile-forms uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','updateClientProfile')?>
  <?php echo CHtml::hiddenField('currentController','store')?>

  <h2><?php echo Yii::t("default","Profile")?></h2>
  
  <?php $client_id=Yii::app()->functions->getClientId();?>
  <?php if ($data=Yii::app()->functions->getClientInfo($client_id) ):?>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","First Name")?></label>
  <?php 
  echo CHtml::textField('first_name',$data['first_name'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Last Name")?></label>
  <?php 
  echo CHtml::textField('last_name',$data['last_name'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Email address")?></label>
  <span><?php echo $data['email_address'];?></span>
  </div>  
  
  <?php 
  $FunctionsK=new FunctionsK();
  $FunctionsK->clientRegistrationCustomFields(true,$data);
  ?>
     
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Password")?></label>
  <?php 
  echo CHtml::passwordField('password','',
  array(
    'class'=>'uk-form-width-large',
    //'data-validation'=>"required"
  ));
  ?>
  </div>
  
  <h3><?php echo Yii::t("default","Address")?></h3>  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Street")?></label>
  <?php 
  echo CHtml::textField('street',$data['street'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","City")?></label>
  <?php 
  echo CHtml::textField('city',$data['city'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","State")?></label>
  <?php 
  echo CHtml::textField('state',$data['state'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Postal Code/Zip Code")?></label>
  <?php 
  echo CHtml::textField('zipcode',$data['zipcode'],
  array(
    'class'=>'uk-form-width-large',
    'data-validation'=>"required"
  ));
  ?>
  </div>
  
  <div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Contact phone")?></label>
  <?php 
  echo CHtml::textField('contact_phone',$data['contact_phone'],
  array(
    'class'=>'uk-form-width-large mobile_inputs',
    'data-validation'=>"required"
  ));
  ?>
  </div>  
  
  <div class="uk-form-row">
   <label class="uk-form-label"></label>
    <input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
  </div>  

  
  <?php else :?>
  <p class="uk-text-danger"><?php echo Yii::t("default","Profile not available")?></p>
  <?php endif;?>  
  </form>
    
  </div>
  </div> <!--main-->
</div> <!--page-right-sidebar--> 