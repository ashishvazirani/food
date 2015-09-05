<?php 
$website_address=Yii::app()->functions->getOptionAdmin('website_address');
$website_contact_phone=Yii::app()->functions->getOptionAdmin('website_contact_phone');
$website_contact_email=Yii::app()->functions->getOptionAdmin('website_contact_email');
$contact_content=Yii::app()->functions->getOptionAdmin('contact_content');

$country=Yii::app()->functions->adminCountry();

$fields=yii::app()->functions->getOptionAdmin('contact_field');
if (!empty($fields)){
	$fields=json_decode($fields);
}

$contact_map=yii::app()->functions->getOptionAdmin('contact_map');
$map_latitude=yii::app()->functions->getOptionAdmin('map_latitude');
$map_longitude=yii::app()->functions->getOptionAdmin('map_longitude');

$marker=Yii::app()->functions->getOptionAdmin('map_marker');
if (!empty($marker)){
   echo CHtml::hiddenField('map_marker',$marker);
}
?>

<div class="page-right-sidebar" id="contact-page">
  <div class="main">
  <div class="inner">

  <h2><?php echo Yii::t("default","Contact Us")?></h2>
  
  <form class="uk-form uk-form-horizontal forms" id="forms" onsubmit="return false;">
  <?php echo CHtml::hiddenField('action','contacUsSubmit')?>
  <?php echo CHtml::hiddenField('currentController','store')?>
  
  <div class="uk-form-row">   
  <p class="nomargin"><?php echo $website_address ." ".$country;?></p>
  <p class="nomargin uk-text-muted"><?php echo $website_contact_phone;?></p>
  <p class="nomargin uk-text-muted"><?php echo $website_contact_email;?></p>
  </div>
  
  
  <p><?php echo $contact_content;?></p>
  
  <?php if ( $contact_map==1):?>
  <div id="google_map_wrap"></div>
  <?php 
  echo CHtml::hiddenField('map_title',yii::app()->functions->getOptionAdmin('website_title'));
  echo CHtml::hiddenField('map_latitude',$map_latitude);
  echo CHtml::hiddenField('map_longitude',$map_longitude);
  ?>
  <?php endif;?>
  
  <?php if (is_array($fields) && count($fields)>=1):?>
  <?php foreach ($fields as $val):?>
  
  <?php 
  $placeholder='';
  switch ($val) {
  	case "name":
  		$placeholder="Name";
  		break;
  	case "email":  
  	    $placeholder="Email address";
  		break;
  	case "phone":  
  	    $placeholder="Phone";
  		break;
  	case "country":  
  	    $placeholder="Country";
  		break;
  	case "message":  
  	    $placeholder="Message";
  		break;	  	
  	default:
  		break;
  }
  ?>
  
  <div class="uk-form-row">   
    <?php if ( $val=="message"):?>
    <?php echo CHtml::textArea($val,'',array(
		'class'=>'uk-width-1-1',
		'data-validation'=>"required" ,
		'placeholder'=>Yii::t("default",$placeholder)
		))?>
    <?php else :?>
		<?php echo CHtml::textField($val,'',array(
		'class'=>'uk-width-1-1',	
		'data-validation'=>"required" ,
		'placeholder'=>Yii::t("default",$placeholder)
		))?>
	<?php endif;?>
  </div>
  <?php endforeach;?>  
  <div class="uk-form-row">   
      <input type="submit" value="<?php echo Yii::t("default","Submit")?>" class="uk-button uk-button-success uk-width-1-3">
   </div>
  <?php endif;?> 
       
  </form>
  
  </div>
  </div> <!--main-->
</div> <!--page-->