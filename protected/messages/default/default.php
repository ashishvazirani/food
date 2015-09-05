<?php
/*if ( Yii::app()->functions->isTableExist("languages") ){	

	$action_front=array('searchArea','loadItemCart','loadReviews','viewFoodItem','loginModal',
	'clientLoginModal','forgotPassword','clientRegistrationModal','addToCart','clientLogin',
	'clientRegistration'
	);
	
	$lang_id='';		
	if ( Yii::app()->controller->id =="admin"){		
		$lang_id=Yii::app()->functions->getAdminLanguage();			
		
		if (isset($_REQUEST['action'])){
			if (in_array($_REQUEST['action'],(array)$action_front)){
				if (isset($_COOKIE['kr_lang_id'])){
				  $lang_id=empty($_COOKIE['kr_lang_id'])?"":$_COOKIE['kr_lang_id'];
			    } else {
				  $lang_id=Yii::app()->functions->getOptionAdmin('default_language');
			    }
			}
		}
					
	} elseif (Yii::app()->controller->id=="store") {				
		if (isset($_COOKIE['kr_lang_id'])){
			$lang_id=empty($_COOKIE['kr_lang_id'])?"":$_COOKIE['kr_lang_id'];
		} else {
			$lang_id=Yii::app()->functions->getOptionAdmin('default_language');
		}
	}
			
	return $t=Yii::app()->functions->getSourceTranslation($lang_id);
}*/
/*require_once("spanish.php");
return $lang;*/

$lang_id='';

switch (Yii::app()->controller->id) {
	case "store":		
	    $lang_id=empty($_COOKIE['kr_lang_id'])?"":$_COOKIE['kr_lang_id'];
		break;

	case "admin":	
	  
	   $lang_id=empty($_COOKIE['kr_admin_lang_id'])?"":$_COOKIE['kr_admin_lang_id'];	   
	   if (empty($lang_id)){	   	  
	   	  $lang_id=Yii::app()->functions->getAdminLanguage();
	   }	   
	   if (isset($_REQUEST['currentController'])){
	   	   if ($_REQUEST['currentController']=="merchant"){
	   	   	   $lang_id=empty($_COOKIE['kr_merchant_lang_id'])?"":$_COOKIE['kr_merchant_lang_id'];	   	    	   
	   	   //} else $lang_id=empty($_COOKIE['kr_lang_id'])?"":$_COOKIE['kr_lang_id'];	   	   
	   	   } else {
	   	   	   if ( $_REQUEST['currentController']=="store"){
	   	   	   	   $lang_id=empty($_COOKIE['kr_lang_id'])?"":$_COOKIE['kr_lang_id'];	   	   
	   	   	   } else $lang_id=empty($_COOKIE['kr_admin_lang_id'])?"":$_COOKIE['kr_admin_lang_id'];	   	   	   	   	   
	   	   }
	   }
	   break;

	case "merchant":   
	    $lang_id=empty($_COOKIE['kr_merchant_lang_id'])?"":$_COOKIE['kr_merchant_lang_id'];	   	    	   
	    if (empty($lang_id)){	   	  
	   	  $lang_id=Yii::app()->functions->getMerchantLanguage();	   	  
	    }	   	    
	    break;
	    
	default:
		break;
}

if (empty($lang_id)){
	$lang_id=Yii::app()->functions->getOptionAdmin('default_language');
	$_COOKIE['kr_lang_id']=$lang_id;
}

//echo "Languages ID:".$lang_id;
$language_pack=Yii::app()->functions->getSourceTranslationFile($lang_id);
return $language_pack;