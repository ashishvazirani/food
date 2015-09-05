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

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/intel/build/css/intlTelInput.css" rel="stylesheet">

<link href="<?php echo Yii::app()->request->baseUrl; ?>/assets/vendor/rupee/rupyaINR.css" rel="stylesheet" />


<?php Widgets::analyticsCode();?>

</head>
<body>

<div id="mobile-menu" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
      <ul class="uk-nav uk-nav-offcanvas uk-nav-parent-icon" data-uk-nav>                     
      <?php echo Yii::app()->functions->mobileMenu()?>      
	 </ul>	
    </div> <!--offcanvar bar-->
</div> <!--uk-offcanvas-->

<?php Widgets::languageBar();?>

<div class="header-wrap" id="header-wrap">
  <div class="main">
     <div class="uk-grid">
     
        <div class="section-mobile-menu-link">
           <a href="#mobile-menu" data-uk-offcanvas><i class="fa fa-bars"></i></a>
        </div>
     
        <div class="uk-width-1-3 top-a">
                          
          <div class="section-top section-to-menu-user">
          
            <?php $this->widget('zii.widgets.CMenu', Yii::app()->functions->topMenu());?>
                                   
            <?php if ( Yii::app()->functions->isClientLogin()):?>
            <div class="uk-button-dropdown" data-uk-dropdown="{mode:'click'}">
			    <button class="uk-button">
			       <i class="uk-icon-user"></i> <?php echo ucwords(Yii::app()->functions->getClientName());?> <i class="uk-icon-caret-down"></i>
			    </button>	    
			    <div class="uk-dropdown" style="">
			        <ul class="uk-nav uk-nav-dropdown">            	            
			            <li>
			            <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/Profile">
			            <i class="uk-icon-user"></i> <?php echo Yii::t("default","Profile")?></a>
			            </li>
			            <li>
			            <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/orderHistory">
			            <i class="fa fa-file-text-o"></i> <?php echo Yii::t("default","Order History")?></a>
			            </li>
			            
			            <li>
			            <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/addressbook">
			            <i class="fa fa-map-marker"></i> <?php echo Yii::t("default","Address Book")?></a>
			            </li>
			            
			            <?php if (Yii::app()->functions->getOptionAdmin('disabled_cc_management')==""):?>
			            <li>
			            <a href="<?php echo Yii::app()->request->baseUrl; ?>/store/Cards">
			            <i class="uk-icon-gear"></i> <?php echo Yii::t("default","Credit Cards")?></a>
			            </li>
			            <?php endif;?>
			            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/store/logout">
			            <i class="uk-icon-sign-out"></i> <?php echo Yii::t("default","Logout")?></a></li>
			        </ul>
			     </div>
			 </div> <!--uk-button-dropdown-->
		  <?php endif;?>
		              
          </div>
        </div>
        <div class="uk-width-1-3 top-b">
           <div class="logo-wrap">
             <?php $website_logo=yii::app()->functions->getOptionAdmin('website_logo');?>
             <?php $website_title=yii::app()->functions->getOptionAdmin('website_title');?>             
             <a href="<?php echo Yii::app()->request->baseUrl;?>/store">
             <?php if ( !empty($website_logo)):?>
             <img src="<?php echo Yii::app()->request->baseUrl."/upload/$website_logo";?>" alt="<?php echo $website_title;?>" title="<?php echo $website_title;?>">
             <?php else :?>
                <h1><?php echo $website_title?></h1>
             <?php endif;?>
             </a>
           </div>
        </div>
        <div class="uk-width-1-3 top-c">
          <div class="section-top section-right">
                      
            <?php $this->widget('zii.widgets.CMenu', Yii::app()->functions->topLeftMenu());?>                                  
            <div class="clear"></div>
            
            <div class="section-social">
            <?php $this->widget('zii.widgets.CMenu', Yii::app()->functions->socialMenu());?>            
            <div class="clear"></div>
            </div>               
            
          </div>                              
        </div>
     </div>
  </div> <!--END main-->
</div> <!--END header-wrap-->

<?php Widgets::orderBar();?>
<?php Widgets::merhantSignupBar();?>
<?php if (Yii::app()->functions->getOptionAdmin('enabled_advance_search')=="yes"):?>     
     <?php 
     if ( Yii::app()->controller->action->id =="index"):
         Widgets::searchAdvanced();
     endif;
     ?>     
<?php else :?>
     <?php Widgets::searchBox();?>
<?php endif;?>

<div class="content">
 <?php echo $content;?>
</div> <!--END content-->

