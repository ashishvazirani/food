<!--<link href="/restomulti/assets/vendor/uikit/css/uikit.almost-flat.min.css" rel="stylesheet" />
<link href="/restomulti/assets/vendor/uikit/css/addons/uikit.addons.min.css" rel="stylesheet" />
<link href="/restomulti/assets/vendor/uikit/css/addons/uikit.gradient.addons.min.css" rel="stylesheet" />
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<link href="/restomulti/assets/css/store.css?ver=1.0" rel="stylesheet" />-->

<div class="pop-wrap">
   <div class="modal-header">
     <h3 class="left"><?php echo Yii::t("default","Enter your address below")?></h3>
     <!--<a class="right fc-close" href="javascript:;"><i class="fa fa-times"></i></a>-->
     <div class="clear"></div>
 </div>
 
 <form id="frm-modal-enter-address" class="frm-modal-enter-address uk-form" method="POST" onsubmit="return false;" >
 <?php echo CHtml::hiddenField('action','setAddress');?> 
 <?php echo CHtml::hiddenField('web_session_id',$this->data['web_session_id']);?>
 
 <div class="modal-body" style="position:relative;">
 <?php echo CHtml::textField('client_address',
 isset($_SESSION['kr_search_address'])?$_SESSION['kr_search_address']:''
 ,array(
 'class'=>"uk-form-width-large",
 'data-validation'=>"required"
 ))?>
 </div> <!--modal-body--> 
 
 <div class="action-wrap">
   <div class="inner right">
	  <input type="submit" class="uk-button" value="<?php echo Yii::t("default","Submit")?>">
	  <!--<a href="javascript:close_fb();" class="uk-button uk-button-danger" ><?php echo Yii::t("default","Cancel")?></a>-->
   </div>
   <div class="clear"></div>
 </div> <!--action-wrap-->
 
 </form>
 
</div> <!--pop-wrap-->


<script type="text/javascript">
$.validate({ 	
    form : '#frm-modal-enter-address',    
    onError : function() {      
    },
    onSuccess : function() {     
      form_submit('frm-modal-enter-address');
      return false;
    }  
})

jQuery(document).ready(function() {
	var google_auto_address= $("#google_auto_address").val();	
	if ( google_auto_address =="yes") {		
	} else {
		$("#client_address").geocomplete({
		    country: $("#admin_country_set").val()
		});	
	}
});
</script>
<?php
die();