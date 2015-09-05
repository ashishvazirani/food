<!--<link href="/restomulti/assets/vendor/uikit/css/uikit.almost-flat.min.css" rel="stylesheet" />
<link href="/restomulti/assets/vendor/uikit/css/addons/uikit.addons.min.css" rel="stylesheet" />
<link href="/restomulti/assets/vendor/uikit/css/addons/uikit.gradient.addons.min.css" rel="stylesheet" />
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
<link href="/restomulti/assets/css/store.css?ver=1.0" rel="stylesheet" />-->

<div class="pop-wrap">
   <div class="modal-header">
     <h3 class="left"><?php echo Yii::t("default","Edit your review")?></h3>
     <a class="right fc-close" href="javascript:;"><i class="fa fa-times"></i></a>
     <div class="clear"></div>
 </div>
 
 <form id="frm-modal-update-review" class="frm-modal-update-review" method="POST" onsubmit="return false;" >
 <?php echo CHtml::hiddenField('action','updateReview');?>
 <?php echo CHtml::hiddenField('id',$this->data['id']);?>
 <?php echo CHtml::hiddenField('web_session_id',$this->data['web_session_id']);?>
 
 <div class="modal-body">
 <?php if ( $res=Yii::app()->functions->getReviewsById($this->data['id']) ):?>
 <?php  
 echo CHtml::textArea('review_content',$res['review'],array(
  'class'=>"uk-form-width-large"
 ));
 ?>
 <?php else :?>
 <p class="uk-text-danger"><?php echo Yii::t("default","Error: review not found.")?></p>
 <?php endif;?>
 </div> <!--modal-body--> 
 
 <div class="action-wrap">
   <div class="inner right">
	  <input type="submit" class="uk-button" value="<?php echo Yii::t("default","Submit")?>">
	  <a href="javascript:close_fb();" class="uk-button uk-button-danger" ><?php echo Yii::t("default","Cancel")?></a>
   </div>
   <div class="clear"></div>
 </div> <!--action-wrap-->
 
 </form>
 
</div> <!--pop-wrap-->


<script type="text/javascript">
$.validate({ 	
    form : '#frm-modal-update-review',    
    onError : function() {      
    },
    onSuccess : function() {     
      form_submit('frm-modal-update-review');
      return false;
    }  
})
</script>