<?php if ( Yii::app()->controller->action->id =="index"):?>
<?php if ( Yii::app()->functions->getOptionAdmin('disabled_featured_merchant')!="yes"):?>
<?php Widgets::featuredMerchant();?>
<?php endif;?>
<?php endif;?>

<div class="footer-wrap">

<div class="back-top" data-uk-scrollspy="{cls:'uk-animation-fade', repeat: true}" >
   <a href="#header-wrap" data-uk-smooth-scroll ><i class="fa fa-arrow-up"></i></a>
   <!--<a href="#header-wrap" class="to-top" data-uk-smooth-scroll ></a>-->
</div>

 <div class="main">
    <div class="uk-grid">
      <div class="uk-width-1-3 footer-address-wrap">
          <ul>           
           <li class="footer-address">
           <?php echo Yii::app()->functions->getOptionAdmin('website_address') ." ".yii::app()->functions->adminCountry();?>    </li>
           <li class="footer-contactphone">
             <?php echo Yii::t("default","Call Us")?> <?php echo Yii::app()->functions->getOptionAdmin('website_contact_phone');?>
           </li>
           <li class="footer-contactmail">
           <?php echo Yii::app()->functions->getOptionAdmin('website_contact_email');?>
          </li>
          </ul>
      </div>
      <div class="uk-width-1-3 footer-buttom-menu-wrap">         
         <?php $this->widget('zii.widgets.CMenu', Yii::app()->functions->bottomMenu());?>            
      </div>
      <div class="uk-width-1-3 footer-social-wrap">
         <p><?php echo Yii::t("default","Stay in touch")?></p>          
          <div class="footer-soocial">
          <?php $this->widget('zii.widgets.CMenu', Yii::app()->functions->socialMenu());?>            
          </div>
      </div>
    </div> <!--END uk-grid-->
 </div>
</div> <!--END footer-wrap-->

<div class="footer-sub">
  <div class="main">
     <div class="footer-a left">
     <p><?php echo Yii::t("default","Copyright")."&copy;".date("Y")?> <?php echo yii::app()->functions->getOptionAdmin('website_title')?></p>
     </div>
     
     <?php $disabled_subscription=Yii::app()->functions->getOptionAdmin('disabled_subscription')?>
     <?php if ($disabled_subscription!="yes"):?>
     <form method="POST" onsubmit="return false;" id="frm-subscribe" class="frm-subscribe">
     <?php echo CHtml::hiddenField('action','subscribeNewsletter')?>
     <div class="footer-b right">
     <div class="tbl-wraper">
        <div class="tbl-col">
        <p><?php echo t("Subscribe to our latest news")?>:</p>
        </div>
        <div class="tbl-col">
        <?php echo CHtml::textField('subscriber_email','',array(
         'placeholder'=>t("Your email")         
         ))?>
        </div>
        <div class="tbl-col">
        <?php echo CHtml::submitButton('submit_subscribe',array('value'=>t("Subscribe")))?>
        </div>
     </div> <!-- tbl-wraper-->    
     </div><!-- footer-b-->
     </form>
     <?php endif;?>
     
     <div class="clear"></div>
     
  </div>
</div> <!--END footer-sub-->

<?php echo CHtml::hiddenField('fb_app_id',Yii::app()->functions->getOptionAdmin('fb_app_id'))?>
<?php echo CHtml::hiddenField('admin_country_set',Yii::app()->functions->getOptionAdmin('admin_country_set'))?>
<?php echo CHtml::hiddenField('google_auto_address',Yii::app()->functions->getOptionAdmin('google_auto_address'))?>
<?php echo CHtml::hiddenField('google_default_country',Yii::app()->functions->getOptionAdmin('google_default_country'))?>
<?php echo CHtml::hiddenField('disabled_share_location',Yii::app()->functions->getOptionAdmin('disabled_share_location'))?>
<?php 
$website_date_picker_format=yii::app()->functions->getOptionAdmin('website_date_picker_format');
if (!empty($website_date_picker_format)){
	echo CHtml::hiddenField('website_date_picker_format',$website_date_picker_format);
}
$website_time_picker_format=yii::app()->functions->getOptionAdmin('website_time_picker_format');
if ( !empty($website_time_picker_format)){
	echo CHtml::hiddenField('website_time_picker_format',$website_time_picker_format);
}
echo CHtml::hiddenField('disabled_cart_sticky',Yii::app()->functions->getOptionAdmin('disabled_cart_sticky'));
?>

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

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl;?>/assets/vendor/intel/build/js/intlTelInput.js?ver=2.1.5"></script>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/store.js?ver=1" type="text/javascript"></script>  
</html>