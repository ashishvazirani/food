

<div class="page-right-sidebar" id="contact-page">
  <div class="main">
  <div class="inner">
  <?php
   $_GET=array_flip($_GET);   
   $slug=$_GET[''];
   ?>
  <?php if ($data=yii::app()->functions->getCustomPageBySlug($slug)):?>
  <h2><?php echo $data['page_name']?></h2>
    
  <p><?php echo $data['content']?></p>
  
  <?php   
  /*SET SEO META*/
  if (!empty($data['seo_title'])){
     $this->pageTitle=ucwords($data['seo_title']);
     Yii::app()->clientScript->registerMetaTag($data['seo_title'], 'title'); 
  }
  if (!empty($data['meta_description'])){   
     Yii::app()->clientScript->registerMetaTag($data['meta_description'], 'description'); 
  }
  if (!empty($data['meta_keywords'])){   
     Yii::app()->clientScript->registerMetaTag($data['meta_keywords'], 'keywords'); 
  }
  ?>
  
  <?php else :?>
  <p class="uk-text-danger"><i class="fa fa-info-circle"></i> <?php echo Yii::t("default","Sorry but we cannot find what you are looking for.")?></p>
  <?php endif;?>
  
  </div>
  </div> <!--main-->
</div> <!--page-->