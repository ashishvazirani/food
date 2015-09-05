
<div class="uk-width-1">
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/Cuisine/Do/Add" class="uk-button"><i class="fa fa-plus"></i> <?php echo Yii::t("default","Add New")?></a>
<a href="<?php echo Yii::app()->request->baseUrl; ?>/admin/Cuisine" class="uk-button"><i class="fa fa-list"></i> <?php echo Yii::t("default","List")?></a>
</div>

<?php 
if (isset($_GET['id'])){
	if (!$data=Yii::app()->functions->GetCuisine($_GET['id'])){
		echo "<div class=\"uk-alert uk-alert-danger\">".
		Yii::t("default","Sorry but we cannot find what your are looking for.")."</div>";
		return ;
	}
}
?>                                   

<div class="spacer"></div>

<form class="uk-form uk-form-horizontal forms" id="forms">
<?php echo CHtml::hiddenField('action','addCuisine')?>
<?php echo CHtml::hiddenField('id',isset($_GET['id'])?$_GET['id']:"");?>
<?php if (!isset($_GET['id'])):?>
<?php echo CHtml::hiddenField("redirect",Yii::app()->request->baseUrl."/admin/Cuisine/Do/Add")?>
<?php endif;?>


<div class="uk-form-row">
  <label class="uk-form-label"><?php echo Yii::t("default","Cuisine Name")?></label>
  <?php 
  echo CHtml::textField('cuisine_name',
  isset($data['cuisine_name'])?$data['cuisine_name']:""
  ,array('class'=>"uk-form-width-large",'data-validation'=>"required"))
  ?>
</div>

<div class="uk-form-row">
<label class="uk-form-label"></label>
<input type="submit" value="<?php echo Yii::t("default","Save")?>" class="uk-button uk-form-width-medium uk-button-success">
</div>

</form>