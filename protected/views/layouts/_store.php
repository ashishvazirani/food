<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<head>

<!-- IE6-8 support of HTML5 elements --> 
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/store.css?ver=1.0" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/responsive.css?ver=1.0" rel="stylesheet" />

<link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />

<link rel="shortcut icon" href="<?php echo  Yii::app()->request->baseUrl; ?>/favicon.ico" />

<!--START Google FOnts-->
<link href='//fonts.googleapis.com/css?family=Open+Sans|Podkova|Rosario|Abel|PT+Sans|Source+Sans+Pro:400,600,300|Roboto' rel='stylesheet' type='text/css'>
<!--END Google FOnts-->

<!--FONT AWESOME-->
<!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">-->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<!--END FONT AWESOME-->

<!--UIKIT-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/css/uikit.almost-flat.min.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/css/addons/uikit.addons.min.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/css/addons/uikit.gradient.addons.min.css" rel="stylesheet" />
<!--UIKIT-->

<!--COLOR PICK-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/colorpick/css/colpick.css" rel="stylesheet" />
<!--COLOR PICK-->

<!--ICHECK-->
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/iCheck/skins/all.css" rel="stylesheet" />
<!--ICHECK-->

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/chosen/chosen.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/animate.min.css" rel="stylesheet" />

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/flexslider/flexslider.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/bxslider/jquery.bxslider.css" rel="stylesheet" />

<?php Widgets::analyticsCode();?>

</head>
<body>


<div class="content">
 <?php echo $content;?>
</div> <!--END content-->

<div class="footer-wrap" style="display:none;"></div>

<?php echo CHtml::hiddenField('fb_app_id',Yii::app()->functions->getOptionAdmin('fb_app_id'))?>
<?php echo CHtml::hiddenField('admin_country_set',Yii::app()->functions->getOptionAdmin('admin_country_set'))?>
<?php echo CHtml::hiddenField('google_auto_address',Yii::app()->functions->getOptionAdmin('google_auto_address'))?>
<?php echo CHtml::hiddenField('google_default_country',Yii::app()->functions->getOptionAdmin('google_default_country'))?>
<?php echo CHtml::hiddenField('disabled_share_location',Yii::app()->functions->getOptionAdmin('disabled_share_location'))?>

</body>

<script src="//code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>  
<!--<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery-1.10.2.min.js" type="text/javascript"></script>-->

<?php  $js_lang=Yii::app()->functions->jsLanguageAdmin(); ?>
<?php $js_lang_validator=Yii::app()->functions->jsLanguageValidator();?>
<script type="text/javascript">
var js_lang=<?php echo json_encode($js_lang)?>;
var jsLanguageValidator=<?php echo json_encode($js_lang_validator)?>;
</script>

<script type="text/javascript">
var ajax_url='<?php echo Yii::app()->request->baseUrl;?>/admin/ajax';
var admin_url='<?php echo Yii::app()->request->baseUrl;?>/admin';
var sites_url='<?php echo Yii::app()->request->baseUrl;?>';
var upload_url='<?php echo Yii::app()->request->baseUrl;?>/upload';
</script>

<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/DataTables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/DataTables/fnReloadAjax.js" type="text/javascript"></script>


<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/JQV/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>

<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery.ui.timepicker-0.0.8.js" type="text/javascript"></script>

<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/js/uploader.js" type="text/javascript"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/ajaxupload/fileuploader.js" type="text/javascript"></script>


<!--UIKIT-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/uikit.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/addons/notify.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/addons/sticky.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/addons/sortable.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/uikit/js/addons/autocomplete.min.js"></script>
<!--UIKIT-->

<!--BAR RATING-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/bar-rating/jquery.barrating.min.js"></script>
<!--BAR RATING-->

<!--NICE SCROLL-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/jquery.nicescroll.min.js"></script>
<!--NICE SCROLL-->

<!--ICHECK-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/iCheck/icheck.js"></script>
<!--ICHECK-->

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/chosen/chosen.jquery.min.js"></script>

<!--Google Maps-->
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery.geocomplete.min.js"></script>
<!--END Google Maps-->

<?php $fb_flag=Yii::app()->functions->getOptionAdmin('fb_flag');?>
<?php if ( $fb_flag==""):?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/fblogin.js?ver=1" type="text/javascript"></script>  
<?php endif;?>

<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jQuery.print.js"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery.printelement.js"></script>

<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/fancybox/source/jquery.fancybox.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/bar-rating/jquery.barrating.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/jquery.appear.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/flexslider/jquery.flexslider-min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/imagesloaded.pkgd.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/store.js?ver=1" type="text/javascript"></script>  
</html>